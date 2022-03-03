<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\ColourModel;
use App\Models\SizeModel;
use App\Models\UserProductSizeModel;
use App\Models\UserProductColourModel;
use App\Models\CategoryModel;
use App\Models\CollectionModel;
use Session;
use Cache;
use Auth;
use View;

class UploadProductController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    //Load Product Page
    public function createUploadProduct()
    {
        $data       = [];
        $editData   = [];

        //Pass edit record details to view
        if(Session::get('productToEdit'))
        {
            $editData['editRecord']             = Session::get('productToEdit');
            $editData['productToEditSize']      = Session::get('productToEditSize');
            $editData['productToEditColour']    = Session::get('productToEditColour');
            $editData['productToEditImages']    = Session::get('productToEditImages');
            $editData['productPath']            = $this->downloadPath() . $this->getUserToken() . '/'. 'product/';
            $editData['productPath300x300']     = $editData['productPath'] . '300x300/';
        }

        try{
            ###############check if user has a valid store or store has been suspended############
            if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $data = Cache::remember('cacheKeyCreateUploadProductUploadProductController', $this->appCacheTime(), function () {
                $data['showPage']           = 1;
                $data['productCategory']    = CategoryModel::where('status', 1)->get();
                $data['getColour']          = ColourModel::where('status', 1)->take(13)->get();
                $data['getSize']            = SizeModel::where('status', 1)->get();
                $data['userCurrency']       = $this->getUserCurrency($this->getUserID());
                return $data;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'UploadProductController@createUploadProduct', 'Error occured on GET Request when trying to load view to create product' );
        }
        Session::forget('productToEdit');
        Session::forget('productToEditSize');
        Session::forget('productToEditColour');
        Session::forget('productToEditImages');
        return $this->checkViewBeforeRender('product.uploadProduct.uploadProductPage', $data, $editData);
    }


    //get all collection
    public function getAllCollections($categoryID = null)
    {
        $productCollection = [];
        try{

            if($categoryID <> null)
            {
                $productCollection  = CollectionModel::where('status', 1)->where('categoryID', $categoryID)->select('collectionID', 'collection')->get();
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'UploadProductController@getAllCollections', 'Error occured when trying to get all product collections with ccategory ID' );
        }
        return $productCollection;
    }

    //Upload Product
    public function storeUploadProduct(Request $request)
    {
        try{
            ###############check if user has a valid store or store has been suspended############
            if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $productToEditID        = $request['productToEdit'];
            $data['showPage']       = 1;
            $complete               = null;
            $userID                 = $this->getUserID();
            $uploadCompletePathName = $this->uploadPath() . 'product/';
            $uploadCompletePathNameThumbnail300X300 = $uploadCompletePathName . '300x300/';
            $uploadCompletePathNameThumbnail500X500 = $uploadCompletePathName . '500x500/';

            //validation
            $this->validate($request,
            [
                'originalPrice'            => ['required', 'string', 'max:100'],
                //'oldPrice'                 => ['required', 'string', 'max:100'],
                'productCategory'          => ['required', 'string', 'max:255'],
                //'productCollection'        => ['required', 'string', 'max:255'],
                //'productBrand'             => ['required', 'string', 'max:255'],
                //'productSize'              => ['required', 'string', 'max:255'],
                //'productColour'            => ['required', 'string', 'max:255'],
                'productAvailable'         => ['required', 'string', 'max:255'],
                'productStatus'            => ['required', 'string', 'max:255'],
                //'productComment'           => ['required', 'string', 'max:100'],
                'productDetails'           => ['required', 'string'],
                //'productKeyFeatures'       => ['required', 'string'],
                //'productPaymentMethod'     => ['required', 'string'],
                //'productImage'             => ['required'],
            ]);
            if(!$productToEditID)
            {
                $this->validate($request,
                [ //regex:/^[A-Za-z\s-_]+$/
                    'productName'              => ['required', 'string', 'max:250', 'unique:product,product_name'],
                    'productImage'             => ['required'],
                    'productImage.*'           => ['image', 'mimes:png,jpg,jpe,jpeg,gif', 'max: 2100'],
                ]);
            }else{
                $this->validate($request,
                [
                    'productName'              => ['required', 'string', 'max:250', 'unique:product,product_name,'.$userID.',userID'],
                ]);
            }

            //Upload File
            if($userID)
            {
                //update record
                if($productToEditID)
                {
                    if(ProductModel::where('productID', $productToEditID)->where('userID', $this->getUserID())->first())
                    {
                        ProductModel::where('userid', $userID)->where('productID', $productToEditID)->update([
                            'product_name'          => $request['productName'],
                            'original_price'        => $this->removeCommaFromString($request['originalPrice']),
                            'old_price'             => $this->removeCommaFromString($request['oldPrice']),
                            'categoryID'            => $request['productCategory'],
                            'collectionID'          => $request['productCollection'],
                            'brand'                 => $request['productBrand'],
                            'is_available'          => $request['productAvailable'],
                            'is_comment'            => $request['productComment'],
                            'is_online'             => $request['productStatus'],
                            'product_details'       => $request['productDetails'],
                            'product_feature'       => $request['productKeyFeatures'],
                            'payment_method'        => $request['productPaymentMethod'],
                            'updated_at'            => date('Y-m-d h:i:s a'),
                        ]);
                     }
                    $complete = 1;
                }else{
                    //create New
                    $complete = ProductModel::create([
                        'userID'                => $userID,
                        'currencyID'            => $this->getUserCurrencyID($userID),
                        'product_code'          => $this->generateRandomAlphaNumeric(11),
                        'product_token'         => $this->generateRandomAlphaNumeric(20),
                        'product_name'          => $request['productName'],
                        'original_price'        => $this->removeCommaFromString($request['originalPrice']),
                        'old_price'             => $this->removeCommaFromString($request['oldPrice']),
                        'categoryID'            => $request['productCategory'],
                        'collectionID'          => $request['productCollection'],
                        'brand'                 => $request['productBrand'],
                        'is_available'          => $request['productAvailable'],
                        'is_comment'            => $request['productComment'],
                        'is_online'             => $request['productStatus'],
                        'product_details'       => $request['productDetails'],
                        'product_feature'       => $request['productKeyFeatures'],
                        'payment_method'        => $request['productPaymentMethod'],
                        'created_at'            => date('Y-m-d h:i:s a'),
                        'updated_at'            => date('Y-m-d h:i:s a'),
                    ]);
                }

                if($complete)
                {
                    //Upload Product Images
                    if($request->hasFile('productImage'))
                    {
                        //Get Descriptions
                        $getAllDescriptions = [];
                        foreach($request['productTitle'] as $itemDescription)
                        {
                            $getAllDescriptions[] = $itemDescription;
                        }

                        foreach($request['productImage'] as $keyImage => $file)
                        {
                            $getArrayResponse = $this->uploadAnyFile($file, $uploadCompletePathName, $maxFileSize = 10, $newExtension = null, $newRadFileName = true);
                            if($getArrayResponse)
                            {
                                if($getArrayResponse['success']){
                                    ProductImageModel::create([
                                        'userID'            => $userID,
                                        'productID'         => ($productToEditID ? $productToEditID : $complete->productID),
                                        'file_name'         => $getArrayResponse['newFileName'],
                                        'file_description'  => $getAllDescriptions[$keyImage],
                                        'created_at'        => date('Y-m-d h:i:s a'),
                                    ]);
                                }
                                //Resize Product Thumbnail - 300X300
                                $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail300X300 . $getArrayResponse['newFileName'], $width = 300, $height = 300);
                                //Resize Product Thumbnail - 500X500
                                $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail500X500 . $getArrayResponse['newFileName'], $width = 500, $height = 500, $is_resize_canvas = 0);
                            }
                        }
                    }
                    //Create user product size
                    if($request['productSize'] <> null)
                    {
                        if($productToEditID)
                        {
                            UserProductSizeModel::where('userid', $userID)->where('productID', $productToEditID)->delete();
                        }
                        foreach($request['productSize'] as $value)
                        {
                            UserProductSizeModel::create([
                                'userID'         => $userID,
                                'productID'      => ($productToEditID ? $productToEditID : $complete->productID),
                                'sizeID'         => $value,
                            ]);
                        }
                    }
                    //Create user product colour
                    if($request['productColour'] <> null)
                    {
                        if($productToEditID)
                        {
                            UserProductColourModel::where('userid', $userID)->where('productID', $productToEditID)->delete();
                        }
                        foreach($request['productColour'] as $value)
                        {
                            UserProductColourModel::create([
                                'userID'        => $userID,
                                'productID'     => ($productToEditID ? $productToEditID : $complete->productID),
                                'colourID'      => $value,
                            ]);
                        }
                    }
                }
            }else{
                $complete = 0;
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'UploadProductController@storeUploadProduct', 'Error occured on POST Request when trying to upload new product' );
        }
        if($complete)
        {
            Session::forget('productToEdit');
            Session::forget('productToEditSize');
            Session::forget('productToEditColour');
            Session::forget('productToEditImages');
            //Refresh Product Cache
            Cache::forget('cacheKeyUserProduct');

            if($productToEditID)
            {
                return redirect()->route('goTostoreHome')->with('message', 'Your product was Updated successfully.');
            }else{
                return redirect()->route('goToProductUpload')->with('message', 'Your product was uploaded successfully.');
            }
        }else{
            return redirect()->route('goTostoreHome')->with('error', 'Sorry, your product was not uploaded/updated successfully! Please review and try again.');
        }

    }//end fun



    //Get Product to edit
    public function getProductToEdit($productID = null)
    {
        Session::forget('productToEdit');
        Session::forget('productToEditSize');
        Session::forget('productToEditColour');
        Session::forget('productToEditImages');

        if($productID <> null && (ProductModel::find($productID)))
        {
            $getSizeID      = [];
            $getColourID    = [];

            try{
                ###############check if user has a valid store or store has been suspended############
                if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
                ######################################################################################

                //product details
                $productModel = ProductModel::where('productID', $productID)->where('userID', $this->getUserID())
                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                    ->select($this->productModel->getTable().'.*', $this->categoryModel->getTable().'.category', $this->collectionModel->getTable().'.collection')
                    ->first();
                //check who to edit
                if($productModel == null)
                {
                    return redirect()->back()->with('info', 'Sorry, you are not authorized to update this product!');
                }
                Session::put('productToEdit', $productModel);

                //produt size
                $getAllSize = UserProductSizeModel::where('productID', $productID)->select('sizeID')->get();
                foreach($getAllSize as $size)
                {
                    $getSizeID[] = $size->sizeID;
                }
                Session::put('productToEditSize', $getSizeID);

                //product colour
                $getColour = UserProductColourModel::where('productID', $productID)->select('colourID')->get();
                foreach($getColour as $colour)
                {
                    $getColourID[] = $colour->colourID;
                }

                Session::put('productToEditColour', $getColourID);
                Session::put('productToEditImages', ProductImageModel::where('productID', $productID)->select('file_name', 'file_description', 'product_imageID')->get());

                return redirect()->route('goToProductUpload')->with('info', 'You can edit your product now!');
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'UploadProductController@getProductToEdit', 'Error occured on GET Request when trying to query product to edit' );
            }
            return redirect()->back()->with('error', 'Sorry, we cannot edit this product now. Please try again.');
        }else{
            return redirect()->back()->with('error', 'Sorry, we cannot edit this product now. Please try again.');
        }
    }

    //Cancel Product to edit
    public function cancelProductEdit()
    {
        Session::forget('productToEdit');
        Session::forget('productToEditSize');
        Session::forget('productToEditColour');
        Session::forget('productToEditImages');
        return redirect()->route('goTostoreHome')->with('info', 'Product editing was cancelled');
    }


    //Soft Delete Product
    public function softeDeleteProduct($productID = null)
    {
        try{
            if($productID <> null && (ProductModel::where('productID',$productID)->where('userID', $this->getUserID())->first()))
            {

                ###############check if user has a valid store or store has been suspended############
                if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
                ######################################################################################

                ProductModel::where('productID', $productID)->update(['is_deleted' => 1, "updated_at" => date('Y-m-d h:i:s a')]);
                Cache::forget('cacheKeyUserProduct');
                return redirect()->route('goTostoreHome')->with('info', 'Your product was moved to trash successfully.');
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'UploadProductController@softeDeleteProduct', 'Error occured on GET Request when trying to move product to trash' );
        }

        return redirect()->back()->with('error', 'Sorry, we cannot move this product to trash now! please try again.');

    }

    //Delete Product Image when editing
    public function deleteProductImageOnEdit($userProductImageID = null, $productID = null)
    {
        try{
            if(($productID <> null) && ($userProductImageID <> null) && (ProductImageModel::find($userProductImageID)) && (ProductImageModel::where('productID', $productID)->first()))
            {
                if(ProductModel::where('productID', $productID)->where('userID', $this->getUserID())->first())
                {
                    ProductImageModel::find($userProductImageID)->delete();
                    return redirect()->route('productToEdit', ['productID' => $productID])->with('info', 'Your product image was deleted successfully.');
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'UploadProductController@deleteProductImageOnEdit', 'Error occured on GET Request when trying to delete product image' );
        }
        return redirect()->back()->with('error', 'Sorry, we cannot delete this image now! please try again.');
    }

    //Push Product online or offline
    public function pushProductOnlineOrOffline($productID = null)
    {
        $newStatus = 0;
        try{
            ###############check if user has a valid store or store has been suspended############
            if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            if($productID <> null)
            {
                $productDetails = ProductModel::find($productID);

                $productStatus = ($productDetails ? $productDetails->is_online : null);
                $newStatus = ($productStatus == 1 ? 0 : 1);
                if($productDetails)
                {
                ProductModel::where('productID', $productID)->update([
                        "is_online" => $newStatus,
                        "updated_at" => date('Y-m-d h:i:s a')
                    ]);
                    Cache::forget('cacheKeyUserProduct');
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'UploadProductController@pushProductOnlineOrOffline', 'Error occured when try to change product status (i.e online/offline).' );
        }
        return $newStatus;
    }





}//end class
