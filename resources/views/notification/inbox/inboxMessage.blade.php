@extends('layouts.site')
@section("pageTitle", "Message - Inbox")
@section("accountPageActive", "active")
@section("storeMenuPageActiveSub", "btn-grey")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $showSortBy             = (isset($showSortBy) ? $showSortBy : 0);
    $showPageInbox          = (isset($showPageInbox) ? $showPageInbox : 1);
@endphp

@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('notification.inbox.inboxMessageView', ['showPageInbox' => (isset($showPageInbox) ? $showPageInbox : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection

@section('script')
    @includeIf('share.jqueryFunctionCalls', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])
@endsection
