<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\ProductCommentModel;
use Cache;
use View;

class ItemCommentProductController extends BaseParentController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->getAllModel();
    }


    //Load Product Page
    public function createListItems()
    {
        $data       = [];
        $passData   = [];
        $passData['showTrashPage'] = 1;
        $passData['openCategoryMenu']   = 0;
        $passData['getComment']   = [];
        $getAllComment  = [];

        try{
            $data = Cache::remember('cacheKeyListItemComment', $this->appCacheTime(), function ()
            {
                $data = $this->getAnyProduct($paginate = 30, $userID = $this->getUserID(), $adminStatus = 1, $isOnline = null, $isDeleted = 0, $orderBy = '.updated_at', $randomData = false, $categoryID = null, $collectionID = null, $pick = null);
                return $data;
            });
             //get all comment for each item/product
             if($data['getProduct'])
             {
                 foreach($data['getProduct'] as $key => $value)
                 {
                    $getAllComment[$key]    = ProductCommentModel::where('productID', $value->productID)->where('status', 1)->orderBy('commentID', 'Desc')->get();
                }
                 $passData['getComment'] = $getAllComment;
             }
        }catch(\Throwable $errorThrown){
            $this->storeTryCatchError($errorThrown, 'ItemCommentProductController@createListItems', 'Error occured when listing all products/items to view comment' );
        }

        return $this->checkViewBeforeRender('store.itemComment.listProductItemPage', $data)->with($passData);
    }


    //Restore Soft Delete Product
    public function restoreSofteDeleteProduct($productID = null)
    {
        if($productID <> null && (ProductModel::where('productID', $productID)->where('userID', $this->getUserID())->first()))
        {
            try{
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
            if(CartModel::where('productID', $productID)->first())
            {
                try{
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
