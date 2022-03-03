
<div class="left-block">
    <div class="product-image-container product-image">
        <a class="grid-view-item__link image-ajax" href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>str_replace(' ', '_+_', $product->product_name)]) : 'javascript:;') }}">

            <img class="img-responsive s-img lazyload" data-sizes="auto"
                src="{{ asset('assets/images/product-loading.svg') }}"
                data-src="@if(isset($productPath[$productKey]) && isset($productPath300x300) && isset($productPath500x500))
                        @if(@getimagesize($productPath[$productKey] . $productPath300x300 . $productCoverImage[$productKey]))
                            {{$productPath[$productKey] . $productPath300x300 . $productCoverImage[$productKey]}}
                        @elseif(@getimagesize($productPath[$productKey] . $productPath500x500 . $productCoverImage[$productKey]))
                            {{$productPath[$productKey] . $productPath500x500 . $productCoverImage[$productKey]}}
                        @else
                            {{$productPath[$productKey] . $productCoverImage[$productKey]}}
                        @endif
                    @endif"
                alt="{{ $product->product_name }}" />
        </a>
        <ul class="product-card__bottom product-card__gallery">
            @if(isset($productImages) && $productImages)
                @foreach($productImages[$productKey] as $imageKey => $productImage)
                    <li class="item-img {{ (($imageKey == 0) ? 'thumb-active' : '') }}" data-src="{{ (isset($productPath) && isset($productPath300x300)) ? $productPath[$productKey] . $productPath300x300 . $productImage->file_name : null }}">
                        <img class="lazyload" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ (isset($productPath) && isset($productPath300x300)) ? $productPath[$productKey] . $productPath300x300 .  $productImage->file_name : null}}" alt="{{ $productImage->file_description }}">
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
            <a class="product-name" href="{{ (Route::has('productDetails') && ($showAddToCart == 1) ? Route('productDetails', ['productID'=>str_replace(' ', '_+_', $product->product_name)]) : 'javascript:;') }}" title="{{ $product->product_name }}"><strong>{{ $product->product_name }}</strong></a>
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
    @if((isset($canIBuyMyProduct) && $canIBuyMyProduct) && $showAddToCart == 1)
    <div class="button-link">
        <div class="product-addto-links">
            <a class="btn_df btnProduct" href="javascript:;" title="Wishlist">
                <i class="fa fa-heart"></i>
                <span class="hidden">Wishlist</span>
            </a>
        </div>
        <div class="btn-button add-to-cart action">
            <a href="{{ (Route::has('productDetails') && ($showAddToCart == 1) ? Route('productDetails', ['productID'=>str_replace(' ', '_+_', $product->product_name)]) : 'javascript:;') }}" title="View Details"><i class="fa fa-shopping-basket"></i><span class=""> Details </span></a>
        </div>
        <div class="product-addto-links">
            <a class="btn_df btnProduct" href="javascript:;" title="Quick View">
                <i class="fa fa-search"></i>
                <span class="hidden">Quick View</span>
            </a>
        </div>
    </div>
    @endif


    {{-- Edit or delete option button --}}
    @if(Auth::check() && (Auth::user()->id == $product->userID) && (isset($isAllowToDeleteEditProduct) ? $isAllowToDeleteEditProduct == 1 : Auth::user()->id == null) && $showEditDelete == 1)
    <div class="button-link">
        <div class="product-addto-links">
            <a class="btn_df btnProduct" href="javascript:;" title="Move product to trash" data-toggle="modal" data-backdrop="false" data-target="#moveToProduct{{$productKey}}">
                <i class="fa fa-trash"></i>
            </a>
        </div>
        <div class="product-addto-links">
        <a class="btn_df btnProduct" href="javascript:;" title="Edit this product" data-toggle="modal" data-backdrop="false" data-target="#editProduct{{$productKey}}">
                <i class="fa fa-edit"></i>
            </a>
        </div>
        <div class="btn-button add-to-cart action  ">
            @if($product->is_online == 1)
                <a class="grl btn_df" href="javascript:void(0)" title="Put Offline" data-toggle="modal" data-backdrop="false" data-target="#pushProductOnlineOrOffline{{$productKey}}">
                    <i class="fa fa-feed"> Online</i>
                </a>
            @else
                <a class="grl btn_df" href="javascript:void(0)" title="Put Online" data-toggle="modal" data-backdrop="false" data-target="#pushProductOnlineOrOffline{{$productKey}}">
                    <i class="fa fa-exclamation-triangle"> Offline</i>
                </a>
            @endif
        </div>
        <div class="btn-button add-to-cart action">
            <a class="grl btn_df" href="javascript:void(0)" title="Total new Order 0">
                <i class="fa fa-shopping-bag"> 0 </i>
            </a>
        </div>
    </div>
    @endif
    {{-- Restore Product option button --}}
    @if(Auth::check() && (Auth::user()->id == $product->userID) && $showRestore == 1)
    <div class="button-link">
        <div class="btn-button add-to-cart action">
            <a class="grl btn_df" href="javascript:;" title="Restore this product" data-toggle="modal" data-backdrop="false" data-target="#restoreProduct{{$productKey}}">
                <i class="fa fa-refresh"> Restore</i>
            </a>
        </div>
        <div class="btn-button add-to-cart action">
            <a class="grl btn_df" href="javascript:void(0)" title="Delete permanently" data-toggle="modal" data-backdrop="false" data-target="#deleteProductPermanantly{{$productKey}}">
                <i class="fa fa-trash"> Delete</i>
            </a>
        </div>
    </div>
    @endif
</div>


