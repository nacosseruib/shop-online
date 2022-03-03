<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',                                                         'IndexController@index')->name('index');
Route::get('/home',                                                     'IndexController@index');

//Auth::routes();
Route::get('/account/login',                                            'Auth\LoginController@createLogin')->name('login');
Route::post('/account/login',                                           'Auth\LoginController@attemptLogin')->name('login');
//Create New Account
Route::get('/registration/account',                                     'Auth\RegisterController@createRegistration')->name('register');
Route::post('/registration/account',                                    'Auth\RegisterController@saveRegistration')->name('register');
Route::get('/logout', 			                                        'Auth\LoginController@logout')->name('logout');
//Register Store
Route::get('/registration/store',                                       'Auth\RegisterController@createStoreRegistration')->name('registerStore');
Route::post('/registration/store',                                      'Auth\RegisterController@saveStoreRegistration')->name('registerStore');
//Registration Completed
Route::get('/registration/completed',                                   'Auth\RegisterController@registrationCompleted')->name('registerCompleted');
//Product Category
Route::get('/collection/{categoryName?}',                               'ProductCollectionController@createProductCollection')->name('productCollection');
//All Collections or Products
Route::get('/all/collections',                                          'ProductCollectionController@createAllProductCollection')->name('allProductCollection');
//visit user store
Route::get('/visit/shop/{userID?}',                                     'VisitUserShopController@createUserStoreProductCollection')->name('visitShop');
//Filter or Sort By
Route::post('/filter-item',                                             'BaseParentController@filterSortBy')->name('sortItemBy');
///Search Product From DB JSON
Route::get('/search-product-from-db-JSON/{query?}',                     'BaseParentController@searchProductFromDB')->name('searchProduct');


//Auth
Route::group(['/middleware' => ['auth']], function ()
{
    //Product Details
    Route::get('/item/{productID?}',                                    'ProductController@createProductDetails')->name('productDetails');
    //Route::get('/item/details/{productID?}',                           'ProductController@createProductDetails')->name('productDetails');

    //Add Product to cart
    Route::get('/add-product-to-cart/{productID?}/{quantity?}',         'ProductController@addProductToCart')->name('addToCart');
    //Remove Item From Cart
    Route::get('/remove-item-from-cart/{cartID?}',                      'ProductController@removeItemFromCart')->name('removeItemFromCart');
    //Update Cart Item Quantity
    Route::get('/update-cart-item-quantity/{cartID?}/{quantity?}',      'ProductController@updateItemQuantityInCart')->name('updateQuantityCart');
    //Add Product Comment -AJAX CALL
    Route::get('/add-comment-or-question-for-product/{productID?}/{comment?}/{name?}/{email?}',      'ProductController@addProductComment')->name('addProductComment');
    Route::get('reply-comment/{commentID?}/{receiverID?}/{message?}',  'ProductController@replyProductComment')->name('replyComment');

    //Shopping Cart
    Route::get('/shopping-cart',                                                 'ShopCartController@createShopCart')->name('shopCart');

    //Filter Products
    Route::get('/filter-product',                                       'StoreController@filterProduct')->name('filterProduct');

    //My Store
    Route::get('/store',                                                'StoreController@createMyStore')->name('goTostoreHome');
    Route::get('/store/setting',                                        'StoreController@createStoreSetting')->name('viewStoreSetting');
    Route::get('/store/edit',                                           'StoreController@createEditStoreSetting')->name('editStoreSetting');
    Route::post('/store/edit',                                          'StoreController@updateStoreSetting')->name('storeStoreSetting');
    //view Item Comment Product
    Route::get('/store/list-comment',                                    'ItemCommentProductController@createListItems')->name('listItemComment');
    Route::get('/store/view-comment',                                    'ItemCommentProductController@viewItemComment')->name('viewItemComment');
    //BLOCKED PRODUCT
    Route::get('/product/blocked',                                       'StoreController@createBlockedProduct')->name('blockedProduct');
    //GET ALL NEW ORDER
    Route::get('/store/order',                                           'StoreTransactionController@createStoreOrder')->name('storeOrder');
    Route::post('/store/confirm/order',                                  'StoreTransactionController@saveconfirmOrder')->name('confirmOrder');

    //My Profile
    Route::get('/profile/view',                                          'ProfileController@createProfile')->name('myProfile');
    Route::get('/profile/edit',                                          'ProfileController@createEditProfile')->name('editProfile');
    Route::post('/profile/edit',                                         'ProfileController@updateProfile')->name('storeEditProfile');
    //My Delivery : All itmes i have delivered
    Route::get('item-i-have-delivered',                                  'AllDeliveryController@createItemIHaveDelivered')->name('myItemDelivery');
    Route::get('details-of-item-i-have-delivered/{u?}/{on?}',            'AllDeliveryController@createItemIHaveDeliveredDetails')->name('detailsItemIHaveDelivery');

    //My Pending Items i need to deliver : Item to i need to deliver to a user
    Route::get('/pending-item-i-need-to-deliver',                       'AllDeliveryController@createPendingItemNeedToDeliver')->name('pendingItemNeedToDeliver');
    Route::get('/delete-pending-item-i-need-to-deliver/{on?}',          'AllDeliveryController@startDeletingPendingItemNeedToDeliver')->name('deletePendingItemNeedToDeliver');
    Route::get('/pending-item-details-i-need-to-deliver/{u?}/{on?}',    'AllDeliveryController@pendingItemNeedToDeliverDetails')->name('viewPendingItemNeedToDeliverDetails');

    //My Order Delivery : All items delivered to me
    Route::get('item-delivered-to-me',                                  'AllDeliveryController@createOrderDeliveredToMe')->name('myOrderDelivery');
    Route::get('item-delivered-to-me-details/{u?}/{on?}',               'AllDeliveryController@orderDeliveryDetails')->name('myOrderDeliveryDetails');

    //My Pending delivery : Item to be delivered to me
    Route::get('/pending-item-to-be-delivered-to-me',                   'AllDeliveryController@createPendingItemToBeDeliveredToMe')->name('myPendingDelivery');
    Route::get('/pending-item-details-to-be-delivered-to-me/{u?}/{on?}', 'AllDeliveryController@createPendingItemToBeDeliveredToMeDetails')->name('viewPendingDeliveryDetails');



    //Order Cancellation
    Route::post('order/cancellation',                                   'MatchUserController@orderCancellationUserMatch')->name('orderCancellation');

    //Upload Product
    Route::get('/product/upload',                                       'UploadProductController@createUploadProduct')->name('goToProductUpload');
    Route::post('/product/upload',                                      'UploadProductController@storeUploadProduct')->name('storeProductUpload');
    Route::get('/product/edit/{productID?}',                            'UploadProductController@getProductToEdit')->name('productToEdit');
    Route::get('/product/cancel-edit',                                  'UploadProductController@cancelProductEdit')->name('cancelProductEdit');
    Route::get('/product/move-to-trash/{product?}',                     'UploadProductController@softeDeleteProduct')->name('trashProduct');
    Route::get('/delete/{userProductImageID?}/{productID?}',            'UploadProductController@deleteProductImageOnEdit')->name('deleteProductImage');
    Route::get('/product-collection/{categoryID?}',                     'UploadProductController@getAllCollections')->name('getAllCollection_ajax_call');
    Route::get('/product/push-online-offline/{product?}',               'UploadProductController@pushProductOnlineOrOffline')->name('pushProductOnlineOffline');
    //List Product in Trash
    Route::get('/product/list-trash',                                   'TrashProductController@getAllMyTrashProduct')->name('listTrashedProduct');
    Route::get('/product/restore-product-to-store/{product?}',          'TrashProductController@restoreSofteDeleteProduct')->name('restoreToStoreProduct');
    Route::get('/product/delete-permanently-from-trash/{product?}',     'TrashProductController@deleteProductPermanentlyFromRecycleBin')->name('deleteProductPermanentlyFromTrash');
    //Checkout
    Route::get('/cart/checkout',                                        'checkOutController@checkoutDiscountAlgorithm')->name('checkout');
    //Match User - accept Order Number (on)
    Route::get('/checkout/{on?}',                                       'MatchUserController@matchUserWithBestAlgorithm')->name('matchUser');
    Route::get('/item-delivery/{u?}/{on?}',                             'MatchUserController@viewWhoToDeliverTo')->name('itemDelivery');
    //update delivery address
    Route::post('/update/delivery-address',                             'UserProfileController@UpdateAddress')->name('updateDeliveryAddress');
    //All My deliveries
    Route::post('/update/delivery-address',                             'UserProfileController@UpdateAddress')->name('updateDeliveryAddress');
    //Confirm Item Delivery
    Route::get('/confirm-delivery/{on?}',                               'ConfirmItemDeliveryController@createItemDelivery')->name('confirmItemDelivery');
    Route::post('/confirm-delivery',                                    'ConfirmItemDeliveryController@processAndConfirmItemDelivery')->name('processItemDelivery');

    //In App Message-Inbox
    Route::get('/inbox',                                                'MessageInboxController@messageInbox')->name('inbox');
    Route::get('/flag-message/{messageID?}',                            'MessageInboxController@markMessageAsRead')->name('readMessage');
    Route::post('/reply-message',                                       'MessageInboxController@sendReplyMessage')->name('replyMessage');
    Route::get('/delete-message/{mi?}',                                 'MessageInboxController@deleteMessageToTrash')->name('deleteMessage');

    //// Change password on Auth
    Route::get('/update-account',                                       'ProfileController@createUpdatePasswordOnAuth')->name('updateAccountAuth');
    Route::post('/update-account',                                      'ProfileController@saveUpdatePasswordOnAuth')->name('saveUpdateAccountAuth');

    //All Checked Order
    Route::get('/my-order',                                             'OrderCheckOutController@createAllItemsICheckout')->name('checkoutOrder');
    Route::get('checkout/order-details/{on?}',                          'OrderCheckOutController@createAllItemsICheckoutDetails')->name('viewOrderDetails');

    //###### AGENT - Our Delivery Agents
    Route::get('delivery-agents',                                      'DeliveryAgentController@createListofDeliveryAgent')->name('listDeliveryAgent');
    Route::get('register/agent',                                       'DeliveryAgentController@createNewAgentRegistration')->name('registerNewAgent');
    Route::post('register/agent',                                      'DeliveryAgentController@storeAgentRegistration')->name('storeAgentRegistration');
    Route::get('update/agent',                                         'DeliveryAgentController@getAgentToEdit')->name('editAgentToEdit');
    Route::get('update-agent/cancel',                                  'DeliveryAgentController@cancelAgentEdit')->name('cancelAgentProfileEdit');
    Route::get('send-order-number-to-agent/{auid?}/{on?}/{m?}',        'DeliveryAgentController@SendOrderNumberToAgent')->name('sendOrderNoToAgent');
    Route::get('rate-agent/{auid?}',                                   'DeliveryAgentController@createAgentRating')->name('rateAgent');
    Route::get('agent/order',                                          'DeliveryAgentController@createAgentOrder')->name('agentAllOrder');
    Route::get('agent-confirm-user-order/{aoid?}/{aaction?}',          'DeliveryAgentController@agentAcceptRejectUserOrder')->name('agentReplyUserOrder');
    Route::get('agent-delivery/{u?}/{on?}',                            'DeliveryAgentController@viewUserDeliveryOrderDetails')->name('viewUserDeliveryOrder');







});


/* $path = $getFullPath . $item;
                        chown($path, 666);
                        if (unlink($path)) {
                          $data['message'] = 'Unlink was successful.';
                          $data['status']  = 1;
                        } else {
                          $data['status']  = 0;
                        } */
