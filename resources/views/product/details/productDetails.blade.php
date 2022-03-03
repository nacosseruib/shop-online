@extends('layouts.site')
@section("pageTitle",  ((isset($product) && $product) ? ($product->product_name) : '') )
@section("productPageActive", "active")

@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $showPageRelatedProduct = 1;
    $dMargin		        = (isset($dMargin) ? $dMargin : 10);
    $dcolumn1               = (isset($dcolumn1) ? $dcolumn1 : 4);
    $dcolumn2               = (isset($dcolumn2) ? $dcolumn2 : 3);
    $dcolumn3               = (isset($dcolumn3) ? $dcolumn3 : 2);
    $dcolumn4               = (isset($dcolumn4) ? $dcolumn4 : 2);
    $dcolumn5               = (isset($dcolumn5) ? $dcolumn5 : 1);
    $showAddToCart          = 0;
@endphp

@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('product.details.productDetailsView', ['title' => (isset($relatedProductDetailsTitle) ? $relatedProductDetailsTitle : 'Related Products'), 'showPage' => (isset($showPage) ? $showPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.product.productSideBarView', ['productSideBarView' => (isset($productSideBarView) ? $productSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 0)])

@endsection
