@if(isset($showPageAgent) && ($showPageAgent ==1) && (isset($listAgent) && $listAgent))

                @if(isset($listAgent) && $listAgent)
                    @foreach($listAgent as $key => $value)

                    <div class="bg-white p-3 h5">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="review-block">
                                    <div class="row">
                                        <div class="col-sm-2" align="center">
                                            <img src="{{ (isset($agentPath) ? $agentPath[$key] : '') }}" class="img-responsive" alt="{{ $value->agent_fullname }}" style="width: 80%;" alt=" "/>
                                        </div>

                                        <div class="col-sm-10">
                                            <div class="review-block-title mt-2 mb-2 h4 text-left">
                                                <a href="javascript:;" data-toggle="modal" data-backdrop="false" data-target="#hireAgentModal{{$value->agentID}}">
                                                    <b><b>{{ $value->agent_fullname }}</b></b>
                                                </a>
                                                <span class="pull-right"> {{ $value->gender }}</span>
                                            </div>
                                            <div class="review-block-description font-weight-bold text-left">
                                                <div>{{ $value->store_city .' | '. $value->store_state .' | '. $value->store_country }}</div>
                                            </div>
                                            <div class="review-block-description font-weight-bold text-left">
                                                <div class="text-center">
                                                    Rating:
                                                    <span class="fa fa-star checked"></span>{{-- checked --}}
                                                    <span class="fa fa-star"></span>{{-- checked --}}
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>

                                                    @if(Auth::check() && (Auth::user()->id <> $value->userID))
                                                        <button class="btn btn-warning my-4 waves-effect waves-light text-uppercase pull-right" type="button" data-toggle="modal" data-backdrop="false" data-target="#hireAgentModal{{$value->agentID}}">Hire</button>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                    </div>

                        <!-- view agent details Modal -->
                        <div class="modal fade text-left d-print-none" id="hireAgentModal{{$value->agentID}}" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title" id="hireAgentModal{{$value->agentID}}"><i class="fa fa-shopping-bag"></i> Hire Agent</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="bg-light text-info text-center p-2 mb-1 h5">
                                            <b>AGENT DETAILS</b>
                                            <br />
                                            Please do contact and follow up with this agent for your delivery.
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4" align="center">
                                                <div class="col-md-12">
                                                    <img src="{{ (isset($agentPath) ? $agentPath[$key] : '') }}" class="img-responsive" alt="{{ $value->agent_fullname }}" style="width: 90%;" />
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <hr />
                                                    <h4 class="mb-1">Rating</h4>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>

                                                    {{-- <br /><br />
                                                    <div>
                                                        <a href="{{ Route::has('rateAgent') ? Route('rateAgent',['auid'=>$value->userID]) : 'javascript:;' }}" class="btn btn-outline-success">Rate me now</a>
                                                    </div> --}}

                                                    <hr />
                                                   {{--  <div class="d-flex justify-content-center">
                                                        <div class="mt-1">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div align="center" class="card-body text-center justify-content-center"> <span class="myratings-OLD">0</span>
                                                                        <h4 class="mt-1">Rating </h4>
                                                                        <fieldset class="rating">
                                                                            <input type="radio" id="star5" name="rating" value="5" />
                                                                            <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                                                            <input type="radio" id="star4half" name="rating" value="4.5" />
                                                                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

                                                                            <input type="radio" id="star4" name="rating" value="4" />
                                                                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                                                            <input type="radio" id="star3half" name="rating" value="3.5" />
                                                                            <label class="half" for="star3half" title="Very good - 3.5 stars"></label>

                                                                            <input type="radio" id="star3" name="rating" value="3" />
                                                                            <label class="full" for="star3" title="Very good - 3 stars"></label>

                                                                            <input type="radio" id="star2half" name="rating" value="2.5" />
                                                                            <label class="half" for="star2half" title="Good - 2.5 stars"></label>

                                                                            <input type="radio" id="star2" name="rating" value="2" />
                                                                            <label class="full" for="star2" title="Good - 2 stars"></label>

                                                                            <input type="radio" id="star1half" name="rating" value="1.5" />
                                                                            <label class="half" for="star1half" title="Kind of good - 1.5 stars"></label>

                                                                            <input type="radio" id="star1" name="rating" value="1" />
                                                                            <label class="full" for="star1" title="Fair - 1 star"></label>

                                                                            <input type="radio" id="starhalf" name="rating" value="0.5" />
                                                                            <label class="half" for="starhalf" title="Not too good - 0.5 stars"></label>
                                                                            <input type="radio" class="reset-option" name="rating" value="reset" />
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row p-1">
                                                    <div class="col-sm-3 text-left">
                                                        <b>NAME:</b>
                                                    </div>
                                                    <div class="col-sm-9 text-left">
                                                        {{ $value->agent_fullname }}
                                                    </div>
                                                </div>

                                                <div class="row p-1">
                                                    <div class="col-sm-3 text-left">
                                                        <b>LOCATION:</b>
                                                    </div>
                                                    <div class="col-sm-9 text-left">
                                                        {{ $value->store_city .' | '. $value->store_state .' | '. $value->store_country }}
                                                    </div>
                                                </div>

                                                <div class="row p-1">
                                                    <div class="col-sm-3 text-left">
                                                        <b>GENDER:</b>
                                                    </div>
                                                    <div class="col-sm-9 text-left">
                                                        {{ $value->gender }}
                                                    </div>
                                                </div>

                                                <div class="row p-1">
                                                    <div class="col-sm-3 text-left">
                                                        <b>PHONE NO.:</b>
                                                    </div>
                                                    <div class="col-sm-9 text-left">
                                                        {{ $value->phone_number }}
                                                    </div>
                                                </div>

                                                <div class="row p-1">
                                                    <div class="col-sm-3 text-left">
                                                        <b>EMAIL:</b>
                                                    </div>
                                                    <div class="col-sm-9 text-left">
                                                        {{ $value->email }}
                                                    </div>
                                                </div>

                                                {{-- <div class="row p-1">
                                                    <div class="col-sm-3 text-left">
                                                        <b>ADDRESS:</b>
                                                    </div>
                                                    <div class="col-sm-9 text-left">
                                                        {{ $value->address }}
                                                    </div>
                                                </div> --}}

                                                <div class="row p-1">
                                                    <div class="col-sm-12 text-left">
                                                        <b>DELIVERY CHARGES:</b>
                                                    </div>
                                                    <div class="col-sm-12 text-left" style="word-break: break-all;">
                                                        {!! wordwrap(nl2br($value->delivery_charge_plan), 200, "<br />", TRUE) !!}
                                                    </div>
                                                </div>

                                                <hr />

                                                <div class="row m-2">
                                                    <div class="col-sm-5 text-left p-2 h4">
                                                        <b>Enter Your Delivery Order Number:</b>
                                                    </div>
                                                    <div align="left" class="col-sm-7 p-1">
                                                        <input type="text" required class="form-control h-100" autocomplete="off" id="deliveryOrderNumber{{$value->userID}}" style="font-size: 23px; font-weight:bold;" >
                                                    </div>

                                                    <div class="col-sm-5 text-left p-2 h4">
                                                        <b>Enter Additional message (Optional)</b>
                                                    </div>
                                                    <div align="left" class="col-sm-7 p-1">
                                                        <textarea class="form-control" id="message{{$value->userID}}" style="font-size: 15px; font-weight:bold;" ></textarea>
                                                    </div>

                                                    <div class="col-sm-12 text-center p-1">
                                                        <hr />
                                                        <div class="text-center h4" id="feedBack{{$value->userID}}"></div>
                                                        <br />
                                                        <button type="submit" id="{{$value->userID}}" class="btn btn-outline-success hireAgent">Send Order Number</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> Close </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end Modal-->


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
                <span class="ico_empty"><i class="fa fa-users fa-x3"></i></span>
                <p class="cart_empty">No Agent is available currently!</p>
            </div>
        </div>
    </div>

@endif

