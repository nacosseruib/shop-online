<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MessageInboxModel;
use Cache;
use Auth;
use View;

class MessageInboxController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }

    //View inbox
    public function messageInbox()
    {
        $data = [];
        try{
            $this->userID = $this->getUserID();

            $getMessage = Cache::remember('cacheKeyMessageInbox', $this->appCacheTime(), function ()
            {
                return MessageInboxModel::where($this->messageInboxModel->getTable().'.receiverID', $this->userID)->where($this->messageInboxModel->getTable().'.is_active', 1)->where('is_deleted', 0)
                        ->leftjoin($this->userProfileModel->getTable(), $this->userProfileModel->getTable().'.userID', '=', $this->messageInboxModel->getTable().'.senderID')
                        //->orderBy($this->messageInboxModel->getTable().'.flag', 'Asc')
                        ->orderBy($this->messageInboxModel->getTable().'.ID', 'Desc')
                        ->select('profile_picture', $this->userProfileModel->getTable().'.first_name', $this->userProfileModel->getTable().'.last_name', $this->messageInboxModel->getTable().'.*', $this->messageInboxModel->getTable().'.created_at as message_date')
                        ->paginate(30);
            });
            $agentPath = [];
            foreach($getMessage as $key=>$value)
            {
                $path = $this->getUserPathImage($value->senderID, $value->profile_picture, 'profile');
                $agentPath[$key]  = $path['filePathbest'];
            }
            $data['getPath']  = $agentPath;
            $data['getMessage'] = $getMessage;
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MessageInboxController@messageInbox', 'Error occured on GET Request when trying to query message in inbox.' );
        }

        return $this->checkViewBeforeRender('notification.inbox.inboxMessage', $data);
    }


    //Reply Message
    public function sendReplyMessage(Request $request)
    {
        $success = 0;
        try{
            if($request['messageID'] <> null)
            {
                $success = MessageInboxModel::where('inboxID', $request['messageID'])->update([
                    'flag'          => 1,
                    'message'       => 'Updated at: '. date('F d, Y h:i:sa')  .'<br />'. $request['getMessage'],
                    'updated_at'    => date('Y-m-d h:i:s a'),
                ]);
                $details = MessageInboxModel::where('inboxID', $request['messageID'])->first();
                $this->sendNotification($details->receiverID, $details->senderID, $request['getMessage'], $canReply = 1, $smsMessage = null);
                Cache::forget('cacheKeyMessageInbox');
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MessageInboxController@markMessageAsRead', 'Error occured on GET Request when trying to mark message as read.' );
        }
        if($success)
        {
            return redirect()->back()->with('message', 'Your message was sent successfully.');
        }else{
            return redirect()->back()->with('info', 'sorry, we could not send you message! An error occured. Please try again.');
        }

    }

    //Mark Message as Read
    public function markMessageAsRead($messageID = null)
    {
        try{
            if($messageID <> null)
            {
                MessageInboxModel::where('inboxID', $messageID)->update(['flag' => 1]);
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MessageInboxController@markMessageAsRead', 'Error occured on GET Request when trying to mark message as read.' );
        }
        return;
    }


    //Delete message to trash
    public function deleteMessageToTrash($messageID = null)
    {
        $success = 0;
        if(Auth::check())
        {
            try{
                if($messageID <> null)
                {
                    $success = MessageInboxModel::where('receiverID', $this->getUserID())->where('inboxID', $messageID)->update(['is_deleted' => 1]);
                    Cache::forget('cacheKeyMessageInbox');
                }
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'MessageInboxController@deleteMessageToTrash', 'Error occured on GET Request when trying to soft-delete message to trash.' );
            }
            if($success)
            {
                return redirect()->route('inbox')->with('message', 'Your message was moved to trash successfully.');
            }
            return redirect()->route('inbox')->with('warning', 'Sorry, we cannot delete this message now! Please try again.');
        }
    }


    //SEND NOTIFICATION
    public function sendNotification($senderID = null, $receiverID = null, $message = null, $canReply = null, $smsMessage = null)
    {
        $success = 0;
        try{
            if($receiverID <> null && $message <> null)
            {
                $success = MessageInboxModel::create([
                    'senderID'          => $senderID,
                    'receiverID'        => $receiverID,
                    'message'           => $message,
                    'can_reply'         => $canReply,
                    'flag'              => 0,
                    'created_at'        => date('Y-m-d h:i:s a'),
                    'updated_at'        => date('Y-m-d h:i:s a'),
                ]);
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MessageInboxController@sendNotification', 'Error occured when trying sending notification to inbox.' );
        }

        return $success;
    }


    ################### GET NOTIFICATION ##################
    public function getUnreadMessage($userID = null)
    {
        $getMessage = 0;
        try{
            $getMessage =  MessageInboxModel::where('receiverID', $userID)->where('flag', 0)->where('is_deleted', 0)->count();
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'MessageInboxController@getUnreadMessage', 'Error occured when trying getting total new unread messages.' );
        }
        return $getMessage;
    }




}//end class
