<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\UserProfileModel;
use App\Models\User;
use View;
use Cache;

class VisitUserShopController extends BaseParentController
{

    public function __construct()
    {
        $this->getAllModel();
    }


    public function createUserStoreProductCollection($storeName = null, $geUserID = null)
    {

        $getProduct                     = [];
        $data                           = [];
        $data['showCollectionPage']     = 1;
        $data['openCategoryMenu']       = 0;
        $data['getStoreName']           = null;
        $data['storeBannerPath']        = null;
        $getStoreDetails    = null;

        try{
            //$this->userID = $userID;
            $this->userID = UserProfileModel::where('store_name', str_replace('+', ' ', $storeName))->value('userID');
            Cache::forget('cacheKeyUserStoreCollectionProduct');
            if($this->userID <> null && User::find($this->userID)){
                $this->categoryID           = null;
                $getStoreDetails   = UserProfileModel::where('userID', $this->userID)->first();
                $data['getStoreName']   = ($getStoreDetails ? "welcome to " . $getStoreDetails->store_name . "'s Store" : " Store");
                $data['storeBannerPath'] = $this->getUserStoreBanner($this->userID);
            }else{
                $getCat = CategoryModel::inRandomOrder()->first();
                $this->categoryID           = ($getCat ?  $getCat->categoryID : null);
                $data['getStoreName']   = ($getCat ?  $getCat->category : null);
                $this->userID               = null;
            }
            $getProduct = Cache::remember('cacheKeyUserStoreCollectionProduct', $this->appCacheTime(), function ()
            {
                $dataProduct = $this->getAnyProduct($paginate = 32, $userID = $this->userID, $adminStatus = 1, $isOnline = null, $isDeleted = 0, $orderBy = '.created_at', $randomData = false, $categoryID = $this->categoryID, $collectionID = null, $pick = null);
                return $dataProduct;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'VisitUserShopController@createUserStoreProductCollection', 'Error occured on GET Request when trying to get user store product collection' );
        }

        return $this->checkViewBeforeRender('product.userStoreCollection.productCollection', $getProduct)->with($data);
    }



}//end class
