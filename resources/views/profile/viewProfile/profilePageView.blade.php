
@if(isset($showPageProfile) && ($showPageProfile ==1) && (isset($getProfile) && $getProfile) )

    {{-- VIEW USER PROFILE --}}
    <div id="shopify-section-cart-template" class="shopify-section bg-light p-1">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4" align="center">
                        <div class="text-info bg-light p-2">Profile Image</div>
                        <img src="{{ (isset($profileImages) ? $profileImages : '') }}" class="img-responsive" alt=" " style="max-width: 200px; max-height: 200px;" />
                        {{-- <a href="{{ (Route::has('editProfile') ? Route('editProfile') : 'javascript:;' ) }}" class="text-info" title="Upload profile picture">Update Profile Image <i class="fa fa-pencil"></i></a> --}}
                    </div>
                    <div class="col-md-8">
                        <div class="row h4 m-1 mt-0" align="left">

                            <table class="table table-hover table-striped">
                                <tr class="bg-info text-white">
                                    <th colspan="2" class="text-center">
                                        PROFILE DETAILS
                                        <a href="{{ (Route::has('editProfile') ? Route('editProfile') : 'javascript:;' ) }}" class="text-info pull-right btn btn-default bg-white" title="Edit Profile"><i class="fa fa-pencil fa-x3"></i> Update</a>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-left">Full Name: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->first_name .' '. $getProfile->last_name : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Gender: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->gender : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Phone Number: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->phone_number : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Delivery Address: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->delivery_address : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Zip Code: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_zip_code : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Country: </td>
                                    <td class="text-right">
                                        <div id="disableCountryDiv" class="niceCountryInputSelector" data-selectedcountry="{{ (isset($getProfile) && $getProfile->store_country ? $getProfile->store_country : 'US') }}" data-showspecial="false" data-showflags="true" data-i18nall="All selected"
                                            data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">State: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_state : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">City: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->store_city : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Currency: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->currency_name : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Profile Type: </td>
                                    <td class="text-right">
                                        {{ (isset($getProfile) ? $getProfile->type_name : '') }} <br />
                                        {!! (isset($getProfile)  && $getProfile->is_store_suspended == 1 ? '<span class="text-danger">Store is suspended</span>' : '<span class="text-success">Store is active</span>') !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center">LOGIN DETAILS</th>
                                </tr>
                                <tr>
                                    <td class="text-left">Email Address: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->email : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Username: </td>
                                    <td class="text-right">{{ (isset($getProfile) ? $getProfile->username : '') }}</td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr />
    {{-- VIEW AGENT PROFILE --}}
    @if(isset($isUserAgent) && $isUserAgent)
    <div id="shopify-section-cart-template" class="shopify-section bg-light p-1">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="text-center">
                <div class="row">
                    <div class="col-md-4" align="center">
                        <div class="text-info bg-light p-2">Agent Profile Image</div>
                        <img src="{{ (isset($agentPassport) ? $agentPassport : '') }}" class="img-responsive" alt=" " style="max-width: 200px; max-height: 200px;" />
                        <hr />
                        <div class="text-info bg-light p-2">Identifications</div>
                        @foreach($allAgentIDCard as $key => $value)
                            <img src="{{ (isset($agentIDCardPath) ? $agentIDCardPath[$key] : '') }}" class="img-responsive" alt=" " style="width: 100%; max-height: 200px;" />
                            @if($value->approved == 1)
                                <div class="text-success">Approved</div>
                            @else
                                <div class="text-danger">Not Approved yet</div>
                            @endif
                            <hr />
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        <div class="row h4 m-1 mt-0" align="left">

                            <table class="table table-hover table-striped">
                                <tr class="bg-info text-white">
                                    <th colspan="2" class="text-center">
                                        AGENT PROFILE DETAILS
                                        <a href="{{ (Route::has('editAgentToEdit') ? Route('editAgentToEdit') : 'javascript:;' ) }}" class="text-info pull-right btn btn-default bg-white" title="Edit Agent Profile"><i class="fa fa-pencil fa-x3"></i> Update</a>
                                    </th>
                                </tr>
                                <tr>
                                    <td class="text-left">Agent Full Name: </td>
                                    <td class="text-right">{{ (isset($isUserAgent) ? $isUserAgent->agent_fullname : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Gender: </td>
                                    <td class="text-right">{{ (isset($isUserAgent) ? $isUserAgent->gender : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Phone Number: </td>
                                    <td class="text-right">{{ (isset($isUserAgent) ? $isUserAgent->phone_number : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Physical Address: </td>
                                    <td class="text-right">{{ (isset($isUserAgent) ? $isUserAgent->address : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Email: </td>
                                    <td class="text-right">{{ (isset($isUserAgent) ? $isUserAgent->email : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Agent Status: </td>
                                    <td class="text-right">{!! (isset($isUserAgent) && ($isUserAgent->admin_status == 1) && $isUserAgent->status == 1 ? '<span class="text-success">Your Profile is active</span>' : '<span class="text-danger">Your Profile is suspended</span> <br /> <span class="text-info">We are still Verifying</span>') !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-left">
                                        <div>Charges Plan (This will be seen by everybody): </div>
                                        <hr />
                                        <div style="word-break: break-all;">
                                            {!!  (isset($isUserAgent) ? wordwrap(nl2br($isUserAgent->delivery_charge_plan), 200, "<br />", TRUE) : '') !!}
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="fa fa-user fa-4x"></span>
                <p class="cart_empty">Sorry, you can't view your profile now!</p>
                <div class="cookie-message">
                    <p>Please check later. Thank you.</p>
                </div>
            </div>
        </div>
    </div>

@endif

