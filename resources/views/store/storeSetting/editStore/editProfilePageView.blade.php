
@if(isset($showPageProfile) && ($showPageProfile ==1) && (isset($getProfile) && $getProfile) )

    <form class="text-left" method="POST" action="{{  (Route::has('storeStoreSetting') ? Route('storeStoreSetting') : '#') }}" enctype="multipart/form-data" style="color: #757575;">
    @csrf

    <div id="shopify-section-cart-template" class="shopify-section bg-light p-1">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-md-12" align="center">
                            <img src="{{ (isset($logoImage) ? $logoImage : '') }}" class="img-responsive" alt=" " style="width: 100px; height: 100px;" />
                            <label class="text-left">Select file for your logo</label>
                            <input type="file" name="logo" class="form-control" />
                        </div>
                        <div class="col-md-12" align="center">
                            <hr />
                            <img src="{{ (isset($bannerImage) ? $bannerImage : '') }}" class="img-responsive" alt=" " style="width: 100%; height: 150px;" />
                            <label class="text-left">Select file for your banner</label>
                            <input type="file" name="banner" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row h4 m-1 mt-0" align="left">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th colspan="2" class="text-center">
                                         <a href="{{ (Route::has('viewStoreSetting') ? Route('viewStoreSetting') : 'javascript:;' ) }}" class="text-white pull-left btn btn-warning" title="Cancel Edit">Cancel</a>
                                         STORE PROFILE DETAILS
                                         <button type="button" class="text-info pull-right btn btn-default bg-white" title="Save Profile" data-toggle="modal" data-backdrop="false" data-target="#confirmUpdateProfile"><i class="fa fa-save fa-x2"></i> Save </button>
                                         <div class="m-1 p-1 h6">Field with <span class="text-danger"><b>*</b></span> is important!</div>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Full Name: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <input class="form-control" name="storeName" required value="{{ (isset($getProfile) ? $getProfile->store_name : '') }}">
                                        @error('storeName')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Phone Number: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <input class="form-control" name="phoneNumber" required value="{{ (isset($getProfile) ? $getProfile->store_phone_number : '') }}">
                                        @error('storeAddress1')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Address 1: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <textarea name="storeAddress1" required class="form-control">{{ (isset($getProfile) ? $getProfile->store_address1 : '') }}</textarea>
                                        @error('storeAddress1')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Address 2: </td>
                                    <td class="text-right">
                                        <textarea name="storeAddress2" class="form-control">{{ (isset($getProfile) ? $getProfile->store_address2 : '') }}</textarea>
                                        @error('storeAddress2')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Store Description: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <textarea name="storeDescription" required class="form-control">{{ (isset($getProfile) ? $getProfile->store_description : '') }}</textarea>
                                        @error('storeDescription')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button type="button" class="btn btn-outline btn-block btn-success" title="Save Profile" data-toggle="modal" data-backdrop="false" data-target="#confirmUpdateProfile"><i class="fa fa-save fa-x2"></i> Save </button>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm update profile Modal-->
    <div class="modal fade text-left d-print-none" id="confirmUpdateProfile" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                <h5 class="modal-title text-white"><i class="fa fa-save"></i> Confirm Update </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 h5 text-success"><b>Are you sure you want to continue to update this profile ?</b> </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                    <button type="submit" class="btn btn-outline btn-success" title="Save Profile"><i class="fa fa-save fa-x2"></i> Save </button>
                </div>
            </div>
        </div>
    </div>
    <!--end Modal-->

    </form>

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

