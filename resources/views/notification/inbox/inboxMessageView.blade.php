@if(isset($showPageInbox) && ($showPageInbox ==1) && (isset($getMessage) && $getMessage))

    <div class="bg-white p-3 h5">

        <table class="table table-hover table-striped table-responsive">
            <tr><td class="bg-white">

                @if(isset($getMessage) && $getMessage)
                        @php $getFullName = null; @endphp
                    @foreach($getMessage as $key => $value)
                        @php
                            $getFullName = (($value->first_name <> null && $value->last_name <> null) ? $value->first_name .' '. $value->last_name : 'Administrator');
                        @endphp

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="review-block">
                                    <div class="row">
                                        <div class="col-sm-2" align="center">
                                            <img src="{{ isset($getPath) && $getPath[$key] ? $getPath[$key] : asset('assets/images/no-image.png') }}" class="img-rounded" width="60" alt=" ">
                                            <div class="review-block-name m-1">
                                                <a href="javascript:;" data-toggle="modal" data-backdrop="false" data-target="#replyMessage{{$key}}"><b>{{ $getFullName }}</b></a>
                                            </div>
                                            <div class="review-block-date">{{ date('F d, Y h:i:s a', strtotime($value->message_date))}}</div>
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="review-block-title mt-2 mb-2">
                                                <b>{{ substr(strip_tags($value->message), 0, 50) }}</b>
                                            </div>
                                            <div class="review-block-description {{$value->flag == 0 ? 'font-weight-bold' : ''}}">
                                                {{ substr(strip_tags($value->message), 0, 1000) }}...
                                            </div>
                                            <div align="right">
                                                <button class="flagMessage btn btn-{{($value->flag == 0 ? 'info' : 'default')}} text-center" id="{{$value->inboxID}}" data-toggle="modal" data-backdrop="false" data-target="#replyMessage{{$key}}"> Read </button>
                                                <button class="btn btn text-center" id="{{$value->inboxID}}" data-toggle="modal" data-backdrop="false" data-target="#deleteMessage{{$key}}"> Delete </button>
                                            </div>
                                        </div>
                                    </div>

                                    <hr/>
                                </div>
                            </div>
                        </div>

                        <!-- Reply message Modal-->
                        <form class="text-left" method="POST" action="{{ (Route::has('replyMessage') ? Route('replyMessage') : '#') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal fade text-left d-print-none" id="replyMessage{{$key}}" tabindex="-1" role="dialog" aria-labelledby="continue" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white"><i class="fa fa-reply"></i> Reply Message</h5>
                                    <button type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="h5 m-3">
                                                    <div class="mb-2 mt-1">From: {{ $getFullName }} </div>

                                                    <div class="mb-2 mt-1">Date Sent: {{ date('F d, Y h:i:s a', strtotime($value->message_date))}} </div>

                                                    <div class="mb-2 mt-1">
                                                        <div class="text-left">Message: </div>
                                                        <textarea class="summernoteLong form-control p-2" id="getEditor" name="getMessage">
                                                            Type here...
                                                            <br />
                                                            <br />
                                                            <br />
                                                            <hr />
                                                            <b>Original Message:</b><br />
                                                            {!! wordwrap(nl2br($value->message), 300, "<br />", TRUE) !!}
                                                        </textarea>
                                                    </div>
                                                    <input type="hidden" name="messageID" value="{{ $value->inboxID }}" />
                                                    <div class="text-center" id="replyMesssageFeedBack{{$value->inboxID}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                                        @if($value->can_reply)
                                            <button type="button" class="btn btn-outline-info"  title="Send Message" data-toggle="modal" data-backdrop="false" data-target="#confirmSendingMessage{{$key}}"><i class="fa fa-reply fa-x2"></i> Send </button>
                                        @else
                                            <div class="btn btn-outline-info"  title="You can't reply to this message"><i class="fa fa-exclamation-triangle fa-x2"></i> You can't Reply </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <!-- confirm to send message modal-->
                        <div class="modal fade text-left d-print-none" id="confirmSendingMessage{{$key}}" tabindex="-1" role="dialog" aria-labelledby="confirmSendingMessage" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                    <h5 class="modal-title text-white"><i class="fa fa-send"></i> Confirm!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-info text-center"> <h3>Are you sure you want to send this message? </h3></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                                        <button type="submit" class="btn btn-outline-success" title="Send Message"><i class="fa fa-save fa-x2"></i> Send </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <!--end send comment reply Modal-->


                        <!-- confirm to delete message modal-->
                        <div class="modal fade text-left d-print-none" id="deleteMessage{{$key}}" tabindex="-1" role="dialog" aria-labelledby="deleteMessage" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                    <h5 class="modal-title text-white"><i class="fa fa-trash"></i> Delete!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-2 mt-1">From: {{ $getFullName }}</div>

                                        <div class="mb-2 mt-1">Date Sent: {{ date('F d, Y h:i:s a', strtotime($value->message_date))}} </div>
                                        <hr />
                                        <div class="text-danger text-center"> <h3>Are you sure you want to delete this message? </h3></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                                        <a href="{{ (Route::has('deleteMessage') ? Route('deleteMessage', ['mi' => $value->inboxID]) : '#') }}" class="btn btn-outline-danger" title="Delete Message"><i class="fa fa-trash fa-x2"></i> Delete </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--delete  Modal-->



                    @endforeach
                @endif

                </td>
            </tr>
        </table>
        <div class="row">
            <div align="right" class="col-xs-12 col-sm-12">
                <hr />
                @if(isset($getMessage))
                    Showing {{($getMessage->currentpage()-1)*$getMessage->perpage()+1}}
                    to {{$getMessage->currentpage()*$getMessage->perpage()}}
                    of  {{$getMessage->total()}} entries
                    <div class="hidden-print pull-left">{{ $getMessage->links() }}</div>
                @endif
            </div>
        </div>
    </div>

@else
    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-envelope fa-x3"></i></span>
                <p class="cart_empty">Your Inbox is currently empty.</p>
            </div>
        </div>
    </div>

@endif

