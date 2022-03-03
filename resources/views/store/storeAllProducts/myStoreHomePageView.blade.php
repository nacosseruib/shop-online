
@if(isset($showPageStore) && ($showPageStore ==1) && (isset($getProduct) && $getProduct ))

    @if(@getimagesize((isset($storeBannerPath) ? $storeBannerPath : '')))
        <img src="{{ (isset($storeBannerPath) ? $storeBannerPath : '')}}" style="width: 100%; height:300px" class="img-responsive mb-2" alt=" " />
    @endif

    @includeIf('share.product.productGridShareView', ['showAddToCart' => (isset($showAddToCart) ? $showAddToCart : 0), 'showRestore'=> (isset($showRestore) ? $showRestore : 0), 'showEditDelete'=> (isset($showEditDelete) ? $showEditDelete : 1)])

@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="material-icons">shopping_basket</i></span>
                <p class="cart_empty">Your Store is currently empty.</p>
                <div class="cookie-message">
                    <p>Upload product to your store to attract customers</p>
                </div>
                @if(isset($userStorestatus) && $userStorestatus)
                    <a href="{{ (Route::has('goToProductUpload') ? Route('goToProductUpload') : '#') }}" class="btn btn-outline-orange btn-orange text-white p-3">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Upload New Product
                    </a>
                @endif
            </div>
        </div>
    </div>

@endif

