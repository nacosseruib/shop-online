<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use View;
use Cache;

class ProductCollectionController extends BaseParentController
{

    public function __construct()
    {
        $this->getAllModel();
    }

    //Get Product Collection
    public function createProductCollection(Request $request, $categoryName = null)
    {
        $searchQuery = preg_split('/\s+/', $request['q'], -1, PREG_SPLIT_NO_EMPTY);
        $getProduct                         = [];
        $showPage                           = [];
        $showPage['showCollectionPage']     = 1;
        $showPage['openCategoryMenu']       = 0;
        $this->categoryID                   = null;

        try{
            if($categoryName <> null)
            {
                $this->categoryID = CategoryModel::where('category', $categoryName)->value('categoryID');
            }elseif($categoryName <> null || $searchQuery <> null)
            {
                //$searchQuery = ($searchQuery == null ? $categoryName : $searchQuery);
                $this->categoryID = ProductModel::where($this->productModel->getTable().'.product_name', 'like', "%{$request['q']}%")
                ->value($this->productModel->getTable().'.categoryID');
            }else{}

            $getProduct = Cache::remember('cacheKeyCollectionProduct', $this->appCacheTime(), function ()
            {
                $dataProduct = $this->getAnyProduct($paginate = 60, $userID = null, $adminStatus = 1, $isOnline = null, $isDeleted = 0, $orderBy = '.created_at', $randomData = false, $categoryID = $this->categoryID, $collectionID = null, $pick = null);
                return $dataProduct;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductCollectionController@createProductCollection', 'Error occured on GET Request when trying to get product collection' );
        }

        return $this->checkViewBeforeRender('product.collection.productCollection', $getProduct)->with($showPage);
    }


    //Get all product collection
    public function createAllProductCollection($categoryName = null)
    {
        $getProduct                         = [];
        $showPage                           = [];
        $showPage['showCollectionPage']     = 1;
        $showPage['openCategoryMenu']       = 0;

        try{
            $getProduct = Cache::remember('cacheKeyAllCollectionProduct', $this->appCacheTime(), function ()
            {
                $dataProduct = $this->getAnyProduct($paginate = 60, $userID = null, $adminStatus = 1, $isOnline = null, $isDeleted = 0, $orderBy = '.created_at', $randomData = true, $categoryID = null, $collectionID = null, $pick = null);
                return $dataProduct;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ProductCollectionController@createProductCollection', 'Error occured on GET Request when trying to get product collection' );
        }

        return $this->checkViewBeforeRender('product.collection.productCollection', $getProduct)->with($showPage);
    }



}//end class
