<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;


class ShopCartController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    public function createShopCart($category = null)
    {

        $getCart = [];
        try{
            $getCart = $this->getItemInCart($userID = $this->getUserID(), $cartStatus = 1, $isOrderPlaced = 0, $isCancel = 0, $orderBy = 'Desc', $orderNumber = []);
        } catch (\Throwable  $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'ShopCartController@createShopCart', 'Trying to get all user items added to cart.' );
        }

        return $this->checkViewBeforeRender('shopCart.cart', $getCart);
    }
}
