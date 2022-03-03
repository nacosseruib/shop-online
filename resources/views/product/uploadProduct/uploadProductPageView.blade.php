
@if(isset($showPage) && $showPage ==1)

<div class="container my-4">
    <div class="text-danger text-right">All fields with asterisk (<span class="text-danger"><b>*</b></span>) are to be filled.</div>
    <!-- Form -->
    <form class="text-left formFormatAmount" method="POST" action="{{  (Route::has('storeProductUpload') ? Route('storeProductUpload') : '#') }}" enctype="multipart/form-data">
    @csrf

        <!--Register for Store Details-->
        <section id="register-form">
            <div class="row">
              <div class="col-md-12 mb-4 offset-md-0">
                <section class="pr-1">
                  <div class="card">
                    <h5 class="card-header bg-light dark-text text-center py-4">
                      <strong>Please Enter Product Details</strong>
                    </h5>
                    <div class="card-body px-lg-5 pt-0">
                        <!--Product name and price-->
                        <div class="form-row row">
                          <div class="col-md-12 mt-3">
                            <div class="md-form">
                                <label for="productName">Product Full Name<span class="text-danger"><b>*</b></span> </label>
                                <input type="text" name="productName" required value="{{ ((isset($editRecord) && $editRecord) ? $editRecord->product_name : old('productName')) }}" class="form-control" placeholder="">
                                @error('productName')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-6 mt-3">
                            <div class="md-form">
                                <label for="originalPrice">Original Price <span class="text-danger"><b>*</b></span> <span class="text-info" title="This price will be shown to your customers"><b>?</b></span> </label>
                                <div class="md-form input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text md-addon">{{ (isset($userCurrency) ?  $userCurrency : null) }} </span>
                                    </div>
                                    <input type="text" name="originalPrice" required value="{{ ((isset($editRecord) && $editRecord) ? number_format($editRecord->original_price, 0) : old('originalPrice')) }}" class="form-control format-amount" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                      <span class="input-group-text md-addon">.00</span>
                                    </div>
                                </div>
                                @error('originalPrice')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-6 mt-3">
                            <div class="md-form">
                                <label for="oldPrice"> Old Price <span class="text-info" title="This price will be used to calculate discount"><b>?</b></span></label>
                                <div class="md-form input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text md-addon">{{ (isset($userCurrency) ?  $userCurrency : null) }}</span>
                                    </div>
                                    <input type="text" name="oldPrice" value="{{ ((isset($editRecord) && $editRecord) ? number_format($editRecord->old_price, 0) : old('oldPrice')) }}" class="form-control format-amount" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                      <span class="input-group-text md-addon">.00</span>
                                    </div>
                                </div>
                                @error('oldPrice')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                        </div>

                        <!--product Brand and category-->
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Category <span class="text-danger"><b>*</b></span></button>
                                        </div>
                                        <select name="productCategory" required class="browser-default custom-select" id="getCategory" aria-label="Example select with button addon">
                                            <option value="" selected>Choose...</option>
                                            @if(isset($productCategory) && $productCategory)
                                                @foreach($productCategory as $categorykey => $value)
                                        <option value="{{$value->categoryID}}" {{ ((isset($editRecord) && $editRecord && $editRecord->categoryID == $value->categoryID) ? 'selected' : ($value->categoryID == old('productCategory') ? 'selected' : '') ) }}>{{$value->category}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('productCategory')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Collection </button>
                                        </div>
                                        <select name="productCollection" class="browser-default custom-select" id="getCollection" aria-label="Example select with button addon">
                                          <option value="">Choose...</option>
                                        </select>
                                    </div>
                                    @error('productCollection')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!--Brand and Size-->
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0 waves-effect" type="button">Brand </button>
                                        </div>
                                        <input type="text" name="productBrand" value="{{ (isset($editRecord) && $editRecord) ? $editRecord->brand : old('productBrand') }}" class="form-control" placeholder="E.g Geneva">
                                    </div>
                                    @error('productBrand')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-md btn-outline-mdb-color mr-4 px-3 py-2 z-depth-0 waves-effect" type="button">Size</button>
                                        </div>
                                        <div class="row">
                                            @if(isset($getSize) && $getSize)
                                                @foreach($getSize as $sizeKey => $value)
                                                    <div class="col-ms-3 m-2">
                                                        <div align="center">
                                                            <input type="checkbox" {{ ((isset($editRecord) && $editRecord) && isset($productToEditSize) && is_array($productToEditSize)) ?  (in_array($value->sizeID, $productToEditSize) ? 'checked' : '') : '' }} name="productSize[]" value="{{ $value->sizeID }}" class="form-control" id="colourSize{{ $value->sizeID }}">
                                                            <label class="custom-control-label" for="colourSize{{ $value->sizeID }}" title="{{ $value->size_name }}">{{ $value->size_code }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @error('productSize')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!--Colour and Available-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-md btn-outline-mdb-color mr-4 px-3 py-2 z-depth-0 waves-effect" type="button">Colour</button>
                                        </div>
                                        <div class="row">
                                            @if(isset($getColour) && $getColour)
                                                @foreach($getColour as $colourKey => $value)
                                                    <div class="col-ms-3 m-1">
                                                        <div align="center">
                                                            <input type="checkbox" {{ ((isset($editRecord) && $editRecord) && isset($productToEditColour) && is_array($productToEditColour)) ?  (in_array($value->colourID, $productToEditColour) ? 'checked' : '') : '' }} name="productColour[]" value="{{ $value->colourID }}" class="form-control" id="colourSize{{ $value->colourID }}">
                                                            <label class="custom-control-label" style="color: #{{ $value->colour_code }};" for="colourSize{{ $value->colourID }}" title="{{ $value->colour_name }}">{{ $value->colour_symbol }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    @error('productColour')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0 waves-effect">Available <span class="text-danger"><b>*</b></span></div>
                                        </div>
                                        <select name="productAvailable" required class="browser-default custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                                            <option {{ ((isset($editRecord) && $editRecord && ($editRecord->is_available == 'Available')) ? 'selected' : ('Available' == old('productAvailable') ? 'selected' : '')) }}>Available</option>
                                            <option {{ ((isset($editRecord) && $editRecord && ($editRecord->is_available == 'Out of Stock')) ? 'selected' : ('Out of Stock' == old('productAvailable') ? 'selected' : '')) }}>Out of Stock</option>
                                            <option {{ ((isset($editRecord) && $editRecord && ($editRecord->is_available == 'Sold Out')) ? 'selected' : ('Sold Out' == old('productAvailable') ? 'selected' : '')) }}>Sold Out</option>
                                        </select>
                                    </div>
                                    @error('productAvailable')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                         <!--Product Status and comment-->
                         <div class="form-row row">
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="text-left">Post this product online/offline now?</div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0 waves-effect">Product Status <span class="text-danger"><b>*</b></span></div>
                                        </div>
                                        <select name="productStatus" required class="browser-default custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                                          <option value="" selected>Choose...</option>
                                          <option value="0" {{ ((isset($editRecord) && $editRecord && ($editRecord->is_online == 0)) ? 'selected' : (old('productStatus') == 0 ? 'selected' : '')) }}>Offline (Only you can see this product)</option>
                                          <option value="1" {{ ((isset($editRecord) && $editRecord && ($editRecord->is_online == 1)) ? 'selected' : (old('productStatus') == 1 ? 'selected' : '')) }}>Online (It will be seen by the public)</option>
                                        </select>
                                    </div>
                                    @error('productStatus')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="text-left">Receive customer's comment on this product?</div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="btn btn-md btn-outline-mdb-color m-0 px-3 py-2 z-depth-0 waves-effect">Receive Comment</div>
                                        </div>
                                        <select name="productComment" class="browser-default custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                                          <option value="" selected>Choose...</option>
                                          <option value="0" {{ ((isset($editRecord) && $editRecord && ($editRecord->is_comment == 0)) ? 'selected' : (old('productComment') == 0 ? 'selected' : '')) }}>No</option>
                                          <option value="1" {{ ((isset($editRecord) && $editRecord && ($editRecord->is_comment == 1)) ? 'selected' : (old('productComment') == 1 ? 'selected' : '')) }}>Yes</option>
                                        </select>
                                    </div>
                                    @error('productComment')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!--Product Details-->
                        <div class="form-row row">
                            <div class="col-md-12 mt-3">
                                <div class="text-left">Product details <span class="text-danger"><b>*</b></span></div>
                                <div>
								    <textarea required class="summernoteLong form-control p-2" id="getEditor" name="productDetails">{{ ((isset($editRecord) && $editRecord) ? $editRecord->product_details : old('productDetails')) }} </textarea>
                                </div>
                                @error('productDetails')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--Product Key Features-->
                        <div class="form-row row">
                            <div class="col-md-12 mt-3">
                                <div class="text-left">Specifications: Product Key Features </div>
                                <div>
								    <textarea class="summernoteLong form-control p-2" id="getEditor" name="productKeyFeatures">{{ ((isset($editRecord) && $editRecord) ? $editRecord->product_feature : old('productKeyFeatures')) }}</textarea>
                                </div>
                                @error('productKeyFeatures')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--Product Payment Method-->
                        <div class="form-row row">
                            <div class="col-md-12 mt-3">
                                <div class="text-left">Payment Method & Other Information </div>
                                <div>
								    <textarea class="summernoteShort form-control p-2" id="getEditor" name="productPaymentMethod">{{ ((isset($editRecord) && $editRecord) ? $editRecord->payment_method : old('productPaymentMethod')) }}</textarea>
                                </div>
                                @error('productPaymentMethod')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--Upload product image(s)-->

                        <div class="row">
                            <div class="col-sm-12 mt-5">
                                <h4 class="card-title text-left">
                                    Product Image(s) - <small class="text-warning">PNG,JPG,JPE,JPEG,PDF | Max: 2MB</small>
                                </h4>
                                <hr />
                                    <div class="attach_more_field_row">
                                        <div class="row">
                                            <div class="form-group col-sm-1"></div>
                                            <div class="form-group col-sm-5">
                                                <div class="text-left">Select Images <span class="text-danger"><b>*</b></span> Dimension: (500 X 500)Pixel </div>
                                                <div>
                                                    <input type="file"  {{ (isset($editRecord) && $editRecord ? '' : 'required') }} name="productImage[]" data-parsley-type="file"  class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <div class="text-left">Product Image Title (Optional)</div>
                                                    <div>
                                                        <input name="productTitle[]" type="text" class="form-control" placeholder="Product Image Title" />
                                                    </div>
                                            </div>
                                        </div>
                                        @error('productImage')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                                    </div>
                                    <button type="button" id="add_more_document_field" class="btn-sm btn btn-circle btn-info pull-right">
                                        <i class="fa fa-plus"> More Field</i>
                                     </button>
                                </div>
                            </div>


                            <hr />
                                <div class="row">
                                    @if(isset($productToEditImages) && $productToEditImages)
                                        @foreach($productToEditImages as $Uploadedkey => $value)
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-12 bg-light p-2">
                                                <div class=" product-media thumbnais-bottom">
                                                    <div class="product-photo-container slider-for">
                                                        <div class="thumb">
                                                            <a class="fancybox" target="_black" rel="gallery1" href="{{ (isset($productPath) ? $productPath . $value->file_name : '') }}" >
                                                                <img id="product-featured-image-3938812723289" class="product-featured-img" src="{{ (isset($productPath300x300) ? $productPath300x300 . $value->file_name : '') }}"/>
                                                            </a>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <a class="btn btn-danger text-white" data-toggle="modal" data-backdrop="false" data-target="#productImageModal{{$Uploadedkey}}"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                                <div class="col-md-10">{{ $value->file_description}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal to delete product image-->
                                            <div class="modal fade text-left d-print-none" id="productImageModal{{$Uploadedkey}}" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                        <h5 class="modal-title text-white"><i class="fa fa-trash"></i> Delete Product Image</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-danger text-center"> <h3>Are you sure you want to delete permanently this image? </h3></div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-success" data-dismiss="modal"> Cancel </button>
                                                            <a href="{{ (Route::has('deleteProductImage') ? Route('deleteProductImage', ['userProductImageID'=>$value->product_imageID, 'productID'=>((isset($editRecord) && $editRecord) ? $editRecord->productID  : null) ]) : 'javascript:;') }}" class="btn btn-outline-danger">Yes. Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end Modal-->
                                        @endforeach
                                    @endif
                                </div>

                            <hr />

                            <div class="row">
                                    @if(isset($editRecord) && $editRecord)
                                        <div class="col-md-6 mt-3 mb-3">
                                            <a href="{{ (Route::has('cancelProductEdit') ? Route('cancelProductEdit') : 'javascript:;') }}" class="btn btn-lg btn-block btn-default text-uppercase"><strong>Cancel  Edit</strong></a>
                                        </div>
                                        <div class="col-md-6 mt-3 mb-3">
                                            <button  type="button" class="btn btn-block btn-lg btn-success text-uppercase" data-toggle="modal" data-backdrop="false" data-target="#confirmToUploadModal"><strong>Update Product</strong></button>
                                        </div>
                                    @else
                                        <div class="col-md-12 mt-3 mb-3">
                                            <button  type="button" class="btn btn-block btn-lg btn-success text-uppercase" data-toggle="modal" data-backdrop="false" data-target="#confirmToUploadModal"><strong>Upload New Product</strong></button>
                                        </div>
                                    @endif
                            </div>
                        </div><!--//card-body-->

                    </div>
                  </div>
                </section>
              </div>
            </div>
          </section>

          <!-- Confirm to upload product Modal -->
          <div class="modal fade text-left d-print-none" id="confirmToUploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light white">
                    <h5 class="modal-title" id="confirmToUploadModal"><i class="fa fa-upload"></i> Upload/Update Product!  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">

                        <h5 class="text-center"> Please don't upload any product if its not available in stock (or make the product offline if not available)! </h5>
                    <p>
                        <div class="text-danger text-center"> Are you sure you want to continue with this operation? </div>
                    </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> Cancel </button>
                        @if(isset($editRecord) && $editRecord)
                            <input type="hidden" value="{{ ((isset($editRecord) && $editRecord) ? $editRecord->productID : null) }}" name="productToEdit" />
                            <button type="submit" class="btn btn-outline-success">Update Now</button>
                        @else
                            <input type="hidden" value="" name="productToEdit" />
                            <button type="submit" class="btn btn-outline-success">Upload Now</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--end Modal-->

    </form> <!--// Form -->

  </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="material-icons">shopping_basket</i></span>
                <p class="cart_empty text-danger">Sorry, you cannot upload any product now!!!</p>
            </div>
        </div>
    </div>

@endif

