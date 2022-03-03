@extends('layouts.site')
@section("pageTitle")
    {{ (isset($userFullName)  ? $userFullName : null) }}'s profile
@endsection
@section("accountPageActive", "active")
@section("profileMenuPageActiveSub", "btn-grey")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $showFilter             = (isset($showFilter) ? $showFilter : 0);
@endphp

@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('profile.viewProfile.profilePageView', ['showPageProfile' => (isset($showPageProfile) ? $showPageProfile : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection


@section('style')
    <script src="{{ asset('assets/select-country/niceCountryInput.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/select-country/niceCountryInput.css')}}">
@endsection

@section('script')
    <script>
        function onChangeCallback(ctr){
            console.log("The country was changed: " + ctr);
            //$("#selectionSpan").text(ctr);
        }
        $(document).ready(function () {
            $(".niceCountryInputSelector").each(function(i,e){
                new NiceCountryInput(e).init();
            });

            //disable country content
            $("#disableCountryDiv :input").prop('disabled', true);
            $(".niceCountryInputSelector :input").prop('disabled', true);
        });
    </script>
@endsection
