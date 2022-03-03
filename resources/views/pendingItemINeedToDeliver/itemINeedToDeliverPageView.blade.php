
@if(isset($showPagePendingItemNeedToDeliver) && ($showPagePendingItemNeedToDeliver ==1) && (isset($getPendingItemNeedToDeliver) && (count($getPendingItemNeedToDeliver) > 0) ))

    <div class="bg-white p-3 h5">
        <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr class="text-center">
                    <th>SN</th>
                    <th>RECEIVER'S NAME</th>
                    <th>STATUS</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th width="150">RATE</th>
                    <th>UPDATED</th>
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($getPendingItemNeedToDeliver) && $getPendingItemNeedToDeliver)
                    @foreach($getPendingItemNeedToDeliver as $key => $value)
                        <tr class="text-center font-weight-bold">
                            <td>{{ ($getPendingItemNeedToDeliver->currentpage()-1) * $getPendingItemNeedToDeliver->perpage() + (1+$key) }}</td>
                            <td class="text-info text-uppercase">{{ $value->first_name .' '. $value->last_name}}</td>
                            <td class="text-danger">Not Delivered</td>
                            <td>{{ $value->item_quantity }}</td>
                            <td class="text-success"><span class=money>${{ number_format($value->receiver_total_amount, 2) }}</span></td>
                            <td>({{ $value->percentage_rate_from .' - '. $value->percentage_rate_to }})%</td>
                            <td>{{ date('M d, Y H:i:sa', strtotime($value->updated_at))}}</td>
                            @if(Auth::check() && Auth::user()->id == $value->userID)
                                @if($value->receiver_order_number <> null)
                                <td>
                                    <a href="{{ Route::has('itemDelivery') ? Route('itemDelivery', ['u'=>$value->userID, 'on'=> $value->order_number]) : 'javascript:;' }}" class="btn btn-info">View</a>
                                </td>
                                <td>
                                    <a href="{{ Route::has('confirmItemDelivery') ? Route('confirmItemDelivery', ['on'=> $value->receiver_order_number]) : 'javascript:;' }}" class="btn btn-outline-success">Confirm</a>
                                </td>
                                @endif
                               {{--  <td>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-backdrop="false" data-target="#confirmPendingDeletion{{$key}}">Delete</button>
                                </td> --}}
                            @endif
                        </tr>

                        <!-- Confirm deletion Modal-->
                        <div class="modal fade text-left d-print-none" id="confirmPendingDeletion{{$key}}" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white"><i class="fa fa-trash"></i> Confirm </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="m-3">
                                                    <div class="mb-2 m-3">Are you sure you want to delete this delivery order?</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                                        <a href="{{ Route::has('deletePendingItemNeedToDeliver') ? Route('deletePendingItemNeedToDeliver', ['on'=> $value->order_number]) : 'javascript:;' }}" class="btn btn-outline btn-warning">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end deletion Modal-->

                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="row">
            <div align="right" class="col-xs-12 col-sm-12">
                <hr />
                @if(isset($getPendingItemNeedToDeliver))
                    Showing {{($getPendingItemNeedToDeliver->currentpage()-1)*$getPendingItemNeedToDeliver->perpage()+1}}
                    to {{$getPendingItemNeedToDeliver->currentpage()*$getPendingItemNeedToDeliver->perpage()}}
                    of  {{$getPendingItemNeedToDeliver->total()}} entries
                    <div class="hidden-print pull-left">{{ $getPendingItemNeedToDeliver->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">You currently have no pending item you want to deliver.</p>
            </div>
        </div>
    </div>

@endif

