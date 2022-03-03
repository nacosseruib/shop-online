
@if(isset($showPage) && $showPage == 1)

    <form class="text-left" method="POST" action="{{  (Route::has('processItemDelivery') ? Route('processItemDelivery') : '#') }}" enctype="multipart/form-data" style="color: #757575;">
    @csrf

    <div id="ProductSection-product-template" class="product-template__containe product mb-5 mt-3">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12  horizontal mt-3">

            <!--Account Details-->
            <section id="register-form">
                <div>
                <div>
                    <section class="pr-1">
                    <div class="card">
                        <h5 class="card-header bg-light dark-text text-center py-4">
                        <strong>Confirm You Have Delivered Your Item(s)</strong>
                        </h5>
                        <div class="card-body px-lg-5 pt-0">
                            <!-- E-mail and Username -->
                            <div class="form-row row">
                                <div class="col-md-6 mt-3">
                                    <div class="md-form">
                                        <label for="orderNumber" class="active">Item Order Number <span class="text-danger"><b>*</b></span></label>
                                        <input type="text" autocomplete="off" required name="orderNumber" value="{{ isset($orderNumber) ? $orderNumber : old('orderNumber') }}" class="form-control">
                                        @error('orderNumber')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="md-form">
                                        <label for="deliveryCode">Item Delivery Code <span class="text-danger"><b>*</b></span> </label>
                                        <input type="text" autocomplete="off" required name="deliveryCode" value="{{ old('deliveryCode') }}" class="form-control">
                                        @error('deliveryCode')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row row mt-4">
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <label for="yourExperience" class="active">Tell us your experience (or rate us) about our service <span class="text-danger"><b>*</b></span> (500 Chars.) </label>
                                        <textarea name="yourExperience" rows="4" required class="form-control">{{ old('yourExperience') }}</textarea>
                                        @error('yourExperience')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <label for="buyFromStoreAssignedToYou">Bought From Store? <span class="text-danger"><b>*</b></span> </label>
                                        <select name="buyFromStoreAssignedToYou" required class="form-control">
                                            <option value="1" selected>Yes. I bought from the store system asigned to me</option>
                                            <option value="0">No. I bought from another store due to some reasons</option>
                                        </select>
                                        @error('buyFromStoreAssignedToYou')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <br />

                            <!-- Terms of service -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" required disabled class="custom-control-input" id="defaultChecked2" checked>
                                        <label class="custom-control-label" for="defaultChecked2">
                                            I have delivered all the items i ought to have delivered for this order number.
                                        </label>
                                    </div>
                                </div>
                            </div>

                        <!-- Sign up button -->
                            <button class="btn btn-orange my-4 btn-block waves-effect waves-light text-uppercase" type="submit">Confirm Now</button>

                        </div>
                    </div>
                    </section>
                </div>
                </div>
            </section>

        </div>
      </div>
    </div>
    </form>

@else
    <div id="shopify-section-cart-template" class="shopify-section">
        <div class="container page-cart" data-section-id="cart-template" data-section-type="cart-template">
            <div class="empty-page-content text-center">
                <span class="ico_empty"><i class="material-icons">shopping_basket</i></span>
                <p class="cart_empty">You are not allow to view this page!!!</p>
            </div>
        </div>
    </div>
@endif
