<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\CheckoutPoolModel;
use App\Models\DeliveredUserProductModel;
use Session;
use Cache;
use View;



class ConfirmItemDeliveryController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }

    // create
    public function createItemDelivery($orderNumber = null)
    {
        $data['orderNumber'] = $orderNumber;
        return $this->checkViewBeforeRender('confirmItemDelivery.confirmItemDelivery', $data);
    }

    //Confirm delivery code
    public function processAndConfirmItemDelivery(Request $request)
    {
        $userID     = $this->getUserID();
        $success    = 0;
        $added      = 0;
        $complete   = 0;

        $this->validate($request,
        [
            'orderNumber'               => ['required', 'string', 'min:15', 'max:15',],
            'deliveryCode'              => ['required', 'string', 'min:23', 'max:23',],
            //'transactionNumber'         => ['required', 'string', 'min:12', 'max:12',],
            'buyFromStoreAssignedToYou' => ['required', 'numeric', 'min:1', 'max:1',],
            'yourExperience'            => ['required', 'min:10', 'max:500',],
        ]);
        $orderNumber    = $request['orderNumber'];
        $deliveryCode   = $request['deliveryCode'];
       //$transactionID  = $request['transactionNumber'];
        $buyFromStore   = $request['buyFromStoreAssignedToYou'];
        $userExperience = $request['yourExperience'];
        try{
            if($userID <> null && $orderNumber <> null && $deliveryCode <> null)
            {
                $getCheckoutPoolDetails = CheckoutPoolModel::where('userID', $userID)->where('receiver_order_number', $orderNumber)->first();
                if($getCheckoutPoolDetails && CartModel::where('order_number', $orderNumber)->where('delivery_code', $deliveryCode)->where('is_active', 1)->count())
                {
                    if(!DeliveredUserProductModel::where('userID', $userID)->where('order_number', $getCheckoutPoolDetails->order_number)->count())
                    {
                        //create
                        $userID         = $getCheckoutPoolDetails->userID;
                        $receiverID     = $getCheckoutPoolDetails->receiverID;
                        $receiverOrderNumber    = $getCheckoutPoolDetails->receiver_order_number;
                        $added = DeliveredUserProductModel::create([
                                'userID'                    => $userID,
                                'receiverID'                => $receiverID,
                                'user_store_details'        => $getCheckoutPoolDetails->user_store_details,
                                'order_number'              => $getCheckoutPoolDetails->order_number,
                                'receiver_order_number'     => $receiverOrderNumber,
                                'percentage_rate_from'      => $getCheckoutPoolDetails->percentage_rate_from,
                                'percentage_rate_to'        => $getCheckoutPoolDetails->percentage_rate_to,
                                'total_cart_amount'         => $getCheckoutPoolDetails->total_cart_amount,
                                'receiver_total_amount'     => $getCheckoutPoolDetails->receiver_total_amount,
                                'item_quantity'             => $getCheckoutPoolDetails->item_quantity,
                                'cart_item_list'            => $getCheckoutPoolDetails->cart_item_list,
                                'is_active'                 => 1,
                                'buy_from_store'            => $buyFromStore,
                                'user_experience'           => $userExperience,
                                'delivery_code'             => $deliveryCode,
                                'created_at'                => date('Y-m-d h:i:s a'),
                                'updated_at'                => date('Y-m-d h:i:s a'),
                        ]);
                        //Disable Receiver and active sender
                        DeliveredUserProductModel::where('userID', $getCheckoutPoolDetails->receiverID)->where('order_number', $receiverOrderNumber)
                            ->update([
                                'is_active'             => 0,
                                'updated_at'            => date('Y-m-d h:i:s a'),
                            ]);
                        //update cart: RECEIVER ITEMS HAS BEEN DELIVERED
                        CartModel::where('userID', $getCheckoutPoolDetails->receiverID)
                            ->where('order_number', $getCheckoutPoolDetails->receiver_order_number)
                            ->update([
                                'status'                => 0,
                                'is_active'             => 0,
                                'is_item_delivered'     => 1,
                                'updated_at'            => date('Y-m-d h:i:s a'),
                            ]);
                        if($added)
                        {
                            $getCheckoutPoolDetails->delete(); //CheckoutPoolModel::where('poolID', $getCheckoutPoolDetails->poolID)->delete();
                            ############# SEND ALL NOTIFICATIONs #################
                            try{
                                //Send Message To Receiver
                                $messageSender      = "Congratulations! Your item(s) with Order Number.: ". $receiverOrderNumber . " has been delivered to you. <br /><br />  Note: you can contact us if it appears that this item(s) has not been delivered to you. Ensure you let us know the details of the item(s). <br /><br />  Thank you. ";
                                $smsMessageReceiver = "";
                                if($this->sendMessageInbox($userID, $receiverID, $messageSender, $canReply = 0, $smsMessageReceiver))
                                {
                                    //Send Message To Sender
                                    $messageReceiver    = "Thank you for delivering this item(s) with order number: ". $receiverOrderNumber .".  Your order will be picked up for delivery within 48 hrs. <br /><br /> Thank you.";
                                    $smsMessageSender   = "";
                                    $this->sendMessageInbox(null, $userID, $messageReceiver, $canReply = 0, $smsMessageSender);
                                }
                            } catch (\Throwable  $errorThrown) {
                                $this->storeTryCatchError($errorThrown, 'ConfirmItemDeliveryController@processAndConfirmItemDelivery', 'Error occured when trying to send notification when user is confirming delivery code.' );
                            }
                            ############# END SEND ALL NOTIFICATION ##############

                            ############ Update User Level
                            $this->updateUserLevel($userID);

                            return redirect()->route('pendingItemNeedToDeliver')->with('message', 'Confirmed! Your delivery item(s) has been successfully confirmed. Your item(s) will be picked up for delivery. Thanks.');
                        }
                    }else{
                        DeliveredUserProductModel::where('receiverID', $getCheckoutPoolDetails->receiverID)->where('receiver_order_number', $orderNumber)
                            ->update([
                                'is_active'             => 0,
                                'updated_at'            => date('Y-m-d h:i:s a'),
                            ]);
                        return redirect()->route('confirmItemDelivery')->with('info', 'Already Confirmed! We noticed that you have already confirmed this delivery code.');
                    }
                }else{
                    return redirect()->route('confirmItemDelivery')->with('warning', 'Not Completed! Sorry, we were unable to complete you confirmation. Please check the delivery code and try again.');
                }
            }
           return redirect()->back()->with('error', 'Sorry, it seems you have entered a wrong delivery code, transaction number or order number!');
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ConfirmItemDeliveryController@processAndConfirmItemDelivery', 'Error occured on POST Request when trying to confirm item delivery.' );
        }
        return redirect()->back()->with('error', 'Sorry, we cannot confirm your delivery code now. please try again later.');
    }



}// end class
