@extends('layouts.site')
@section("pageTitle", "Welcome to shopstore4me")
@section("indexPageActive", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $openCategoryMenu       = 1;
    $popupContentPage       = 'share.index.welcomePopupContent.indexPage';
@endphp
@section('pageContent')

        <div class="quick-view"></div>
        <div class="page-container" id="PageContainer">
            <div class="main-content" id="MainContent">

                <div class="content-section1 index-slider-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-9 offset-xl-3">

                                <!--Top search section-->
                                <!--includeif('share.index.topSearchSection')-->
                                <!--//Top search section-->

                                <!--main slider section-->
                                @includeif('share.index.mainSliderSection')
                                <!--//main slider section-->

                                <!--free shipping, save shipping, free store section-->
                                @includeif('share.index.freeShippingSection')
                                <!--//free shipping, save shipping, free store section-->

                            </div>
                        </div>
                    </div>
                </div>

                <!--Best Seller products section-->
                @includeif('share.product.bestSellerProductSection', ['headerTitle'=>'Best Sellers'])

                <!--Best Seller products section-->
                @includeif('share.product.moreBestSellerProductSection', ['headerTitle'=>'Hot Sellers'])
                <!--//End Best Seller section-->

                 <!--New Arrival products section-->
                 @includeif('share.product.newArrivalProductSection', ['headerTitle'=>'New Arrival'])
                <!--//End New Arrival products section-->

                <!--collection products section-->
                @includeif('share.product.collectionProductSection', ['showCollection'=> (isset($showCollection) ? $showCollection : 1)])
                <!--//End collection section-->

                <!--Best Seller products section-->
                @includeif('share.product.bestSellerProductSection', ['headerTitle'=>'Fast Sellers'])

                 <!--Best Seller products section-->
                 @includeif('share.product.moreBestSellerProductSection', ['headerTitle'=>'Trending Products'])
                 <!--//End Best Seller section-->

                 <!--Category Collection-->
                 @includeif('share.product.collectionCategorySection')
                 <!--//end Category Collection-->



            </div>
        </div>
@endsection

