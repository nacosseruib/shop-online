@extends('layouts.site')
@section("pageTitle")
   {{ (isset($userStoreName)  ? $userStoreName : null) }}'s store
 @endsection
@section("accountPageActive", "active")
@section("storeMenuPageActiveSub", "btn-grey")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $showSortBy             = (isset($showSortBy) ? $showSortBy : 1);
    $showAddToCart          = 0;
    $col_3_or_4             = 4;
@endphp

@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('store.storeAllProducts.myStoreHomePageView', ['showPageStore' => (isset($showPageStore) ? $showPageStore : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection

@section('script')
    @includeIf('share.jqueryFunctionCallsOfflineOnline', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])
@endsection
