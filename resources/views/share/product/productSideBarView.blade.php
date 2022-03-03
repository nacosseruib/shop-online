
@if(isset($productSideBarView) && $productSideBarView ==1)

    <div class="quick-view"></div>
    <div class="page-container" id="PageContainer">
        <div class="main-content" id="MainContent">
            <div class="container positon-sidebar">
                <div class="row">
                    <div class="col-sidebar sidebar-fixed col-lg-3">
                        <span id="close-sidebar" class="btn-fixed d-lg-none">
                            <i class="fa fa-times"></i>
                        </span>
                        <div class="block sidebar-banner spaceBlock banners" style="background: #f5f2f2;">
                            @if(isset($getProduct) && $getProduct)
                                @foreach($getProduct as $productKey => $product)
                                @if($productKey > -1 && $productKey < 9)
                                    <div class="mb-4 bg-light">
                                        <a class="grid-view-item__link image-ajax" href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>str_replace(' ', '_+_', $product->product_name)]) : 'javascript:;') }}">

                                            <img class="img-responsive lazyload" data-sizes="auto"
                                                src="{{ asset('assets/images/product-loading.svg') }}"
                                                data-src="@if(isset($productPath[$productKey]) && isset($productPath300x300) && isset($productPath500x500))
                                                        @if(@getimagesize($productPath[$productKey] . $productPath300x300 . $productCoverImage[$productKey]))
                                                            {{$productPath[$productKey] . $productPath300x300 . $productCoverImage[$productKey]}}
                                                        @elseif(@getimagesize($productPath[$productKey] . $productPath500x500 . $productCoverImage[$productKey]))
                                                            {{$productPath[$productKey] . $productPath500x500 . $productCoverImage[$productKey]}}
                                                        @else
                                                            {{$productPath . $productCoverImage[$productKey]}}
                                                        @endif
                                                    @endif"
                                                alt="{{ $product->product_name }}" />
                                        </a>
                                        <div class="caption text-center pl-3 pr-3 pt-3">
                                            <h4 class="title-product text-truncate">
                                                <a class="product-name" href="{{ (Route::has('productDetails') ? Route('productDetails', ['productID'=>$product->productID]) : 'javascript:;') }}" title="{{ $product->product_name }}"><strong>{{ $product->product_name }}</strong></a>
                                            </h4>
                                            <div class="price pb-2">
                                                <span class="price-new"><span class=money>${{ number_format($product->original_price, 2) }}</span></span>
                                                @if($product->old_price > 0 || $product->old_price <> null)
                                                    <span class="price-old"> <span class=money>${{ number_format($product->old_price, 2) }}</span> </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="sidebar-overlay"></div>
                    <div class="col-main col-lg-9 col-12">
                        <a href="javascript:void(0)" class="open-sidebar d-lg-none"><i class="fa fa-bars"></i> Side Menu</a>

                        <!--Yield view-->
                        @yield('pageSubContent')

                    </div>
                </div>
            </div>
            <script>
                $(".open-sidebar").click(function(e){

                $(".sidebar-overlay").toggleClass("show");
                $(".sidebar-fixed").toggleClass("active");
                });
                $( ".open-fiter" ).click(function() {
                $('.sidebar-fixed').slideToggle(200);
                $(this).toggleClass('active');
                });
                $(".sidebar-overlay").click(function(e){

                $(".sidebar-overlay").toggleClass("show");
                $(".sidebar-fixed").toggleClass("active");
                });
                $('#close-sidebar').click(function() {
                $('.sidebar-overlay').removeClass('show');
                $('.sidebar-fixed').removeClass('active');

                });
            </script>

        </div>
    </div>

@else
    <section id="breadcrumbs" class=" breadcrumbbg">
        <div class="breadcrumbwrapper">
            <div class="container">
                <!--Yield view-->
                @yield('pageSubContent')
            </div>
        </div>
        <hr />
    </section>
@endif
