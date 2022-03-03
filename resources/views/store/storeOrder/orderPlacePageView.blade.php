
@if(isset($showPageOrder) && ($showPageOrder ==1) && (isset($getOrders) && (count($getOrders) > 0) ))

    <div class="bg-white p-3 h5">
        <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>PRODUCT NAME</th>
                    <th>PRICE</th>
                    <th>TRANSACTION NO</th>
                    <th>ORDER NO</th>
                    <th>STATUS</th>
                    <th>CREATED</th>
                    <th>UPDATED</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($getOrders) && $getOrders)
                    @foreach($getOrders as $key => $value)
                        <tr class="font-weight-bold">
                            <td>{{ ($getOrders->currentpage()-1) * $getOrders->perpage() + (1+$key) }}</td>
                            <td width="500">
                                <div class="row">
                                    <div class="col-md-5" align="center">
                                        <img class="product-featured-img" style="width: 50px; height: 50px;" src="{{ (isset($productPath) ? $productPath[$key] : '') }}" alt=" " />
                                    </div>
                                    <div class="col-md-7" align="left">
                                        <b>{{ $value->product_name }}</b>
                                    </div>
                                </div>
                            </td>
                            <td class="text-success"><span class=money>${{ number_format($value->original_price, 2) }}</span></td>
                            <td class="text-info">{{ $value->transactionID }}</td>
                            <td class="text-success">
                                @if($value->is_item_confirm_by_store)
                                    {{ $value->order_number  }}
                                @endif
                            </td>
                            <td>{!! ($value->is_cancel ? '<span class="text-danger">Order Cancelled</span>' : '<span class="text-success">Active</span>') !!}</td>
                            <td>{{ date('M d, Y H:i:sa', strtotime($value->created_at))}}</td>
                            <td>{{ date('M d, Y H:i:sa', strtotime($value->updated_at))}}</td>
                            <td>
                                @if($value->is_item_confirm_by_store)
                                    <button type="button" class="btn btn-info">Confirmed</a>
                                @else
                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-backdrop="false" data-target="#confirmOrder{{$key}}">Confirm</a>
                                @endif
                            </td>
                        </tr>
                            <!-- confirm order Modal-->
                            <form method="POST" action="{{  (Route::has('confirmOrder') ? Route('confirmOrder') : '#') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal fade text-left d-print-none" id="confirmOrder{{$key}}" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info">
                                        <h5 class="modal-title text-white"><i class="fa fa-shopping-bag"></i> Confirm Order </h5>
                                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body m-4 p-1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Transaction Number</label>
                                                    <div class="form-control">{{ $value->transactionID }}</div>
                                                    <input type="hidden" required name="transactionNumber" value="{{ $value->transactionID }}" />
                                                </div>
                                                <div class="col-md-12 mt-3">
                                                    <label>Order Number <span class="text-danger"><b>*</b></span> <small><em>(Request order number for item sold)</em></small></label>
                                                    <input type="text" name="orderNumber" required class="form-control" placeholder="Enter Item Order Number"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-default" title="Cancel" data-dismiss="modal"> Cancel </button>
                                            <button type="submit" class="btn btn-outline btn-success" title="confirm now"><i class="fa fa-save fa-x2"></i> Submit </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>
                            <!--end confirm order Modal-->

                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="row">
            <div align="right" class="col-xs-12 col-sm-12">
                <hr />
                @if(isset($getOrders))
                    Showing {{($getOrders->currentpage()-1)*$getOrders->perpage()+1}}
                    to {{$getOrders->currentpage()*$getOrders->perpage()}}
                    of  {{$getOrders->total()}} entries
                    <div class="hidden-print pull-left">{{ $getOrders->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">You currently have no new order.</p>
                <div class="cookie-message">
                    <p>New order will be shown here</p>
                </div>
            </div>
        </div>
    </div>

@endif

