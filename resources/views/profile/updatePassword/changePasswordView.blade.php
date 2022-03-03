
@if(isset($showPageUpdateAccount) && ($showPageUpdateAccount ==1) && (isset($updateAccount) && $updateAccount))

    <!--includeIf('share.product.productGridShareView', ['showAddToCart' => (isset($showAddToCart) ? $showAddToCart : 0), 'showRestore'=> (isset($showRestore) ? $showRestore : 0), 'showEditDelete'=> (isset($showEditDelete) ? $showEditDelete : 1)])-->
    <div class="container my-4">
        <div class="text-danger text-right">All fields with asterisk (<span class="text-danger"><b>*</b></span>) are to be filled.</div>

        <form class="text-left formFormatAmount" method="POST" action="{{  (Route::has('saveUpdateAccountAuth') ? Route('saveUpdateAccountAuth') : '#') }}" enctype="multipart/form-data">
        @csrf
            <!--Register for Store Details-->
            <section id="register-form">
                <div class="row">
                  <div class="col-md-12 mb-4 offset-md-0">
                    <section class="pr-1">
                      <div class="card">
                        <h5 class="card-header bg-light dark-text text-center py-4">
                          <strong>Please Enter Your Details</strong>
                        </h5>
                        <div class="card-body px-lg-5 pt-0 mt-2">

                            <div class="form-row row">
                              <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <label for="email"> Email Address <span class="text-danger"><b>*</b></span> </label>
                                    <div class="md-form input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text md-addon"> <i class="fa fa-envelope"></i></span>
                                        </div>
                                        <div class="form-control">{{ (isset($updateAccount) && $updateAccount ? $updateAccount->email : '') }}</div>
                                    </div>
                                    @error('email')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <label for="currentPassword"> Current Password <span class="text-danger"><b>*</b></span> </label>
                                    <div class="md-form input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text md-addon"> <i class="fa fa-user"></i> </span>
                                        </div>
                                        <input type="password" name="currentPassword" required class="form-control">
                                    </div>
                                    @error('currentPassword')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              </div>
                            </div>

                            <div class="form-row row">
                                <div class="col-md-6 mt-3">
                                  <div class="md-form">
                                      <label for="password"> New Password <span class="text-danger"><b>*</b></span> </label>
                                      <div class="md-form input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text md-addon"> <i class="fa fa-key"></i></span>
                                          </div>
                                          <input type="password" name="password" required class="form-control">
                                      </div>
                                      @error('password')
                                          <span class="text-danger text-left" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                  <div class="md-form">
                                      <label for="password_confirmation"> Confirm New Password <span class="text-danger"><b>*</b></span> </label>
                                      <div class="md-form input-group mb-3">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text md-addon"> <i class="fa fa-key"></i> </span>
                                          </div>
                                          <input type="password" name="password_confirmation" required class="form-control">
                                      </div>
                                      @error('password_confirmation')
                                          <span class="text-danger text-left" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12 mt-3 mb-3">
                                    <button  type="button" class="btn btn-outline-success btn-block text-uppercase" data-toggle="modal" data-backdrop="false" data-target="#confirmToUpdateModal"><strong>Update Now</strong></button>
                                </div>
                            </div>

                        </div>
                      </div>
                    </section>
                  </div>
                </div>
            </section>



        <!-- confirm to send message modal-->
        <div class="modal fade text-left d-print-none" id="confirmToUpdateModal" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white"><i class="fa fa-save"></i> Confirm!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-warning text-center"> <h3>Are you sure you want to continue with this update? </h3></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal"> Cancel </button>
                        <button type="submit" class="btn btn-outline-success" title="Send Message"><i class="fa fa-save fa-x2"></i> Update </button>
                    </div>
                </div>
            </div>
        </div>
        <!--endconfirm  Modal-->

            </form>
        </div>
    </div>
@else

    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="fa fa-key fa-x3"></i></span>
                <p class="cart_empty">You cannot update your account now!</p>
            </div>
        </div>
    </div>

@endif

