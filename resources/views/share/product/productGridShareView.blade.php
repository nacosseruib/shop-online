
    <div id="shopify-section-collection-template" class="shopify-section pt-3">
        <div data-section-id="collection-template" data-section-type="collection-template" class="products-collection">
            <div class="product-wrapper" id="Collection">
                <div class="products-listing products-grid grid row EndlessScroll">

                @if(isset($getProduct) && $getProduct)
                    @foreach($getProduct as $productKey => $product)

                        <div id="product-{{( 1 + $productKey)}}" class="product product-layout grid__item grid__item--collection-template col-xl-{{(isset($col_3_or_4) ? $col_3_or_4 : 4)}} col-lg-{{(isset($col_3_or_4) ? $col_3_or_4 : 4)}} col-md-{{(isset($col_3_or_4) ? $col_3_or_4 : 4)}} col-sm-{{(isset($col_3_or_4) ? $col_3_or_4 : 4)}} col-xs-6 grid_3" data-price="{{ number_format($product->original_price, 2) }}">
                            <span class="d-none"><span class=money>${{ number_format($product->original_price, 2) }}</span></span>
                            <div class="product-item" data-id="{{ ($product->productID) }}">
                                <div class="product-item-container grid-view-item">

                                    <!-- product name, image and button -->
                                    @includeIf('share.product.item.itemImagePreview', ['showAddToCart' => (isset($showAddToCart) ? $showAddToCart : 0), 'showRestore'=> (isset($showRestore) ? $showRestore : 0), 'showEditDelete'=> (isset($showEditDelete) ? $showEditDelete : 1)])

                                </div>
                            </div>
                        </div>

                        <!-- Modal to confirm product edit-->
                        <div class="modal fade text-left d-print-none" id="editProduct{{$productKey}}" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                        <h5 class="modal-title text-white"><i class="fa fa-edit"></i> Edit Product </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12"><b>Product Name:</b> {{ $product->product_name }} </div>
                                                <div class="col-md-12"><b>Product Original Price:</b> <span class=money>${{ number_format($product->original_price, 2) }}</span></div>
                                                <div class="col-md-12"><b>Product Old Price:</b> <span class=""> <span class=money>${{ number_format($product->old_price, 2) }}</span> </span></div>
                                                <div class="col-md-12"><b>Product Status:</b> {{ ($product->is_online == 1 ? 'Product is online' : 'Product is offline') }}</div>
                                            </div>
                                            <hr />
                                            <div class="text-info text-center"> <h3>Are you sure you want to edit this product? </h3></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> Cancel </button>
                                            <a href="{{ (Route::has('productToEdit') ? Route('productToEdit', ['productID'=>$product->productID]) : 'javascript') }}" class="btn btn-outline-success">Continue to edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->

                            <!-- Modal to confirm product Soft Delete-->
                            <div class="modal fade text-left d-print-none" id="moveToProduct{{$productKey}}" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-warning">
                                        <h5 class="modal-title text-white"><i class="fa fa-trash"></i> Move Product to Trash </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12"><b>Product Name:</b> {{ $product->product_name }} </div>
                                                <div class="col-md-12"><b>Product Original Price:</b> <span class=money>${{ number_format($product->original_price, 2) }}</span></div>
                                                <div class="col-md-12"><b>Product Old Price:</b> <span class=money>${{ number_format($product->old_price, 2) }} </span></div>
                                                <div class="col-md-12"><b>Product Status:</b> {{ ($product->is_online == 1 ? 'Product is online' : 'Product is offline') }}</div>
                                            </div>
                                            <hr />
                                            <div class="text-danger text-center"> <h3>Are you sure you want to move this product to trash? </h3></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-success" data-dismiss="modal"> Cancel </button>
                                            <a href="{{ (Route::has('trashProduct') ? Route('trashProduct', ['product'=>$product->productID]) : 'javascript:;') }}" class="btn btn-outline-danger">Yes. Continue</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->

                             <!-- Modal to confirm product Restore-->
                             <div class="modal fade text-left d-print-none" id="restoreProduct{{$productKey}}" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                        <h5 class="modal-title text-white"><i class="fa fa-refresh"></i> Restore Product to Store </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12"><b>Product Name:</b> {{ $product->product_name }} </div>
                                                <div class="col-md-12"><b>Product Original Price:</b> <span class=money>${{ number_format($product->original_price, 2) }}</span></div>
                                                <div class="col-md-12"><b>Product Old Price:</b> <span class=money>${{ number_format($product->old_price, 2) }} </span></div>
                                                <div class="col-md-12"><b>Product Status:</b> {{ ($product->is_online == 1 ? 'Product is online' : 'Product is offline') }}</div>
                                            </div>
                                            <hr />
                                            <div class="text-info text-center"> <h3>Are you sure you want to restore this product to store? </h3></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                                            <a href="{{ (Route::has('restoreToStoreProduct') ? Route('restoreToStoreProduct', ['product'=>$product->productID]) : 'javascript:;') }}" class="btn btn-outline-success">Yes. Continue</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->

                            <!-- Modal to confirm delete Product Permanantly-->
                            <div class="modal fade text-left d-print-none" id="deleteProductPermanantly{{$productKey}}" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                        <h5 class="modal-title text-white"><i class="fa fa-file-o"></i> Delete Product Permanently </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12"><b>Product Name:</b> {{ $product->product_name }} </div>
                                                <div class="col-md-12"><b>Product Original Price:</b> <span class=money>${{ number_format($product->original_price, 2) }}</span></div>
                                                <div class="col-md-12"><b>Product Old Price:</b> <span class=money>${{ number_format($product->old_price, 2) }} </span></div>
                                                <div class="col-md-12"><b>Product Status:</b> {{ ($product->is_online == 1 ? 'Product is online' : 'Product is offline') }}</div>
                                            </div>
                                            <hr />
                                            <div class="text-danger text-center"> <h3>Are you sure you want to delete this product permanently? </h3></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-success" data-dismiss="modal"> Cancel </button>
                                            <a href="{{ (Route::has('deleteProductPermanentlyFromTrash') ? Route('deleteProductPermanentlyFromTrash', ['product'=>$product->productID]) : 'javascript:;') }}" class="btn btn-outline-danger">Yes. Continue</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->

                            <!-- Modal to confirm to push product online or offline-->
                            <div class="modal fade text-left d-print-none" id="pushProductOnlineOrOffline{{$productKey}}" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                        <h5 class="modal-title text-white"><i class="fa fa-save"></i> Push Product Online/Offline </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12"><b>Product Name:</b> {{ $product->product_name }} </div>
                                                <div class="col-md-12"><b>Product Status:</b> {{ ($product->is_online == 1 ? 'Product is online' : 'Product is offline') }}</div>
                                            </div>
                                            <hr />
                                            <div class="text-danger text-center"> <h3>Are you sure you want to push this {{ ($product->is_online == 1 ? 'product offline' : 'product  online') }}? </h3></div>
                                            <br />
                                            <div class="text-success text-center" style="font-size: 14px;" id="updateOnlineOfflineProductReplyMessage"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                                            <button type="button" class="btn btn-outline-info updateOnlineOfflineProduct" id="{{$product->productID}}"> Yes. Continue </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end Modal-->

                        @endforeach
                    @endif
                </div>
                @if(isset($getProduct) && $getProduct)
                    <div class="row">
                        @if(isset($getProduct) && is_iterable($getProduct))
                            <div align="right" class="col-md-12"><hr />
                                Showing {{($getProduct->currentpage()-1)*$getProduct->perpage()+1}}
                                    to {{$getProduct->currentpage()*$getProduct->perpage()}}
                                    of  {{$getProduct->total()}} entries
                            </div>
                            <div class="d-print-none text-right">{{ $getProduct->links() }}</div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

