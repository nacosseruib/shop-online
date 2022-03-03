<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Cache;

class IndexController extends BaseParentController
{

    public function __construct()
    {
        $this->getAllModel();
    }


    public function index()
    {
        $data                               = [];
        $passData                           = [];
        $dataCollection                     = [];
        $passData['showPageStore']          = 1;
        $passData['showWelcomePopupModal']  = 1;
        $getProductHotMoreBest              = [];

        //$passData['getHoteBestProduct']  = [];
        Cache::forget('cacheKeyBestSellerProductIndex');

        ########### GET BEST SELLERS #############
        try{
            $data = Cache::remember('cacheKeyBestSellerProductIndex', $this->appCacheTime(), function ()
            {
                Cache::forget('cacheKeyAnyProduct');
                $data = $this->getAnyProduct($paginate = null, $userID = null, $adminStatus = 1, $isOnline = 1, $isDeleted = 0, $orderBy = '.productID', $randomData = true, $categoryID = null, $collectionID = null, $pick = 24);
                return $data;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'IndexController@index-BestSeller', 'Error occured when getting best products.' );
        }

        ####### GET HOT SELLERS #########
        try{
            $getHotData = Cache::remember('cacheKeyHotSellerProductIndex', $this->appCacheTime(), function ()
            {
                Cache::forget('cacheKeyAnyProduct');
                $hotData = $this->getAnyProduct($paginate = null, $userID = null, $adminStatus = 1, $isOnline = 1, $isDeleted = 0, $orderBy = '.productID', $randomData = true, $categoryID = null, $collectionID = null, $pick = 24);
                if($hotData)
                {
                    $data['getHotProduct']       = $hotData['getProduct'];
                    $data['getHotImages']        = $hotData['productImages'];
                    $data['getHotCoverImage']    = $hotData['productCoverImage'];
                    $data['getHotPath']          = $hotData['productPath'];
                    $data['getHotPath300x300']   = $hotData['productPath300x300'];
                    $data['getHotPath500x500']   = $hotData['productPath500x500'];
                }
                return $data;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'IndexController@HotSellerProductIndex', 'Error occured when getting hot products.' );
        }


        ####### GET NEW PRODUCTS #########
        try{
            $getNewArrivalData = Cache::remember('cacheKeyNewProductIndex', $this->appCacheTime(), function ()
            {
                Cache::forget('cacheKeyAnyProduct');
                $arrivalData = $this->getAnyProduct($paginate = null, $userID = null, $adminStatus = 1, $isOnline = 1, $isDeleted = 0, $orderBy = '.created_at', $randomData = false, $categoryID = null, $collectionID = null, $pick = 24);
                if($arrivalData)
                {
                    $data['getNewProduct']          = $arrivalData['getProduct'];
                    $data['getNewImages']           = $arrivalData['productImages'];
                    $data['getNewCoverImage']       = $arrivalData['productCoverImage'];
                    $data['getNewProductPath']      = $arrivalData['productPath'];
                    $data['getNewProductPath300x300']   = $arrivalData['productPath300x300'];
                    $data['getNewProductPath500x500']   = $arrivalData['productPath500x500'];
                }
                return $data;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'IndexController@NewProductIndex', 'Error occured when getting new products.' );
        }


        //Get Collections
        try{
            $dataCollection = Cache::remember('cacheKeyCollectionProductIndex', $this->appCacheTime(), function ()
            {
                Cache::forget('cacheKeyAnyProduct');
                $data = [];
                $getData = $this->getAnyProduct($paginate = null, $userID = null, $adminStatus = 1, $isOnline = 1, $isDeleted = 0, $orderBy = '.created_at', $randomData = true, $categoryID = null, $collectionID = null, $pick = 48);
                if($getData)
                {
                    $data['getCollection']              = $getData['getProduct'];
                    $data['getCollectionImages']        = $getData['productImages'];
                    $data['getCollectionCoverImage']    = $getData['productCoverImage'];
                    $data['getCollectionPath']          = $getData['productPath'];
                    $data['getCollectionPath300x300']   = $getData['productPath300x300'];
                    $data['getCollectionPath500x500']   = $getData['productPath500x500'];
                }
                return $data;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'IndexController@index', 'Error occured on GET Request when trying to Get Collections' );
        }

        return $this->checkViewBeforeRender('index.welcomeView')
            ->with($data)
            ->with($getHotData)
            ->with($getNewArrivalData)
            ->with($dataCollection)
            ->with($passData);
    }
}
