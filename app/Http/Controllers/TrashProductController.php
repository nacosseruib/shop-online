<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\ProductCommentModel;
use Cache;
use View;

class TrashProductController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    //Load Product Page
    public function getAllMyTrashProduct()
    {
        $data       = [];
        $showPage   = [];
        $showPage['showTrashPage'] = 1;
        $showPage['openCategoryMenu']   = 0;

        try{
            ###############check if user has a valid store or store has been suspended############
            if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
            ######################################################################################

            $data = Cache::remember('cacheKeyAllMyTrashedProduct', $this->appCacheTime(), function ()
            {
                $data = $this->getAnyProduct($paginate = 24, $userID = $this->getUserID(), $adminStatus = 1, $isOnline = null, $isDeleted = 1, $orderBy = '.created_at', $randomData = false, $categoryID = null, $collectionID = null, $pick = null);
                return $data;
            });
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'TrashProductController@getAllMyTrashProduct', 'Error occured when listing all product in trash box' );
        }

        return $this->checkViewBeforeRender('store.trashProduct.myTrashProductPage', $data)->with($showPage);
    }


    //Restore Soft Delete Product
    public function restoreSofteDeleteProduct($productID = null)
    {
        if($productID <> null && (ProductModel::where('productID', $productID)->where('userID', $this->getUserID())->first()))
        {
            try{
                ###############check if user has a valid store or store has been suspended############
                if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
                ######################################################################################

                ProductModel::where('productID', $productID)->update(['is_deleted' => 0]);
                Cache::forget('cacheKeyUserTrashedProduct');
                return redirect()->route('listTrashedProduct')->with('message', 'Your product was retored to your store successfully.');
            }catch(\Throwable $errorThrown){
                $this->storeTryCatchError($errorThrown, 'TrashProductController@restoreSofteDeleteProduct', 'Error occured when restoring product from trash' );
            }
        }
        return redirect()->back()->with('error', 'Sorry, we cannot restore this product from your trash now! please try again.');
    }

    //Delete Product Permanantly
    public function deleteProductPermanentlyFromRecycleBin($productID = null)
    {
        if($productID <> null && (ProductModel::where('productID', $productID)->where('userID', $this->getUserID())->first()))
        {
            if(!CartModel::where('productID', $productID)->first() && !ProductCommentModel::where('productID', $productID)->first())
            {
                try{
                    ###############check if user has a valid store or store has been suspended############
                    if(!$this->getUserType()){ return redirect()->route('index')->with('error', 'Sorry, you are not authorized to view this page.'); }
                    ######################################################################################

                    ProductModel::find($productID)->delete();
                    Cache::forget('cacheKeyUserTrashedProduct');
                    return redirect()->route('listTrashedProduct')->with('message', 'Your product was permanently deleted successfully.');
                }catch(\Throwable $errorThrown){
                    $this->storeTryCatchError($errorThrown, 'TrashProductController@deleteProductPermanentlyFromRecycleBin', 'Error occured when deleting product permanently from trash.' );
                }
            }else{
                return redirect()->back()->with('info', 'Sorry, you cannot delete this product right now. Is in use. Thanks');
            }
        }
        return redirect()->back()->with('error', 'Sorry, we cannot delete this product now! please try again.');
    }





}//end class
