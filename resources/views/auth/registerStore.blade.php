@extends('layouts.site')
@section("pageTitle", "Create Your Store")
@section("signUpPageActive", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showAlert              = 1;
@endphp
@section('pageContent')

<div class="container my-4">
    <div class="text-danger text-right">All fields with asterisk (<span class="text-danger"><b>*</b></span>) are to be filled.</div>
    <!-- Form -->
    <form class="text-center" method="POST" action="{{  (Route::has('registerStore') ? Route('registerStore') : '#') }}" style="color: #757575;">
    @csrf

        <!--Register for Store Details-->
        <section id="register-form">
            <div class="row">
              <div class="col-md-8 mb-4 offset-md-2">
                <section class="pr-1">
                  <div class="card">
                    <h5 class="card-header bg-light dark-text text-center py-4">
                      <strong>Store Information</strong>
                    </h5>
                    <div class="card-body px-lg-5 pt-0">
                        <!--First and last name-->
                        <div class="form-row row">
                          <div class="col-md-6 mt-3">
                            <div class="md-form">
                              <div class="text-left">Store Name <span class="text-danger"><b>*</b></span> </div>
                              <input type="text" name="storeName" required value="{{ old('storeName') }}" class="form-control">
                              @error('storeName')
                              <span class="text-danger text-left" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                             @enderror
                            </div>
                          </div>
                          <div class="col-md-6 mt-3">
                            <div class="md-form">
                                <div class="text-left">Phone Number <span class="text-danger"><b>*</b></span></div>
                              <input type="number" name="storePhoneNumber" required value="{{ old('storePhoneNumber') }}" class="form-control">
                              @error('storePhoneNumber')
                              <span class="text-danger text-left" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                             @enderror
                            </div>
                          </div>
                        </div>
                        <!--Address-->
                        <div class="form-row row">
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                 <div class="text-left">Store Address 1 <span class="text-danger"><b>*</b></span></div>
                                  <input type="text" name="address1" required value="{{ old('address1') }}" class="form-control">
                                  @error('address1')
                                   <span class="text-danger text-left" role="alert">
                                      <strong>{{ $message }}</strong>
                                   </span>
                                  @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <div class="text-left">Store Address 2 </div>
                                    <input type="text" name="address2" value="{{ old('address2') }}" class="form-control">
                                    @error('address2')
                                     <span class="text-danger text-left" role="alert">
                                       <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--Gender and Phone Number-->
                        <div class="form-row row">
                            <div class="col-md-12 mt-3">
                                <div class="mt-3 text-left">Store Description <span class="text-danger"><b>*</b></span></div>
                                <div>
                                  <textarea name="storeDescription" required class="form-control">{{ old('storeDescription') }}</textarea>
                                  @error('storeDescription')
                                   <span class="text-danger text-left" role="alert">
                                    <strong>{{ $message }}</strong>
                                   </span>
                                  @enderror
                                </div>
                            </div>
                        </div>

                        <!--Country, State and City-->
                        <div class="form-row row">
                            <div class="col-md-12 mt-3">
                                <div class="text-left">Let us know where you are running your store.</div>
                            </div>
                            {{-- <div class="col-md-4 mt-3">
                              <div>
                                <select name="country"  value="{{ old('country') }}" class="form-control">
                                    <option value="" selected>Select Country  *</option>
                                </select>
                                @error('country')
                                 <span class="text-danger text-left" role="alert">
                                   <strong>{{ $message }}</strong>
                                 </span>
                                @enderror
                              </div>
                            </div> --}}
                            <div class="col-md-6 mt-3">
                                <div>
                                    <div class="text-left">State<span class="text-danger"><b>*</b></span></div>
                                    <input type="text" required name="state" value="{{ old('state') }}" class="form-control" >
                                    @error('state')
                                        <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div>
                                    <div class="text-left">City<span class="text-danger"><b>*</b></span></div>
                                    <input type="text" required name="city" value="{{ old('city') }}" class="form-control" >
                                    @error('city')
                                        <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Terms of service -->
                            <div class="row">
                                <div class="col-sm-12 mt-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" required disabled class="custom-control-input" id="defaultChecked2" checked>
                                        <label class="custom-control-label" for="defaultChecked2">
                                            By clicking <em>Create my store</em> you agree to our <a href="" target="_blank"> store terms of service</a>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3 mb-3">
                                <hr />
                                <!-- Sign up button -->
                                <button class="btn btn-orange my-4 btn-block waves-effect waves-light" type="submit">Create My Store</button>
                            </div>
                        </div>

                    </div>
                  </div>
                </section>
              </div>
            </div>
          </section>
    </form> <!--// Form -->

  </div>
  @endsection
