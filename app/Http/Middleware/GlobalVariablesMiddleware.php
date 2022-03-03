<?php

namespace App\Http\Middleware;

use Closure;
use response;
use App\Http\Controllers\BaseParentController;
use App\Models\User;
use App\Models\UserTypeModel;
use App\Models\UserProfileModel;
use App\Models\CategoryModel;
use App\Models\CollectionModel;
use App\Models\DeliveryAgentModel;
use Cache;
use Auth;
use DB;
use view;



class GlobalVariablesMiddleware
{
    private $cacheTimeInMininutes;
    /*Cache::Put ()
    Cache::Get()
    Cache::Forever()
    Cache::Has()
    Cache::pull('key');
    Cache ::put(key, value , 15);*/


    public function handle($request, Closure $next)
    {
        //Get instance to BaseParentController
        $getCacheTime = 30;
        $this->cacheTimeInMininutes = 30;
        $globalVariable             = [];
        $cachedAllProductCollection = [];
        $cachedAllProductCategory   = [];
        $baseParentFunction = new BaseParentController;
        $this->baseParentFunction = $baseParentFunction;


        try{
            $getCacheTime = Cache::remember('cacheKeyAppCacheTime', 60, function () {
                return $this->baseParentFunction->appCacheTime();
            });
            $this->cacheTimeInMininutes = $getCacheTime;
        } catch (\Throwable  $errorThrown) {}


        //Get user details after login - CACHED
        if(Auth::check() && Auth::user()->id)
        {
            try{
                $globalVariable['userProfile'] = Cache::remember('cacheKeyUserProfile', $this->cacheTimeInMininutes, function () {
                    return UserProfileModel::where('userID', Auth::user()->id)->first();
                });
                $globalVariable['userFullName']             = ((isset($globalVariable['userProfile']) && $globalVariable['userProfile'] <> null) ? $globalVariable['userProfile']->first_name .' '. $globalVariable['userProfile']->last_name : null);
                $globalVariable['userStoreName']            = ((isset($globalVariable['userProfile']) && $globalVariable['userProfile'] <> null) ? $globalVariable['userProfile']->store_name : null);
                $globalVariable['userStoreSuspend']         = ((isset($globalVariable['userProfile']) && $globalVariable['userProfile'] <> null) ? $globalVariable['userProfile']->is_store_suspended : 0);
                $globalVariable['userStorestatus']          = ((isset($globalVariable['userProfile']) && $globalVariable['userProfile'] <> null) ? $globalVariable['userProfile']->status : 0);
            } catch (\Throwable  $errorThrown) {
                $baseParentFunction->storeTryCatchError($errorThrown, 'GlobalVariablesMiddleware@handle', 'Middleware for global user profile. Share User Profile Data.' );
                $globalVariable['userStoreSuspend']         = null;
                $globalVariable['userStorestatus']          = null;
                $globalVariable['userStoreName']            = null;
                $globalVariable['userFullName']             = null;
                $globalVariable['userFullName']             = [];
            }
        }

        //Get all product categories - CACHED
        try{
            $cachedAllProductCategory = Cache::remember('cacheKeyAllCategory', $this->cacheTimeInMininutes, function () {
                return CategoryModel::where('status', 1)->take(7)->orderBy('category', 'Desc')->get();
            });
            $cachedAllProductCollection = Cache::remember('cacheKeyAllCollection', $this->cacheTimeInMininutes, function () {
                $productCategory = CategoryModel::where('status', 1)->take(13)->orderBy('category', 'Desc')->get();
                foreach( $productCategory as $catKey =>$item)
                {
                    $getCollection[$catKey] = CollectionModel::where('status', 1)->where('categoryID', $item->categoryID)->take(10)->orderBy('collection', 'Desc')->get();
                }
                return $getCollection;
            });
            $globalVariable['getAllProductCategory']    = $cachedAllProductCategory;
            $globalVariable['getAllProductCollection']  = $cachedAllProductCollection;
        } catch (\Throwable  $errorThrown) {
            $baseParentFunction->storeTryCatchError($errorThrown, 'GlobalVariablesMiddleware@handle', 'Error occured when trying to get all product categories' );
            $globalVariable['getAllProductCategory']    = [];
            $globalVariable['getAllProductCollection']  = [];
        }

        // Get all accredited store - CACHED
        try{
            $accreditedStores = Cache::remember('cacheKeyAllAccreditedStores', $this->cacheTimeInMininutes, function () {
                $getUsertypeID = UserTypeModel::where('is_store', 1)->where('status', 1)->select('user_typeID')->get();
                return UserProfileModel::where('is_store_suspended', 0)->where('status', 1)->take(50)->whereIn('user_typeID', $getUsertypeID)->select('userID', 'store_name', 'store_description', 'store_state', 'store_country')->get(); //->where('store_premium', '<>', 1)
            });
            $globalVariable['allAccreditedStores'] = $accreditedStores;
        } catch (\Throwable  $errorThrown) {
            $baseParentFunction->storeTryCatchError($errorThrown, 'GlobalVariablesMiddleware@handle', 'Error occured when trying to get all accredited stores' );
            $globalVariable['allAccreditedStores'] = [];
        }

        //Get User Type ID
        try{
            $globalVariable['checkAndGetUserTypeID'] = $baseParentFunction->getUserType();
            //Activate or suspend store
            if($globalVariable['checkAndGetUserTypeID'])
            {
                $baseParentFunction->activateStore($baseParentFunction->getUserID());
            }else{
                $baseParentFunction->suspendStore($baseParentFunction->getUserID());
            }
        } catch (\Throwable  $errorThrown) {
            $baseParentFunction->storeTryCatchError($errorThrown, 'GlobalVariablesMiddleware@handle', 'Trying to get useType if user has store' );
            $globalVariable['checkAndGetUserTypeID'] = null;
        }

        //Get all my current cart item
        try{
            $getCartData = $baseParentFunction->getItemInCart($baseParentFunction->getUserID(), $cartStatus = 1, $isOrderPlaced = 0, $isCancel = 0, $orderBy = 'Desc', $orderNumber = []);
            $globalVariable['myCart']               = $getCartData['itemInCart'];
            $globalVariable['myCartTotolAmount']    = $getCartData['totalCartAmount'];
        }catch (\Throwable  $errorThrown) {
            $baseParentFunction->storeTryCatchError($errorThrown, 'GlobalVariablesMiddleware@handle', 'Trying to get user items/products added to cart.' );
            $globalVariable['myCart']               = null;
            $globalVariable['myCartTotolAmount']    = 0;
        }

        //New Notifications
        try{
            $globalVariable['newMessage']   = $baseParentFunction->getNotifications($baseParentFunction->getUserID());
        }catch (\Throwable  $errorThrown) {
            $baseParentFunction->storeTryCatchError($errorThrown, 'GlobalVariablesMiddleware@handle', 'Trying to get new notification message' );
            $globalVariable['newMessage']   =  null;
        }

        //Check if user is an Agent
        try{
            $globalVariable['is_User_Agent'] = $baseParentFunction->getUserAgentStatus();
        }catch (\Throwable  $errorThrown) {
            $baseParentFunction->storeTryCatchError($errorThrown, 'GlobalVariablesMiddleware@handle', 'Trying to get if user is an agent' );
            $globalVariable['is_User_Agent']   =  0;
        }





        //ROUTE MONITORING
        //Upload Route



        //abort(403);
        view()->share($globalVariable);
        return $next($request);
    }
}
