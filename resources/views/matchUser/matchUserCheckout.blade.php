@extends('layouts.site')
@section("pageTitle", "Buy and deliver below product(s). Then, we deliver your product(s) with no further cost.")
@section("pageActiveCheckout", "active")
@php
    $showWelcomePopupModal = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav         = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $showMatchPage         = (isset($showMatchPage) ? $showMatchPage : 1);
@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('matchUser.matchUserCheckoutView', ['title' => (isset($relatedProductCartTitle) ? $relatedProductCartTitle : 'Checkout'), 'showPage' => (isset($showPage) ? $showPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.product.productSideBarView', ['showSideBarProductSideBarView' => (isset($showSideBarProductSideBarView) ? $showSideBarProductSideBarView : 0), 'showFilter' => (isset($showFilter) ? $showFilter : 0)])

@endsection
