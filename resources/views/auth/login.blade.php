@extends('layouts.site')
@section("pageTitle", "Login Now")
@section("loginPageActive", "active")
@php
    $showWelcomePopupModal  = (isset($showWelcomePopupModal) ? $showWelcomePopupModal : 0);
    $showHeaderNav          = (isset($showHeaderNav) ? $showHeaderNav : 1);
@endphp
@section('pageContent')

<div class="container">
    <div class="wraper-inner sn">
      <div class="row">
        <div class="col-12 col-sm-6">
          <div class="formaccount formlogin">
            <div id="login">
              <h1 class="page-title">Login</h1>
              <form method="post" action="{{ (Route::has('login') ? Route('login') : '#') }}" id="customer_login" accept-charset="UTF-8"><input type="hidden" name="form_type" value="customer_login" /><input type="hidden" name="utf8" value="✓" />
                @csrf

              <div class="form-group">
                <label for="email">Username/Email Address<sup class="text-danger">*</sup></label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>


              <div class="form-group">
                <label for="password">Password <sup class="text-danger">*</sup></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="row">
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-outline-default btn-block text-uppercase">
                      <strong><i class="fa fa-sign-out" aria-hidden="true"></i>Login</strong>
                    </button>
                </div>
              </div>
              <br>

              <p class="btn-top"><a href="#" onclick="showRecoverPasswordForm();return false;" class="link-color">Forgot your password?</a></p>

              </form>

            </div>

            <div id="recover-password" style="display:none;" class="wrap">

              <div class="block">
                <h1 class="page-title">Reset your password</h3>
                <p>We will send you an email to reset your password.</p>
              </div>

              <div class="form-vertical">
                <form method="post" action="#" accept-charset="UTF-8"><input type="hidden" name="form_type" value="recover_customer_password" /><input type="hidden" name="utf8" value="✓" />

                <div class="form-group">
                  <label for="RecoverEmail">Email</label>
                <input type="email" value="" name="email" id="RecoverEmail" class="form-control" autocorrect="off" autocapitalize="off">
                </div>
                <div class="submit">
                  <p>
                    <input type="submit" class="btn btn-default" value="Submit">
                  </p>
                </div>
                or
                <a class="" href="#" onclick="hideRecoverPasswordForm();return false;">Cancel</a>
                </form>
              </div>

            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6">
          <div class="formaccount formlogin block">
            <h1 class="page-title">Create Account</h1>
            <div class="formcontent">
              <div class="registerdescription">
                <p>Start and create your free account. Registration is quick and easy. It allows you to be able to order from our shops.</p>
              </div>
              <div class="submit">
                <a class="btn btn-outline-default btn-block text-uppercase" href="{{ (Route::has('register') ? Route('register') : '#') }}">
                    <strong><i class="fa fa-user-plus" aria-hidden="true"></i><span>Create An Account</span></strong>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br />

  @endsection
