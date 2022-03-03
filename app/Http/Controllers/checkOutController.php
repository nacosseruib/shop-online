<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\CheckoutPoolModel;
use View;


class checkOutController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    public function checkoutDiscountAlgorithm()
    {
        $data = [];
        try{
            $userID     = $this->getUserID();
            ##########check if user has more than 5 checkout products that has not been closed
            $getAllUserCheckout = CheckoutPoolModel::where('userID', $userID)->where('is_active', 1)->get();
            if(count($getAllUserCheckout) > 5)
            {
                return redirect()->back()->with('info', 'Sorry, you have some checkout items that are yet to be closed! Please try to close some items and you will be able to add more. Thank you.');
            }

            ##########check total cart amount
            $getCart = $this->getItemInCart($userID = $userID, $cartStatus = 1, $isOrderPlaced = 0, $isCancel = 0, $orderBy = 'Desc', $orderNumber = []);
            if($getCart['totalCartAmount'] < 0)
            {
                return redirect()->back()->with('info', 'Your cart seems to be empty. Nothing to checkout.');
            }

            $data['userProfile'] = $this->getUserProfile($userID);
            $data['orderNumber'] = CartModel::where('userID', $userID)->where('status', 1)->where('is_order_placed', 0)->where('is_cancel', 0)->value('order_number');
            CartModel::where('userID', $userID)->where('order_number', $data['orderNumber'])->update(['checkout'=>1]);
            return $this->checkViewBeforeRender('checkout.checkout', $data);
        } catch (\Throwable  $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'checkOutController@checkoutDiscountAlgorithm', 'Error occured when trying to checkout.' );
        }

       return redirect()->route('shopCart')->with('info', 'We are unable to checkout your items! Please trying again.');
    }



}//end class
