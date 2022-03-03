
@if(isset($showPageRelatedProduct) && $showPageRelatedProduct == 1)

<div class="shopify-section home-section bg-white mt-3">
    <div class="widget-product-tabs m-0 p-0">
        <div class="container">
        <div class="widget-content products-listing grid">
            <div class="ltabs-tabs-container">
                <div class="home-title text-white">
                    <span>{{ (isset($headerTitle) ? $headerTitle : 'New Arrival') }}</span>
                </div>
                <div class="wrap-bg owl-style2">
                    <div class="ltabs-products-loader">
                        <img class="img-responsive" src="{{ asset('assets/js/3817/t/3/assets/icon-loadings.svg?v=17303354247329670281')}}" alt="loading" />
                    </div>
                    <div class="tabs-content product-layout">
                        <div class="tab-content">
                            <div class="ss-carousel ss-owl">
                                <div class="owl-carousel"
                                    data-nav		="true"
                                    data-margin		="{{(isset($dMargin) ? $dMargin : 15)}}"
                                    data-autoplay	="true"
                                    data-lazyLoad	="true"
                                    data-autospeed	="10000"
                                    data-speed		="300"
                                    data-column1	="{{(isset($dcolumn1) ? $dcolumn1 : 4)}}"
                                    data-column2	="{{(isset($dcolumn2) ? $dcolumn2 : 4)}}"
                                    data-column3	="{{(isset($dcolumn3) ? $dcolumn3 : 3)}}"
                                    data-column4	="{{(isset($dcolumn4) ? $dcolumn4 : 3)}}"
                                    data-column5	="{{(isset($dcolumn5) ? $dcolumn5 : 1)}}">

                                @if(isset($getProduct) && $getProduct)
                                    @foreach($getProduct as $productKey => $product)

                                        <div class="item {{ ($productKey == 0 ? 'item-first' : '') }}">
                                            <div class="product-item" data-id="{{ ($product->productID) }}">
                                                <div class="product-item-container grid-view-item">
                                                    <div class="left-block">

                                                        @includeIf('share.product.item.itemImagePreview', ['showAddToCart' => (isset($showAddToCart) ? $showAddToCart : 1), 'showRestore'=> (isset($showRestore) ? $showRestore : 0), 'showEditDelete'=> (isset($showEditDelete) ? $showEditDelete : 0)])

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @endif

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
