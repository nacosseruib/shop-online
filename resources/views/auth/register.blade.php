@extends('layouts.site')
@section("pageTitle", "Create new account")
@section("signUpPageActive", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showAlert              = 1;
@endphp
@section('pageContent')

<div class="container my-4">
    <!-- Form -->
    <form class="text-left" method="POST" action="{{  (Route::has('register') ? Route('register') : '#') }}" style="color: #757575;">
    @csrf
        <!--About Me-->
        <section id="register-form">
            <div class="row">
              <div class="col-md-8 mb-4 offset-md-2">
                <section class="pr-1">
                  <div class="card">
                    <h5 class="card-header bg-light dark-text text-center py-4">
                      <strong>About Me</strong>
                      <div class="text-danger text-right h6">
                        All fields with asterisk (<span class="text-danger"><b>*</b></span>) are to be filled.
                    </div>
                    </h5>
                    <div class="card-body px-lg-5 pt-0">
                        <!--First and last name-->
                        <div class="form-row row">
                          <div class="col-md-6 mt-3">
                            <div class="md-form">
                                <label for="firstName">First name <span class="text-danger"><b>*</b></span> </label>
                                <input type="text" name="firstName" required value="{{ old('firstName') }}" class="form-control">
                                @error('firstName')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                          <div class="col-md-6 mt-3">
                            <div class="md-form">
                             <label for="lastName">Last name <span class="text-danger"><b>*</b></span></label>
                              <input type="text" name="lastName" required value="{{ old('lastName') }}" class="form-control">
                                @error('lastName')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                        </div>
                        <!--Gender and Phone Number-->
                        <div class="form-row row">
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                 <label for="zipCode">Zip Code <span class="text-danger"><b>*</b></span> <span class="text-info" title="You don't know your zip code! search your zip code on google search engine."><b> ? </b></span> </label>
                                  <input type="number" name="zipCode" required value="{{ old('zipCode') }}" class="form-control">
                                    @error('zipCode')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <label for="phoneNumber"> Country <span class="text-danger"><b>*</b></span></label>
                                    <div class="niceCountryInputSelector form-control" data-selectedcountry="US" data-showspecial="false" data-showflags="true" data-i18nall="All selected"
                                        data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback" />
                                    </div>
                                    @error('country')
                                      <span class="text-danger text-left" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!--Currency and Zip code-->
                        <div class="form-row row">
                            <div class="col-md-4 mt-3">
                                <div class="md-form">
                                  <label for="phoneNumber">Phone Number <span class="text-danger"><b>*</b></span></label>
                                  <input type="number" name="phoneNumber" required value="{{ old('phoneNumber') }}" class="form-control">
                                  @error('phoneNumber')
                                      <span class="text-danger text-left" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                              <div class="text-left">
                                <label for="currency">Select Currency <span class="text-danger"><b>*</b></span></label>
                                <select name="currency" required class="form-control">
                                    <option value="" selected>Select Currency </option>
                                    @if(isset($allCurrency) && ($allCurrency))
                                        @foreach ($allCurrency as $item)
                                                <option value="{{ $item->currencyID }}" {{ (old('currency') == $item->currencyID ? 'selected' : '') }}>{{ $item->currency_name . ' (' . $item->currency_symbol .')' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('currency')
                                    <span class="text-danger text-left" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="text-left">
                                  <label for="gender">Select Gender <span class="text-danger"><b>*</b></span></label>
                                  <select name="gender" required class="form-control">
                                      <option value="" selected>Select Gender</option>
                                      <option value="Male" {{ (old('gender') == 'Male' ? 'selected' : '') }}>Male</option>
                                      <option value="Female" {{ (old('gender') == 'Female' ? 'selected' : '') }}>Female</option>
                                  </select>
                                    @error('gender')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!--own a store or not-->
                        <div class="form-row row">
                            <div class="col-md-6 mt-3">
                                <div class="text-left">
                                    <label for="whatDoYouLikeToDo">What do you like to do? <span class="text-danger"><b>*</b></span></label>
                                    <select name="whatDoYouLikeToDo" required class="form-control">
                                        <option value="" selected>Select </option>
                                        @if(isset($userType) && ($userType))
                                            @foreach ($userType as $item)
                                                <option value="{{ $item->user_typeID }}" {{ (old('whatDoYouLikeToDo') == $item->user_typeID ? 'selected' : '') }}>{{ $item->type_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('whatDoYouLikeToDo')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="text-left">
                                    <label for="howDidYouKnowUs">How did you know about us? <span class="text-danger"><b>*</b></span></label>
                                    <select name="howDidYouKnowUs" required class="form-control">
                                        <option value="" selected>Select </option>
                                        @if(isset($hearAboutUs) && ($hearAboutUs))
                                            @foreach ($hearAboutUs as $item)
                                                <option value="{{ $item->hear_aboutID }}" {{ (old('howDidYouKnowUs') == $item->hear_aboutID ? 'selected' : '') }}>{{ $item->how_hear_us }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('howDidYouKnowUs')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                    </div>
                  </div>
                </section>
              </div>
            </div>
          </section>

        <!--Account Details-->
        <section id="register-form">
            <div class="row">
              <div class="col-md-8 mb-4 offset-md-2">
                <section class="pr-1">
                  <div class="card">
                    <h5 class="card-header bg-light dark-text text-center py-4">
                      <strong>Login Details</strong>
                    </h5>
                    <div class="card-body px-lg-5 pt-0">
                         <!-- E-mail and Username -->
                        <div class="form-row row">
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <label for="email" class="active">E-mail <span class="text-danger"><b>*</b></span></label>
                                    <input type="email" required name="email" value="{{ old('email') }}" class="form-control">
                                    @error('email')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <label for="username">Username <span class="text-danger"><b>*</b></span> (Min. 6 chars) </label>
                                    <input type="text" required name="username" value="{{ old('username') }}" class="form-control">
                                    @error('username')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                         <!--password and confirm password -->
                         <div class="form-row row">
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <label for="password" class="active">Password <span class="text-danger"><b>*</b></span> (Min. 8 chars) </label>
                                    <input type="password" required name="password" class="form-control">
                                    @error('password')
                                        <span class="text-danger text-left" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="md-form">
                                    <label for="password_confirmation">Confirm Password <span class="text-danger"><b>*</b></span> (Min. 8 chars) </label>
                                    <input type="password" required name="password_confirmation" class="form-control">
                                    @error('password_confirmation')
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
                                        By clicking <em>Sign up</em> you agree to our <a href="javascript:;" class="text-info">terms of service</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                       <!-- Sign up button -->
                        <button class="btn btn-orange my-4 btn-block waves-effect waves-light text-uppercase" type="submit">Create Account</button>

                    </div>
                  </div>
                </section>
              </div>
            </div>
          </section>

    </form> <!--// Form -->

  </div>
  @endsection

@section('style')
    <script src="{{ asset('assets/select-country/niceCountryInput.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/select-country/niceCountryInput.css')}}">
@endsection

@section('script')
    <script>
        function onChangeCallback(ctr){
            console.log("The country was changed: " + ctr);
            //$("#selectionSpan").text(ctr);
        }
        $(document).ready(function () {
            $(".niceCountryInputSelector").each(function(i,e){
                new NiceCountryInput(e).init();
            });
        });
    </script>
@endsection
