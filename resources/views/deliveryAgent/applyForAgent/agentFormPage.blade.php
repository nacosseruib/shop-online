@extends('layouts.site')
@section("pageTitle", "New Agent Registration")
@section("pageActiveCart", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('deliveryAgent.applyForAgent.agentFormPageView', ['showAgentRegistrationPage' => (isset($showAgentRegistrationPage) ? $showAgentRegistrationPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection
