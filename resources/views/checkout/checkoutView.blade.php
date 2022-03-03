
@if(isset($showPage) && $showPage ==1 && (isset($myCartTotolAmount) && ($myCartTotolAmount > 0) ))

    <div id="ProductSection-product-template" class="product-template__containe product mb-5 mt-3">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered- table-condensed table-hover bg-light h4">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-left">MY DETAILS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white">
                                <td class="text-left">Full Name:</td>
                                <td class="text-right">{{ (isset($userProfile) && $userProfile ? $userProfile->first_name .' '. $userProfile->last_name : '' ) }}</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="text-left">Gender:</td>
                                <td class="text-right">{{ isset($userProfile) && $userProfile ? $userProfile->gender : '' }}</td>
                            </tr>
                            <tr class="bg-white">
                                <td class="text-left">Currency:</td>
                                <td class="text-right"> {{ isset($userProfile) && $userProfile ? $userProfile->currency_name .'('.   $userProfile->currency_symbol  .')' : '' }} </td>
                            </tr>
                            <tr class="bg-white">
                                <td class="text-left">Delivery Address:</td>
                                <td class="text-right">
                                    {{ isset($userProfile) && $userProfile ? $userProfile->delivery_address : '' }}
                                    <a href="javascript:;" title="Edit delivery address" class="d-print-none" data-toggle="modal" data-backdrop="false" data-target="#editDeliveryAddress">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-bordered- table-condensed table-hover bg-light h4">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-left">CHECKOUT DETAILS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white text-success">
                                <td class="text-left">Total Item Ordered:</td>
                                <td class="text-right">{{ isset($myCart) ? count($myCart) : 0 }} item(s)</td>
                            </tr>
                            <tr class="text-info">
                                <td class="text-left">Total Cart Amount :</td>
                                <td class="text-right"><span class=money>${{ isset($myCartTotolAmount) ? number_format($myCartTotolAmount, 2) : '' }}</span> </td>
                            </tr>
                            <tr class="text-success">
                                <td class="text-left">Your Order Number:</td>
                                <td class="text-right">
                                    {{ isset($orderNumber) ? $orderNumber : '' }}
                                </td>
                            </tr>
                            {{-- <tr class="text-success">
                                <td class="text-left">New Amount (Discounted):</td>
                                <td class="text-right">
                                    <span class=money>${{ isset($getDiscountedNewAmountFrom) ? number_format($getDiscountedNewAmountFrom, 2) : 0 }}</span> -
                                    <span class=money>${{ isset($getDiscountedNewAmountTo) ? number_format($getDiscountedNewAmountTo, 2) : 0 }}</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <hr />
                    <div class="text-left h4 bg-light p-3">
                        <p>INSTRUCTIONS:</p>
                        <p class="text-danger">For your product to be delivered quickly, you need to buy and deliver the item(s)/product(s) that will be presented to you in the next page that worth the discounted amount given to you from the store details that will also be shown to you when you click on "Am Ready to Buy and Deliver" button.</p>
                        <p class="text-info">NOTE: Your order will be taken and your product will be delivered to the delivery address you have specified when we have confirmed your delivery transaction that will be shown to you in the next page.</p>
                    </div>

                     <hr />
                    <div class="alert alert-info btn-outline m-4 text-center h4">
                       You will be given the best discount based on your shopping cart item(s).
                    </div>

                    <div class="row">
                        <div align="center" class="mb-4 col-md-5">
                            <a href="{{ Route::has('shopCart') ? Route('shopCart') : 'javascript:;' }}" class="btn btn-outline-default btn-lg" style="font-size: 20px;">Back to my shopping cart</a>
                        </div>
                        <div align="center" class="mb-4 col-md-7">
                            <a href="{{ (Route::has('matchUser') ? Route('matchUser') : 'javascript:;') }}" class="btn btn-outline-success btn-lg" data-toggle="modal" data-backdrop="false" data-target="#continueToBuyDeliver" style="font-size: 20px;">Confirm You are Ready to get the discount now</a>
                        </div>
                    </div>

                </div>
            </div><!--//row-->
        </div>
      </div>
    </div>

    <!-- Update Delivery Address Modal-->
    <form method="POST" action="{{ (Route::has('updateDeliveryAddress') ? Route('updateDeliveryAddress') : '#') }}">
    @csrf
    <div class="modal fade text-left d-print-none" id="editDeliveryAddress" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                <h5 class="modal-title text-white"><i class="fa fa-save"></i> Update Delivery Address </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12"><b>Delivery Address (You can include the time you can be reached):</b> </div>
                        <div class="col-md-12">
                            <textarea name="deliveryAddress" class="form-control">{{ isset($userProfile) && $userProfile ? $userProfile->delivery_address : '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                    <button type="submit" class="btn btn-outline-success">Update</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!--end Modal-->

     <!-- Confirm continuation Modal-->
        <div class="modal fade text-left d-print-none" id="continueToBuyDeliver" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                    <h5 class="modal-title text-white"><i class="fa fa-shopping-cart"></i> Ready to Buy/Deliver! </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 h5 m-2"><b>You will be presented some item(s) to buy and deliver to the details that will be given to you.</b> </div>
                            <div class="col-md-12 h5 m-2 text-info"><b>Are you sure you are ready to continue ?</b> </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                        <a href="{{ (Route::has('matchUser') ? Route('matchUser', ['on'=>(isset($orderNumber) ? $orderNumber : null)]) : 'javascript:;') }}" class="btn btn-outline-success"> Continue </a>
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal-->


@else
    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="material-icons">shopping_basket</i></span>
                <p class="cart_empty">Nothing to checkout</p>
                <a href="{{ (Route::has('productCollection') ? Route('productCollection') : 'javascript:;') }}" class="btn btn--has-icon-after cart__continue-btn sn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Continue shopping</a>
            </div>
        </div>
    </div>
@endif


@section('script')

        @includeIf('share.jqueryFunctionAddToCart', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])

@endsection
