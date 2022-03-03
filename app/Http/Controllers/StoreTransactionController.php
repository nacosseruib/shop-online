<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\UserProfileModel;
use App\Models\ProductImageModel;
use Session;
use Cache;
use View;

class StoreTransactionController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();

    }


    //View Order List
    public function createStoreOrder()
    {
        $data['getOrders']          = [];
        $data                       = [];
        $data['showPageOrder']      = 1;
        $data['openCategoryMenu']   = 0;
        $data['storeBannerPath']    = null;
        $productPath                = [];
        try{
            ###############check if user has a valid store or store has been suspended############
                if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $data['getOrders'] = Cache::remember('cacheKeyStoreOrder', $this->appCacheTime(), function ()
            {       $getStoreID = UserProfileModel::where('userID', $this->getUserID())->value('storeID');
                    $getOrders = CartModel::where($this->cartModel->getTable().'.is_order_placed', 1)->where($this->cartModel->getTable().'.checkout', 1)->where($this->cartModel->getTable().'.is_deliver_user_match', 1)->where($this->cartModel->getTable().'.store_token', $getStoreID)
                        ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.storeID', '=', $this->cartModel->getTable().'.store_token')
                        ->leftjoin($this->productModel->getTable(), $this->productModel->getTable().'.productID', '=', $this->cartModel->getTable().'.productID')
                        ->orderBy($this->cartModel->getTable().'.is_item_confirm_by_store', 'Desc')
                        ->orderBy($this->cartModel->getTable().'.updated_at', 'Desc')
                        ->select($this->cartModel->getTable().'.productID', 'original_price', 'product_name', 'quantity', 'store_token', 'transactionID', 'order_number', 'cartID', 'is_order_placed', 'is_cancel', 'is_deliver_user_match', $this->cartModel->getTable().'.updated_at', $this->cartModel->getTable().'.created_at', 'is_item_confirm_by_store')
                        ->paginate(30);
                    return $getOrders;
            });

            if(count($data['getOrders']) > 0)
            {
                foreach($data['getOrders'] as $key => $value)
                {
                    $path               = $this->downloadPath() . $this->getUserToken() . '/'. 'product/300x300/';
                    $productImages      = ProductImageModel::where('productID', $value->productID)->value('file_name');
                    $productPath[$key]  = $path . $productImages;
                }
            }
            $data['productPath']                 = $productPath;
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'StoreTransactionController@createStoreOrder', 'Error occured when trying to get store orders.' );
        }
        return $this->checkViewBeforeRender('store.storeOrder.orderPlacePage', $data);
    }


     //View Order List
     public function saveconfirmOrder(Request $request)
     {
         $success = 0;
        $this->validate($request,
        [
           'orderNumber'         => ['required', 'string', 'max:200'],
           'transactionNumber'   => ['required', 'string', 'max:200'],
        ]);
        try{
            $orderNumber        = $request['orderNumber'];
            $transactionNumber  = $request['transactionNumber'];
            if(CartModel::where('order_number', $orderNumber)->where('transactionID', $transactionNumber)->first())
            {
                $success = CartModel::where('order_number', $orderNumber)->where('transactionID', $transactionNumber)->update([
                    'is_item_confirm_by_store' => 1
                ]);
                if($success)
                {
                    return redirect()->route('storeOrder')->with('message', 'Your order was confirmed successfully.');
                }else{
                    return redirect()->route('storeOrder')->with('info', 'No update was performed on order.');
                }
            }else{
                return redirect()->back()->with('error', 'Sorry, you have entered invalid order number.');
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'StoreTransactionController@saveconfirmOrder', 'Error occured on post request when trying to confirm order number.' );
        }
        return redirect()->back()->with('error', 'Sorry, you have entered invalid order number.');
     }













    //View store setting
    public function createStoreSetting()
    {
        $data = [];
        try{
            ###############check if user has a valid store or store has been suspended############
                if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $data = $this->userStoreProfileDetails($this->getUserID());
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'StoreController@createStoreSetting', 'Error occured on GET Request when trying to view Store profile' );
        }
        return $this->checkViewBeforeRender('store.storeSetting.viewStoreProfile.profilePage', $data);
    }


    //Create Edit Store setting
    public function createEditStoreSetting()
    {
        Cache::forget('cacheKeyStoreProfile');
        $data = [];
        try{
            ###############check if user has a valid store or store has been suspended############
            if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $data = $this->userStoreProfileDetails($this->getUserID());
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'StoreController@createEditStoreSetting', 'Error occured on GET Request when trying to view store edit page' );
        }
        return $this->checkViewBeforeRender('store.storeSetting.editStore.editProfilePage', $data);
    }


    //store details
    public function userStoreProfileDetails($userID = null)
    {
        $data['getProfile']         = [];
        $data['showFilter']         = 0;
        $data['showPage']           = 1;
        $data['showPageProfile']    = 1;
        $data['openCategoryMenu']   = 0;
        $data['getProfile']     = null;
        $data['logoImage']  = null;
        $data['bannerImage']  = null;
        $this->userID  = $userID;
        try{
            ###############check if user has a valid store or store has been suspended############
            if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $data['userType'] = UserTypeModel::where('status', 1)->get();
            $data['allCurrency'] = CurrencyModel::where('status', 1)->get();

            if($userID <> null)
            {
                $data['getProfile'] = Cache::remember('cacheKeyStoreProfile', $this->appCacheTime(), function ()
                {
                    $profile = $this->getUserProfile($this->userID);
                    return $profile;
                });
                //logo
                $profileImage = ($data['getProfile'] ? $data['getProfile']->store_logo : null);
                $getImageAndPath300x300 = ($data['getProfile'] ? $data['getProfile']->user_token : null) .'/logo'. '/300x300'. '/'. $profileImage;
                $getImageAndPath = ($data['getProfile'] ? $data['getProfile']->user_token : null) .'/logo'. '/'. $profileImage;
                if(@getimagesize($getImageAndPath300x300))
                {
                    $data['logoImage'] = $this->downloadPath() . $getImageAndPath300x300;
                }elseif(@getimagesize($getImageAndPath)){
                    $data['logoImage'] = $this->downloadPath() . $getImageAndPath;
                }else{
                    $data['logoImage'] = $this->downloadPath() . 'assets/images/logoDefault.png';
                }
                //Banner
                $profileImage = ($data['getProfile'] ? $data['getProfile']->store_advert_banner : null);
                $getImageAndPath300x300 = ($data['getProfile'] ? $data['getProfile']->user_token : null) .'/banner'. '/300x300'. '/'. $profileImage;
                $getImageAndPath = ($data['getProfile'] ? $data['getProfile']->user_token : null) .'/probannerfile'. '/'. $profileImage;
                if(@getimagesize($getImageAndPath300x300))
                {
                    $data['bannerImage'] = $this->downloadPath() . $getImageAndPath300x300;
                }elseif(@getimagesize($getImageAndPath)){
                    $data['bannerImage'] = $this->downloadPath() . $getImageAndPath;
                }else{
                    $data['bannerImage'] = $this->downloadPath() . 'assets/images/bannerDefault.jpg';
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'StoreController@userStoreProfileDetails', 'Error occured when trying to query user profile' );
        }
        return $data;
    }


    //Update Edit Profile
    public function updateStoreSetting(Request $request)
    {
        $this->validate($request,
        [
             'storeName'            => ['required', 'string', 'min:3', 'max:200'],
             'phoneNumber'          => ['required', 'string', 'min:9', 'max:15'],
             'storeAddress1'        => ['required', 'string', 'max:200'],
             //'storeAddress2'      => ['required', 'string', 'max:255'],
             'storeDescription'     => ['required', 'string', 'max:255'],
        ]);
        //Validate Profile image
        if($request->hasFile('logo'))
        {
            $this->validate($request,
            [
                'logo'  => ['required', 'image', 'mimes:png,jpg,jpe,jpeg,gif', 'max: 3000'],
            ]);
        }
        if($request->hasFile('banner'))
        {
            $this->validate($request,
            [
                'banner'  => ['required', 'image', 'mimes:png,jpg,jpe,jpeg,gif', 'max: 3000'],
            ]);
        }
        try{
            ###############check if user has a valid store or store has been suspended############
            if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $userID = $this->getUserID();
            $success = 0;
            $getArrayResponseLogo = [];
            $getArrayResponseLogo['newFileName'] = null;
            $getArrayResponseBanner = [];
            $getArrayResponseBanner['newFileName'] = null;
            $oldLogo    = UserProfileModel::where('userID', $userID)->value('store_logo');
            $oldBanner  = UserProfileModel::where('userID', $userID)->value('store_advert_banner');
            $uploadCompletePathNameLogo = $this->uploadPath() . 'logo/';
            $uploadCompletePathNameThumbnail300X300Logo = $uploadCompletePathNameLogo . '300x300/';
            $uploadCompletePathNameThumbnail500X500Logo = $uploadCompletePathNameLogo . '500x500/';
            $uploadCompletePathNameBanner = $this->uploadPath() . 'banner/';
            $uploadCompletePathNameThumbnail300X300Banner = $uploadCompletePathNameBanner . '300x300/';
            $uploadCompletePathNameThumbnail500X500Banner = $uploadCompletePathNameBanner . '500x500/';

            //Upload logo and banner
            if($request->hasFile('logo'))
            {
                $getArrayResponseLogo = $this->uploadAnyFile($request['logo'], $uploadCompletePathNameLogo, $maxFileSize = 5, $newExtension = null, $newRadFileName = true);
            }
            if($request->hasFile('banner'))
            {
                $getArrayResponseBanner = $this->uploadAnyFile($request['banner'], $uploadCompletePathNameBanner, $maxFileSize = 5, $newExtension = null, $newRadFileName = true);
            }
           if(!UserProfileModel::where('userID', '<>', $userID)->where('store_phone_number', $request['phoneNumber'])->first())
           {
                $success =  UserProfileModel::where('userID', $userID)->update([
                    'store_name'                => $request['storeName'],
                    'store_phone_number'        => $request['phoneNumber'],
                    'store_address1'            => $request['storeAddress1'],
                    'store_address2'            => $request['storeAddress1'],
                    'store_description'         => $request['storeDescription'],
                    'store_logo'                => (($getArrayResponseLogo && $getArrayResponseLogo['newFileName']) ? $getArrayResponseLogo['newFileName'] : $oldLogo),
                    'store_advert_banner'       => (($getArrayResponseBanner && $getArrayResponseBanner['newFileName']) ? $getArrayResponseBanner['newFileName'] : $oldBanner),
                    'updated_at'                => date('Y-m-d h:i:s a'),
                ]);
                if($request->hasFile('logo') && $getArrayResponseLogo)
                {
                    //Resize Product Thumbnail - 300X300
                    $this->createThumbnail($uploadCompletePathNameLogo . $getArrayResponseLogo['newFileName'], $uploadCompletePathNameThumbnail300X300Logo . $getArrayResponseLogo['newFileName'], $width = 300, $height = 300, $is_resize_canvas = 0);
                    //Resize Product Thumbnail - 500X500
                    $this->createThumbnail($uploadCompletePathNameLogo . $getArrayResponseLogo['newFileName'], $uploadCompletePathNameThumbnail500X500Logo . $getArrayResponseLogo['newFileName'], $width = 500, $height = 500, $is_resize_canvas = 0);

                    //UNLINK previous Image - $oldFileName
                }
                if($request->hasFile('banner') && $getArrayResponseBanner)
                {
                    //Resize Product Thumbnail - 300X300
                    $this->createThumbnail($uploadCompletePathNameBanner . $getArrayResponseBanner['newFileName'], $uploadCompletePathNameThumbnail300X300Banner . $getArrayResponseBanner['newFileName'], $width = 300, $height = 300, $is_resize_canvas = 0);
                    //Resize Product Thumbnail - 500X500
                    $this->createThumbnail($uploadCompletePathNameBanner . $getArrayResponseBanner['newFileName'], $uploadCompletePathNameThumbnail500X500Banner . $getArrayResponseBanner['newFileName'], $width = 500, $height = 500, $is_resize_canvas = 0);

                    //UNLINK previous Image - $oldFileName
                }
           }else{
               return redirect()->back()->with('error', 'Sorry, this phone number has been taken.');
           }
           if($success)
           {
                return redirect()->route('viewStoreSetting')->with('message', 'Your store profile was updated successfully.');
           }
        }catch(\Throwable $errorThrown)
        {
           $this->storeTryCatchError($errorThrown, 'StoreController@updateStoreSetting', 'Error occured on POST Request when updating user store profile.');
        }
        return redirect()->back()->with('info', 'Sorry, no update was performed on your store profile.');
    }


    ######################## BLOCKED PRODUCT ##########
    public function createBlockedProduct()
    {
        $getAllData                     = [];
        $data                           = [];
        $data['showPageBlockedProduct'] = 1;
        $data['openCategoryMenu']       = 0;
        try{
            ###############check if user has a valid store or store has been suspended############
                if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $getAllData = Cache::remember('cacheKeyBlockedProduct', $this->appCacheTime(), function ()
            {
                $getObject = $this->getAnyProduct($paginate = 24, $userID = $this->getUserID(), $adminStatus = 0, $isOnline = null, $isDeleted = 0, $orderBy = '.created_at', $randomData = false, $categoryID = null, $collectionID = null, $pick = null);
                return $getObject;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'StoreController@createBlockedProduct', 'Error occured on GET Request when trying to view all blocked products' );
        }
        return $this->checkViewBeforeRender('store.blockedProducts.homePage', $getAllData)->with($data);
    }



}//end class
