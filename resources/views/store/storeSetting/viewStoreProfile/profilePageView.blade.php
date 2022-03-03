
@if(isset($showPageProfile) && ($showPageProfile ==1) && (isset($getProfile) && $getProfile) )

    <div id="shopify-section-cart-template" class="shopify-section bg-light p-1">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-md-12" align="center">
                            <img src="{{ (isset($logoImage) ? $logoImage : '') }}" class="img-responsive" alt=" " style="width: 100px; height: 100px;" />
                            <a href="{{ (Route::has('editStoreSetting') ? Route('editStoreSetting') : 'javascript:;' ) }}" class="text-info" title="Upload store logo">Store Logo <i class="fa fa-pencil"></i></a>
                        </div>
                        <div class="col-md-12" align="center">
                            <hr />
                            <img src="{{ (isset($bannerImage) ? $bannerImage : '') }}" class="img-responsive" alt=" " style="width: 100%; height: 150px;" />
                            <a href="{{ (Route::has('editStoreSetting') ? Route('editStoreSetting') : 'javascript:;' ) }}" class="text-info" title="Upload store main banner">Store Main Banner <i class="fa fa-pencil"></i></a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row h4 m-1 mt-0" align="left">

                            <table class="table table-hover table-striped">
                                <tr>
                                    <th colspan="2" class="text-center">STORE PROFILE DETAILS  <a href="{{ (Route::has('editStoreSetting') ? Route('editStoreSetting') : 'javascript:;' ) }}" class="text-info pull-right btn btn-default bg-white" title="Edit Store"><i class="fa fa-pencil fa-x3"></i> Update</a> </th>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Full Name: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_name : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Owner's Name: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->first_name .' '. $getProfile->last_name : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Phone Number: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_phone_number : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Address 1: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_address1 : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Address 2: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_address2 : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Description: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_description : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Plan: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->premium_name : '') }}</td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="fa fa-user fa-4x"></span>
                <p class="cart_empty">Sorry, you can't view your store profile now!</p>
                <div class="cookie-message">
                    <p>Please, try to check later if you can't view your store profile. Thanks</p>
                </div>
            </div>
        </div>
    </div>

@endif

