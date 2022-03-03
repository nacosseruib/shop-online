<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryAgentModel;
use App\Models\AgentIDCardModel;
use App\Models\AgentOrderNumberModel;
use App\Models\CheckoutPoolModel;
use App\Http\Controllers\MatchUserController;
use Cache;
use Session;

class DeliveryAgentController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }



    //View inbox
    public function createListofDeliveryAgent()
    {
        Session::forget('agentToEdit');
        $data['listAgent'] = null;
        try{
            $allAgents = Cache::remember('cacheKeyAgentList', $this->appCacheTime(10), function ()
            {
                $agents['allActiveAgent'] = DeliveryAgentModel::where($this->deliveryAgentModel->getTable().'.admin_status', 1)->where($this->deliveryAgentModel->getTable().'.status', 1)
                        ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->deliveryAgentModel->getTable().'.userID')
                        ->orderBy($this->deliveryAgentModel->getTable().'.agent_fullname', 'Asc')
                        ->select('agentID', 'delivery_charge_plan', $this->deliveryAgentModel->getTable().'.email', $this->deliveryAgentModel->getTable().'.address', $this->deliveryAgentModel->getTable().'.userID', 'agent_fullname', $this->deliveryAgentModel->getTable().'.gender', $this->deliveryAgentModel->getTable().'.phone_number', 'store_country', 'store_state', 'store_city')
                        ->paginate(30);
                $agentPath = [];
                foreach($agents['allActiveAgent'] as $key=>$valeu)
                {
                    $agentPath[$key]  = $this->getAgentProfilePicture($valeu->userID);
                }
                $agents['getPath']  = $agentPath;
                return $agents;
            });
            $data['listAgent'] = $allAgents['allActiveAgent'];
            $data['agentPath'] = $allAgents['getPath'];
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@createListofDeliveryAgent', 'Error occured when listing all agents.' );
        }

        return $this->checkViewBeforeRender('deliveryAgent.listAgent.listAgentPage', $data);
    }


    //Create New: Agent Registration
    public function createNewAgentRegistration()
    {
        $data       = [];
        $userID     = $this->getUserID();
        if(Session::get('agentToEdit'))
        {
            $data['agentDetails'] = Session::get('agentToEdit');
        }else{
            Session::forget('agentToEdit');
            //check if user had register before
            if(DeliveryAgentModel::where('userID', $userID)->count())
            {
                return redirect()->back()->with('info', 'You have already submitted a delivery agent application form! Update your profile or contact us. Thank you.');
            }
        }
        return $this->checkViewBeforeRender('deliveryAgent.applyForAgent.agentFormPage', $data);
    }


    //Store/create new Agent
    public function storeAgentRegistration(Request $request)
    {
         //validation
         $this->validate($request,
         [
             'agentName'             => ['required', 'string', 'max:200'],
             'phoneNumber'           => ['required', 'string', 'max:100'],
             'email'                 => ['required', 'email', 'max:100'],
             'contactAddress'        => ['required', 'string', 'max:100'],
             'gender'                => ['required', 'string', 'max:100'],
             'deliveryChargesPlan'   => ['required', 'string'],
         ]);
        //try{
            $agentID                = $request['agentIDToEdit'];
            $complete               = null;
            $userID                 = $this->getUserID();
            $uploadCompletePathName = $this->uploadPath() . 'profile/';
            $uploadCompletePathNameThumbnail300X300 = $uploadCompletePathName . '300x300/';
            $uploadCompletePathNameThumbnail500X500 = $uploadCompletePathName . '500x500/';
            $uploadCompleteIDCardPathName = $this->uploadPath() . 'IDCard/';
            $uploadCompleteIDCardPathNameThumbnail300X300 = $uploadCompleteIDCardPathName . '300x300/';
            $uploadCompleteIDCardPathNameThumbnail500X500 = $uploadCompleteIDCardPathName . '500x500/';

            if($agentID)
            {
                $this->validate($request,
                [
                    'agentName'                 => ['required', 'string', 'max:200', 'unique:delivery_agent,agent_fullname,'.$userID.',userID'],
                ]);
            }else{
                $this->validate($request,
                [
                    'agentName'                 => ['required', 'string', 'max:200', 'unique:delivery_agent,agent_fullname'],
                    'passport'                  => ['required', 'image', 'mimes:png,jpg,jpe,jpeg,gif', 'max: 2140'],
                    'nationalIDCard'            => ['required'],
                    'nationalIDCard.*'          => ['image', 'mimes:png,jpg,jpe,jpeg,gif', 'max: 2140'],
                ]);
            }
            //Upload File
            if($userID)
            {
                //Update or create New Agent
                $complete = DeliveryAgentModel::updateOrCreate(
                    [
                        'userID'                => $userID
                        //'agentID'               => $agentID
                    ],
                    [
                        'agent_fullname'        => $request['agentName'],
                        'gender'                => $request['gender'],
                        'address'               => $request['contactAddress'],
                        'phone_number'          => $request['phoneNumber'],
                        'email'                 => $request['email'],
                        'delivery_charge_plan'  => $request['deliveryChargesPlan'],
                        'status'                => (isset($request['status']) ? $request['status'] : 1),
                        'updated_at'            => date('Y-m-d h:i:s a'),
                    ]
                );
                if($complete)
                {
                    //Upload Agent National ID Card
                    if($request->hasFile('nationalIDCard') && !AgentIDCardModel::where('userID', $userID)->where('approved', 1)->count())
                    {
                        foreach($request['nationalIDCard'] as $keyImage => $file)
                        {
                            $getArrayResponse = $this->uploadAnyFile($file, $uploadCompleteIDCardPathName, $maxFileSize = 5, $newExtension = null, $newRadFileName = true);
                            if($getArrayResponse)
                            {
                                if($getArrayResponse['success']){
                                    AgentIDCardModel::create(
                                        [
                                            'userID'            => $userID,
                                            'agentID'           => ($agentID ? $agentID : $complete->agentID),
                                            'file_name'         => $getArrayResponse['newFileName'],
                                            'created_at'        => date('Y-m-d h:i:s a'),
                                        ]
                                    );
                                }
                                //Resize Product Thumbnail - 300X300
                                $this->createThumbnail($uploadCompleteIDCardPathName . $getArrayResponse['newFileName'], $uploadCompleteIDCardPathNameThumbnail300X300 . $getArrayResponse['newFileName'], $width = 300, $height = 300, $is_resize_canvas = 0);
                                //Resize Product Thumbnail - 500X500
                                $this->createThumbnail($uploadCompleteIDCardPathName . $getArrayResponse['newFileName'], $uploadCompleteIDCardPathNameThumbnail500X500 . $getArrayResponse['newFileName'], $width = 500, $height = 500, $is_resize_canvas = 0);
                            }
                        }
                    }
                    //upload agent passport
                    if($request->hasFile('passport'))
                    {
                        $getArrayResponse = $this->uploadAnyFile($request['passport'], $uploadCompletePathName, $maxFileSize = 5, $newExtension = null, $newRadFileName = true);
                        if($getArrayResponse)
                        {
                            if($getArrayResponse['success'])
                            {
                                DeliveryAgentModel::updateOrCreate(
                                    ['userID'            => $userID],
                                    [
                                        'picture'           => $getArrayResponse['newFileName'],
                                        'updated_at'        => date('Y-m-d h:i:s a')
                                    ]
                                );
                            }
                            //Resize Product Thumbnail - 300X300
                            $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail300X300 . $getArrayResponse['newFileName'], $width = 300, $height = 300, $is_resize_canvas = 0);
                            //Resize Product Thumbnail - 500X500
                            $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail500X500 . $getArrayResponse['newFileName'], $width = 500, $height = 500, $is_resize_canvas = 0);
                        }
                    }
                }
            }else{
                $complete = 0;
                Session::forget('agentToEdit');
            }
         /* }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@storeAgentRegistration', 'Error occured on POST Request when trying to create new agent' );
        } */
        if($complete)
        {
            Session::forget('agentToEdit');
            if($agentID)
            {
                return redirect()->route('myProfile')->with('message', 'Your profile was Updated successfully.');
            }else{
                return redirect()->route('myProfile')->with('message', 'Congratulations! You have been successfully registered as a delivery agent. You will be enlisted after we verified your data. Thank you.');
            }
        }else{
            return redirect()->route('registerNewAgent')->with('error', 'Sorry, we are unable to complete your registration! Please try again. Thank you.');
        }

    }



    //Edit Agent
    public function getAgentToEdit()
    {
        Session::forget('agentToEdit');
        try{
            ###########Check user is agent#################
            if(!$this->getUserAgentStatus()){ return redirect()->back()->with('info', 'Sorry, you are not authorized to perform this task.'); }
            ###############################################

            $userID = $this->getUserID();
            if(DeliveryAgentModel::where('userID', $userID)->count())
            {
                //Agent details
                $agentModel = DeliveryAgentModel::where('userID', $userID)->first();
                Session::put('agentToEdit', $agentModel);
                return redirect()->route('registerNewAgent')->with('info', 'You can edit your agent profile details now!');
            }else{
                return redirect()->back()->with('error', 'Sorry, we are having some errors while updating your record. Please try again. Thank you.');
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@getAgentToEdit', 'Error occured on GET Request when trying to query product to edit' );
        }
        return redirect()->back()->with('error', 'Sorry, we cannot edit your record now! Please try again.');
    }


    //Cancel Product to edit
    public function cancelAgentEdit()
    {
        Session::forget('agentToEdit');

        return redirect()->route('myProfile')->with('info', 'Your agent profile editing was cancelled');
    }


    //#SEND ORDER NUMBER TO AGAENT
    public function SendOrderNumberToAgent($agentUserID = null, $orderNumber = null, $message = null)
    {
        $complete = 0;//not success
        if(CheckoutPoolModel::where('receiver_order_number', $orderNumber)->where('is_active', 0)->first())
        {
            $complete = 2; //paid
        }else{
            try{
                $userID = $this->getUserID();
                $complete = AgentOrderNumberModel::updateOrCreate(
                    [
                        'senderID'               => $userID,
                        'order_number'           => $orderNumber
                    ],
                    [
                        'receiverID'            => $agentUserID,
                        'message'               => $message,
                        'updated_at'            => date('Y-m-d h:i:s a'),
                    ]
                );
                if($complete){
                    //Send Message To receiver
                    $messageReceiver    = "A new delivery order received with order no.: ". $orderNumber .". We urge you to expedite delivery.  <br /><br /><em> ". $message ."</em><br /><br /> Thank you.";
                    $smsMessageSender   = "A new delivery order received with order no.: ". $orderNumber .". We urge you to expedite delivery. Thks.";
                    $this->sendMessageInbox($userID, $agentUserID, $messageReceiver, $canReply = 1, $smsMessageSender);
                    //Send Message To Sender
                    $messageReceiver    = "Thank you. I receiver your order with order number: ". $orderNumber .". I will get back to you shortly.<br /><br /> Thank you.";
                    $smsMessageSender   = null;
                    $this->sendMessageInbox($agentUserID, $userID, $messageReceiver, $canReply = 1, $smsMessageSender);
                }
                $complete = 1;
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@SendOrderNumberToAgent', 'Error occured on GET Request when trying send order number to agent.' );
            }
        }
        return $complete;
    }


    //CREATE AGENT RATING
    public function createAgentRating($agentUserID = null)
    {
        $data = [];
        try{
            $data['getAgentRating'] = 1;

            return $this->checkViewBeforeRender('deliveryAgent.agentRating.ratingPage', $data);
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@createAgentRating', 'Error occured on GET Request when creating agent rating page.' );
        }
    }


    //CREATE AGENT ORDER
    public function createAgentOrder()
    {
        $data = [];
        $data['showPageAgentOrder'] = 1;
        try{
            ###########Check user is agent#################
            if(!$this->getUserAgentStatus()){ return redirect()->back()->with('info', 'Sorry, you are not authorized to perform this task.'); }
            ###############################################
            $userID = $this->getUserID();
            $data['listAgentOrder'] = AgentOrderNumberModel::where($this->agentOrderNumberModel->getTable().'.receiverID', $userID)
                        ->join($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->agentOrderNumberModel->getTable().'.senderID')
                        ->orderBy($this->agentOrderNumberModel->getTable().'.ID', 'Desc')
                        ->select('senderID', $this->userProfileModel->getTable().'.first_name', $this->userProfileModel->getTable().'.last_name', $this->userProfileModel->getTable().'.profile_picture', $this->userProfileModel->getTable().'.phone_number', $this->agentOrderNumberModel->getTable().'.*')
                        ->paginate(30);
            $agentPath = [];
            foreach($data['listAgentOrder'] as $key=>$value)
            {
                $path = $this->getUserPathImage($value->senderID, $value->profile_picture, 'profile');
                $agentPath[$key]  = $path['filePathbest'];
            }
            $data['getPath']  = $agentPath;
            return $this->checkViewBeforeRender('deliveryAgent.listAgentOrder.listOrderPage', $data);
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@createAgentOrder', 'Error occured when listing all order submitted to agent.' );
        }
    }


    //#### Agent - Accept or Reject user order
    public function agentAcceptRejectUserOrder($agentOrderID = null, $actionID = null)
    {
        $success = 0;
        try{
            ###########Check user is agent#################
            if(!$this->getUserAgentStatus()){ return redirect()->back()->with('info', 'Sorry, you are not authorized to perform this task.'); }
            ###############################################

            $getRecordDetails = AgentOrderNumberModel::find($agentOrderID);
            if($getRecordDetails)
            {
                //send notification
                try{
                    //Send Message To Receiver
                    $messageSender      = "I got your message. Your order with order number: ".  $getRecordDetails->order_number ." has been ". ($actionID ? 'accepted. <br /> I will deliver your item and get back to you with your DELIVERY CODE.' : 'rejected. <br /> I will be unable to deliver your item.') ."  <br /><br /> Thank you.";
                    $smsMessageReceiver = "Agent reply: Your order with order number: ".  $getRecordDetails->order_number ." has been ". ($actionID ? 'accepted' : 'rejected'). ". <br /> <br /> Thank you.";
                    $this->sendMessageInbox($getRecordDetails->receiverID, $getRecordDetails->senderID, $messageSender, $canReply = 1, $smsMessageReceiver);
                } catch (\Throwable  $errorThrown) {
                    $this->storeTryCatchError($errorThrown, 'MatchUserController@orderCancellationUserMatch', 'Error occured when trying to send notification when user cancelled order.' );
                }
                if($actionID)
                {
                    //Update
                    $getRecordDetails->flag         = 1;
                    $getRecordDetails->updated_at   = date('Y-m-d h:i:s a');
                    $getRecordDetails->update();
                    $success = 1;
                }else{
                    //Delete
                    $getRecordDetails->delete();
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@agentAcceptRejectUserOrder', 'Error occured when agent takes action to accept or reject user order.' );
        }
        return $success;
    }


    //VIEW USER DELIVERY ORDER DETAILS
    public function viewUserDeliveryOrderDetails($userID = null, $orderNumber = null)
    {
        $data = [];
        try{
            ###########Check user is agent#################
            if(!$this->getUserAgentStatus()){ return redirect()->back()->with('info', 'Sorry, you are not authorized to perform this task.'); }
            ###############################################

            $orderDetails = new MatchUserController;
            $data = $orderDetails->viewUserStoreDetails($userID,  $orderNumber, 'agent_view_order_details');
            return $this->checkViewBeforeRender('deliveryAgent.viewUserOrder.userCheckoutOrder', $data);
         }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'DeliveryAgentController@viewUserDeliveryOrderDetails', 'Error occured when agent is trying to view user delivery order details.' );
        }
        return redirect()->back()->with('info', 'Sorry, we cannot view the details of this order. Please try again or contact the user with the order number. Thanks.');
    }




}//end class
