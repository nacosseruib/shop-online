
@if(isset($showPageMyDelivery) && ($showPageMyDelivery ==1) && (isset($getMyDelivery) && (count($getMyDelivery) > 0) ))

    <div class="bg-white p-3 h5">
        <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr class="text-center">
                    <th>SN</th>
                    <th>DELIVERED BY</th>
                    <th>STATUS</th>
                    <th>AMOUNT</th>
                    <th>QTY</th>
                    <th>LOCATION</th>
                    <th>UPDATED</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($getMyDelivery) && $getMyDelivery)
                    @foreach($getMyDelivery as $key => $value)
                        <tr class="text-center font-weight-bold">
                            <td>{{ ($getMyDelivery->currentpage()-1) * $getMyDelivery->perpage() + (1+$key) }}</td>
                            <td class="text-info text-uppercase">{{ $value->first_name .' '. $value->last_name}}</td>
                            <td class="text-success">Delivered</td>
                            <td><div class="price-new"><span class=money>${{ number_format($value->receiver_total_amount,2) }}</span></div></td>
                            <td>{{ $value->item_quantity }}</td>
                            <td>{{ $value->store_city .', '. $value->store_country }}</td>
                            <td>{{ date('M d, Y H:i:sa', strtotime($value->updated_at))}}</td>
                            <td>
                                <a href="{{ Route::has('myOrderDeliveryDetails') ? Route('myOrderDeliveryDetails', ['u'=>$value->receiverID, 'on'=> $value->receiver_order_number]) : 'javascript:;' }}" class="btn btn-info">View</a>
                            </td>
                        </tr>
                            <!-- confirm order Modal - data-toggle="modal" data-backdrop="false" data-target="#confirmOrder{{$key}}"-->
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
                @if(isset($getMyDelivery))
                    Showing {{($getMyDelivery->currentpage()-1)*$getMyDelivery->perpage()+1}}
                    to {{$getMyDelivery->currentpage()*$getMyDelivery->perpage()}}
                    of  {{$getMyDelivery->total()}} entries
                    <div class="hidden-print pull-left">{{ $getMyDelivery->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">You currently have no Delivery Item.</p>
                <div class="cookie-message">
                    <p>All your delivery items will be shown here</p>
                </div>
            </div>
        </div>
    </div>

@endif

