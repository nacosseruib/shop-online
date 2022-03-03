<header id="header" class="header header-style1 header-fixed d-print-none">
    <div class="header-top d-none d-lg-block d-print-none">
      <div class="container">
        <div class="row">
          <div class="header-top-left col-xl-8 col-lg-8 d-none d-lg-block">
            <div id="menu-menu-top-left">

                <div class="toplink-item language no__at">
                   {{--  <!-- language start --> --}}
                    <div class="language-theme ">
                        <button class="btn btn-primary dropdown-toggle" type="button">
                           <div id="google_translate_element"></div>
                        </button>

                    </div>
                    {{-- <!-- End language --> --}}
                </div>

                <div class="toplink-item checkout currency">
                {{-- <!--Start Currency --> --}}
                    <div class="currency-wrapper">
                        <label class="currency-picker__wrapper">
                            <select class="currency-picker" name="currencies" style="display: inline; width: auto; vertical-align: middle;">
                                <option value="USD" selected="selected">USD</option>
                                <option value="NGN">NGN</option>
                                <option value="EUR">EUR</option>
                                <option value="GBP">GBP</option>
                                <option value="CAD">CAD</option>
                                {{-- <option value="AUD">AUD</option> --}}

                            </select>
                            <i class="fa fa-angle-down"></i>
                        </label>
                        <div class="pull-right currency-Picker">
                            <a class="dropdown-toggle" href="javascript:;" title="USD">USD</a>
                            <ul class="drop-left dropdown-content">
                                <li><a href="javascript:;" title="USD" data-value="USD">USD</a></li>
                                <li><a href="javascript:;" title="NGN" data-value="NGN">NGN</a></li>
                                <li><a href="javascript:;" title="EUR" data-value="EUR">EUR</a></li>
                                <li><a href="javascript:;" title="GBP" data-value="GBP">GBP</a></li>
                                <li><a href="javascript:;" title="CAD" data-value="CAD">CAD</a></li>
                                {{-- <li><a href="javascript:;" title="AUD" data-value="AUD">AUD</a></li> --}}
                            </ul>
                        </div>
                    </div>
                  {{-- <!--End Currency --> --}}
                </div>
            </div>
            @if(Auth::check())
                <div class="pl-5 pr-5">
                    &nbsp; {{ (isset($userFullName)  ? $userFullName : null) }}
                    &nbsp; {{ (isset($userStoreName)  ? ' - ' .$userStoreName : null) }}
                    &nbsp;
                    @if(isset($checkAndGetUserTypeID) && ($checkAndGetUserTypeID))
                        <span title="Active" class="text-success">(Your store is Online)</span>
                    @else
                       {{--  <span title="Suspended" class="text-danger">(Your store is offline)</span> --}}
                    @endif
                </div>
            @endif
           </div>

            {{-- <!--Start My Account --> --}}
           <div class="header-top-right no__at col-xl-4 col-lg-4 col-sm-12 col-12">
                <ul class="toplinks-wrapper">
                    @if(Auth::check())
                        <li class="toplink-item account" id="my_account">
                            <a href="#" class="dropdown-toggle">
                                My Account<span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-content dropdown-menu sn">
                                @if(isset($checkAndGetUserTypeID) && $checkAndGetUserTypeID)
                                    <li>
                                        <a href="{{ Route::has('goTostoreHome') ? Route('goTostoreHome') :'#' }}" title="My Store"><i class="fa fa-shopping-cart"></i>My Store</a>
                                    </li>
                                @endif
                                <li><a href="{{ Route::has('myProfile') ? Route('myProfile') :'#' }}" title="My Profile"><i class="fa fa-user"></i>My Profile</a></li>
                                <li class="s-login"><i class="fa fa-sign-out"></i>
                                    <a href="{{ (Route::has('logout') ? Route('logout') : '#') }}" class="customer_login_link">Logout</a>
                                </li>
                            </ul>
                        </li>
                       {{--  <li class="login"><a href="{{ (Route::has('shopCart') ? Route('shopCart') : 'javascript:;') }}">Shopping Cart</a></li> --}}
                    @else
                        <li class="toplink-item account" id="my_account">
                            <a href="#" class="dropdown-toggle">
                                My Account<span class="fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-content dropdown-menu sn">
                                <li class="s-login"><i class="fa fa-sign-out"></i>
                                    <a href="{{ (Route::has('login') ? Route('login') : '#') }}" class="customer_login_link">Login</a>
                                </li>
                                <li><a href="{{ (Route::has('register') ? Route('register') : '#') }}" title="Create Account"><i class="fa fa-user"></i>Create account</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
            {{-- <!--End My Account --> --}}
        </div>
      </div>
    </div>

    <div class="header-center d-print-none top-header-bg m-0 p-3">
      <div class="container">
        <div class="row">
            <div class="navbar-logo col-lg-2 d-none d-lg-block">
                {{-- <!--Start site Logo --> --}}
                <div class="site-header-logo title-heading" itemscope itemtype="#">
                    <a href="{{ (Route::has('index') ? Route('index') : "#") }}" itemprop="url" class="site-header-logo-image">
                        <img src="{{ asset('assets/images/logo_149x40.png?v=1534840581') }}"
                            srcset="{{ asset('assets/images/logo_149x40.png?v=1534840581') }}"
                            alt="Shopstore4me"
                            itemprop="logo">
                    </a>
                </div>
            </div>
           {{--  <!--End site Logo --> --}}

            {{-- <!--Start site Search --> --}}
            <div class="header-search col-xl-7 col-lg-6 d-none d-lg-block">
                <div class="search-header-w">
                    <div class="btn btn-search-mobi d-lg-none d-md-block" >
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="form_search">
                        <form class="formSearch" action="{{(Route::has('productCollection') ? Route('productCollection') : '#' )}}" method="get">
                            <input class="form-control" type="search" name="q" id="txtSearchJquery" placeholder="Enter keywords here... " autocomplete="off" />
                            <button class="btn btn-search" type="submit" >
                                <span class="btnSearchText d-none d-lg-block">Search</span>
                                <i class="fa fa-search d-lg-none"></i>
                            </button>

                            <div class="pl-3 pr-3" style="position: absolute; width:100%; overflow: hidden; max-height: 500px; border-radius: 0 0 4px 4px; background: #ffffff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
                                <table id="tblSearchGet">
                                    <tbody class="bg-light">
                                        <tr></tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <!--End site Search --}}

            <div class="right col-xl-1 col-lg-1 col-md-1 d-none d-lg-block">
                <div class="minilink-header hidden-sm hidden-xs">
                    @if(isset($newMessage) && $newMessage)
                    <div class="text-center" style="background: #f50; border-radius: 100%; height: 40px; width: 40px; padding: 8px; 0px 1px 0px;">
                        <a href="{{ (Route::has('inbox') ? Route('inbox') : "javascript:;") }}" class="text-white" title="New Message">
                            <i class="fa fa-bell"><div class="mt-1"><b>{{ $newMessage }}</b></div></i>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            {{-- <!--Start Top Shopping cart and popup --> --}}
            <div class="middle-right col-xl-2 col-lg-2 d-none d-lg-block">
                <div class="minilink-header hidden-sm hidden-xs">
                    <div class="inner">
                        <div class="minicart-header">
                            <a href="{{ (Route::has('shopCart') ? Route('shopCart') : "javascript:;") }}" class="site-header__carts shopcart"><!--dropdown-toggle-->
                                <span class="cart_ico"><i class="fa fa-shopping-basket"></i></span>
                                <span class="cart_info">
                                    <span class="cart-title"><span class="title-cart">Shopping Cart</span></span>
                                    <span id="CartCount" class="cout_cart"><span class="cout_item">{{ (isset($myCart) ? count($myCart) : 0 ) }}</span> item(s)</span>
                                    <span class="cart-total">
                                        <span id="CartTotal"  class="total_cart"> | <span class=money>${{ (isset($myCartTotolAmount) ? number_format($myCartTotolAmount, 2) : '0.00') }}</span></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end shopping cart --}}
        </div>
      </div>
    </div>

    <!--Start Header Mobile-->
    <div class="header-mobile d-lg-none d-print-none">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="logo-mobiles">
                    <div class="site-header-logo title-heading" itemscope itemtype="#">
                        <a href="{{ (Route::has('index') ? Route('index') : "#") }}" itemprop="url" class="site-header-logo-image">
                            <img src="{{ asset('assets/images/logo_149x40.png?v=1534840581') }}"
                                srcset="{{ asset('assets/images/logo_149x40.png?v=1534840581') }}"
                                alt="Shopstore4me"
                                itemprop="logo">
                        </a>
                    </div>
                </div>
                <div class="group-nav">
                    <div class="group-nav__ico group-nav__menu">
                        <div class="mob-menu">
                            <i class="material-icons">&#xE8FE;</i>
                        </div>
                    </div>
                    <div class="group-nav__ico group-nav__search no__at">
                        <div class="btn-search-mobi dropdown-toggle">
                            <i class="material-icons">&#xE8B6;</i>
                        </div>
                        <div class="form_search dropdown-content" style="display: none;">

                            <form class="formSearch" action="{{(Route::has('productCollection') ? Route('productCollection') : '#' )}}" method="get">
                                <input class="form-control" type="search" name="q" id="txtSearchJquery" placeholder="Enter keywords here... " autocomplete="off" />
                                <button class="btn btn-search" type="submit" >
                                    <span class="btnSearchText hidden">Search</span>
                                    <i class="fa fa-search"></i>
                                </button>
                                <div class="pl-3 pr-3" style="position: absolute; width:100%; overflow: hidden; max-height: 500px; border-radius: 0 0 4px 4px; background: #ffffff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" >
                                    <table id="tblSearchGet">
                                        <tbody style='background: #ffffff;'>
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="group-nav__ico group-nav__account no__at">
                        <a href="#" class="dropdown-toggle">
                            <i class="material-icons">&#xE7FF;</i>
                        </a>
                        <ul class="dropdown-content dropdown-menu sn">
                            @if(Auth::check())
                                @if(isset($checkAndGetUserTypeID) && $checkAndGetUserTypeID)
                                    <li>
                                        <a href="{{ Route::has('goTostoreHome') ? Route('goTostoreHome') :'#' }}" title="My Store"><i class="fa fa-shopping-cart"></i>My Store</a>
                                    </li>
                                @endif
                                    <li><a href="{{ Route::has('myProfile') ? Route('myProfile') :'#' }}" title="My Profile"><i class="fa fa-user"></i>My Profile</a></li>
                                    <li class="s-login"><i class="fa fa-sign-out"></i>
                                        <a href="{{ (Route::has('logout') ? Route('logout') : '#') }}" class="customer_login_link">Logout</a>
                                    </li>
                            @else
                                <li class="s-login"><i class="fa fa-sign-out"></i>
                                    <a href="{{ (Route::has('login') ? Route('login') : '#') }}" class="customer_login_link">Login</a>
                                </li>
                                <li><a href="{{ (Route::has('register') ? Route('register') : '#') }}" title="Create Account"><i class="fa fa-user"></i>Create account</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="group-nav__ico group-nav__cart no__at">
                        <div class="minicart-header">
                        <a href="{{ (Route::has('shopCart') ? Route('shopCart') : "javascript:;") }}" class="site-header__carts shopcart">
                            <span class="cart_icos"><i class="material-icons">&#xE854;</i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <!--All Categories-->
                    @includeif('share.header.allCategoryOpen')
                <!--//End All Categories-->

                <!--All Categories-->
                @includeif('share.header.menu')
                <!--//End All Categories-->
            </div>
        </div>
    </div>
</header>
