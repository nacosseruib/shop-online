@extends('layouts.site')
@section("pageTitle", "Shopping Cart")
@section("pageActiveCart", "active")
@php
    $showWelcomePopupModal = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('shopCart.cartView', ['title' => (isset($relatedProductCartTitle) ? $relatedProductCartTitle : 'More Products'), 'showPage' => (isset($showPage) ? $showPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.product.productSideBarView', ['showSideBarProductSideBarView' => (isset($showSideBarProductSideBarView) ? $showSideBarProductSideBarView : 0), 'showFilter' => (isset($showFilter) ? $showFilter : 0)])

@endsection
