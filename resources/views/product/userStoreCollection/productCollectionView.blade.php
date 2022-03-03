
@if(isset($showCollectionPage) && ($showCollectionPage ==1) && (isset($getProduct) && (count($getProduct) > 0) ))

    @if(@getimagesize((isset($storeBannerPath) ? $storeBannerPath : '')))
        <img src="{{ (isset($storeBannerPath) ? $storeBannerPath : '')}}" style="width: 100%; height:300px" class="img-responsive mb-2" alt=" " />
    @endif

    @includeIf('share.product.productGridShareView', ['showAddToCart' => (isset($showAddToCart) ? $showAddToCart : 0), 'showRestore'=> (isset($showRestore) ? $showRestore : 0), 'showEditDelete'=> (isset($showEditDelete) ? $showEditDelete : 0)])

@else

<div id="shopify-section-cart-template" class="shopify-section">
    <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
        <div class="empty-page-content text-center">
            <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
            <p class="cart_empty"> {{ ((isset($userDetails) && $userDetails) ? $userDetails->store_name : null ) }} Product collection is currently empty.</p>
        </div>
    </div>
</div>

@endif
