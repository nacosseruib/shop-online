@if(isset($getAllProductCategory) && $getAllProductCategory)
    <div id="shopify-section-1534413804014" class="shopify-section home-section clearfix">
        <div class="widget-collection m-0 p-0">
            <div class="container">
                <div class="wrap-bg owl-style2 bg-light">
                    <div class="home-title bg-light p-3">
                        <span>COLLECTIONS</span>
                    </div>
                    <div class="collections">
                        <div class="ss-carousel ss-owl">
                            <div style="top: -2px;" class="owl-carousel"
                                data-nav	    ="true"
                                data-margin	    ="0"
                                data-column1	="6"
                                data-column2	="5"
                                data-column3	="4"
                                data-column4	="3"
                                data-column5	="2">

                                @foreach($getAllProductCategory as $categorykey => $value)
                                <div class="collect ">
                                    <a href="{{ (Route::has('productCollection') ? Route('productCollection', ['categoryName'=>$value->category]) : 'javascript:;') }}" class="collection-item">
                                        <span class="{{ $value->icon }} fa-4x"></span>
                                        <div class="collection-name">
                                        {{ $value->category }}
                                        </div>
                                    </a>
                                </div>
                               @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
