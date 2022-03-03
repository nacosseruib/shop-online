
@if(isset($showPageBlockedProduct) && ($showPageBlockedProduct ==1) && (isset($getProduct) && (count($getProduct) > 0) ))

    @includeIf('share.product.productGridShareView', ['showAddToCart' => 0, 'showRestore'=> 0, 'showEditDelete'=> 0])

@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">You Currently have no blocked product</p>
                <div class="cookie-message">
                    <p>If your costomers complain about any product or upload fake item, such item can be blocked.</p>
                </div>
            </div>
        </div>
    </div>

@endif

