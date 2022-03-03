
@if(isset($showPageMyPendingDelivery) && ($showPageMyPendingDelivery ==1) && (isset($getMyPendingDelivery) && (count($getMyPendingDelivery) > 0) ))

    <div class="bg-white p-3 h5">
        <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr class="text-center">
                    <th>SN</th>
                    <th>DELIVER'S NAME</th>
                    <th>STATUS</th>
                    <th>QTY</th>
                    <th>PRICE</th>
                    <th>LOCATION</th>
                    <th>UPDATED</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if(isset($getMyPendingDelivery) && $getMyPendingDelivery)
                    @foreach($getMyPendingDelivery as $key => $value)
                        <tr class="text-center font-weight-bold">
                            <td>{{ ($getMyPendingDelivery->currentpage()-1) * $getMyPendingDelivery->perpage() + (1+$key) }}</td>
                            <td class="text-info text-uppercase">{{ $value->first_name .' '. $value->last_name}}</td>
                            <td class="text-danger">Not Delivered</td>
                            <td>{{ $value->item_quantity }}</td>
                            <td class="text-success"><span class=money>${{ number_format($value->receiver_total_amount, 2) }}</span></td>
                            <td>{{ $value->store_city .', '. $value->store_country }}</td>
                            <td>{{ date('M d, Y H:i:sa', strtotime($value->updated_at))}}</td>
                            <td>
                                <a href="{{ Route::has('viewPendingDeliveryDetails') ? Route('viewPendingDeliveryDetails', ['u'=>$value->receiverID, 'on'=> $value->receiver_order_number]) : 'javascript:;' }}" class="btn btn-info">View</a>
                            </td>
                        </tr>

                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="row">
            <div align="right" class="col-xs-12 col-sm-12">
                <hr />
                @if(isset($getMyPendingDelivery))
                    Showing {{($getMyPendingDelivery->currentpage()-1)*$getMyPendingDelivery->perpage()+1}}
                    to {{$getMyPendingDelivery->currentpage()*$getMyPendingDelivery->perpage()}}
                    of  {{$getMyPendingDelivery->total()}} entries
                    <div class="hidden-print pull-left">{{ $getMyPendingDelivery->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">You currently have no Pending Order.</p>
            </div>
        </div>
    </div>

@endif

