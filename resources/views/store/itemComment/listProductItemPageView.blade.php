
@if(isset($showPageComment) && ($showPageComment ==1) && (isset($getProduct) && $getProduct ))

    <!--includeIf('share.product.productGridShareView', ['showAddToCart' => (isset($showAddToCart) ? $showAddToCart : 0), 'showRestore'=> (isset($showRestore) ? $showRestore : 0), 'showEditDelete'=> (isset($showEditDelete) ? $showEditDelete : 1)])-->
    <div class="bg-white p-3 h5">
        <table class="table table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>COMMENT</th>
                    <th>PRODUCT NAME</th>
                    <th>PRICE</th>
                    <th>OLD PRICE</th>
                    <th>STATUS</th>
                    <th>LAST UPDATED</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($getProduct) && $getProduct)
                    @foreach($getProduct as $key => $value)
                        <tr>
                            <td>{{ ($getProduct->currentpage()-1) * $getProduct->perpage() + (1+$key) }}</td>
                            <td>
                                @if(isset($getComment) && count($getComment[$key]) > 0)
                                    <a href="#" class="btn btn-default text-center" data-toggle="modal" data-backdrop="false" data-target="#viewComment{{$key}}"> <b>{{ (isset($getComment) ? count($getComment[$key]) : 0) }}</b> Comment <br /> View</a>
                                @else
                                    <span class="text-info">No Comment </span>
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img class="product-featured-img" style="width: 50px; height: 50px;" src="{{ (isset($productCoverImage) && isset($productUserPath) ? $productUserPath . $productPath300x300 . $productCoverImage[$key] : '') }}" alt=" " />
                                    </div>
                                    <div class="col-md-9" align="left">
                                        <b>{{ $value->product_name }}</b>
                                    </div>
                                </div>
                            </td>
                            <td class="text-success"><span class=money>${{ number_format($value->original_price, 2) }}</span></td>
                            <td class="text-info"><span class=money>${{ number_format($value->old_price, 2) }}</span></td>
                            <td>{!! ($value->is_online ? 'Online' : 'Offline') !!}</td>
                            <td>{{ date('F d, Y H:i:sa', strtotime($value->updated_at))}}</td>
                        </tr>

                        <!-- View all comment per item Modal-->
                        <div class="modal fade text-left d-print-none" id="viewComment{{$key}}" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white"><i class="fa fa-comment"></i> Comment </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="text-left p-2">PRODUCT NAME: <b>{{ $value->product_name }}</b> </div>

                                                @if(isset($getComment) && count($getComment[$key]) > 0)
                                                    @foreach($getComment[$key] as $keyComment => $item)
                                                    <div style="border-bottom: #eeeeee solid 1px"></div>
                                                    <div class="row m-1 p-3">
                                                        <div class="col-md-12 p-2">
                                                            <div class="text-left"><i class="fa fa-comment-o"></i> {!! $item->comment !!} </div>
                                                        </div>
                                                        <div class="col-md-12 p-2 text-warning bg-light">
                                                            <span>{{ $item->name }}</span> |
                                                            <span>{{ date('d F, Y', strtotime($item->created_at)) }}</span> |
                                                            <span>{{ $item->email }}</span> |
                                                            <span>
                                                                <a href="javascript:;" class="btn btn-default btn-outline" data-toggle="modal" data-backdrop="false" data-target="#replyComment{{$key.$keyComment}}">Reply</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <!-- Reply comment Modal-->
                                                    <div class="modal fade text-left d-print-none modalComment{{$key.$keyComment}}" id="replyComment{{$key.$keyComment}}" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-info">
                                                                <h5 class="modal-title text-white"><i class="fa fa-reply"></i> Reply <span>{{ $item->name }}</span>'s Comment</h5>
                                                                <button type="button" class="close btnModalComment" id="{{$key.$keyComment}}" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="m-3">
                                                                                <div class="mb-2 mt-1">Message: {{ substr($item->comment, 0, 50) }}... </div>
                                                                                <textarea id="replyMessage{{$item->commentID}}" rows="4" class="form-control" placeholder="Enter your reply message"></textarea>
                                                                                <input type="hidden" id="receiverID{{$item->commentID}}" value="{{ $item->userID }}" />
                                                                                <div class="text-center" id="replyCommentFeedBack{{$item->commentID}}"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-default btnModalComment" id="{{$key.$keyComment}}"> Cancel </button> <!--data-dismiss="modal"-->
                                                                    <button type="button" class="btn btn-outline btn-success sendComment" id="{{$item->commentID}}" title="Send Message"><i class="fa fa-save fa-x2"></i> Send </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end send comment reply Modal-->

                                                    @endforeach
                                                @else
                                                    No Comment
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Close </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end view comment Modal-->

                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="row">
            <div align="right" class="col-xs-12 col-sm-12">
                <hr />
                @if(isset($getProduct))
                    Showing {{($getProduct->currentpage()-1)*$getProduct->perpage()+1}}
                    to {{$getProduct->currentpage()*$getProduct->perpage()}}
                    of  {{$getProduct->total()}} entries
                    <div class="hidden-print pull-left">{{ $getProduct->links() }}</div>
                @endif
            </div>
        </div>
    </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-shopping-cart fa-x3"></i></span>
                <p class="cart_empty">Your Store is currently empty.</p>
                <div class="cookie-message">
                    <p>Upload product to your store to attract customers</p>
                </div>
            </div>
        </div>
    </div>

@endif

