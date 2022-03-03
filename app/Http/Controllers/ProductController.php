<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\UserProductColourModel;
use App\Models\UserProductSizeModel;
use App\Models\CartModel;
use App\Models\ProductCommentModel;
use App\Models\MessageInboxModel;
use Cache;
use View;

class ProductController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    public function createProductDetails($productID = null)
    {
        $data['product']                        = [];
        $data['showPage']                       = 1;
        $data['getProductDetailsImages']        = [];
        $data['getProductDetailsCoverImage']    = [];
        $data['productDetailsPath']             = null;
        $data['productDetailsPath300x300']      = null;
        $data['productDetailsPath500x500']      = null;
        $dataRelated                            = [];
        $data['openCategoryMenu']               = 0;
        $productID = ProductModel::where('product_name', str_replace('_+_', ' ', $productID))->value('productID');
        try{
            $data['product'] = ProductModel::where('admin_status', 1)->where('is_deleted', 0)->where('is_online', 1)->where($this->productModel->getTable().'.productID', $productID)
                    ->leftjoin($this->currencyModel->getTable(), $this->currencyModel->getTable().'.currencyID', '=', $this->productModel->getTable().'.currencyID')
                    ->leftjoin($this->categoryModel->getTable(), $this->categoryModel->getTable().'.categoryID', '=', $this->productModel->getTable().'.categoryID')
                    ->leftjoin($this->collectionModel->getTable(), $this->collectionModel->getTable().'.collectionID', '=', $this->productModel->getTable().'.collectionID')
                    ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->productModel->getTable().'.userID')
                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                    ->select($this->productModel->getTable() .'.*', 'user_token', $this->productModel->getTable().'.productID as productIDField', $this->categoryModel->getTable().'.category',
                    $this->collectionModel->getTable().'.collection', $this->userProfileModel->getTable().'.store_name', $this->userProfileModel->getTable().'.store_address1', $this->userProfileModel->getTable().'.store_address2',
                    $this->userProfileModel->getTable().'.store_description',  $this->userProfileModel->getTable().'.store_country', $this->userProfileModel->getTable().'.store_state', $this->userProfileModel->getTable().'.store_city')
                    ->first();
            if($data['product'] == null)
            {
                return redirect()->back()->with('info', 'Sorry, you cannot view this product now!');
            }

            //get all product colour
            $data['getColour'] = UserProductColourModel::where('productID', $productID)
                                ->join($this->colourModel->getTable(), $this->colourModel->getTable().'.colourID', '=', $this->userProductColourModel->getTable().'.colourID')
                                ->select($this->userProductColourModel->getTable().'.colourID', 'colour_name', 'colour_code')
                                ->get();

            //get all product size
            $data['getSize'] = UserProductSizeModel::where('productID', $productID)
                            ->join($this->sizeModel->getTable(), $this->sizeModel->getTable().'.sizeID', '=', $this->userProductSizeModel->getTable().'.sizeID')
                            ->select($this->userProductSizeModel->getTable().'.sizeID', 'size_name', 'size_code')
                            ->get();

            //Get Product Images
            if($data['product'])
            {
                $data['getProductDetailsImages']      = ProductImageModel::where('productID', $data['product']->productIDField)->select('file_name', 'file_description')->get();
                $data['getProductDetailsCoverImage']  = ProductImageModel::where('productID', $data['product']->productIDField)->inRandomOrder()->value('file_name');
                $data['productDetailsPath']           = $this->downloadPath() . $data['product']->user_token .'/'. 'product/';
            }
            $data['productDetailsPath300x300']         = $data['productDetailsPath'] . '300x300/';
            $data['productDetailsPath500x500']         = $data['productDetailsPath'] . '500x500/';
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@createProductDetails', 'Error occured on GET Request when trying to get product details' );
        }

        //Get Related Product
        try{
            $this->categoryID = ProductModel::where('productID', $productID)->value('categoryID');
            $dataRelated = Cache::remember('cacheKeyRelatedProductDetails', $this->appCacheTime(), function ()
            {
                return $this->getAnyProduct($paginate = 24, $userID = null, $adminStatus = 1, $isOnline = 1, $isDeleted = 0, $orderBy = '.created_at', $randomData = true, $categoryID = $this->categoryID, $collectionID = null, $pick = null);
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@createProductDetails', 'Error occured on GET Request when trying to Get related products' );
        }

        return $this->checkViewBeforeRender('product.details.productDetails', $data, $dataRelated);
    }



    //Add product to cart
    public function addProductToCart($productID = null, $quantity = 1)
    {
        $data['status'] = 0;
        $data['message'] = "Sorry, we could not add your product to cart! Try again.";

        try{
            $userID = $this->getUserID();
            $isProductOkay = ProductModel::where('productID', $productID)->where('is_deleted', 0)->where('is_online', 1)->where('admin_status', 1)->first();
            if($this->checkCartTotalAmount($userID, $productID))
            {
                if($productID <> null && ($userID <> null) && $isProductOkay)
                {
                    if(!CartModel::where('userID', $userID)->where('productID', $productID)->where('status', 1)->where('is_order_placed', 0)->where('is_cancel', 0)->first())
                    {
                        $complete = CartModel::create([
                            'userID'                => $userID,
                            'productID'             => $productID,
                            'quantity'              => $quantity,
                            'transactionID'         => $this->generateRandomAlphaNumeric(12),
                            'store_token'           => $this->getStoreID($productID),
                            'created_at'            => date('Y-m-d h:i:s a'),
                            'updated_at'            => date('Y-m-d h:i:s a'),
                        ]);
                        //Update order Number
                        $this->updateOrderNumber($this->getUserID(), $productID);
                        $data['status'] = 1;
                        $data['message'] = "Item was added to cart successfully.";
                        Cache::forget('cacheKeyItemICartProduct');
                    }else{
                        $data['status'] = 0;
                        $data['message'] = "Sorry, Item already added to your cart !";
                    }
                }
            }else{
                $data['message'] = "Sorry, You have exceeded the maximum amount (<span class=money>". number_format($this->maximumCartAmountUserCanCheckOut(), 2) ."</span>) of items you can add to your cart for now!";
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@addProductToCart', 'Error occured on GET Request when trying to add product to cart' );
        }
        return $data;
    }


    //Add product comment
    public function addProductComment($productID = null, $comment = null, $name = null, $email = null)
    {
        $data['status'] = 0;
        $data['message'] = "Sorry, we could not add your comment/question for this product! Try again.";

        try{
            $userID = $this->getUserID();
            if($productID <> null && ($userID <> null) && $comment <> null)
            {
                ProductCommentModel::create([
                    'userID'                => $userID,
                    'productID'             => $productID,
                    'comment'               => $comment,
                    'name'                  => $name,
                    'email'                 => $email,
                    'created_at'            => date('Y-m-d h:i:s a'),
                    'updated_at'            => date('Y-m-d h:i:s a'),
                ]);
                $data['status'] = 1;
                $data['message'] = "Your comment/question was sent successfully.";
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@addProductComment', 'Error occured on GET Request when trying to add comment for product' );
        }
        return $data;
    }


    //REPLY COMMENT TO INBOX
    public function replyProductComment($commentID = null, $receiverID = null, $message = null)
    {
        $data['status'] = 0;
        $data['message'] = "Sorry, your message was not sent!";
        try{
            $userID = $this->getUserID();
            if($commentID <> null && $receiverID <> null && $message <> null)
            {
                $getCommentDetails = ProductCommentModel::where('commentID', $commentID)->value('comment');
                MessageInboxModel::create([
                    'senderID'      => $userID,
                    'receiverID'    => $receiverID,
                    'message'       => $message .' (Normal Message: ' . $getCommentDetails . ')',
                    'created_at'    => date('Y-m-d h:i:s a'),
                    'updated_at'    => date('Y-m-d h:i:s a')
                ]);
                $data['status'] = 1;
                $data['message'] = "Sent! Your message was sent successfully.";
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@replyComment', 'Error occured on Post Request when trying to reply comment' );
        }
        return $data;
    }


    //Remove Product From CArt
    public function removeItemFromCart($cartID = null)
    {
        $data['status'] = 0;
        $data['message'] = "Sorry, we could not remove your item from cart! please try again.";
        try{
            if($cartID <> null)
            {
               $getCart = CartModel::find($cartID);
               if($getCart)
               {
                    $getCart->delete();

                    $data['status'] = 1;
                    $data['message'] = "Your item was removed successfully.";
                    Cache::forget('cacheKeyItemICartProduct');
               }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@removeItemFromCart', 'Error occured on GET Request when trying to remove item from cart.' );
        }
        return $data;
    }

    //Remove Product From CArt
    public function updateItemQuantityInCart($cartID = null, $quantity = 1)
    {
        $data['status'] = 0;
        $data['message'] = "Sorry, we could not update your item quantity! please try again.";
        try{
            if($cartID <> null)
            {
               $getCart = CartModel::find($cartID);
               if($getCart)
               {
                    $getCart->quantity = $quantity;
                    $getCart->updated_at = date('Y-m-d h:i:s a');
                    $getCart->update();

                    $data['status'] = 1;
                    $data['message'] = "Your item quantity was updated successfully.";
                    Cache::forget('cacheKeyItemICartProduct');
               }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductController@removeItemFromCart', 'Error occured on GET Request when trying to update item quantity in cart.' );
        }
        return $data;
    }


    //CHECK USER CART TOTAL AMOUNT BEFORE ADDING TO CART
    public function checkCartTotalAmount($userID = null, $productID = null)
    {
        $amountOkay    = 0;
        $totalCartAmount        = 0.0;
        if($userID <> null && $productID <> null)
        {
            try{
                $newToBeAdded = (ProductModel::find($productID) ? ProductModel::find($productID)->original_price : 0.0);
                $userCartItems = CartModel::where($this->cartModel->getTable().'.userID', $userID)->where($this->cartModel->getTable().'.status', 1)->where('is_order_placed', 0)->where('is_cancel', 0)
                        ->leftjoin($this->productModel->getTable(), $this->productModel->getTable().'.productID', '=', $this->cartModel->getTable().'.productID')
                        ->select($this->cartModel->getTable().'.quantity', $this->productModel->getTable().'.original_price')->get();
                foreach($userCartItems as $value)
                {
                    $totalCartAmount += ($value->quantity * $value->original_price);
                }
                if(($totalCartAmount + $newToBeAdded) <= ($this->maximumCartAmountUserCanCheckOut()))
                {
                    $amountOkay = 1; //amount okay then, allow to add to cart
                }else{
                    $amountOkay = 0; //Amount not okay, dont allow to add to cart
                }
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'ProductController@checkCartTotalAmount', 'Error occured when try to check cart total amount before adding to cart.' );
            }
        }
        return $amountOkay;
    }



}//end class
