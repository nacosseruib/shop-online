<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MessageInboxController;

use App\Library\AnyFileUploadClass;
use App\Library\RandomAlphaNumericClass;

use App\Models\ErrorCaughtModel;
use App\Models\UserProfileModel;
use App\Models\CurrencyModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\CollectionModel;
use App\Models\ColourModel;
use App\Models\SizeModel;
use App\Models\ProductImageModel;
use App\Models\User;
use App\Models\UserTypeModel;
use App\Models\CartModel;
use App\Models\CheckoutPoolModel;
use App\Models\StorePlanModel;
use App\Models\UserProductColourModel;
use App\Models\UserProductSizeModel;
use App\Models\ProductCommentModel;
use App\Models\MessageInboxModel;
use App\Models\DeliveredUserProductModel;
use App\Models\UserAmountLevelModel;
use App\Models\AmountLevelModel;
use App\Models\DeliveryAgentModel;
use App\Models\AgentIDCardModel;
use App\Models\AgentOrderNumberModel;
use App\Models\AgentRatingModel;

use Session;
use Cache;
use Image;
use Auth;
use View;



class BaseParentController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');

        $this->getAllModel();
    }

    // all model
    public function getAllModel()
    {
        $this->productModel                 = new ProductModel;
        $this->categoryModel                = new CategoryModel;
        $this->collectionModel              = new CollectionModel;
        $this->colourModel                  = new ColourModel;
        $this->currencyModel                = new CurrencyModel;
        $this->userProfileModel             = new UserProfileModel;
        $this->sizeModel                    = new SizeModel;
        $this->userTypeModel                = new UserTypeModel;
        $this->cartModel                    = new CartModel;
        $this->checkoutPoolModel            = new CheckoutPoolModel;
        $this->storePlanModel               = new StorePlanModel;
        $this->user                         = new User;
        $this->userProductColourModel       = new UserProductColourModel;
        $this->userProductSizeModel         = new UserProductSizeModel;
        $this->productCommentModel          = new ProductCommentModel;
        $this->messageInboxModel            = new MessageInboxModel;
        $this->deliveredUserProductModel    = new DeliveredUserProductModel;
        $this->userAmountLevelModel         = new UserAmountLevelModel;
        $this->amountLevelModel             = new AmountLevelModel;
        $this->deliveryAgentModel           = new DeliveryAgentModel;
        $this->agentIDCardModel             = new AgentIDCardModel;
        $this->agentOrderNumberModel        = new AgentOrderNumberModel;
        $this->agentRatingModel             = new AgentRatingModel;


        return;
    }

    ############### LIVE SEARCH ANY PRODUCT###########
    public function searchProductFromDB($getQuery = null)
    {
        $getAllMatchProducts = array();
        $reservedSymbols = ['<', '>', '@', '(', ')', '~', '|', '/', '{', '}', '[', ']'];
        $searchQuery = preg_split('/\s+/', $getQuery, -1, PREG_SPLIT_NO_EMPTY);
        //$searchQuery = str_replace($reservedSymbols, '', $searchQuery);
        if(!empty($getQuery))
        {
            try{
                //$getQuery = $_GET['term'];
                $getAllMatchProducts = ProductModel::query()->where($this->productModel->getTable().'.is_online', 1)->where($this->productModel->getTable().'.admin_status', 1)->where($this->productModel->getTable().'.is_deleted', 0)
                ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                ->select($this->productModel->getTable().'.categoryID', $this->productModel->getTable().'.userID', $this->productModel->getTable().'.productID', $this->categoryModel->getTable().'.category', $this->productModel->getTable().'.product_name', $this->userProfileModel->getTable().'.store_description', $this->userProfileModel->getTable().'.store_name')
                ->orderBy($this->productModel->getTable().'.product_name', 'Asc')
                ->where(function ($query) use ($searchQuery)
                {
                    foreach ($searchQuery as $value)
                    {
                        $query->orWhere($this->categoryModel->getTable().'.category', 'like', "%{$value}%");
                        $query->orWhere($this->userProfileModel->getTable().'.store_name', 'like', "%{$value}%");
                        $query->orWhere($this->userProfileModel->getTable().'.store_description', 'like', "%{$value}%");
                        $query->orWhere($this->productModel->getTable().'.product_name', 'like', "%{$value}%");
                    }
                })
                //->take(10)
                ->get();
                return $getAllMatchProducts;
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'BaseParentController@searchProductFromDB', 'Error occured when trying to search for product/store.');
            }
            return $getAllMatchProducts;
        }else{
             return $getAllMatchProducts;
        }
    }
    ######## END LIVE SEARCH #############


    ################# sort By ################
    public function filterSortBy(Request $request)
    {
        /* Session::forget('sortBy');
        Session::forget('online');
        Session::forget('random');
        Session::forget('orderBy');
        Session::forget('orderType');
        */

        $sortBy = $request['sortBy'];
        Session::forget('orderType');

        if($sortBy == 'All')
        {
            Session::put('online', null);
            Session::put('random', false);
            Session::put('orderBy', '.created_at');
            Session::put('orderType', 'Desc');
        }elseif($sortBy == 'online')
        {
            Session::put('online', 1);
        }elseif($sortBy == 'offline')
        {
            Session::put('online', 2);
        }elseif($sortBy == 'ascending')
        {
            Session::put('online', null);
            Session::put('orderBy', '.product_name');
            Session::put('orderType', 'Asc');
            Session::put('random', false);
        }elseif($sortBy == 'descending')
        {
            Session::put('online', null);
            Session::put('orderBy', '.product_name');
            Session::put('orderType', 'Desc');
            Session::put('random', false);
        }elseif($sortBy == 'random')
        {
            Session::put('online', null);
            Session::put('random', true);
            Session::put('orderBy', '.created_at');
            Session::put('orderType', 'Desc');
        }
        Session::put('sortBy', $sortBy);

        return redirect()->back();
    }


    //Return Integer - Cache Time - 30Mininutes
    public function appCacheTime($getTime = 1)
    {
        return $getTime;
    }

    //Return Integer - Cache Time - 30Mininutes
    public function maximumCartAmountUserCanCheckOut($amount = 30000.00)
    {
        $userLevelAmount = UserAmountLevelModel::where('userID', $this->getUserID())
                        ->join($this->amountLevelModel->getTable(), $this->amountLevelModel->getTable().'.stage', '=', $this->userAmountLevelModel->getTable().'.level')
                        ->value($this->amountLevelModel->getTable().'.amount');
        if($userLevelAmount)
        {
            return $userLevelAmount;
        }else{
            return $amount;
        }
    }

    //User Level Update function
    public function updateUserLevelFunction($userID = null, $newLevel = 0)
    {
        return $success = UserAmountLevelModel::updateOrCreate(
                ['userID'  => $userID],
                [
                    'level'       => $newLevel,
                    'updated_at'  => date('Y-m-d h:i:s a')
                ]
            );
    }

    //Update User State
    public function updateUserLevel($userID = null)
    {
        $userID     = ($userID ? $userID : $this->getUserID());
        $success    = 0;
        try{
            $countUserDelivery  = DeliveredUserProductModel::where('userID', $userID)->count();
            $amountLevels       = AmountLevelModel::where('status', 1)->select('delivery_no', 'stage')->orderBy('amount_levelID', 'Desc')->get();
            if($amountLevels)
            {
                foreach($amountLevels as $item)
                {
                    if($countUserDelivery >= $item->delivery_no)
                    {
                        $success = $this->updateUserLevelFunction($userID, $item->stage);
                        break;
                    }
                }
            }
        } catch (\Throwable  $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'BaseParentController@updateUserLevel', 'Error occured when trying to update user maximum amount level.' );
        }
        return $success;
    }

    //Check if User is an agent
    public function getUserAgentStatus($userID = null)
    {
        $isAgent = 0;
        $userID = ($userID == null ? $this->getUserID() : $userID);
        if($userID <> null)
        {
            $isAgent = DeliveryAgentModel::where('userID', $userID)->count();
        }
        return $isAgent;
    }


    //Return String - Get User ID that logs in
    public function getUserID()
    {
        return (Auth::check() ? Auth::user()->id : null);
    }

    //Return String - Get User Token that logs in
    public function getUserToken()
    {
        return (Auth::check() ? Auth::user()->user_token : null);
    }

    //Can i buy my uploaded product
    public function buyMyProduct($buyProduct = 0)
    {
        return ($buyProduct ? $buyProduct : 0);
    }

    //GET USER BANNER
    public function getUserStoreBanner($userID = null, $folderName = "banner")
    {
        $storeBannerPath = null;
        try{
            if($userID <> null)
            {
                $getStoreDetails   = UserProfileModel::where('userID', $userID)->first();
                $getAllPaths = $this->getUserPathImage($userID, ($getStoreDetails ? $getStoreDetails->store_advert_banner : null), $folderName = $folderName);
                $storeBannerPath = $getAllPaths['filePathBig'];
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getUserStoreBanner', 'Error occured when trying to get user store banner.' );
        }

        return $storeBannerPath;
    }


    //GET AGENT PASSPORT
    public function getAgentProfilePicture($userID = null, $folderName = "profile")
    {
        $storeBannerPath = null;
        try{
            if($userID <> null)
            {
                $getDetails   = DeliveryAgentModel::where('userID', $userID)->first();
                $getAllPaths = $this->getUserPathImage($userID, ($getDetails ? $getDetails->picture : null), $folderName = $folderName);
                $storeBannerPath = $getAllPaths['filePath300x300'];
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getAgentProfilePicture', 'Error occured when trying to get agent profile image.' );
        }

        return $storeBannerPath;
    }

    //GET AGENT ID CARD
    public function getAgentIDCard($userID = null, $folderName = "IDCard")
    {
        $storeBannerPath = [];
        try{
            if($userID <> null)
            {
                $getDetails   = AgentIDCardModel::where('userID', $userID)->get();
                foreach($getDetails as $key=>$value)
                {
                    $getAllPaths = $this->getUserPathImage($userID, ($getDetails ? $value->file_name : null), $folderName = $folderName);
                    $storeBannerPath[$key] = $getAllPaths['filePath300x300'];
                }

            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getAgentProfilePicture', 'Error occured when trying to get agent profile image.' );
        }

        return $storeBannerPath;
    }


    //Get user name
    public function getUserFullName($userID = null)
    {
        $userFullName = null;

        if($userID <> null)
        {
            try{
                $getUser = UserProfileModel::where($this->userProfileModel->getTable().'.userID', $userID)
                                ->select('first_name', 'last_name')
                                ->first();
                $userFullName = ($getUser ? $getUser->first_name .' '. $getUser->last_name : null);
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'BaseParentController@getUserFullName', 'Error occured when trying to get user full name' );
            }
        }
        return $userFullName;
    }


    //Get user profile
    public function getUserProfile($userID = null)
    {
        $userProfile = null;

        if($userID <> null)
        {
            try{
                $userProfile = UserProfileModel::where($this->userProfileModel->getTable().'.userID', $userID)->where($this->userProfileModel->getTable().'.status', 1)
                                ->leftjoin($this->userTypeModel->getTable(), $this->userTypeModel->getTable().'.user_typeID', '=', $this->userProfileModel->getTable().'.user_typeID')
                                ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->userProfileModel->getTable().'.userID')
                                ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->userProfileModel->getTable().'.currencyID')
                                ->leftjoin($this->storePlanModel->getTable(), $this->storePlanModel->getTable().'.premiumID', '=', $this->userProfileModel->getTable().'.store_premium')
                                ->select($this->userProfileModel->getTable().'.*', $this->currencyModel->getTable().'.*', 'user_token', 'is_store_suspended', $this->user->getTable().'.email', $this->user->getTable().'.username',
                                $this->user->getTable().'.id as userID', $this->user->getTable().'.password', $this->userTypeModel->getTable().'.type_name', $this->userTypeModel->getTable().'.user_typeID', $this->storePlanModel->getTable().'.*',)
                                ->first();
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'BaseParentController@getUserProfile', 'Error occured when trying to get user profile' );
            }
        }
        return $userProfile;
    }

    //Allow to delete or update product
    public function isAllowToDeleteEditProduct($isAllowToDeleteEdit = 0)
    {
        return ($isAllowToDeleteEdit ? $isAllowToDeleteEdit : 0);
    }

    //Return Numeric - check and Get user Type
    public function getUserType()
    {
        $checkUserTypeID = null;
        try{
            $userType = UserProfileModel::where('userID', $this->getUserID())->where('is_store_suspended', 0)->where('status', 1)->value('user_typeID');
            $checkUserTypeID = UserTypeModel::where('is_store', 1)->where('status', 1)->where('user_typeID', $userType)->value('user_typeID');
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getUserType', 'Error occured when trying to get user type ID.' );
        }
        return $checkUserTypeID;
    }

    //Suspend Store
    public function suspendStore($userID = null)
    {
        $success = 0;
        try{
            if($userID <> null && User::find($userID))
            {
                $success = UserProfileModel::where('userID', $userID)->update(['is_store_suspended' => 1, 'updated_at' => date('Y-m-d')]);
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@suspendStore', 'Error occured when trying to suspend store' );
        }
        return $success;
    }

    //Activate Store
    public function activateStore($userID = null)
    {
        $success = 0;
        try{
            if($userID <> null && User::find($userID))
            {
                $success = UserProfileModel::where('userID', $userID)->update(['is_store_suspended' => 0, 'updated_at' => date('Y-m-d')]);
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@activateStore', 'Error occured when trying to active store' );
        }
        return $success;
    }

    //Return View - Check view if exist before rendering the view blade
    public function checkViewBeforeRender($getView = null, $data1 = [], $data2 = [], $data3 = [], $data4 = [], $data5 = [])
    {
        if($getView <> null)
        {
            try{
                return (View::exists($getView) ? view($getView, $data1, $data2, $data3, $data4, $data5) : redirect()->route('index'));
            }catch(\Throwable $errorThrown)
            {
                $this->storeTryCatchError($errorThrown, 'BaseParentController@checkViewBeforeRender', 'Error occured when trying to check if view/blade exist before rendering the view/blade.' );
                return redirect()->route('index');
            }
        }else{
            return redirect()->route('index');
        }
    }

    //Return No Value : Void - Store any error that occurred in try-catch block
    public function storeTryCatchError($getError = null, $getFunctionModuleName = null, $errorDescription = null )
    {
        try{
            return ErrorCaughtModel::create([
                'throwable_error'       => ($getError <> null ? $getError : 'No error occured'),
                'function_module_name'  => $getFunctionModuleName,
                'error_description'     => $errorDescription,
                'created_at'            => date('Y-m-d h:i:sa'),
                'updated_at'            => date('Y-m-d h:i:sa')
            ]);
        }catch(\Throwable $errorThrown){}
    }

    //Return Array of String/Numeric - Reuseable Image File Upload Module
    public function uploadAnyFile($file = null, $uploadCompletePathName = null, $maxFileSize = 10, $newExtension = null, $newRadFileName = true)
    {
         $data = new AnyFileUploadClass($file, $uploadCompletePathName, $maxFileSize, $newExtension, $newRadFileName);
         return $data->return();
     }//end function


     //Return String - Reuseable Random AlphaNumeric  Module
    public function generateRandomAlphaNumeric($getLength = 10)
    {
         $data = new RandomAlphaNumericClass($getLength);
         return $data->return();
     }//end function


     //Return String - Upload Path
     public function uploadPath()
     {
        return $this->getUploadPath = env('UPLOADPATHROOT', null) . $this->getUserToken() .'/';
     }

    //Return String - Download Path
    public function downloadPath()
    {
        return $this->getDownloadPath = env('DOWNLOADPATHROOT', null);
    }

    //Get User path image
    public function getUserPathImage($userID = null, $file = null, $folderName = null)
    {
        $data['filePathbest']       = null;
        $data['filePath300x300']    = null;
        $data['filePath500x500']    = null;
        $data['filePathBig']           = null;
        if($userID <> null)
        {
            try{
                $userToken = User::where('id', $userID)->value('user_token');
                $getImageAndPath300x300     = ($userToken ? $userToken : null) .'/'. $folderName .'/300x300'. '/'. $file;
                $getImageAndPath500x500     = ($userToken ? $userToken : null) .'/'. $folderName .'/500x350'. '/'. $file;
                $getImageAndPath            = ($userToken ? $userToken : null) .'/'. $folderName .'/'. $file;
                if(@getimagesize($getImageAndPath300x300))
                {
                    $data['filePathbest'] = $this->downloadPath() . $getImageAndPath300x300;
                }elseif(@getimagesize($getImageAndPath500x500)){
                    $data['filePathbest'] = $this->downloadPath() . $getImageAndPath500x500;
                }else{
                    $data['filePathbest'] = $this->downloadPath() . $getImageAndPath;
                }
                $data['filePath300x300']    = $this->downloadPath() . $getImageAndPath300x300;
                $data['filePath500x500']    = $this->downloadPath() . $getImageAndPath500x500;
                $data['filePathBig']        = $this->downloadPath() . $getImageAndPath;
            }catch(\Throwable $errorThrown)
            {
               $this->storeTryCatchError($errorThrown, 'BaseParentController@getUserPathImage', 'Error occured when trying to get file path.');
            }
        }
        return $data;
    }

    //Return String - Get User Currncy
    public function getUserCurrency($userID = null)
    {
        $currencyCode = '$';
        if($userID <> null)
        {
            try{
                $getCurrency = UserProfileModel::where('userID', $userID)->select('currencyID')->first();
                $getCurrencyID = ($getCurrency ? $getCurrency->currencyID : null);
                $getCurrencyCode = CurrencyModel::find($getCurrencyID);
                $currencyCode = ($getCurrencyCode ? $getCurrencyCode->currency_symbol : null);
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'BaseParentController@getUserCurrency', 'Error occured when trying to get user currency symbol' );
            }
        }
        return $currencyCode;
    }

    //Return Integer - Get User CurrncyID
    public function getUserCurrencyID($userID = null)
    {
        $getCurrencyID = null;
        if($userID <> null)
        {
            try{
                $getCurrencyID = UserProfileModel::where('userID', $userID)->value('currencyID');
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'BaseParentController@getUserCurrencyID', 'Error occured when trying to get user currency ID' );
            }
        }
        return $getCurrencyID;
    }

    //Return Numeric Value - Remove comma from string
    public function removeCommaFromString($getString = null)
    {
        $numericString = 0;
        try{
            if($getString != null || $getString != 0)
            {
                $stringWithNoComma = str_replace( ',', '', $getString );

                if( is_numeric( $stringWithNoComma) ) {
                    $numericString = $stringWithNoComma;
                }else{
                    $numericString = (int)$stringWithNoComma;
                }
            }else{
                $numericString = $getString;
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@removeCommaFromString', 'Error occured when trying to remove comma from string' );
        }
        return $numericString;
    }

    //Return Nothing : Void - Create Image Thumbnail after upload the image to a path
    public function createThumbnail($pathSource = null, $pathDestination = null, $width = 300, $height = 300, $is_resize_canvas = 1)
    {
        if($pathDestination != null)
        {
            try{
                //copy file
                ($pathSource ? copy($pathSource, $pathDestination) : null);

                //Resize Image with canvas
                $img = Image::make($pathDestination)->resize(($width - (($is_resize_canvas ? $width/4 : 0))), ($height - (($is_resize_canvas ? $width/4 : 0))), function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas($width, $height, 'center', false, '#ffffff');

                $img->save($pathDestination);

            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'BaseParentController@createThumbnail', 'Error occured when trying to create image thumbnail' );
            }
        }
        return;
    }


    //Get Cart
    public function getItemInCart($userID = null, $cartStatus = 1, $isOrderPlaced = 0, $isCancel = 0, $orderBy = 'Desc', $orderNumber = [])
    {
        $data                       = [];
        $data['cartData']           = [];
        $this->userID               = $userID;
        $this->cartStatus           = $cartStatus;
        $this->isOrderPlaced        = $isOrderPlaced;
        $this->isCancel             = $isCancel;
        $this->orderBy              = $orderBy;
        $this->orderNumber          = $orderNumber;
        $data['itemInCart']         = [];
        $data['totalCartAmount']    = 0.00;
        $data['productPath']        = null;
        $data['productImages']      = null;
        $data['productPath300x300'] = '300x300/';
        $data['productPath500x500'] = '500x500/';
        $data['itemQuantity']       = 0;

        if($this->userID && Auth::check())
        {
            try{
                $data = Cache::remember('cacheKeyItemICartProduct', $this->appCacheTime(), function ()
                {
                    $totalCartAmount        = 0.00;
                    $productPath            = null;
                    $productImages          = [];
                    $totalQuantity          = 0;
                    $productPath            = [];
                    $productImages          = [];
                    if($this->orderNumber == [])
                    {
                        $getAllCartItems = CartModel::where($this->cartModel->getTable().'.userID', $this->userID)->where($this->cartModel->getTable().'.status', $this->cartStatus)->where('is_order_placed', $this->isOrderPlaced)
                        ->leftjoin($this->productModel->getTable(), $this->productModel->getTable().'.productID', '=', $this->cartModel->getTable().'.productID')
                        ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                        ->orderBy($this->cartModel->getTable().'.cartID', $this->orderBy)
                        ->select($this->cartModel->getTable() .'.userID', $this->cartModel->getTable() .'.created_at', $this->cartModel->getTable().'.productID', 'product_code',
                        'transactionID', 'cartID', 'quantity', 'brand', 'is_available', 'original_price', 'user_token', 'old_price', 'product_name', 'delivery_code', 'order_number')
                        ->get();
                    }else{
                        $getAllCartItems = CartModel::where($this->cartModel->getTable().'.userID', $this->userID)->where($this->cartModel->getTable().'.status', $this->cartStatus)->where('is_order_placed', $this->isOrderPlaced)
                        ->whereIn($this->cartModel->getTable().'.order_number', $this->orderNumber)
                        ->leftjoin($this->productModel->getTable(), $this->productModel->getTable().'.productID', '=', $this->cartModel->getTable().'.productID')
                        ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                        ->orderBy($this->cartModel->getTable().'.cartID', $this->orderBy)
                        ->select($this->cartModel->getTable() .'.userID', $this->cartModel->getTable() .'.created_at', $this->cartModel->getTable().'.productID', 'product_code',
                        'transactionID', 'cartID', 'quantity', 'brand', 'is_available', 'original_price', 'user_token', 'old_price', 'product_name', 'delivery_code', 'order_number')
                        ->get();
                    }

                    if(count($getAllCartItems) > 0)
                    {
                        foreach($getAllCartItems as $key => $value)
                        {
                            $totalCartAmount        += ($value->quantity * $value->original_price);
                            $totalQuantity          += $value->quantity;
                            $productPath[$key]      = $this->downloadPath() . $value->user_token . '/'. 'product/';
                            $productImages[$key]    = ProductImageModel::where('productID', $value->productID)->value('file_name');
                        }
                    }
                    $data['itemInCart']                 = $getAllCartItems;
                    $data['totalCartAmount']            = $totalCartAmount;
                    $data['productPath']                = $productPath;
                    $data['productImages']              = $productImages;
                    $data['productPath300x300']         = '300x300/';
                    $data['productPath500x500']         = '500x500/';
                    $data['itemQuantity']               = $totalQuantity;

                    return $data;
                });
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'BaseParentController@getItemInCart', 'Error occured when trying to get items in cart' );
            }
        }

        return $data;
    }




    //Get Any Product
    public function getAnyProduct($paginate = 24, $userID = null, $adminStatus = 1, $isOnline = null, $isDeleted = 0, $orderBy = '.created_at', $randomData = false, $categoryID = null, $collectionID = null, $pickRecord = null)
    {
        $this->paginate     = $paginate;
        $this->userID       = $userID;
        $this->adminStatus  = $adminStatus;
        $this->isOnline     = $isOnline;
        $this->isDeleted    = $isDeleted;
        $this->orderBy      = $orderBy;
        $this->random       = $randomData;
        $this->categoryID   = $categoryID;
        $this->collectionID = $collectionID;
        $this->pickRecord   = $pickRecord;
        $returnProduct      = [];

        try{
            $returnProduct = Cache::remember('cacheKeyAnyProduct', $this->appCacheTime(), function ()
            {
                $getProductImages           = [];
                $getProductCoverImage       = [];
                $getProduct                 = [];
                $productPath                = [];

                //Get Product
                $getProduct = $this->getMyProduct($this->paginate, $this->userID, $this->adminStatus, $this->isOnline, $this->isDeleted, $this->orderBy, $this->random, $this->categoryID, $this->collectionID, $this->pickRecord);

                //get all images
                if($getProduct)
                {
                    foreach($getProduct as $key => $productValue)
                    {
                        if($this->userID == null)
                        {
                            $getProductImages[$key]      = ProductImageModel::where('productID', $productValue->productIDField)->select('file_name', 'file_description')->get();
                            $getProductCoverImage[$key]  = ProductImageModel::where('productID', $productValue->productIDField)->inRandomOrder()->value('file_name');
                        }else{
                            $getProductImages[$key]      = ProductImageModel::where('userID', $this->userID)->where('productID', $productValue->productIDField)->select('file_name', 'file_description')->get();
                            $getProductCoverImage[$key]  = ProductImageModel::where('userID', $this->userID)->where('productID', $productValue->productIDField)->value('file_name'); //->inRandomOrder()
                        }
                        $productPath[$key]               = $this->downloadPath() . $productValue->user_token . '/'. 'product/';
                    }
                }


                $data['productImages']              = $getProductImages;
                $data['productCoverImage']          = $getProductCoverImage;
                $data['getProduct']                 = $getProduct;

                $data['productPath']                = $productPath;
                $data['productPath300x300']         = '300x300/';
                $data['productPath500x500']         = '500x500/';
                $data['productUserPath']            = $this->downloadPath() . $this->getUserToken() . '/'. 'product/';
                //Setting
                $data['canIBuyMyProduct']           = $this->buyMyProduct($yes = 1);//can i buy my product my self?
                $data['isAllowToDeleteEditProduct'] = $this->isAllowToDeleteEditProduct($yes = 1);
                $data['openCategoryMenu']           = 0;

                return $data;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getAnyProduct', 'Error occured when trying to get all/any products' );
        }
        return $returnProduct;
    }



    //Get All Products
    public function getMyProduct($paginate = 24, $userID = null, $adminStatus = 1, $isOnline = 1, $isDeleted = 0,  $orderBy = '.created_at', $randomData = false, $categoryID = null, $collectionID = null, $pickRecord = null)
    {
        $data       = [];
        $orderType  = Session::get('orderType', 'Desc');
        $orderBy    = Session::get('orderBy', $orderBy);
        $randomData = Session::get('random', $randomData);

        try{
            if($userID == null)
            {
                if($isOnline == null)
                {
                    if($categoryID == null)
                    {
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->inRandomOrder()
                                    ->take($pickRecord)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->inRandomOrder()
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->take($pickRecord)
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }
                    }else{
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                ->where(function ($query) use ($categoryID, $collectionID) {
                                    $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                        ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                })
                                ->inRandomOrder()
                                ->take($pickRecord)
                                ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                    })
                                    ->inRandomOrder()
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                    })
                                    ->take($pickRecord)
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                    })
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }
                    }
                }else{
                    if($categoryID == null)
                    {
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->inRandomOrder()
                                    ->take($pickRecord)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->inRandomOrder()
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->take($pickRecord)
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }
                    }else{
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                    })
                                    ->inRandomOrder()
                                    ->take($pickRecord)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                    })
                                    ->inRandomOrder()
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=', $collectionID);
                                    })
                                    ->take($pickRecord)
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=', $collectionID);
                                    })
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }
                    }
                }
            }else{
                if($isOnline == null)
                {
                    if($categoryID == null)
                    {
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->inRandomOrder()
                                    ->take($pickRecord)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->inRandomOrder()
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->take($pickRecord)
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }
                    }else{
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=', $collectionID);
                                    })
                                    ->inRandomOrder()
                                    ->take($pickRecord)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=', $collectionID);
                                    })
                                    ->inRandomOrder()
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }

                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                    })
                                    ->take($pickRecord)
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                    })
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }
                    }

                }else{
                    if($categoryID == null)
                    {
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                ->inRandomOrder()
                                ->take($pickRecord)
                                ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                ->inRandomOrder()
                                ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                ->paginate($paginate);
                            }
                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->take($pickRecord)
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }
                        }
                    }else{
                        if($randomData)
                        {
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=', $collectionID);
                                    })
                                    ->inRandomOrder()
                                    ->take($pickRecord)
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                    ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                    ->where(function ($query) use ($categoryID, $collectionID) {
                                        $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                            ->orWhere($this->productModel->getTable().'.collectionID','=', $collectionID);
                                    })
                                    ->inRandomOrder()
                                    ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                    ->paginate($paginate);
                            }

                        }else{
                            if($pickRecord)
                            {
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                ->where(function ($query) use ($categoryID, $collectionID) {
                                    $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                        ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                })
                                ->take($pickRecord)
                                ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                ->get();
                            }else{
                                $data = ProductModel::where('admin_status', $adminStatus)->where($this->productModel->getTable().'.userID', $userID)->where('is_deleted', $isDeleted)->where('is_online', ($isOnline == 2 ? 0 : $isOnline))->where($this->productModel->getTable().'.categoryID', $categoryID)->where('is_store_suspended', 0)->where($this->userProfileModel->getTable().'.status', 1)
                                ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                                ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                                ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                                ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                                ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                                ->where(function ($query) use ($categoryID, $collectionID) {
                                    $query->where($this->productModel->getTable().'.categoryID','=', $categoryID)
                                        ->orWhere($this->productModel->getTable().'.collectionID','=',$collectionID);
                                })
                                ->orderBy($this->productModel->getTable().$orderBy, $orderType)
                                ->select($this->userProfileModel->getTable().'.storeID', $this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                                ->paginate($paginate);
                            }

                        }
                    }

                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getMyProduct', 'Error occured when running master product qurey.' );
        }
        return $data;
    }



    ### GET USER TOTAL AMOUNT
    public function getUserTotalCartAmount($userID = null, $orderNumber = null)
    {
        $cartAmount             = 0.00;
        $cartQuantity           = 0;
        $data['totalAmount']    = 0.0;
        $data['totalQuantity']  = 0;
        try{
            if($userID <> null && $orderNumber <> null)
            {
                ### Get User Amount
                $getAllCartItems = CartModel::where($this->cartModel->getTable().'.userID', $userID)->where($this->cartModel->getTable().'.order_number', $orderNumber)
                    ->leftjoin($this->productModel->getTable(), $this->productModel->getTable().'.productID', '=', $this->cartModel->getTable().'.productID')
                    ->select($this->cartModel->getTable().'.quantity', $this->productModel->getTable().'.original_price')
                    ->get();
                if(count($getAllCartItems) > 0)
                {
                    foreach($getAllCartItems as $key => $value)
                    {
                        $cartAmount += ($value->quantity * $value->original_price);
                        $cartQuantity += $value->quantity;
                    }
                }
                $data['totalAmount']    = $cartAmount;
                $data['totalQuantity']  = $cartQuantity;
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MatchUserController@getUserTotalCartAmount', 'Error occured when try to get user total cart amount.' );
        }
        return $data;
    }



    ///=====================START ALGORITHM FOR MTCHING=============

    //UPDATE ORDER NUMBER IN CART
    public function updateOrderNumber($userID = null, $productID = null)
    {
        try{
            if($userID <> null)
            {
                CartModel::where('userID', $userID)
                    ->where('status', 1)
                    ->where('is_order_placed', 0)
                    ->where('is_item_delivered', 0)
                    ->update(
                        [
                            'order_number'      => $this->generateRandomAlphaNumeric(15),
                            'delivery_code'     => $this->generateRandomAlphaNumeric(23),
                        ]
                    );
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@updateOrderNumber', 'Error occured when try to update order number.' );
        }
        return;
    }


    //GET STORE STOKEN OR STOREID
    public function getStoreID($productID = null)
    {
        $storeID    = null;
        $userID     = null;
        try{
            if($productID <> null)
            {
                $userID = (ProductModel::find($productID) ? ProductModel::find($productID)->userID : null);
                $storeID = UserProfileModel::where('userID', $userID)->value('storeID');
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getStoreID', 'Error occured when try to get storeID or store token.' );
        }
        return $storeID;
    }


    // COMPUTE DISCOUNT (51% - 70%)
    public function computeBestDiscountAmount($getAmount = 0.00, $percentageFrom = 10, $percentageTo = 20, $currency = 'USD')
    {
        $data['getDiscountedNewAmountFrom'] = 0.00;
        $data['getDiscountedNewAmountTo']   = 0.00;
        try{
            $amount = str_replace(',', '', $getAmount);
            $data['getPercentFrom']             =  $percentageFrom;
            $data['getPercentTo']               =  $percentageTo;
            $data['getAmount']                  =  $amount;
            $data['getDiscountRate']            =  $percentageFrom .' - '. $percentageTo;
            if($amount > 0)
            {
                $data['getDiscountedNewAmountFrom']   =  ($amount - (($percentageFrom / 100) * $amount));
                $data['getDiscountedNewAmountTo']     =  ($amount - (($percentageTo / 100) * $amount));
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@computeBestDiscountAmount', 'Error occured when try to compute product discount.' );
        }
        return $data;
    }


    ################### SEND MESSAGE TO INBOX ##################
    public function sendMessageInbox($senderID = null, $receiverID = null, $message = null, $canReply = null, $smsMessage = null)
    {
        $success = 0;
        try{
            $messageInboxController = new MessageInboxController;
            $success = $messageInboxController->sendNotification($senderID, $receiverID, $message, $canReply, $smsMessage);
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@sendMessageInbox', 'Error occured when try to create new message.' );
        }
        return $success;
    }

    ################### GET NOTIFICATION ##################
    public function getNotifications($receiverID = null)
    {
        $totalCount = 0;
        try{
            $messageInboxController = new MessageInboxController;
            $totalCount = $messageInboxController->getUnreadMessage($receiverID);
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'BaseParentController@getNotifications', 'Error occured when try get all new unread messages.' );
        }
        return $totalCount;
    }

}//end class
