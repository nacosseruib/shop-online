@extends('layouts.site')
@section("pageTitle", "All Pending Item To Be Delivered To Me")
@section("accountPageActive", "active")
@section("storeMenuPageActiveSub", "btn-grey")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $showSortBy             = (isset($showSortBy) ? $showSortBy : 0);
@endphp

@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('pendingItemToBeDeliveredToMe.pendingDeliveryPageView', ['showPageMyDelivery' => (isset($showPageMyPendingDelivery) ? $showPageMyPendingDelivery : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection

@section('script')
    @includeIf('share.jqueryFunctionAddToCart', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])
    <script>
        $(".btnModalComment").click(function(){
            var id = this.id
            $('#replyMessage').val('');
            $(".modalComment" + id).modal('hide');
        });
    </script>
@endsection
