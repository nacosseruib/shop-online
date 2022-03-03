
@if(isset($showTrashPage) && ($showTrashPage == 1) && (isset($getProduct) && (count($getProduct) > 0) ))

    @includeIf('share.product.productGridShareView', ['showAddToCart' => (isset($showAddToCart) ? $showAddToCart : 0), 'showRestore'=> (isset($showRestore) ? $showRestore : 1), 'showEditDelete'=> (isset($showEditDelete) ? $showEditDelete : 0)])

@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">Your trash is currently empty.</p>
                <div class="cookie-message">
                    <p>All deleted products appear here</p>
                </div>
                <a href="{{ (Route::has('listTrashedProduct') ? Route('listTrashedProduct') : '#') }}" class="btn btn-outline-orange btn-orange text-white p-3">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Refresh
                </a>
            </div>
        </div>
    </div>

@endif

