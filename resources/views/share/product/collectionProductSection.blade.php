<!--collection section-->
@if(isset($showCollection) && $showCollection == 1)
    @if(isset($getCollection) && $getCollection)
        <div class="shopify-section home-section" style="padding: 5px 82px;">
            <div class="home-banner-ct banners m-0 p-2">
                <div class="container bg-light element-border-radius">
                    <div class="wrap-bg">
                        <div class="row">
                            @foreach($getCollection as $collectionKey => $value)

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 static-image" style="margin: 0; padding: 0;">
                                        <a href="{{ (Route::has('productCollection') ? Route('productCollection', ['categoryName'=>$value->category]) : 'javascript:;') }}" title=" ">
                                            <img class="img-responsive lazyload p-1" data-sizes="auto" src="{{ asset('assets/js/3817/t/3/assets/icon-loadings.svg?v=17303354247329670281') }}" alt=" " data-src="{{ $getCollectionPath[$collectionKey] . $getCollectionPath300x300 . $getCollectionCoverImage[$collectionKey] }}" /><!--getCollectionPath500x500-->
                                        </a>
                                    </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
