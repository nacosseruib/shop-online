
@if(isset($showAgentRegistrationPage) && $showAgentRegistrationPage == 1)

    <form class="text-left" method="POST" action="{{  (Route::has('storeAgentRegistration') ? Route('storeAgentRegistration') : '#') }}" enctype="multipart/form-data" style="color: #757575;">
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

                        <div class="card-body px-lg-5 pt-0">
                            <!-- E-mail and Username -->
                            <div class="form-row row">
                                <div class="col-md-12 mt-3">
                                    <div class="md-form">
                                        <label for="agentName" class="active">Agent Name (Full name on your ID card)<span class="text-danger"><b>*</b></span></label>
                                        <input type="text" required name="agentName" value="{{ isset($agentDetails) ? $agentDetails->agent_fullname : old('agentName') }}" class="form-control">
                                        @error('agentName')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="md-form">
                                        <label for="email">Email Address <span class="text-danger"><b>*</b></span> </label>
                                        <input type="email" required name="email" value="{{ isset($agentDetails) ? $agentDetails->email : old('email') }}" class="form-control">
                                        @error('email')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="md-form">
                                        <label for="phoneNumber">Phone Number <span class="text-danger"><b>*</b></span> </label>
                                        <input type="text" required name="phoneNumber" value="{{ isset($agentDetails) ? $agentDetails->phone_number : old('phoneNumber') }}" class="form-control">
                                        @error('phoneNumber')
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
                                        <label for="contactAddress" class="active">Contact/Physical Address (your current province, city & Country)<span class="text-danger"><b>*</b></span> </label>
                                        <textarea name="contactAddress" rows="4" required class="form-control">{{ isset($agentDetails) ? $agentDetails->address : old('contactAddress') }}</textarea>
                                        @error('contactAddress')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="md-form">
                                        <label for="gender">Gender <span class="text-danger"><b>*</b></span> </label>
                                        <select name="gender" required class="form-control">
                                            <option value="">Select</option>
                                            <option value="Male" {{ isset($agentDetails) && $agentDetails->gender == 'Male' ? 'selected' : old('gender') }}>Male</option>
                                            <option value="Female" {{ isset($agentDetails) && $agentDetails->gender == 'Female' ? 'selected' : old('gender') }}>Female</option>
                                        </select>
                                        @error('gender')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row row mt-4">
                                <div class="form-group col-sm-6">
                                    <div class="text-left">Select Passport Images <span class="text-danger"><b>*</b></span> Dimension: (300 X 300)Pixel </div>
                                    <div>
                                        <input type="file" {{ (isset($agentDetails) && $agentDetails ? '' : 'required') }} name="passport" data-parsley-type="file"  class="form-control"/>
                                        <br />

                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <div class="text-left">Upload Your Any National ID card<span class="text-danger"><b>*</b></span> Dimension: (400 X 300)Pixel </div>
                                    <div>
                                        <input type="file" multiple  {{ (isset($agentDetails) && $agentDetails ? '' : 'required') }} name="nationalIDCard[]" data-parsley-type="file"  class="form-control"/>
                                        You can attach Multiple files
                                        <br />

                                    </div>
                                </div>
                            </div>
                            <div class="form-row row mt-4">
                                <div class="col-md-12">
                                    <div class="md-form">
                                        <label for="deliveryChargesPlan" class="active">Delivery Charges Plan <span class="text-danger"><b>*</b></span> <br /> (Give details what kind of products/items you can deliver and how much [in your local currency] you will charge for delivery for different locations.) </label>
                                        <textarea class="summernoteLong form-control p-2" id="getEditor" name="deliveryChargesPlan">{{ ((isset($agentDetails) && $agentDetails) ? $agentDetails->delivery_charge_plan : old('deliveryChargesPlan')) }}</textarea>
                                        @error('deliveryChargesPlan')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @if(isset($agentDetails) && $agentDetails)
                                <div class="col-md-6 mt-4">
                                    <div class="md-form">
                                        <label for="status">I want to suspend my agent profile account for now </label>
                                        <select name="status" required class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" {{ isset($agentDetails) && $agentDetails->status == 1 ? 'selected' : old('status') }}>Active</option>
                                            <option value="0" {{ isset($agentDetails) && $agentDetails->status == 0 ? 'selected' : old('status') }}>Suspend</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger text-left" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            </div>

                            <br />

                            <div class="form-row row mt-4">
                                @if(isset($agentDetails) && $agentDetails)
                                    <div class="col-md-6">
                                        <a class="btn btn-orange my-4 btn-block waves-effect waves-light text-uppercase" href="{{ (Route::has('cancelAgentProfileEdit') ? Route('cancelAgentProfileEdit') : 'javascript:;') }}"><strong>Cancel  Edit</strong></a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success my-4 btn-block waves-effect waves-light text-uppercase" type="button" data-toggle="modal" data-backdrop="false" data-target="#confirmToSubmitModal">Update</button>
                                    </div>
                                @else
                                    <div class="col-md-12 ">
                                        <button class="btn btn-orange my-4 btn-block waves-effect waves-light text-uppercase" type="button" data-toggle="modal" data-backdrop="false" data-target="#confirmToSubmitModal">Submit</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    </section>
                </div>
                </div>
            </section>

                <!-- Confirm to submit Modal -->
                <div class="modal fade text-left d-print-none" id="confirmToSubmitModal" tabindex="-1" role="dialog" aria-labelledby="uploadProduct" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="confirmToSubmitModal"><i class="fa fa-save"></i> Submit! </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">

                            <p>
                                <div class="text-success text-center h4"> Are you sure you want to continue with this operation? </div>
                            </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"> Cancel </button>
                                @if(isset($agentDetails) && $agentDetails)
                                    <input type="hidden" name="agentIDToEdit" value="{{ ((isset($agentDetails) && $agentDetails) ? $agentDetails->agentID : '') }}" />
                                    <button type="submit" class="btn btn-outline-success">Update Record</button>
                                @else
                                <input type="hidden" value="" name="agentIDToEdit" />
                                    <button type="submit" class="btn btn-outline-success">Submit</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--end Modal-->

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
