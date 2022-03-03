<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserTypeModel;
use App\Models\UserProfileModel;
use App\Http\Controllers\BaseParentController;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\CurrencyModel;
use App\Models\HearAboutUsModel;
use Illuminate\Support\Str;
use Session;
use DB;

class RegisterController extends BaseParentController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
    }

    //CREATE NEW REGISTRATION
    public function createRegistration()
    {
        try {
            $data['userType'] = UserTypeModel::where('status', 1)->get();
            $data['allCurrency'] = CurrencyModel::where('status', 1)->get();
            $data['hearAboutUs'] = HearAboutUsModel::where('status', 1)->get();
        } catch (\Throwable $errorThrown) {
            $this->storeTryCatchError($errorThrown, 'createRegistration', 'Error occured on Get Request when create user registration page' );
            $data['userType'] = [];
            $data['allCurrency'] = [];
            $data['hearAboutUs'] = [];
        }

        return $this->checkViewBeforeRender('auth.register', $data);
    }

    //New User Details and Login Registration
     public function saveRegistration(Request $request)
     {
         //Validate
         $this->validate($request,
         [
            'firstName'            => ['required', 'string', 'max:200'],
            'lastName'             => ['required', 'string', 'max:200'],
            'phoneNumber'          => ['required', 'string', 'max:255', 'unique:user_profile,phone_number'],
            'currency'             => ['required', 'string', 'max:255'],
            'gender'               => ['required', 'string', 'max:255'],
            'whatDoYouLikeToDo'    => ['required', 'numeric', 'max:255'],
            'howDidYouKnowUs'      => ['required', 'string', 'max:255'],
            'country'              => ['required'],
            'email'                => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username'             => ['required', 'string', 'min:6', 'max:255', 'unique:users'],
            'password'             => ['required', 'string', 'min:8', 'confirmed'],
            'zipCode'               => 'required|min:2',
         ]);

         //Create user login details
         try{
             //Double check username if taken
            if(!User::where('username', $request['username'])->first())
            {
                $userCreated =  User::create([
                    'username'      => $request['username'],
                    'email'         => $request['email'],
                    'password'      => Hash::make($request['password']),
                    'user_token'    => $this->generateRandomAlphaNumeric(36),
                ]);
            }else{
                $userCreated = 0;
                return redirect()->back()->with('info', 'Sorry we cannot complete your registration. Your username is already taken. Please try another one.');
            }


            if($userCreated)
            {
                //create user profile details
                $profileCreated =  UserProfileModel::create([
                    'userID'                    => $userCreated->id,
                    'first_name'                => $request['firstName'],
                    'last_name'                 => $request['lastName'],
                    'phone_number'              => $request['phoneNumber'],
                    'currencyID'                => $request['currency'],
                    'gender'                    => $request['gender'],
                    'user_typeID'               => $request['whatDoYouLikeToDo'],
                    'store_zip_code'            => $request['zipCode'],
                    'store_country'            => $request['country'],
                    'how_did_you_know_about_us' => $request['howDidYouKnowUs'],
                ]);

                //Register Store details
                if($profileCreated)
                {
                    $getUserType = UserTypeModel::find($profileCreated->user_typeID);
                    if($getUserType)
                    {
                        $isStore = $getUserType->is_store;
                        if($isStore == 1)
                        {
                            //goto create store
                            if(!Session::get('userIDStore'))
                            {
                                Session::put('userIDStore', $userCreated->id);
                            }
                            return redirect()->route('registerStore')->with('info', 'You are almost done. Complete your store registration now!');
                        }else{
                            //registration complete
                        }
                    }else{
                        //registration complete
                    }
                }else{
                   //registration complete
                }
            }
            //registration complete
            Session::forget('userIDStore');
            return redirect()->route('registerCompleted');
         }catch(\Throwable $errorThrown)
         {
            $this->storeTryCatchError($errorThrown, 'saveRegistration', 'Error occured on POST Request when saving user registration data' );
            return redirect()->back()->with('error', 'Sorry, an error occurred while creating your account. Please try again.')->withInput();
         }
     }//


     //CREATE STORE REGISTRATION
    public function createStoreRegistration()
    {
        return $this->checkViewBeforeRender('auth.registerStore');
    }

    //SAVE STORE Registration
     public function saveStoreRegistration(Request $request)
     {
         //Validate
         $this->validate($request,
         [
             'storeName'            => ['required', 'string', 'max:200', 'unique:user_profile,store_name'],
             'storePhoneNumber'     => ['required', 'string', 'max:100'],
             'address1'             => ['required', 'string', 'max:255'],
             //'address2'             => ['required', 'string', 'max:255'],
             'storeDescription'     => ['required', 'string', 'max:20000'],
             //'country'              => ['required', 'string', 'max:100'],
             'state'                => ['required', 'string', 'max:100'],
             'city'                 => ['required', 'string', 'max:100'],
         ]);

         //Create new record
         try{
            $success = UserProfileModel::where('userID', Session::get('userIDStore'))->update([
                'store_name'            => $request['storeName'],
                'store_phone_number'    => $request['storePhoneNumber'],
                'store_address1'        => $request['address1'],
                'store_address2'        => $request['address2'],
                'store_description'     => $request['storeDescription'],
                'is_store_suspended'    => 0,
                //'store_country'         => $request['country'],
                'store_state'           => $request['state'],
                'store_city'            => $request['city'],
                'storeID'               => $this->generateRandomAlphaNumeric(15)
            ]);

            //registration complete
            if($success)
            {
                Session::forget('userIDStore');
                return redirect()->route('registerCompleted');
            }else{
                return redirect()->back()->with('error', 'Sorry, an error occurred while creating your store. Please try again or login to complete your store registration.')->withInput();
            }
         }catch(\Throwable $errorThrown)
         {
            $this->storeTryCatchError($errorThrown, 'savestoreRegistration', 'Error occured on POST Request when saving store registration data' );
            return redirect()->back()->with('error', 'Sorry, an error occurred while creating your store. Please try again.')->withInput();
         }
     }//


     //REGISTRATION COMPLETE
     public function registrationCompleted()
     {
         return $this->checkViewBeforeRender('auth.registrationCompleted');
     }



}
