@extends('layouts.site')
@section("pageTitle", "Pending Item To Be Delivered To Me")
@section('pageContent')

@if( isset($getReceiverItemList) && (count($getReceiverItemList) > 0) )
    <div class="container product-template__containe product mb-5 mt-3">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div align="center">

                <table class="table table-bordered table-condensed table-hover table-responsive bg-light">
                    <thead>
                        <tr>
                            <th colspan="8"><b>LIST OF ITEMS TO BE DELIVERED TO {{ $userFullName ? strtoupper($userFullName) : 'You'}} </b></th>
                        </tr>
                        <tr>
                            <th>SN</th>
                            <th>ITEM</th>
                            <th>TRANSACTION&nbsp;NO</th>
                            <th>ORDER&nbsp;NO</th>
                            <th>DELIVERY&nbsp;CODE</th>
                            <th>QUANTITY</th>
                            <th>UNIT PRICE</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(isset($getReceiverItemList) && $getReceiverItemList)
                            @foreach($getReceiverItemList as $cartKey => $item)
                                <tr class="bg-white">
                                    <td><b>{{ (1 + $cartKey) }}</b></td>
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

                                    <td><b>{{ $item->transactionID }}</b></td>
                                    <td><b>{{ (isset($item->order_number) ? $item->order_number : '') }}</b></td>
                                    <td><b>{{ (isset($item->delivery_code) ? $item->delivery_code : '') }}</b></td>

                                    <td>{{ $item->quantity }}</td>

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
                            <td colspan="5"></td>
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
            <div class="row d-print-none">
                <div align="center" class="mb-4 col-md-12">
                    <a href="{{ (Route::has('myPendingDelivery') ? Route('myPendingDelivery') : 'javascript:;' ) }}" class="btn btn-outline-info btn-lg">
                        Go Back
                    </a>
                </div>
            </div>

        </div>
      </div>
    </div>

@else
    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">Sorry, we cannot find your record</p>

                <div class="row d-print-none">
                    <div align="center" class="m-2 col-md-12">
                        <a href="{{ (Route::has('myPendingDelivery') ? Route('myPendingDelivery') : 'javascript:;' ) }}" class="btn btn-outline-info btn-lg">
                            Go Back
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endif

@endsection
