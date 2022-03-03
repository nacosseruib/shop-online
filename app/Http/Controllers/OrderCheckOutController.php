<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImageModel;
use App\Models\CartModel;
use Session;
use Cache;
use View;
use DB;

class OrderCheckOutController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();

    }

    ###################### ALL MY ITEMS I HAVE CHECKEDOUT ####################
    public function createAllItemsICheckout()
    {
        $data['getAllCheckedOut']   = [];
        $data['showPageCheckedout'] = 1;
        $data['openCategoryMenu']   = 0;
        try{
            $data['getAllCheckedOut'] = Cache::remember('cacheKeyAllOrderCheckedOut', $this->appCacheTime(), function ()
            {
                $order = CartModel::where($this->cartModel->getTable().'.userID', $this->getUserID())->where($this->cartModel->getTable().'.checkout', 1)
                    ->leftjoin($this->productModel->getTable(), $this->productModel->getTable().'.productID', '=', $this->cartModel->getTable().'.productID')
                    ->select(DB::raw('SUM(quantity) as totalQuantity'), DB::raw('(SUM(quantity * original_price)) as totalAmount'), $this->cartModel->getTable().'.userID', $this->cartModel->getTable().'.order_number', $this->cartModel->getTable().'.is_active', $this->cartModel->getTable().'.created_at', $this->cartModel->getTable().'.updated_at')
                    ->groupBy('order_number')
                    ->orderBy($this->cartModel->getTable().'.cartID', 'Desc')
                    ->paginate(30);
                return $order;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'OrderCheckOutController@createAllItemsICheckout', 'Error occured when trying to get item delivered.' );
        }
        return $this->checkViewBeforeRender('allCheckedoutOrders.checkoutOrderPage', $data);
    }


    ###################### ALL MY ITEMS I HAVE CHECKEDOUT DETAILS ####################
    public function createAllItemsICheckoutDetails($orderNumber = null, $userID = null)
    {
        try{
            $userID = ($userID ? $userID : $this->getUserID());
            if($userID <> null && $orderNumber <> null && CartModel::where('order_number', $orderNumber)->first())
            {
                Cache::forget('cacheKeyCheckOutDetails');
                $data = $this->getCheckoutItemInCart($userID, $cartStatus = 0, $ischeckout = 1, $isActive = 0, $orderBy = 'Desc', $orderNumber);

                return $this->checkViewBeforeRender('allCheckedoutOrders.checkoutOrderDetailsView', $data);
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'OrderCheckOutController@createAllItemsICheckoutDetails', 'Error occured when try view my checkedout order details.');
        }
        return redirect()->route('checkoutOrder')->with('info', 'Sorry, we cannot view the details of this record.');
    }

    // CALL DATA FROM CART
    public function getCheckoutItemInCart($userID = null, $cartStatus = 0, $ischeckout = 1, $isActive = 1, $orderBy = 'Desc', $orderNumber = null)
    {
        $getData                    = [];
        $data['cartData']           = [];
        $this->userID               = $userID;
        $this->cartStatus           = $cartStatus;
        $this->ischeckout           = $ischeckout;
        $this->isActive             = $isActive;
        $this->orderBy              = $orderBy;
        $this->orderNumber          = $orderNumber;
        $data['itemInCart']         = [];
        $data['totalCartAmount']    = 0.00;
        $data['productPath']        = null;
        $data['productImages']      = null;
        $data['productPath300x300'] = '300x300/';
        $data['productPath500x500'] = '500x500/';
        $data['itemQuantity']       = 0;

        if($this->orderNumber)
        {
            try{
                $getData = Cache::remember('cacheKeyCheckOutDetails', $this->appCacheTime(), function ()
                {
                    $totalCartAmount        = 0.00;
                    $productPath            = null;
                    $productImages          = [];
                    $totalQuantity          = 0;
                    $productPath            = [];
                    $productImages          = [];

                    $getAllCartItems = CartModel::where($this->cartModel->getTable().'.order_number', $this->orderNumber)->where($this->cartModel->getTable().'.userID', $this->userID)->where($this->cartModel->getTable().'.status', $this->cartStatus)->where($this->cartModel->getTable().'.checkout', $this->ischeckout)
                        ->leftjoin($this->productModel->getTable(), $this->productModel->getTable().'.productID', '=', $this->cartModel->getTable().'.productID')
                        ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->productModel->getTable().'.userID')
                        ->orderBy($this->cartModel->getTable().'.cartID', $this->orderBy)
                        ->select($this->cartModel->getTable() .'.userID', $this->cartModel->getTable() .'.created_at', $this->cartModel->getTable().'.productID', 'product_code',
                        'transactionID', 'cartID', 'quantity', 'brand', 'is_available', 'original_price', 'user_token', 'old_price', 'product_name', 'delivery_code', 'order_number')
                        ->get();


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
                $this->storeTryCatchError($errorThrown, 'OrderCheckOutController@getCheckoutItemInCart', 'Error occured when trying to get all checkedout items from shopping cart.' );
            }
        }

        return $getData;
    }



}//end class
