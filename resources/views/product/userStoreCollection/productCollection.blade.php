@extends('layouts.site')
@section("pageTitle")
    {{ (isset($getStoreName) ? $getStoreName : null ) }}
@endsection
@section("productPageActive", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $showAddToCart          = 0;
    $col_3_or_4             = 3;

@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('product.userStorecollection.productCollectionView', ['showPage' => (isset($showCollectionPage) ? $showCollectionPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.product.productSideBarView', ['showSideBarProductSideBarView' => (isset($showSideBarProductSideBarView) ? $showSideBarProductSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 0)])

@endsection
