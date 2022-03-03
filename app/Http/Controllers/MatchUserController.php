<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\UserProfileModel;
use App\Models\CheckoutPoolModel;
use App\Models\DeliveredUserProductModel;
use App\Models\ProductModel;
use App\Models\AgentOrderNumberModel;
use Session;
use Cache;



class MatchUserController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    ////viewWhoToDeliverTo
    public function  viewWhoToDeliverTo($userID = null, $orderNumber = null)
    {
        $data = [];
        try{
            $userID = $userID;
            $data = $this->viewUserStoreDetails($userID, $orderNumber);
            if($userID <> null && $orderNumber <> null && $data['getReceiverUserID'])
            {
                return $this->checkViewBeforeRender('matchUser.matchUserCheckout', $data)->with('message', 'Congratulation! Your item(s)/product(s) will soon be deliver. You need to deliver below items as soon as possible.');
            }else{
                return redirect()->back()->with('info', 'Sorry, we are unable to complete your checkout order. Please try again. Thank you.');
            }
        } catch (\Throwable  $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'MatchUserController@viewWhoToDeliverTo', 'Error occured when trying to view the user to deliver to and store to buy from.' );
        }
        return redirect()->back()->with('warning', 'Sorry, we could not complete your operation! Please try try again. Thank you.');
    }

    ############ MATCH USER ###################
    public function matchUserWithBestAlgorithm($orderNumber = null)
    {
        $myUserProfileDetails   = [];

        try{
            Cache::forget('cacheKeyItemICartProduct');
            $currentUserID              = $this->getUserID();
            $getOrderNumber             = $orderNumber;

            ##### VALIDATE ###### CHECK IF USER PASSES VALIDE ORDER NUMBER AND HE/SHE HAS CHECKEDOUT ##########
             if($getOrderNumber == null || CartModel::where('userID', $currentUserID)->where('order_number', $getOrderNumber)->where('checkout', 0)->first() )
             {
                 return redirect()->route('shopCart')->with('info', 'Sorry, you need to proceed to checkout or add new item to you cart!');
             }

            ############ CHECK IF USER HAS BEEN MATCHED OR NOT MATCH ###################
            if(CheckoutPoolModel::where('userID', $currentUserID)->where('order_number', $orderNumber)->first())
            {
                return redirect()->route('itemDelivery', ['u'=>$this->getUserID(), 'on'=>$getOrderNumber]);
            }else{
                #####VALIDATE###### CHECK CURRENT USER DELIVERY ADDRESS IF SET ELSE RETURN BACK ##########
                $myUserProfileDetails = $this->getUserProfile($currentUserID);
                if( $myUserProfileDetails && empty($myUserProfileDetails->delivery_address))
                {
                    return redirect()->route('checkout')->with('error', 'Sorry, you have to update your delivery address (also specify the time day/time to reach you)!');
                }

                ##### START TO MATCH RECEIVER WITH USER ##
                 ############## CALL MATCH USER FROM POOL ########
                $completedProcess = $this->getBestDiscountForUser($currentUserID, $getOrderNumber, $myUserProfileDetails->store_zip_code, $myUserProfileDetails->store_country);

                if($completedProcess)
                {
                        ############## VIEW RECEIVER MATCH AND STORE ########
                         ######### CLEAR CURRENT USER CART ##############
                        $clearMyCart = CartModel::where('userID', $currentUserID)
                            ->where('status', 1)
                            ->where('checkout', 1)
                            ->where('is_active', 1)
                            ->update([
                                'status'                => 0,
                                'is_order_placed'       => 1,
                                'updated_at'            => date('Y-m-d h:i:s a'),
                            ]);
                        if($clearMyCart)
                        {
                            return redirect()->route('itemDelivery', ['u'=>$this->getUserID(), 'on'=>$getOrderNumber]); //view selected user and store
                        }else{
                            return redirect()->route('shopCart')->with('warning', 'Sorry, we encountered problem when processing your order. Please try again.');
                        }
                }else{
                    //No match user found...Go back
                    return redirect()->route('shopCart')->with('info', 'Sorry, we are yet to get you the best discount price. Please try again by checking out your item(s). Thank you.');
                }
                return redirect()->route('shopCart')->with('warning', 'Sorry, we encountered problem when processing your order. Please try again.');
            }
        } catch (\Throwable  $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'MatchUserController@matchUserWithBestAlgorithm', 'Error occured when trying to match user with best algorithm.' );
        }

       return redirect()->route('shopCart')->with('info', 'We are unable to checkout your items! Please trying again.');
    }




    ############### GET RECEIVER OF ITEMS AND SELLER OF THOSE ITEMS
    public function getBestDiscountForUser($myUserID = null, $myOrderNumber = null, $myZipCode = null, $myCountry)
    {
        $returnReceiverAndSeller = [];
        $success                 = 0;

        try{
            $getMatchData10_29  = $this->getReceiverUserAndStoreSellerMatched($myUserID, $myOrderNumber, $myZipCode, $myCountry, $percentageFrom = 10, $percentageTo = 29.9);
            $getMatchData30_49  = $this->getReceiverUserAndStoreSellerMatched($myUserID, $myOrderNumber, $myZipCode, $myCountry, $percentageFrom = 30, $percentageTo = 49.9);
            $getMatchData50_69  = $this->getReceiverUserAndStoreSellerMatched($myUserID, $myOrderNumber, $myZipCode, $myCountry, $percentageFrom = 50, $percentageTo = 69.9);
            $getMatchData70_80  = $this->getReceiverUserAndStoreSellerMatched($myUserID, $myOrderNumber , $myZipCode, $myCountry, $percentageFrom = 70, $percentageTo = 80);

            if(DeliveredUserProductModel::where('userID', $myUserID)->first())
            {   //Returning User
                if($getMatchData10_29['getReceiverUserID'] &&  $getMatchData10_29['getSellerStoreDetails']){
                    $returnReceiverAndSeller = $getMatchData10_29;
                }elseif($getMatchData30_49['getReceiverUserID'] &&  $getMatchData30_49['getSellerStoreDetails']){
                    $returnReceiverAndSeller = $getMatchData30_49;
                }elseif($getMatchData50_69['getReceiverUserID'] &&  $getMatchData50_69['getSellerStoreDetails']){
                    $returnReceiverAndSeller = $getMatchData50_69;
                }elseif($getMatchData70_80['getReceiverUserID'] &&  $getMatchData70_80['getSellerStoreDetails']){
                    $returnReceiverAndSeller = $getMatchData70_80;
                }else{
                    ######## PLAN B FOR ADMIN #########
                    $getPlanB = $this->planB_IfNoMatchFound($myUserID, $myOrderNumber, $percentageFrom = 10, $percentageTo = 40, $myZipCode, $myCountry);
                    if($getPlanB['getReceiverUserID'] <> null)
                    {
                        $returnReceiverAndSeller = $getPlanB;
                    }else{
                        $returnReceiverAndSeller = [];
                        $returnReceiverAndSeller['getReceiverUserID']         = null;
                        $returnReceiverAndSeller['getReceiverItemList']       = [];
                        $returnReceiverAndSeller['getSellerStoreDetails']     = [];
                    }
                }
            }else{
                //New user
                if($getMatchData30_49['getReceiverUserID'] &&  $getMatchData30_49['getSellerStoreDetails']){
                    $returnReceiverAndSeller = $getMatchData30_49;
                }elseif($getMatchData50_69['getReceiverUserID'] &&  $getMatchData50_69['getSellerStoreDetails']){
                    $returnReceiverAndSeller = $getMatchData50_69;
                }elseif($getMatchData10_29['getReceiverUserID'] &&  $getMatchData10_29['getSellerStoreDetails']){
                        $returnReceiverAndSeller = $getMatchData10_29;
                }elseif($getMatchData70_80['getReceiverUserID'] &&  $getMatchData70_80['getSellerStoreDetails']){
                    $returnReceiverAndSeller = $getMatchData70_80;
                }else{
                    ######## PLAN B FOR ADMIN #########
                    $getPlanB = $this->planB_IfNoMatchFound($myUserID, $myOrderNumber, $percentageFrom = 10, $percentageTo = 60, $myZipCode, $myCountry);
                    if($getPlanB['getReceiverUserID'] <> null)
                    {
                        $returnReceiverAndSeller = $getPlanB;
                    }else{
                        $returnReceiverAndSeller = [];
                        $returnReceiverAndSeller['getReceiverUserID']         = null;
                        $returnReceiverAndSeller['getReceiverItemList']       = [];
                        $returnReceiverAndSeller['getSellerStoreDetails']     = [];
                    }
                }
            }
            ###### UPDATE CHECKOUT POOL ####
            if($returnReceiverAndSeller && $returnReceiverAndSeller['getReceiverItemList'] && $returnReceiverAndSeller['getSellerStoreDetails'] && $returnReceiverAndSeller['getReceiverUserID'])
            {
                $receiverID             = $returnReceiverAndSeller['getReceiverUserID'];
                $receiverOrderNumber    = $returnReceiverAndSeller['getReceiverOrderNumber'];
                $success                = CheckoutPoolModel::create([
                    'userID'                => $myUserID,
                    'order_number'          => $myOrderNumber,
                    'receiverID'            => $receiverID,
                    'user_store_details'    => json_encode($returnReceiverAndSeller['getSellerStoreDetails']),
                    'receiver_order_number' => $receiverOrderNumber,
                    'percentage_rate_from'  => $returnReceiverAndSeller['percentageFrom'],
                    'percentage_rate_to'    => $returnReceiverAndSeller['percentageTo'],
                    'total_cart_amount'     => $returnReceiverAndSeller['totalCartAmount'],
                    'receiver_total_amount' => $returnReceiverAndSeller['userDiscountedTotalCartAmount'],
                    'item_quantity'         => $returnReceiverAndSeller['totalNumberOfItemToDeliver'],
                    'cart_item_list'        => json_encode($returnReceiverAndSeller['getReceiverItemList']),
                    'created_at'            => date('Y-m-d h:i:s a'),
                    'updated_at'            => date('Y-m-d h:i:s a'),
                    'is_active'             => 1,
                ]);
                if($success)
                {
                    ############# SEND NOTIFICATION ON MATCH NEW USER #################
                    try{
                        //Send Message To Receiver
                        $messageSender = "There is item(s) that needs to be delivered to you within 48 hrs with Order Number.: ". $receiverOrderNumber . " <br /> Login to your account to view this item delivery code. <br /><br />  Note: never disclose your delivery code untill you received the item. <br /><br />  Thank you. ";
                        if($this->sendMessageInbox($myUserID, $receiverID, $messageSender, $canReply = 0))
                        {
                            //Send Message To Sender
                            $messageReceiver = "You are to deliver this item(s) with order number: ". $receiverOrderNumber ." to the receiver details within 48 hrs else the order will be cancelled. <br /><br />  Note, the user had been notified about your delivery. <br /><br />  Thank you.";
                            $this->sendMessageInbox(null, $myUserID, $messageReceiver, $canReply = 0);
                        }
                    } catch (\Throwable $errorThrown) {
                        $this->storeTryCatchError($errorThrown, 'MatchUserController@getBestDiscountForUser', 'Error occured when trying to send notification when match user.' );
                    }
                    ############# END SEND ALL NOTIFICATION ##############
                }
            }else{
                $success = 0;
            }
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'MatchUserController@getBestDiscountForUser', 'Error occured when trying to get the best discount rate for user.' );
        }
        return $success;
    }


    #######GET USER PERCENTAGE RATE AND CALCULATE SEARCH USER AMOUNT FROM THE POOL
    public function getReceiverUserAndStoreSellerMatched($userID = null, $orderNumber = null, $zipCode = null, $country = null, $percentageFrom = 10, $percentageTo = 20)
    {
        $data                                   = [];
        $newUserIDFromPool                      = null; //New Receiver User
        $getUserOrderNumber                     = null; //New Receiver user order number
        $newUserFromPoolTotalCartAmount         = 0.00;
        $data['getReceiverUserID']              = null;
        $data['getReceiverOrderNumber']         = null;
        $data['percentageFrom']                 = $percentageFrom;
        $data['percentageTo']                   = $percentageTo;
        $data['userDiscountedTotalCartAmount']  = 0.00;
        $data['totalCartAmount']                = 0.00;
        $data['getReceiverItemList']            = [];
        $data['getSellerStoreDetails']          = [];
        $data['totalNumberOfItemToDeliver']     = 0;

        if($userID <> null && $orderNumber <> null)
        {
            try{
                    ### Get User Amount
                    $getUserAmountAndQuantity   = $this->getUserTotalCartAmount($userID, $orderNumber);
                    $myTotalCartAmount          = $getUserAmountAndQuantity['totalAmount'];

                    //compute discount on current user amount
                    $getDiscounted              = $this->computeBestDiscountAmount($myTotalCartAmount, $percentageFrom, $percentageTo);
                    $getDiscountedNewAmountFrom = $getDiscounted['getDiscountedNewAmountFrom'];
                    $getDiscountedNewAmountTo   = $getDiscounted['getDiscountedNewAmountTo'];

                    //get all awaiting users from pool
                    $getAllActiveUsers = DeliveredUserProductModel::where($this->deliveredUserProductModel->getTable().'.userID', '<>', $userID)
                        ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->deliveredUserProductModel->getTable().'.userID')
                        ->where($this->deliveredUserProductModel->getTable().'.is_active', 1)
                        ->where(function ($query) use ($zipCode, $country) {
                            $query->orwhere($this->userProfileModel->getTable().'.store_zip_code', $zipCode)
                            ->orwhere($this->userProfileModel->getTable().'.store_country', $country);
                        })
                        ->select($this->deliveredUserProductModel->getTable().'.userID', $this->deliveredUserProductModel->getTable().'.order_number')
                        ->orderBy($this->deliveredUserProductModel->getTable().'.deliveredID', 'Asc')
                        ->get();

                    if($getAllActiveUsers)
                    {
                        foreach($getAllActiveUsers as $item)
                        {
                            $getNewUserAmountAndQuantity           = $this->getUserTotalCartAmount($item->userID, $item->order_number);
                            $newUserFromPoolTotalCartAmount = $getNewUserAmountAndQuantity['totalAmount'];
                            if(($newUserFromPoolTotalCartAmount >= $getDiscountedNewAmountTo) && ($newUserFromPoolTotalCartAmount <= $getDiscountedNewAmountFrom))
                            {
                                $newUserIDFromPool  = $item->userID;
                                $getUserOrderNumber = $item->order_number;
                                break;
                            }
                        }
                    }
                    $getStoreDetails = $this->getUserStoreToBuyFrom($newUserIDFromPool, $getUserOrderNumber);
                    $allItemInCart   = $this->getItemInCart($newUserIDFromPool, $cartStatus = 0, $isOrderPlaced = 1, $isCancel = 0, $orderBy = 'Desc', [$getUserOrderNumber]);
                    if($getStoreDetails && $allItemInCart)
                    {
                        $data['getReceiverUserID']              = $newUserIDFromPool;
                        $data['getReceiverOrderNumber']         = $getUserOrderNumber;
                        $data['percentageFrom']                 = $percentageFrom;
                        $data['percentageTo']                   = $percentageTo;
                        $data['totalCartAmount']                = $myTotalCartAmount;
                        $data['getReceiverItemList']            = ($allItemInCart['itemInCart'] ? $allItemInCart : []);
                        $data['totalNumberOfItemToDeliver']     = ($allItemInCart['itemQuantity'] ? $allItemInCart['itemQuantity'] : 0);
                        $data['userDiscountedTotalCartAmount']  = $newUserFromPoolTotalCartAmount;
                        $data['getSellerStoreDetails']          = $getStoreDetails;
                    }

            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'MatchUserController@getReceiverUserAndStoreSellerMatched', 'Error occured when try to get user from the pool.' );
            }
        }
        return $data;
    }


    ### GET USER STORE TO BUY FROM
    public function getUserStoreToBuyFrom($userID = null, $orderNumber = null)
    {
        $storeDetails  = [];
        try{
            if($userID <> null && $orderNumber <> null)
            {
                $storeToken = CartModel::where('order_number', $orderNumber)->value('store_token');
                if($storeToken)
                {
                    $storeDetails = UserProfileModel::where('storeID', $storeToken)
                    ->leftjoin($this->user->getTable(), $this->user->getTable().'.id', '=', $this->userProfileModel->getTable().'.userID')
                    ->select('userID', 'user_token', 'phone_number', 'store_phone_number', 'storeID', 'currencyID', 'storeID', 'store_country', 'store_state', 'store_city', 'store_name', 'store_address1', 'store_address2', 'store_logo', 'store_description')
                    ->get();
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MatchUserController@getUserStoreToBuyFrom', 'Error occured when try to get store details based on the item user added to cart.' );
        }
        return $storeDetails;
    }


    ########### VIEW USER AND STORE DETAILS
    public function viewUserStoreDetails($userID = null,  $orderNumber = null, $status = null)
    {
        $data                                   = [];
        $data['poolID']                         = null;
        $data['getReceiverUserID']              = null;
        $data['getReceiverOrderNumber']         = null;
        $data['getOrderNumber']                 = null;
        $data['percentageFrom']                 = 0;
        $data['percentageTo']                   = 0;
        $data['totalCartAmount']                = 0.0;
        $data['getReceiverItemList']            = [];
        $data['totalNumberOfItemToDeliver']     = 0;
        $data['userDiscountedTotalCartAmount']  = 0.0;
        $data['getSellerStoreDetails']          = [];
        $data['getReceiverDetails']             = null;
        $data['productPath']                    = null;
        $data['productImages']                  = null;
        $data['productPath300x300']             = null;
        $data['productPath500x500']             = null;
        $data['isItemDeliveredToUser']          = null;
        $data['getDeliveryCode']                = null;
        $data['setUserFullName']                = null;
        $getMatchData                           = null;
        try{
            if($userID <> null && $orderNumber <> null)
            {
                //VIEW USER AND STORE DETAILS
                if($status == 'item_pending_to_deliver_to_me')
                {
                    $getMatchData = CheckoutPoolModel::where('receiverID', $userID)->where('receiver_order_number', $orderNumber)->first();
                }elseif($status == 'item_pending_to_deliver_to_user')
                {
                    $getMatchData = CheckoutPoolModel::where('userID', $userID)->where('order_number', $orderNumber)->first();
                }elseif($status == 'item_delivered_to_me')
                {
                    $getMatchData = DeliveredUserProductModel::where('receiverID', $userID)->where('receiver_order_number', $orderNumber)->first();
                }elseif($status == 'item_i_have_delivered_to_user')
                {
                    $getMatchData = DeliveredUserProductModel::where('userID', $this->getUserID())->where('receiverID', $userID)->where('receiver_order_number', $orderNumber)->first();
                }elseif($status == 'agent_view_order_details'){
                    $getMatchData = CheckoutPoolModel::where('userID', $userID)->where('receiver_order_number', $orderNumber)->first();
                }else{
                    $getMatchData = CheckoutPoolModel::where('userID', $userID)->where('order_number', $orderNumber)->first();
                }
                $data['setUserFullName'] = $this->getUserFullName($userID);

                if($getMatchData)
                {
                    $data['poolID']                         = $getMatchData->poolID;
                    $data['getReceiverUserID']              = $getMatchData->receiverID;
                    $data['getReceiverOrderNumber']         = $getMatchData->receiver_order_number;
                    $data['getOrderNumber']                 = $getMatchData->order_number;
                    $data['percentageFrom']                 = $getMatchData->percentage_rate_from;
                    $data['percentageTo']                   = $getMatchData->percentage_rate_to;
                    $data['totalCartAmount']                = $getMatchData->total_cart_amount;
                    $data['isItemDeliveredToUser']          = $getMatchData->is_item_delivered_to_user;
                    $data['getDeliveryCode']                = CartModel::where('userID', $data['getReceiverUserID'])->where('order_number', $data['getReceiverOrderNumber'])->value('delivery_code');

                    $getItemList                            = json_decode($getMatchData->cart_item_list);
                    if($getItemList)
                    {
                        $data['getReceiverItemList']            = ($getItemList->itemInCart);
                        $data['productPath']                    = $getItemList->productPath;
                        $data['productImages']                  = $getItemList->productImages;
                        $data['productPath300x300']             = $getItemList->productPath300x300;
                        $data['productPath500x500']             = $getItemList->productPath500x500;
                    }

                    $data['totalNumberOfItemToDeliver']     = $getMatchData->item_quantity;
                    $data['userDiscountedTotalCartAmount']  = $getMatchData->receiver_total_amount;
                    //GET MATCH STORE DETAILS
                    $data['getSellerStoreDetails']          = json_decode($getMatchData->user_store_details);
                    //GET MATCH RECEIVER DETAILS
                    $data['getReceiverDetails']             = ($getMatchData->receiverID ? UserProfileModel::where('userID', $getMatchData->receiverID)->first() : []);
                }//
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MatchUserController@viewUserStoreDetails', 'Error occured when try to load/create user picked from the pool and store details.');
        }
        return $data;
    }



    ######## PLAN B IF NO MATCH FOUND
    public function planB_IfNoMatchFound($userID = null, $orderNumber = null, $percentageFrom = 10, $percentageTo = 70, $zipCode = null, $country = null)
    {
        $data = [];
        $createNewCartSuccess   = 0;
        $checkoutPoolSuccess    = 0;
        $data['getReceiverUserID']              = null;
        $data['getReceiverOrderNumber']         = null;
        $data['percentageFrom']                 = $percentageFrom;
        $data['percentageTo']                   = $percentageTo;
        $data['totalCartAmount']                = 0.0;
        $data['getReceiverItemList']            = [];
        $data['totalNumberOfItemToDeliver']     = 0;
        $data['userDiscountedTotalCartAmount']  = 0.0;
        $data['getSellerStoreDetails']          = [];

        try{

            if($userID <> null && $orderNumber <> null)
            {
                //get user details
                ### Get User Amount
                $getAmountAndQuantity   = $this->getUserTotalCartAmount($userID, $orderNumber);
                $myTotalCartAmount      = $getAmountAndQuantity['totalAmount'];

                //compute discount on current user amount
                $getDiscountForUser         = $this->computeBestDiscountAmount($myTotalCartAmount, $percentageFrom, $percentageTo);
                $userTotalCartAmount        = $myTotalCartAmount;
                $getDiscountedNewAmountFrom = $getDiscountForUser['getDiscountedNewAmountFrom'];
                $getDiscountedNewAmountTo   = $getDiscountForUser['getDiscountedNewAmountTo'];

                //pick any product that matches the discounted price
                $getProductMatched = ProductModel::where('is_online', 1)->where('admin_status', 1)->where('is_deleted', 0)
                                        ->where('original_price', '>=', $getDiscountedNewAmountTo)
                                        ->where('original_price', '<=', $getDiscountedNewAmountFrom)
                                        ->orderBy('created_at', 'Asc')
                                        ->first();
                //dd($getProductMatched->original_price .' -'.  $myTotalCartAmount . ' - '. $getDiscountedNewAmountTo .' to '. $getDiscountedNewAmountFrom);
                ###########Admin has User_Role ID of 1 in DB #############
                //add item to cart for admin user
                $getAdminDetails = UserProfileModel::where('user_role', 1)->where('status', 1)->where('userID', '<>', $this->getUserID())
                                    ->where(function ($query) use ($zipCode, $country) {
                                        $query->orwhere($this->userProfileModel->getTable().'.store_zip_code', $zipCode)
                                        ->orwhere($this->userProfileModel->getTable().'.store_country', $country);
                                    })
                                    ->inRandomOrder()
                                    ->first();

                if($getAdminDetails && $getProductMatched)
                {
                    $createNewCartSuccess = CartModel::create([
                        'userID'                => $getAdminDetails->userID,
                        'productID'             => $getProductMatched->productID,
                        'quantity'              => 1,
                        'transactionID'         => $this->generateRandomAlphaNumeric(12),
                        'delivery_code'         => $this->generateRandomAlphaNumeric(23),
                        'store_token'           => $this->getStoreID($getProductMatched->productID),
                        'order_number'          => $this->generateRandomAlphaNumeric(15),
                        'status'                => 0,
                        'is_cancel'             => 0,
                        'is_order_placed'       => 1,
                        'checkout'              => 1,
                        'created_at'            => date('Y-m-d h:i:s a'),
                        'updated_at'            => date('Y-m-d h:i:s a'),
                    ]);
                    $orderNumber        = $createNewCartSuccess->order_number;
                    $newUserIDFromPool  = $getAdminDetails->userID;
                    //add item to checkoutpool for admin user
                    if($createNewCartSuccess)
                    {
                            $data['getReceiverUserID']              = $newUserIDFromPool;
                            $data['getReceiverOrderNumber']         = $orderNumber;
                            $data['percentageFrom']                 = $percentageFrom;
                            $data['percentageTo']                   = $percentageTo;
                            $data['totalCartAmount']                = $userTotalCartAmount;
                            Cache::forget('cacheKeyItemICartProduct');
                            $allItemInCart                          = $this->getItemInCart($newUserIDFromPool, $cartStatus = 0, $isOrderPlaced = 1, $isCancel = 0, $orderBy = 'Desc', [$orderNumber]);
                            $data['getReceiverItemList']            = ($allItemInCart['itemInCart'] ? $allItemInCart : []);
                            $data['totalNumberOfItemToDeliver']     = ($allItemInCart['itemQuantity'] ? $allItemInCart['itemQuantity'] : 0);
                            $data['userDiscountedTotalCartAmount']  = $getProductMatched->original_price;
                            $data['getSellerStoreDetails']          = $this->getUserStoreToBuyFrom($newUserIDFromPool, $orderNumber);

                    }
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MatchUserController@planB_IfNoMatchFound', 'Error occured when try to create admin for plan B when no match was found for user.');
        }

        return $data;
    }//end fun



    public function orderCancellationUserMatch(Request $request)
    {
        $poolID                 = $request['poolID'];
        $orderNumber            = $request['orderNumber'];
        $getReceiverOrderNumber = $request['getReceiverOrderNumber'];

        if($request['poolID'] && $request['orderNumber'] && $getReceiverOrderNumber)
        {
            try{
                $getDetails = CheckoutPoolModel::where('poolID', $poolID)->first();
                //delete
                $is_user        = CartModel::where('order_number', $orderNumber)->delete();
                //NOTE: Never delete receiver cart items  ===== //$is_receiver    = CartModel::where('order_number', $getReceiverOrderNumber)->delete();
                $is_pool        = CheckoutPoolModel::where('poolID', $poolID)->delete();

                if($is_user || $is_pool)
                {
                    ############## cancel Agent order ##################
                    AgentOrderNumberModel::where('order_number', $getReceiverOrderNumber)->update(['is_active' => 0]);

                    ############# SEND NOTIFICATION ON ORDER CANCELLATION #################
                     try{
                        //Send Message To Receiver
                        $messageSender      = "We are very sorry to inform you that the user that ought to deliver this item with Order Number.: ". $getReceiverOrderNumber . " had cancelled the order due to some reason unknown to us. <br /> Thus, we will notify you has another user picks up your delivery. <br /> <br /> Thank you. ";
                        $smsMessageReceiver = "";
                        if($this->sendMessageInbox($getDetails->userID, $getDetails->receiverID, $messageSender, $canReply = 0, $smsMessageReceiver))
                        {
                            //Send Message To Sender
                            $messageReceiver    = "You have cancelled an item with order number: ". $getReceiverOrderNumber ." which ought to be delivered within 48 hrs. Cancelling order reduces your rating and can lead to ban. <br /> <br /> Thank you.";
                            $smsMessageSender   = "";
                            $this->sendMessageInbox(null, $getDetails->userID, $messageReceiver, $canReply = 0, $smsMessageSender);
                        }
                    } catch (\Throwable  $errorThrown) {
                        $this->storeTryCatchError($errorThrown, 'MatchUserController@orderCancellationUserMatch', 'Error occured when trying to send notification when user cancelled order.' );
                    }
                    ############# END SEND ALL NOTIFICATION ##############
                }

                return redirect()->route('pendingItemNeedToDeliver')->with('message', 'Your order was cancelled successfully. You can place a new order now.');
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'MatchUserController@orderCancellationUserMatch', 'Error occured when try to cancel order that had been matched.');
            }
        }
        return redirect()->route('pendingItemNeedToDeliver')->with('warning', 'sorry, we cannot cancel this order now. Please try again.');
    }




}// end class
