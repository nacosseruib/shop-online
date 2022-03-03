@extends('layouts.site')
@section("pageTitle",  ((isset($editRecord) && $editRecord) ? 'Update Product' : 'Upload New Product'))
@section("accountPageActive", "active")
@section("storeMenuPageActiveSub", "btn-grey")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 1);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
    $openCategoryMenu       = (isset($openCategoryMenu) ? $openCategoryMenu : 0);
    $popupContentPage       = 'share.index.welcomePopupContent.uploadProductPage';
@endphp
@section('pageContent')

    <!--Render main view content-->
    @section('pageSubContent')
        @includeIf('product.uploadProduct.uploadProductPageView', ['showPage' => (isset($showPage) ? $showPage : 1)])
    @endsection

    <!--Render sidebar view content-->
    @includeIf('share.store.storeSideBarView', ['showSideBarStoreSideBarView' => (isset($showSideBarStoreSideBarView) ? $showSideBarStoreSideBarView : 1), 'showFilter' => (isset($showFilter) ? $showFilter : 1)])

@endsection

@section('script')
<script>
    //add more field or remove field
    $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('#add_more_document_field'); //Add button selector
            var wrapper = $('.attach_more_field_row'); //Input field wrapper
            var fieldHTML = '<div class="row">' +
                                '<div class="remove_document_field_btn form-group col-sm-1">' +
                                    '<div id="remove_row" class="mt-4 text-right"> <a href="#" class="align-right text-danger" title="Remove"><i class="fa fa-trash"></i></a></div>' +
                                '</div>' +
                                '<div class="form-group col-sm-5">' +
                                    '<div class="text-left">Select File <span class="text-danger"><b>*</b></span></div>' +
                                    '<div>' +
                                        '<input type="file" name="productImage[]" data-parsley-type="file"  class="form-control"/>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="form-group col-sm-6">' +
                                    '<div class="text-left">Product Image Title (Optional)</div>' +
                                    '<div>' +
                                        '<input name="productTitle[]" type="text" class="form-control" placeholder="Product Title" />' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

            var x = 1; //Initial field counter is 1
            //Once add button is clicked
            $(addButton).click(function(){
                if(x < maxField){
                    x++;
                    $(wrapper).append(fieldHTML);
                }else{
                    alert('You cannot add more than 10 fields!');
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_document_field_btn', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
    });
    //end more field
</script>

{{-- GET PRODUCT COLLECTION FROM CATEGORY --}}
@includeIf('share.jqueryFunctionCalls', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])
{{--  END --}}

@endsection
