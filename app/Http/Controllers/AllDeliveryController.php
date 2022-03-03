<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CheckoutPoolModel;
use App\Http\Controllers\MatchUserController;
use App\Models\DeliveredUserProductModel;
use App\Models\CartModel;
use Session;
use Cache;
use View;

class AllDeliveryController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();

    }

    ###################### ITEM DELIVERED TO ME ####################
    public function createOrderDeliveredToMe()
    {
        $data['getMyDelivery']      = [];
        $data                       = [];
        $data['showPageMyDelivery'] = 1;
        $data['openCategoryMenu']   = 0;
        try{
            $data['getMyDelivery'] = Cache::remember('cacheKeyItemDeliveredToMe', $this->appCacheTime(), function ()
            {
                $getDelivery = DeliveredUserProductModel::where($this->deliveredUserProductModel->getTable().'.receiverID', $this->getUserID())
                    ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->deliveredUserProductModel->getTable().'.userID')
                    ->orderBy($this->deliveredUserProductModel->getTable().'.deliveredID', 'Desc')
                    ->select('store_country', 'store_city', $this->deliveredUserProductModel->getTable().'.userID', $this->deliveredUserProductModel->getTable().'.receiverID', $this->deliveredUserProductModel->getTable().'.receiver_order_number', $this->deliveredUserProductModel->getTable().'.order_number', 'last_name', 'first_name', 'percentage_rate_from', 'percentage_rate_to', 'total_cart_amount', 'receiver_total_amount', 'item_quantity', $this->deliveredUserProductModel->getTable().'.updated_at', $this->deliveredUserProductModel->getTable().'.created_at')
                    ->paginate(30);
                return $getDelivery;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'AllDeliveryController@createOrderDeliveredToMe', 'Error occured when trying to get item delivered to be.' );
        }
        return $this->checkViewBeforeRender('myOrderDelivery.orderDeliveryPage', $data);
    }


     ###################### ITEM DELIVERED TO ME DETAILS ####################
     public function orderDeliveryDetails($userID = null, $orderNumber = null)
     {
         $getDeliveryDetails         = [];
         $data                       = [];

         $this->userID              = $userID;
         $this->orderNumber         = $orderNumber;

         if($userID == null && $orderNumber == null)
         {
             return redirect()->back()->with('info', 'Sorry, we cannot get the details of this record!');
         }
         try{
             $getDeliveryDetails = Cache::remember('cacheKeyItemDeliveredToMeDetails', $this->appCacheTime(), function ()
             {
                $getClass = new MatchUserController;
                $getDeliveryDetails = $getClass->viewUserStoreDetails($this->userID, $this->orderNumber, 'item_delivered_to_me');
                return $getDeliveryDetails;
             });
            return $this->checkViewBeforeRender('myOrderDelivery.orderDeliveryDetailsView', $getDeliveryDetails)->with($data);
         }catch(\Throwable $errorThrown){
             $this->storeTryCatchError($errorThrown, 'AllDeliveryController@orderDeliveryDetails', 'Error occured when trying to get order delivered details.' );
         }
        return redirect()->back()->with('info', 'Sorry, we cannot get the details of this record!');
     }



    ################## PENDING ITEM TO BE DELIVERED TO ME ##########
    public function createPendingItemToBeDeliveredToMe()
    {
        $data['getMyPendingDelivery']       = [];
        $data                               = [];
        $data['showPageMyPendingDelivery']  = 1;
        $data['openCategoryMenu']           = 0;
        $myTotalCartAmount                  = [];
        $totalQuantity                      = [];
        $data['totalCartAmount']            = [];
        $data['totalCartQuantity']          = [];
        try{
            $data['getMyPendingDelivery'] = Cache::remember('cacheKeyPendingDelivered', $this->appCacheTime(), function ()
            {
                $getDelivery = CheckoutPoolModel::where($this->checkoutPoolModel->getTable().'.receiverID', $this->getUserID())->where('is_active', 1)
                    ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->checkoutPoolModel->getTable().'.userID')
                    ->orderBy($this->checkoutPoolModel->getTable().'.poolID', 'Desc')
                    ->select($this->checkoutPoolModel->getTable().'.userID', $this->checkoutPoolModel->getTable().'.receiverID', $this->checkoutPoolModel->getTable().'.receiver_order_number', 'last_name', 'first_name', 'percentage_rate_from', 'percentage_rate_to', 'total_cart_amount', 'receiver_total_amount', 'item_quantity', 'order_number', $this->checkoutPoolModel->getTable().'.updated_at', $this->checkoutPoolModel->getTable().'.created_at', 'store_city', 'store_country')
                    ->paginate(30);
                return $getDelivery;
            });

            foreach($data['getMyPendingDelivery'] as $key=>$value)
            {
                $getData = $this->getUserTotalCartAmount($value->userID, $value->order_number);
                $myTotalCartAmount[$key] = $getData['totalAmount'];
                $totalQuantity[$key]     = $getData['totalQuantity'];
            }
            $data['totalCartAmount'] = $myTotalCartAmount;
            $data['totalCartQuantity'] = $totalQuantity;
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'AllDeliveryController@createPendingItemToBeDeliveredToMe', 'Error occured when trying to get item to be delivered to me.' );
        }
        return $this->checkViewBeforeRender('pendingItemToBeDeliveredToMe.pendingDeliveryPage', $data);
    }


    ################## PENDING ITEM TO BE DELIVERED TO ME DETAILS ##########
    public function createPendingItemToBeDeliveredToMeDetails($userID = null, $orderNumber = null)
    {
        $getDeliveryDetails         = [];
        $this->userID              = $userID;
        $this->orderNumber         = $orderNumber;

        if($userID == null && $orderNumber == null)
        {
            return redirect()->back()->with('info', 'Sorry, we cannot get the details of this record!');
        }
        try{
            $getDeliveryDetails = Cache::remember('cacheKeycreatePendingItemToBeDeliveredToMeDetails', $this->appCacheTime(), function ()
            {
               $getClass = new MatchUserController;
               $getDeliveryDetails = $getClass->viewUserStoreDetails($this->userID, $this->orderNumber, 'item_pending_to_deliver_to_me');
               return $getDeliveryDetails;
            });
           return $this->checkViewBeforeRender('pendingItemToBeDeliveredToMe.pendingDeliveryDetailsView', $getDeliveryDetails);
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'AllDeliveryController@createPendingItemToBeDeliveredToMeDetails', 'Error occured when trying to view pending item details to be delivered to.' );
        }
       return redirect()->back()->with('info', 'Sorry, we cannot get the details of this record!');
    }


    ###################### ITEM I HAVE DELIVERED ###########
    public function createItemIHaveDelivered()
    {
        $data['getMyDelivery']      = [];
        $data                       = [];
        $data['showPageMyDelivery'] = 1;
        $data['openCategoryMenu']   = 0;
        try{
            $data['getMyDelivery'] = Cache::remember('cacheKeyItemIHaveDelivered', $this->appCacheTime(), function ()
            {
                $getDelivery = DeliveredUserProductModel::where($this->deliveredUserProductModel->getTable().'.userID', $this->getUserID())
                    ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->deliveredUserProductModel->getTable().'.receiverID')
                    ->orderBy($this->deliveredUserProductModel->getTable().'.deliveredID', 'Desc')
                    ->select($this->deliveredUserProductModel->getTable().'.userID', 'receiverID', 'receiver_order_number', $this->deliveredUserProductModel->getTable().'.order_number', 'last_name', 'first_name', 'percentage_rate_from', 'percentage_rate_to', 'total_cart_amount', 'receiver_total_amount', 'item_quantity', $this->deliveredUserProductModel->getTable().'.updated_at', $this->deliveredUserProductModel->getTable().'.created_at')
                    ->paginate(30);
                return $getDelivery;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'AllDeliveryController@createItemIHaveDelivered', 'Error occured when trying to get item delivered.' );
        }
        return $this->checkViewBeforeRender('myItemDelivery.myDeliveryPage', $data);
    }


    ###################### ITEM I HAVE DELIVERED DETAILS ####################
    public function createItemIHaveDeliveredDetails($userID = null, $orderNumber = null)
    {
        $getDeliveryDetails         = [];
        $data                       = [];

        $this->userID              = $userID;
        $this->orderNumber         = $orderNumber;

        if($userID == null && $orderNumber == null)
        {
            return redirect()->back()->with('info', 'Sorry, it seems the order number number is wrong!');
        }
        try{
            $getDeliveryDetails = Cache::remember('cacheKeyItemDeliveredToMeDetails', $this->appCacheTime(), function ()
            {
               $getClass = new MatchUserController;
               $getDeliveryDetails = $getClass->viewUserStoreDetails($this->userID, $this->orderNumber, 'item_i_have_delivered_to_user');
               return $getDeliveryDetails;
            });
           return $this->checkViewBeforeRender('myItemDelivery.myDeliveryDetailsPageView', $getDeliveryDetails)->with($data);
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'AllDeliveryController@createItemIHaveDeliveredDetails', 'Error occured when trying to get item i have delivered details.' );
        }
       return redirect()->back()->with('info', 'Sorry, we cannot get the details of this record!');
    }




    ################## PENDING ITEM I NEED TO DELIVER ##########
    public function createPendingItemNeedToDeliver()
    {
        $data['getPendingItemNeedToDeliver']        = [];
        $data                                       = [];
        $data['showPagePendingItemNeedToDeliver']   = 1;
        $data['openCategoryMenu']                   = 0;
        $myTotalCartAmount                          = [];
        $totalQuantity                              = [];
        $data['totalCartAmount']                    = [];
        $data['totalCartQuantity']                  = [];
        try{
            $data['getPendingItemNeedToDeliver'] = Cache::remember('cacheKeyPendingItemNeedToDeliver', $this->appCacheTime(), function ()
            {
                $getDelivery = CheckoutPoolModel::where($this->checkoutPoolModel->getTable().'.userID', $this->getUserID())->where('is_active', 1)
                    ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->checkoutPoolModel->getTable().'.receiverID')
                    ->orderBy($this->checkoutPoolModel->getTable().'.poolID', 'Desc')
                    ->select($this->checkoutPoolModel->getTable().'.userID', 'receiverID', $this->checkoutPoolModel->getTable().'.receiver_order_number', 'last_name', 'first_name', 'percentage_rate_from', 'percentage_rate_to', 'total_cart_amount', 'receiver_total_amount', 'item_quantity', 'order_number', $this->checkoutPoolModel->getTable().'.updated_at', $this->checkoutPoolModel->getTable().'.created_at')
                    ->paginate(30);

                return $getDelivery;
            });

            foreach($data['getPendingItemNeedToDeliver'] as $key=>$value)
            {
                $getData = $this->getUserTotalCartAmount($value->userID, $value->order_number);
                $myTotalCartAmount[$key] = $getData['totalAmount'];
                $totalQuantity[$key]     = $getData['totalQuantity'];
            }
            $data['totalCartAmount'] = $myTotalCartAmount;
            $data['totalCartQuantity'] = $totalQuantity;
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'AllDeliveryController@createPendingItemNeedToDeliver', 'Error occured when trying to get item i need to deliver.' );
        }

        return $this->checkViewBeforeRender('pendingItemINeedToDeliver.itemINeedToDeliverPage', $data);
    }


    ####################### CANCEL ORDER #####################
    public function startDeletingPendingItemNeedToDeliver($orderNumber = null)
    {
        try{
            if(CheckoutPoolModel::where('userID', $this->getUserID())->where('order_number', $orderNumber)->delete())
            {
                if(CartModel::where('userID', $this->getUserID())->where('order_number', $orderNumber)->delete())
                {
                    Cache::forget('cacheKeyPendingItemNeedToDeliver');
                    Cache::forget('cacheKeyPendingDelivered');
                    return redirect()->route('pendingItemNeedToDeliver')->with('message', 'Your order was deleted successfully.');
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MatchUserController@startDeletingPendingItemNeedToDeliver', 'Error occured when try to delete pending item i need to deliver.');
        }
        return redirect()->back()->with('warning', 'Sorry, we cannot delete this order now. Please try again.');
    }



}//end class
