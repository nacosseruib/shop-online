@extends('layouts.site')
@section("pageTitle", "Confirm Your Item delivery")
@section("pageActiveCart", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('confirmItemDelivery.confirmItemDeliveryView', ['title' => (isset($relatedProductCartTitle) ? $relatedProductCartTitle : 'Item Delivery'), 'showPage' => (isset($showPage) ? $showPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection
