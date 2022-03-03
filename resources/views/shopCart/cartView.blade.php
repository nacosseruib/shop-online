
@if(isset($showPage) && $showPage ==1 && (isset($itemInCart) && count($itemInCart) > 0 ))

    <div id="ProductSection-product-template" class="product-template__containe product mb-5 mt-3">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12  horizontal">

            <div align="center">
                <div class="mt-3">
                    <div class="font-weight-bold h4 alert alert-info">Cart: {{ (isset($myCart) ? count($myCart) : 0 ) }} Item(s)</div>
                </div>
                <table class="table table-bordered table-condensed table-hover table-responsive bg-light">
                    <thead>
                        <tr>
                            <th colspan="2">ITEM</th>
                            <th>QUANTITY</th>
                            <th>UNIT PRICE</th>
                            <th>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(isset($itemInCart) && $itemInCart)
                            @foreach($itemInCart as $cartKey => $item)

                                <tr class="bg-white">
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <a href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>str_replace(' ', '+', $item->product_name)]) : 'javascript:;') }}">
                                                    <img class="product-featured-img" src="{{ (isset($productPath) && isset($productImages) ? $productPath[$cartKey] . $productPath300x300 . $productImages[$cartKey] : '') }}" alt=" " />
                                                </a>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="col-md-12 text-left font-weight-bold h4">
                                                    <a href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>str_replace(' ', '+', $item->product_name)]) : 'javascript:;') }}">
                                                        <strong> {{ $item->product_name }} </strong>
                                                    </a>
                                                </div>
                                                <div class="col-md-12 text-left">Brand: {{ $item->brand }}</div>
                                                <div class="col-md-12 text-left">Available: {{ $item->is_available }}</div>
                                                <div align="right" class="col-md-12">
                                                    <a href="javascript:;" class="text-warning" data-toggle="modal" data-backdrop="false" data-target="#confirmToRemoveItemModal{{$cartKey}}"> <i class="fa fa-trash"></i>  Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="bg-white">
                                            <select name="quantity" id="{{ $item->cartID }}" class="form-control updateShopCartQty getQuantity{{ $item->cartID }}">
                                                @for ($quantityCount = 1; $quantityCount < 21; $quantityCount++)
                                                    <option {{ $item->quantity == $quantityCount ? 'selected' : ''}}>{{ $quantityCount }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </td>
                                    <td style="min-width: 120px;">
                                        <div>
                                            <div class="price">
                                                <div class="price-new"><span class=money>${{ number_format($item->original_price, 2) }}</span></div>
                                                @if($item->old_price > 0)
                                                    <div class="price-old"><span class=money>${{ number_format($item->old_price, 2) }}</span> </div>
                                                    <div class="product-name">Saved: <span class=money>${{ number_format($item->old_price - $item->original_price, 2) }}</span></div>
                                                @endif
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

                                 <!-- Confirm to delete item from cart Modal -->
                                <div class="modal fade text-left d-print-none" id="confirmToRemoveItemModal{{$cartKey}}" tabindex="-1" role="dialog" aria-labelledby="removeItem" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light white">
                                            <h5 class="modal-title" id="confirmToRemoveItemModal"><i class="fa fa-trash"></i> Remove Item  </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <h5 class="text-center"> You are about to remove an item from the cart! </h5>
                                            <p>
                                                <div class="text-danger text-center"> Are you sure you want to continue with this operation? </div>
                                            </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> Cancel </button>
                                                <button type="button" id="{{ $item->cartID }}" data-dismiss="modal" class="btn btn-outline-success removeItemFromProductCart">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end Modal-->

                            @endforeach
                        @endif

                        <tr class="bg-white p-2">
                            <td colspan="4"> <div class="text-right font-weight-bold h4"><strong>Total:</strong></div> </td>
                            <td>
                                <div class="price">
                                    <div class="price-new"><strong><span class=money>${{ (isset($totalCartAmount) ? number_format($totalCartAmount, 2) : 0.00) }} </span></strong></div>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="row">

                <div align="left" class="col-sm-6 col-md-6">
                    <a href="{{ (Route::has('allProductCollection') ? Route('allProductCollection') : 'javascript:;') }}" class="btn btn--has-icon-after cart__continue-btn lg font-weight-bold"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> CONTINUE SHOPPING </a>
                </div>
                @if($totalCartAmount > 0)
                    <div align="right" class="col-sm-6 col-md-6">
                        <a href="{{ (Route::has('checkout') ? Route('checkout') : 'javascript:;') }}" class="btn btn-warning btn--has-icon-after cart__continue-btn lg font-weight-bold">PROCEED TO CHECKOUT <i class="fa fa-long-arrow-right" aria-hidden="false"></i></a>
                    </div>
                @endif
            </div>
            <hr />

        </div>
      </div>
    </div>


@else
    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="material-icons">shopping_basket</i></span>
                <p class="cart_empty">Your cart is currently empty.</p>
                <a href="{{ (Route::has('allProductCollection') ? Route('allProductCollection') : 'javascript:;') }}" class="btn btn--has-icon-after cart__continue-btn sn"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>Continue shopping</a>
            </div>
        </div>
    </div>
@endif


@section('script')

        @includeIf('share.jqueryFunctionAddToCart', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])

@endsection
