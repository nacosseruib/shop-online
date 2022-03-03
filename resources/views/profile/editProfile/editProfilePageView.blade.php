
@if(isset($showPageProfile) && ($showPageProfile ==1) && (isset($getProfile) && $getProfile) )

    <form class="text-left" method="POST" action="{{  (Route::has('storeEditProfile') ? Route('storeEditProfile') : '#') }}" enctype="multipart/form-data" style="color: #757575;">
    @csrf

    <div id="shopify-section-cart-template" class="shopify-section bg-light p-1">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4" align="center">
                        <img src="{{ (isset($profileImages) ? $profileImages : '') }}" class="img-responsive" alt=" " style="width: 120px; height: 150px;" />
                        <label class="text-left">Select File</label>
                        <input type="file" name="profilePicture" class="form-control" />
                    </div>
                    <div class="col-md-8">
                        <div class="row h4 m-1 mt-0" align="left">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th colspan="2" class="text-center">
                                         <a href="{{ (Route::has('myProfile') ? Route('myProfile') : 'javascript:;' ) }}" class="text-white pull-left btn btn-warning" title="Cancel Edit">Cancel</a>
                                         PROFILE DETAILS
                                         <button type="button" class="text-info pull-right btn btn-default bg-white" title="Save Profile" data-toggle="modal" data-backdrop="false" data-target="#confirmUpdateProfile"><i class="fa fa-save fa-x2"></i> Save </button>
                                         <div class="m-1 p-1 h6">Field with <span class="text-danger"><b>*</b></span> is important!</div>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-left">First Name: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <input class="form-control" name="firstName" required value="{{ (isset($getProfile) ? $getProfile->first_name : '') }}">
                                        @error('firstName')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Last Name: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <input class="form-control" name="lastName" required value="{{ (isset($getProfile) ? $getProfile->last_name : '') }}">
                                        @error('lastName')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Gender: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <select name="gender" required class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male" {{ ((isset($getProfile) ? $getProfile->gender : '') == 'Male' ? 'selected' : '') }}>Male</option>
                                            <option value="Female" {{ ((isset($getProfile) ? $getProfile->gender : '') == 'Female' ? 'selected' : '') }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Phone Number: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <input class="form-control" name="phoneNumber" required value="{{ (isset($getProfile) ? $getProfile->phone_number : '') }}">
                                        @error('phoneNumber')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Delivery Address: </td>
                                    <td class="text-right">
                                        <textarea name="deliveryAddress" class="form-control">{{ (isset($getProfile) ? $getProfile->delivery_address : '') }}</textarea>
                                        @error('deliveryAddress')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Zip Code: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <input class="form-control" name="zipCode" required value="{{ (isset($getProfile) ? $getProfile->store_zip_code : '') }}">
                                        @error('zipCode')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Country: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-left">
                                        <div class="niceCountryInputSelector form-control" data-selectedcountry="{{ (isset($getProfile->store_country) ? $getProfile->store_country : 'US') }}" data-showspecial="false" data-showflags="true" data-i18nall="All selected"
                                            data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback" />
                                        </div><input type="hidden" name="oldCountry" value="{{ (isset($getProfile) ? $getProfile->store_country : '') }}" />
                                        @error('country')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">State: </td>
                                    <td class="text-right">
                                        <input class="form-control" name="state" value="{{ (isset($getProfile) ? $getProfile->store_state : '') }}">
                                        @error('state')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">City: </td>
                                    <td class="text-right">
                                        <input class="form-control" name="city" value="{{ (isset($getProfile) ? $getProfile->store_city : '') }}">
                                        @error('city')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">Currency: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <select name="currency" required class="form-control">
                                            <option value="" selected>Select Currency </option>
                                            @if(isset($allCurrency) && ($allCurrency))
                                                @foreach ($allCurrency as $item)
                                                        <option value="{{ $item->currencyID }}" {{ ((isset($getProfile) ? $getProfile->currencyID : '') == $item->currencyID ? 'selected' : '') }}>{{ $item->currency_name . ' (' . $item->currency_symbol .')' }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('currency')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                <input type="hidden" name="oldStoreStatus" value="{{ (isset($getProfile) ? $getProfile->is_store_suspended : '') }}" />
                                @if(isset($getProfile) && $getProfile->storeID)
                                <tr>
                                    <td class="text-left">Store Status: <span class="text-danger"><b>*</b></span></td>
                                    <td class="text-right">
                                        <select name="storeStatus" required class="form-control">
                                            <option value="1" {{ ((isset($getProfile) && ($getProfile->is_store_suspended == 1)) ? 'selected' : '') }}>Deactivate</option>
                                            <option value="0"  {{ ((isset($getProfile) && ($getProfile->is_store_suspended == 0)) ? 'selected' : '') }}>Activate</option>
                                        </select>
                                        @error('storeStatus')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </td>
                                </tr>
                                @endif

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
                <p class="cart_empty">Sorry, you can't view your profile now!</p>
                <div class="cookie-message">
                    <p>Please, try to check later if you can't view your profile. Thanks</p>
                </div>
            </div>
        </div>
    </div>

@endif

