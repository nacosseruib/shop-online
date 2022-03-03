@extends('layouts.site')
@section("pageTitle", "List of Delivery Agents")
@section("accountPageActive", "active")
@section("storeMenuPageActiveSub", "btn-grey")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $showPageAgent          = (isset($showPageAgent) ? $showPageAgent : 1);
@endphp

@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('deliveryAgent.listAgent.listAgentPageView', ['showPageAgent' => (isset($showPageAgent) ? $showPageAgent : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection

@section('script')
    @includeIf('share.jqueryFunctionCalls', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])
    <script>
        $(document).ready(function()
        {
            $("input[type='radio']").click(function()
            {
                var sim = $("input[type='radio']:checked").val();
                if (sim < 3)
                {
                    $('.myratings').css('color','red'); $(".myratings").text(sim);
                }else{
                    $('.myratings').css('color','green'); $(".myratings").text(sim);
                }
            });
        });
    </script>
@endsection

@section('style')
    <style>

        fieldset,
        label {
            margin: 0;
            padding: 0
        }

        h1 {
            font-size: 1.5em;
            margin: 10px
        }

        .rating {
            border: none;
            margin-right: 49px
        }

        .myratings {
            font-size: 65px;
            color: green
        }

        .rating>[id^="star"] {
            display: none
        }

        .rating>label:before {
            margin: 2px;
            font-size: 2.15em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005"
        }

        .rating>.half:before {
            content: "\f089";
            position: absolute
        }

        .rating>label {
            color: #ddd;
            float: right
        }

        .rating>[id^="star"]:checked~label,
        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            color: #FFD700
        }

        .rating>[id^="star"]:checked+label:hover,
        .rating>[id^="star"]:checked~label:hover,
        .rating>label:hover~[id^="star"]:checked~label,
        .rating>[id^="star"]:checked~label:hover~label {
            color: #FFED85
        }

        .reset-option {
            display: none
        }

        .reset-button {
            margin: 6px 12px;
            background-color: rgb(255, 255, 255);
            text-transform: uppercase
        }
        .card {
            position: relative;
            display: flex;
            width: 240px;
            flex-direction: column;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #d2d2dc;
            border-radius: 11px;
            -webkit-box-shadow: 0px 0px 5px 0px rgb(157, 157, 219);
            -moz-box-shadow: 0px 0px 5px 0px rgba(212, 182, 212, 1);
            box-shadow: 0px 0px 5px 0px rgb(161, 163, 164)
        }
        .card-body {
            flex: 1 1 auto;
            padding: 0.1rem
        }
        p {
            font-size: 12px
        }
        h4 {
            margin-top: 13px
        }
        /* .rating-btn:focus {
            outline: none
        }
        .rating-btn {
            border-radius: 22px;
            text-transform: capitalize;
            font-size: 13px;
            padding: 8px 19px;
            cursor: pointer;
            color: #fff;
            background-color: #D50000
        }
        .rating-btn:hover {
            background-color: #D32F2F !important
        } */
    </style>
@endsection
