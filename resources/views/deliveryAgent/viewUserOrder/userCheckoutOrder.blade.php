@extends('layouts.site')
@section("pageTitle", "Buy and deliver as described below")
@section("pageActiveCheckout", "active")
@php
    $showWelcomePopupModal = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav         = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $showUserOrderPage     = (isset($showUserOrderPage) ? $showUserOrderPage : 1);
@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('deliveryAgent.viewUserOrder.userCheckoutOrderView', ['showUserOrderPage' => (isset($showUserOrderPage) ? $showUserOrderPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.product.productSideBarView', ['showSideBarProductSideBarView' => (isset($showSideBarProductSideBarView) ? $showSideBarProductSideBarView : 0), 'showFilter' => (isset($showFilter) ? $showFilter : 0)])

@endsection
