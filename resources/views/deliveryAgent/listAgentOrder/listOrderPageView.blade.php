@if(isset($showPageAgentOrder) && ($showPageAgentOrder == 1) && (isset($listAgentOrder) && $listAgentOrder))
    <div class="bg-white p-3 h5">
        @if(isset($listAgentOrder) && $listAgentOrder)
            @foreach($listAgentOrder as $key => $value)

                    <div class="bg-white p-3 h5">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="review-block">
                                    <div class="row">
                                        <div class="col-sm-2" align="center">
                                            <img src="{{ isset($getPath) && $getPath[$key] ? $getPath[$key] : asset('assets/images/no-image.png') }}" class="img-rounded" width="60" alt=" ">
                                            <div class="review-block-date">{{ date('F d, Y h:i:s a', strtotime($value->created_at))}}</div>
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="review-block-name m-1 h5">
                                                <b>{{ ucfirst($value->first_name) .' '. ucfirst($value->last_name) }}</b>
                                            </div>
                                            <div class="review-block-title mt-2 mb-2 h4">
                                                <b>ORDER NUMBER: {{ substr(strip_tags($value->order_number), 0, 50) }}</b>
                                            </div>
                                            <div class="review-block-description font-weight-bold">
                                                {{ strip_tags($value->message) }}
                                            </div>
                                            <div align="right">
                                                @if($value->flag == 0)
                                                    <button class="btn btn-info text-center" data-toggle="modal" data-backdrop="false" data-target="#acceptReject{{$key}}"> Reject/Accept </button>
                                                @else
                                                    <a href="{{ (Route::has('viewUserDeliveryOrder') ? Route('viewUserDeliveryOrder', ['u'=>$value->senderID, 'on'=>$value->order_number]) : 'javascript:;') }}" class="btn btn-default text-center"> View Details </a>
                                                @endif
                                                @if($value->is_deleted == 1)
                                                    <button class="btn btn-warning text-center"> Order Cancelled </button>
                                                @else
                                                    @if($value->is_active == 1)
                                                        <button class="btn btn text-center"> Not Complete </button>
                                                    @else
                                                        <button class="btn btn-success text-center"> Completed </button>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <hr/>
                                </div>
                            </div>
                        </div>
                    </div>

                     <!-- confirm reject of accept order-->
                     <div class="modal fade text-left d-print-none" id="acceptReject{{$key}}" tabindex="-1" role="dialog" aria-labelledby="acceptReject{{$key}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                <h5 class="modal-title text-white"><i class="fa fa-reply"></i> Confirm!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="m-2">
                                        <div>Select Action</div>
                                        <select class="form-control" id="rejectAccept{{$value->agent_orderID}}">
                                            <option value="1" selected>Accept Order</option>
                                            <option value="0">Reject Order</option>
                                        </select>
                                    </div>
                                    <div class="text-info text-center m-2 pt-2"> <h3>Are you sure you want to continue with this operation? </h3></div>
                                    <div class="p-1 m-1" id="feedBack{{$value->agent_orderID}}"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                                    <button type="button" class="btn btn-outline-success rejectAcceptBtn" id="{{$value->agent_orderID}}" title="Reply sender"><i class="fa fa-reply fa-x2"></i> Reply </button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            @endif

        <div class="row">
            <div align="right" class="col-xs-12 col-sm-12">
                <hr />
                @if(isset($listAgent))
                    Showing {{($listAgent->currentpage()-1)*$listAgent->perpage()+1}}
                    to {{$listAgent->currentpage()*$listAgent->perpage()}}
                    of  {{$listAgent->total()}} entries
                    <div class="hidden-print pull-left">{{ $listAgent->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-bag fa-x3"></i></span>
                <p class="cart_empty">You currently have no order submitted to you!</p>
            </div>
        </div>
    </div>

@endif

