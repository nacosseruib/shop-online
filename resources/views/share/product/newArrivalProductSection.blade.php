
@if(isset($getNewProduct) && count($getNewProduct) > 0)
<div id="shopify-section-1534565689125" class="shopify-section home-section clearfix">
    <div class="widget-product-tabs m-0 p-0">
        <div class="container">
        <div class="widget-content products-listing grid">
            <div class="bg-light element-border-radius">
                <div class="home-title bg-light p-4">
                    <span>{{ (isset($headerTitle) ? $headerTitle : 'New Arrival') }}</span>
                </div>
                <div class="wrap-bg owl-style2">
                    <div class="ltabs-products-loader">
                        <img class="img-responsive" src="{{ asset('assets/js/3817/t/3/assets/icon-loadings.svg?v=17303354247329670281')}}" alt="loading" />
                    </div>
                    <div class="tabs-content product-layout">
                        <div class="tab-content">
                            <div class="ss-carousel ss-owl">
                                <div style="top: -15px;" class="owl-carousel"
                                    data-nav		="true"
                                    data-margin		="{{(isset($dMargin) ? $dMargin : 15)}}"
                                    data-autoplay	="true"
                                    data-lazyLoad	="true"
                                    data-autospeed	="20000"
                                    data-speed		="500"
                                    data-column1	="{{(isset($dcolumn1) ? $dcolumn1 : 5)}}"
                                    data-column2	="{{(isset($dcolumn2) ? $dcolumn2 : 4)}}"
                                    data-column3	="{{(isset($dcolumn3) ? $dcolumn3 : 3)}}"
                                    data-column4	="{{(isset($dcolumn4) ? $dcolumn4 : 3)}}"
                                    data-column5	="{{(isset($dcolumn5) ? $dcolumn5 : 1)}}">

                                    {{-- data-nav		="true"
                                    data-margin		="30"
                                    data-autoplay	="true"
                                    data-autospeed	="10000"
                                    data-speed		="300"
                                    data-column1	="4"
                                    data-column2	="3"
                                    data-column3	="2"
                                    data-column4	="2"
                                    data-column5	="1" --}}

                                    @foreach($getNewProduct as $productKey => $product)

                                        <div class="item {{ ($productKey == 0 ? 'item-first' : '') }}">
                                            <div class="product-item" data-id="{{ ($product->productID) }}">
                                                <div class="product-item-container grid-view-item">
                                                    <div class="left-block">


                                                        <div class="left-block">
                                                            <div class="product-image-container product-image">
                                                                <a class="grid-view-item__link image-ajax" href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>str_replace(' ', '_+_', $product->product_name)]) : 'javascript:;') }}">

                                                                    <img class="img-responsive s-img lazyload" data-sizes="auto" style="max-height: 210px;"
                                                                        src="{{ asset('assets/images/product-loading.svg') }}"
                                                                        data-src="@if(isset($getNewProductPath[$productKey]) && isset($getNewProductPath300x300) && isset($getNewProductPath500x500))
                                                                                @if(@getimagesize($getNewProductPath[$productKey] . $getNewProductPath300x300 . $getNewCoverImage[$productKey]))
                                                                                    {{$getNewProductPath[$productKey] . $getNewProductPath300x300 . $getNewCoverImage[$productKey]}}
                                                                                @elseif(@getimagesize($getNewProductPath[$productKey] . $getNewProductPath500x500 . $getNewCoverImage[$productKey]))
                                                                                    {{$getNewProductPath[$productKey] . $getNewProductPath500x500 . $getNewCoverImage[$productKey]}}
                                                                                @else
                                                                                    {{$getNewProductPath[$productKey] . $getNewCoverImage[$productKey]}}
                                                                                @endif
                                                                            @endif"
                                                                        alt="{{ $product->product_name }}" />
                                                                </a>
                                                                <ul class="product-card__bottom product-card__gallery">
                                                                    @if(isset($getNewImages) && $getNewImages)
                                                                        @foreach($getNewImages[$productKey] as $imageKey => $productImage)
                                                                            <li class="item-img {{ (($imageKey == 0) ? 'thumb-active' : '') }}" data-src="{{ (isset($getNewProductPath) && isset($getNewProductPath300x300)) ? $getNewProductPath[$productKey] . $getNewProductPath300x300 . $productImage->file_name : null }}">
                                                                                <img class="lazyload" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ (isset($getNewProductPath) && isset($getNewProductPath300x300)) ? $getNewProductPath[$productKey] . $getNewProductPath300x300 .  $productImage->file_name : null}}" alt="{{ $productImage->file_description }}">
                                                                            </li>
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            @if($product->old_price > 0 )
                                                                <div class="box-labels">
                                                                    <span class="label-product label-sale" style="font-size: 10px; font-weight: 100;"><span class="d-none">Sale</span> -{{ (($product->old_price > 0 ? number_format((($product->old_price - $product->original_price) / ($product->old_price) * 100), 2) : 0)) }}%</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="right-block bg-light">
                                                            <div class="caption">
                                                                <h4 class="title-product text-truncate pl-3 p-3">
                                                                    <a class="product-name" href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>str_replace(' ', '_+_', $product->product_name)]) : 'javascript:;') }}" title="{{ $product->product_name }}"><strong>{{ $product->product_name }}</strong></a>
                                                                </h4>
                                                                <div class="custom-reviews">
                                                                    <span class="shopify-product-reviews-badge" data-id="1426341298265"></span>
                                                                </div>
                                                                <div class="price">
                                                                    <span class="price-new"><span class=money>${{ number_format($product->original_price, 2) }}</span></span>
                                                                    @if($product->old_price > 0 || $product->old_price <> null)
                                                                        <span class="price-old"> <span class=money>${{ number_format($product->old_price, 2) }}</span> </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            {{-- Show Cart/Details optional button --}}
                                                            {{-- <div class="button-link">
                                                                <div class="product-addto-links">
                                                                    <a class="btn_df btnProduct" href="javascript:;" title="Wishlist">
                                                                        <i class="fa fa-heart"></i>
                                                                        <span class="hidden">Wishlist</span>
                                                                    </a>
                                                                </div>
                                                                <div class="btn-button add-to-cart action">
                                                                    <a href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>str_replace(' ', '_+_', $product->product_name)]) : 'javascript:;') }}" title="View Details"><i class="fa fa-shopping-basket"></i><span class=""> Details </span></a>
                                                                </div>
                                                                <div class="product-addto-links">
                                                                    <a class="btn_df btnProduct" href="javascript:;" title="Quick View">
                                                                        <i class="fa fa-search"></i>
                                                                        <span class="hidden">Quick View</span>
                                                                    </a>
                                                                </div>
                                                            </div> --}}
                                                        </div>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                            </div><!--//-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
@endif
