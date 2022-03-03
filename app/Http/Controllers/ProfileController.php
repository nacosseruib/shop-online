<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfileModel;
use App\Models\CurrencyModel;
use App\Models\UserTypeModel;
use App\Models\DeliveryAgentModel;
use Illuminate\Support\Facades\Hash;
use App\Models\AgentIDCardModel;
use App\Models\User;
use Cache;
use Session;


class ProfileController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }

    //View Profile
    public function createProfile()
    {
        $data = [];
        $userID = $this->getUserID();
        Session::forget('agentToEdit');
        try{
            $passData['isUserAgent']    = DeliveryAgentModel::where('userID', $userID)->first();
            $passData['agentPassport']  = $this->getAgentProfilePicture($userID);
            $passData['agentIDCardPath']    = $this->getAgentIDCard($userID);
            $passData['allAgentIDCard']      = AgentIDCardModel::where('userID', $userID)->select('approved')->get();
            $data = $this->userProfileDetails($userID);
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProfileController@createProfile', 'Error occured on GET Request when trying to query user profile' );
        }
        return $this->checkViewBeforeRender('profile.viewProfile.profilePage', $data)->with($passData);
    }


    //View Edit Profile
    public function createEditProfile()
    {
        Cache::forget('cacheKeyMyProfile');
        $data = [];
        try{
            $data = $this->userProfileDetails($this->getUserID());
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProfileController@createProfile', 'Error occured on GET Request when trying to query user profile' );
        }
        return $this->checkViewBeforeRender('profile.editProfile.editProfilePage', $data);
    }


    //user profile details
    public function userProfileDetails($userID = null)
    {
        $data['getProfile']         = [];
        $data['showFilter']         = 0;
        $data['showPage']           = 1;
        $data['showPageProfile']    = 1;
        $data['openCategoryMenu']   = 0;
        $data['getProfile']     = null;
        $data['profileImages']  = null;
        $this->userID  = $userID;
        try{
            $data['userType'] = UserTypeModel::where('status', 1)->get();
            $data['allCurrency'] = CurrencyModel::where('status', 1)->get();

            if($userID <> null)
            {
                $data['getProfile'] = Cache::remember('cacheKeyMyProfile', $this->appCacheTime(), function ()
                {
                    $profile = $this->getUserProfile($this->userID);
                    return $profile;
                });
                $profileImage = ($data['getProfile'] ? $data['getProfile']->profile_picture : null);
                $getImageAndPath300x300 = ($data['getProfile'] ? $data['getProfile']->user_token : null) .'/profile'. '/300x300'. '/'. $profileImage;
                $getImageAndPath = ($data['getProfile'] ? $data['getProfile']->user_token : null) .'/profile'. '/'. $profileImage;
                if(@getimagesize($getImageAndPath300x300))
                {
                    $data['profileImages'] = $this->downloadPath() . $getImageAndPath300x300;
                }elseif(@getimagesize($getImageAndPath)){
                    $data['profileImages'] = $this->downloadPath() . $getImageAndPath;
                }else{
                    $data['profileImages'] = $this->downloadPath() . 'assets/images/noPicture.png';
                }
            }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProfileController@userProfileDetails', 'Error occured when trying to query user profile' );
        }
        return $data;
    }



    //Update Edit Profile
    public function updateProfile(Request $request)
    {
        $this->validate($request,
        [
             'firstName'            => ['required', 'string', 'min:3', 'max:200'],
             'lastName'             => ['required', 'string', 'min:3', 'max:200'],
             'phoneNumber'          => ['required', 'string', 'max:15'],
             //'country'              => ['required', 'string', 'max:255'],
             'currency'             => ['required', 'numeric', 'max:255'],
             'gender'               => ['required', 'string', 'max:255'],
             //'userType'             => ['required', 'numeric', 'max:255'],
             //'deliveryAddress'      => ['required', 'string', 'max:255'],
            'zipCode'               => ['required', 'numeric', 'min:3'],
            //'state'                 => ['required', 'string'],
            //'city'                  => ['required', 'string'],
        ]);
        //Validate Profile image
        if($request->hasFile('profilePicture'))
        {
            $this->validate($request,
            [
                'profilePicture'  => ['required', 'image', 'mimes:png,jpg,jpe,jpeg,gif', 'max: 3000'],
            ]);
        }
        try{
            $userID = $this->getUserID();
            $success = 0;
            $getArrayResponse = [];
            $getArrayResponse['newFileName'] = null;
            $oldFileName  = UserProfileModel::where('userID', $userID)->value('profile_picture');
            $uploadCompletePathName = $this->uploadPath() . 'profile/';
            $uploadCompletePathNameThumbnail300X300 = $uploadCompletePathName . '300x300/';
            $uploadCompletePathNameThumbnail500X500 = $uploadCompletePathName . '500x500/';

            //Upload profile picture
            if($request->hasFile('profilePicture'))
            {
                $getArrayResponse = $this->uploadAnyFile($request['profilePicture'], $uploadCompletePathName, $maxFileSize = 5, $newExtension = null, $newRadFileName = true);
            }
           if(!UserProfileModel::where('userID', '<>', $userID)->where('phone_number', $request['phoneNumber'])->first())
           {
                $success =  UserProfileModel::where('userID', $userID)->update([
                    'first_name'                => $request['firstName'],
                    'last_name'                 => $request['lastName'],
                    'phone_number'              => $request['phoneNumber'],
                    'currencyID'                => (int) $request['currency'],
                    'gender'                    => $request['gender'],
                    //'user_typeID'               => $request['userType'],
                    'store_zip_code'            => $request['zipCode'],
                    'store_country'             => ($request['country'] ? $request['country'] : $request['oldCountry']),
                    'store_state'               => $request['state'],
                    'store_city'                => $request['city'],
                    'profile_picture'           => (($getArrayResponse && $getArrayResponse['newFileName']) ? $getArrayResponse['newFileName'] : $oldFileName),
                    'delivery_address'          => $request['deliveryAddress'],
                    'is_store_suspended'        => (int) $request['storeStatus'], //$request['oldStoreStatus']),
                    'updated_at'                => date('Y-m-d h:i:s a'),
                ]);
                if($request->hasFile('profilePicture') && $getArrayResponse)
                {
                    //Resize Product Thumbnail - 300X300
                    $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail300X300 . $getArrayResponse['newFileName'], $width = 300, $height = 300, $is_resize_canvas = 0);
                    //Resize Product Thumbnail - 500X500
                    $this->createThumbnail($uploadCompletePathName . $getArrayResponse['newFileName'], $uploadCompletePathNameThumbnail500X500 . $getArrayResponse['newFileName'], $width = 500, $height = 500, $is_resize_canvas = 0);

                    //UNLINK previous Image - $oldFileName
                }
           }else{
               return redirect()->back()->with('error', 'Sorry, this phone number has been taken.');
           }
           if($success)
           {
                return redirect()->route('myProfile')->with('message', 'Your profile was updated successfully.');
           }
        }catch(\Throwable $errorThrown)
        {
           $this->storeTryCatchError($errorThrown, 'ProfileController@updateProfile', 'Error occured on POST Request when updating user profile.');
        }
        return redirect()->back()->with('info', 'Sorry, no update was performed on your profile.');
    }


    ########################### CHANGE PASSWORD #########
    public function createUpdatePasswordOnAuth()
    {
        $data = [];
        try{
            $data['updateAccount'] = $this->getUserProfile($this->getUserID());
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProfileController@createUpdatePasswordOnAuth', 'Error occured on GET Request when try to update password.' );
        }
        return $this->checkViewBeforeRender('profile.updatePassword.changePassword', $data);
    }


    ################### SAVE CHANGE PASSWORD #########
    public function saveUpdatePasswordOnAuth(Request $request)
    {
        $this->validate($request,
         [
            'currentPassword'   => ['required', 'string', 'min:8'],
            'password'          => ['required', 'string', 'min:8', 'confirmed']
         ]);
        $isChanged = 0;
        try{
            $updateAccount = $this->getUserProfile($this->getUserID());
            //avoid user entering the same password
            if(Hash::check($request['password'], $updateAccount->password))
            {
                return redirect()->route('updateAccountAuth')->with('error', 'Sorry, you cannot enter the same password as your current password!');
            }

            if($updateAccount && Hash::check($request['currentPassword'], $updateAccount->password))
            {
                $isChanged      =  User::where('id', $this->getUserID())->update([
                    'password'  => Hash::make($request['password'])
                ]);
                if($isChanged)
                {
                    return redirect()->route('updateAccountAuth')->with('message', 'Your password was changed successfully.');
                }
            }else{
                return redirect()->route('updateAccountAuth')->with('error', 'Sorry, your have entered wrong current password!');
            }

        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProfileController@saveUpdatePasswordOnAuth', 'Error occured on POST Request when try to update password.' );
        }
        return redirect()->route('updateAccountAuth')->with('error', 'Sorry, we could not change your password! Please try again.');
    }


}//end class
