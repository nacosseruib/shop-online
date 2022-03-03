<?php

namespace App\Http\Controllers;

use App\Models\UserProfileModel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use DB;
use auth;

class UserProfileController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    //Update Delivery Address
    public function UpdateAddress(Request $request)
    {
        try{
            UserProfileModel::where('userID', $this->getUserID())->update(['delivery_address' => $request['deliveryAddress'], 'updated_at' => date('Y-m-d')]);
            return redirect()->back()->with('message', 'Your delivery address was updated successfully.');
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'UserProfileController@UpdateAddress', 'Error occured on POST Request when trying to update delivery address.' );
        }
        return redirect()->back()->with('error', 'Sorry, we are unable to update your delivery address.');
    }



}
