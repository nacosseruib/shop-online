
@if(isset($showUserOrderPage) && $showUserOrderPage == 1 && (isset($getSellerStoreDetails) && (count($getSellerStoreDetails) > 0) && (isset($getReceiverDetails) && $getReceiverDetails) ))

    <div id="ProductSection-product-template" class="product-template__containe product mb-5 mt-3">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div align="center">
               {{--  <div class="alert alert-success text-uppercase h5">
                    <b></b>
                </div> --}}

                <div class="row">
                    <div class="col-md-5">
                        <div class="text-center text-success h4">BUY FROM</div>

                        @if(isset($getSellerStoreDetails) && $getSellerStoreDetails)
                            @foreach($getSellerStoreDetails as $key => $value)
                            <table class="table table-bordered- table-condensed table-hover table-responsive bg-light h5">
                                <tbody>
                                    <tr>
                                        <th colspan="2" class="text-center"> YOU ARE TO BUY BELOW ITEMS FROM THIS STORE DETAILS</th>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Store Name:</td>
                                        <td class="text-right">{{ $value->store_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Store Contact Number:</td>
                                        <td class="text-right">{{ $value->store_phone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Store Address 1:</td>
                                        <td class="text-right">{{ $value->store_address1 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Store Address 2:</td>
                                        <td class="text-right">{{ $value->store_address2 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Store Location:</td>
                                        <td class="text-right">{{ $value->store_country }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Store Description:</td>
                                        <td class="text-right">{{ $value->store_description }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Store Logo:</td>
                                        <td class="text-right">
                                            <img src="{{ asset($value->user_token .'/logo' . '/300x300'. '/'. $value->store_logo) }}" class="img-responsive" alt=" " style="width: 70px; height: 70px;" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endforeach

                        @endif

                    </div>
                    <div class="col-md-1 mt-5">
                         <span class="fa fa-share fa-4x"></span>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center text-success h4">DELIVER TO</div>
                        <table class="table table-bordered- table-condensed table-hover table-responsive bg-light h5">
                            <tbody>
                                <tr>
                                    <th colspan="2" class="text-center"> YOU ARE TO DELIVER THE ITEM(S) BOUGHT TO THIS DETAILS</th>
                                </tr>
                                <tr>
                                    <td class="text-left">User Full Name:</td>
                                    <td class="text-right">{{ (isset($getReceiverDetails) && $getReceiverDetails ? $getReceiverDetails->first_name .' '. $getReceiverDetails->last_name : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Phone Number:</td>
                                    <td class="text-right">{{ (isset($getReceiverDetails) && $getReceiverDetails ? $getReceiverDetails->phone_number : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Delivery Address:</td>
                                    <td class="text-right">{{ (isset($getReceiverDetails) && $getReceiverDetails ? $getReceiverDetails->delivery_address : '') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Total Item:</td>
                                    <td class="text-right">{{ (isset($totalNumberOfItemToDeliver) ? $totalNumberOfItemToDeliver : 0) }} Item(s)</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Delivery Code:</td>
                                    <td class="text-center text-danger">
                                        After you've delivered this item(s), be sure you get your <b>DELIVERY CODE</b> from <b>{{ (isset($getReceiverDetails) && $getReceiverDetails ? $getReceiverDetails->first_name .' '. $getReceiverDetails->last_name : '') }}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!--//row-->

                <table class="table table-bordered table-condensed table-hover table-responsive bg-light">
                    <thead>
                        <tr>
                            <th colspan="5"><b>LIST OF ITEMS YOU NEED TO BUY AND DELIVER</b></th>
                        </tr>
                        <tr>
                            <th>ITEM</th>
                            <th>TRANSACTION&nbsp;NO</th>
                            <th>ORDER&nbsp;NO</th>
                            <th>QUANTITY</th>
                            <th>UNIT PRICE</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(isset($getReceiverItemList) && $getReceiverItemList)
                            @foreach($getReceiverItemList as $cartKey => $item)
                                <tr class="bg-white">
                                    <td>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <img class="product-featured-img" src="{{ (isset($productPath) && isset($productImages) ? $productPath[$cartKey] . $productPath300x300 . $productImages[$cartKey] : '') }}" alt=" " />
                                            </div>
                                            <div class="col-md-8">
                                                <div class="col-md-12 text-left font-weight-bold h4"><strong> {{ $item->product_name }} </strong></div>
                                                <div class="col-md-12 text-left">Brand: {{ $item->brand }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="bg-white">
                                            <b>{{ $item->transactionID }}</b>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="bg-white">
                                            <b>{{ $item->order_number }}</b>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="bg-white">
                                            {{ $item->quantity }}
                                        </div>
                                    </td>
                                    <td style="min-width: 120px;">
                                        <div>
                                            <div class="price">
                                                <div class="price-new"><span class=money>${{ number_format($item->original_price, 2) }}</span></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="min-width: 100px;">
                                        <div class="bg-white p-1">
                                            <div class="price">
                                                <div class="price-new"><span class=money>${{ number_format(($item->quantity * $item->original_price), 2) }}</span></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        @endif

                        <tr class="bg-white p-2">
                            <td colspan="3"></td>
                            <td>{{ $totalNumberOfItemToDeliver }} item(s)</td>
                            <td>
                                <div class="text-right font-weight-bold h4"><strong>Total:</strong></div>
                            </td>
                            <td>
                                <div class="price">
                                    <div class="price-new"><strong><span class=money>${{ (isset($userDiscountedTotalCartAmount) ? number_format($userDiscountedTotalCartAmount, 2) : 0.00) }} </span></strong></div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <hr />
            <div class="row">
                <div align="center" class="mb-4 col-md-12">
                    <a href="{{ (Route::has('agentAllOrder') ? Route('agentAllOrder') : 'javascript:;' ) }}" class="btn btn-outline-info btn-lg">
                        Go Back
                    </a>
                </div>
            </div>

        </div>
      </div>
    </div>

    <!-- Confirm cancellation order Modal-->
    <form class="text-left formFormatAmount" method="POST" action="{{  (Route::has('orderCancellation') ? Route('orderCancellation') : '#') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left d-print-none" id="continueCancelOrder" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                <h5 class="modal-title text-white"><i class="fa fa-trash"></i> Cancel Order </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 h5 text-info"><b>If you continue with this operation, this order will be cancelled and the reciever of the item(s) will be nofified about the cancellation.</b> </div>
                        <div class="col-md-12 h5 text-danger"><b>Are you sure you want to cancel this order ?</b> </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="poolID" value="{{ isset($poolID) ? $poolID : ''}}" />
                    <input type="hidden" name="orderNumber" value="{{ isset($getOrderNumber) ? $getOrderNumber : ''}}" />
                    <input type="hidden" name="getReceiverOrderNumber" value="{{ isset($getReceiverOrderNumber) ? $getReceiverOrderNumber : ''}}" />
                    <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                    <button type="submit" class="btn btn-outline-danger"> Yes, Cancel Order  </button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!--end Modal-->


@else
    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">Sorry, we cannot find your order.</p>
                <div>
                   The user might have cancelled the order. Contact the user for clarity
                </div>
                <div class="row">
                    <div align="center" class="mb-4 col-md-12">
                        <a href="{{ (Route::has('agentAllOrder') ? Route('agentAllOrder') : 'javascript:;' ) }}" class="btn btn-outline-info btn-lg">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
