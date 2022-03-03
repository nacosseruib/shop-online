@extends('layouts.site')
@section("pageTitle", "Welcome to " . {{ (isset($userStoreName)  ? $userStoreName : null) }})
@section("productPageActive", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('product.collection.productCollectionView', ['showPage' => (isset($showPage) ? $showPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.product.productSideBarView', ['showSideBarProductSideBarView' => (isset($showSideBarProductSideBarView) ? $showSideBarProductSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 0)])

@endsection
