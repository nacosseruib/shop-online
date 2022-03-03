
    <div id="shopify-section-ss-tools" class="shopify-section">
        <script src="{{ asset('assets/js/jquery.tmpl.min.js')}}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/3817/t/3/assets/ss_toolsd6ef.js?v=4066751617484014785')}}" type="text/javascript"></script>

        <div id="so-groups" class="right so-groups-sticky hidden-md hidden-sm hidden-xs" style="top: 100px">
            <a class="sticky-categories" data-target="popup" data-popup="#popup-categories">
                <span>Collection</span>
                <i class="material-icons">tune</i>
            </a>

            <a class="sticky-mycart" data-target="popup" data-popup="#popup-mycart">
                <span>Shopping Cart</span>
                <i class="material-icons">add_shopping_cart</i>
            </a>

            <a class="sticky-myaccount" data-target="popup" data-popup="#popup-myaccount">
                <span>My Account</span>
                <i class="material-icons">supervisor_account</i>
            </a>

            <a class="sticky-mysearch" data-target="popup" data-popup="#popup-mysearch">
                <span>Search</span>
                <i class="material-icons">search</i>
            </a>

            <a class="sticky-recent" data-target="popup" data-popup="#popup-recent">
                <span>Recent Viewed Product</span>
                <i class="material-icons">wb_sunny</i>
            </a>

            <!--All Collections Popup -->
            @include('share.rightStickyPopupOnPages.popup.allCollection')

            <!--Shopping Cart Popup -->
            @include('share.rightStickyPopupOnPages.popup.shoppingCart')

            <!--My Account Popup -->
            @include('share.rightStickyPopupOnPages.popup.myAccount')

            <!--Search Product Popup -->
            @include('share.rightStickyPopupOnPages.popup.searchProduct')

            <!--Recent viewed Product Popup -->
            @include('share.rightStickyPopupOnPages.popup.recentViewedProduct')

        </div>
    </div>
