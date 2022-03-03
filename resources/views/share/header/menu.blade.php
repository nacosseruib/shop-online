     <!--DESKTOP MENU-->
    <div class="horizontal_menu col-xl-9">
        <div id="shopify-section-ss-mainmenu" class="shopify-section">
            <div class="main-megamenu d-none d-lg-block">
                <nav class="main-wrap">
                    <ul class="main-navigation nav hidden-tablet hidden-sm hidden-xs">

                        <li class="ss_menu_lv1 menu_item  @yield('indexPageActive')">
                            <a href="{{ (Route::has('index') ? Route('index') : "javascript:;") }}" title="Home">
                                <span class="ss_megamenu_title"> <i class="fa fa-home" style="font-size: 15px;"></i> </span>
                            </a>
                        </li>

                    @if(!Auth::check())
                    <li class="ss_menu_lv1 menu_item @yield('loginPageActive')">
                        <a href="{{ (Route::has('login') ? Route('login') : 'javascript:;') }}" title="">Login</a>
                    </li>
                    <li class="ss_menu_lv1 menu_item @yield('signUpPageActive')">
                        <a href="{{ (Route::has('register') ? Route('register') : 'javascript:;') }}" title="">Sign up</a>
                    </li>
                    @endif

                    @if(Auth::check())
                    <li class="ss_menu_lv1 menu_item menu_item_drop arrow @yield('accountPageActive')">
                        <a href="javascript:;" title="">
                            <span class="ss_megamenu_title">My Account</span>
                        </a>
                        <div class="ss_megamenu_dropdown megamenu_dropdown width-custom left " style="width:840px; margin-left: -300px !important;">
                            <div class="row">
                                <div class="ss_megamenu_col col_menu col-lg-12">
                                <div class="ss_inner">
                                    <div class="row">
                                    <div class="ss_megamenu_col col-md-3">
                                        <ul class="menulink">
                                            <li class="ss_megamenu_lv2 megatitle">
                                                <a href="javascript:;" title="">My Account</a>
                                            </li>
                                            <li class="ss_megamenu_lv3 ">
                                                <div align="left">
                                                    <a href="{{ (Route::has('myProfile') ? Route('myProfile') : 'javascript:;') }}" class="btn btn-info btn-block mt-2 text-white">
                                                        <i class="fa fa-user"></i> My Profile
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <div align="left">
                                                    <a href="{{ (Route::has('confirmItemDelivery') ? Route('confirmItemDelivery') : 'javascript:;') }}" class="btn btn-warning btn-block mt-2 text-white" title="You will need delivery code of the user you've delivered to">
                                                        <i class="fa fa-key"></i> Confirm New Delivery
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="ss_megamenu_lv3 ">
                                                <div align="left">
                                                    <a href="{{ (Route::has('inbox') ? Route('inbox') : 'javascript:;' ) }}" class="btn btn-default btn-block mt-2 text-white">
                                                        <i class="fa fa-bell"></i> Inbox
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="ss_megamenu_lv3 ">
                                                <div align="left">
                                                    <a href="{{ (Route::has('updateAccountAuth') ? Route('updateAccountAuth') : 'javascript:;') }}" class="btn btn-default btn-block mt-2 text-white">
                                                        <i class="fa fa-lock"></i> Change Password
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="ss_megamenu_lv3 ">
                                                <div align="left">
                                                    <a href="{{ (Route::has('logout') ? Route('logout') : 'javascript:;') }}" class="btn btn-default btn-block mt-2 text-white">
                                                        <i class="fa fa-sign-out"></i> Logout
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="ss_megamenu_col col-md-3">
                                        <ul class="menulink">
                                            <li class="ss_megamenu_lv2 megatitle">
                                                <a href="javascript:;" title="">My Order</a>
                                            </li>

                                            <li class="ss_megamenu_lv3 ">
                                                <a href="{{ (Route::has('myOrderDelivery') ? Route('myOrderDelivery') : 'javascript:;' ) }}" title="Item delivered to me"> <i class="fa fa-shopping-bag"></i> Items Delivered To Me</a>
                                            </li>

                                            <li class="ss_megamenu_lv3 ">
                                                <a href="{{ (Route::has('myPendingDelivery') ? Route('myPendingDelivery') : 'javascript:;' ) }}" title="I tems i need to deliver"> <i class="fa fa-shopping-bag"></i> Pending Delivery</a>
                                            </li>

                                            <li class="ss_megamenu_lv3 ">
                                                <a href="{{ (Route::has('checkoutOrder') ? Route('checkoutOrder') : 'javascript:;') }}" title="All my checkout orders"> <i class="fa fa-shopping-bag"></i> Order History</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="ss_megamenu_col col-md-3">
                                        <ul class="menulink">
                                            <li class="ss_megamenu_lv2 megatitle">
                                                <a href="javascript:;" title="">My Delivery</a>
                                            </li>

                                            <li class="ss_megamenu_lv3 ">
                                                <a href="{{ (Route::has('pendingItemNeedToDeliver') ? Route('pendingItemNeedToDeliver') : 'javascript:;') }}" title="All my checkout orders"> <i class="fa fa-shopping-cart"></i> Items I need to Deliver</a>
                                            </li>

                                            <li class="ss_megamenu_lv3 ">
                                                <a href="{{ (Route::has('myItemDelivery') ? Route('myItemDelivery') : 'javascript:;') }}" title="All my checkout orders"> <i class="fa fa-shopping-cart"></i> Items I have Delivered</a>
                                            </li>
                                        </ul>
                                    </div>

                                    @if(isset($checkAndGetUserTypeID) && $checkAndGetUserTypeID)
                                        <div class="ss_megamenu_col col-md-3">
                                            <ul class="menulink">
                                                <li class="ss_megamenu_lv2 megatitle">
                                                    <a href="javascript:;" title="">My Store</a>
                                                </li>
                                                <li class="ss_megamenu_lv3 ">
                                                    <a href="{{ Route::has('storeOrder') ? Route('storeOrder') :'javascript:;' }}" title=""><i class="fa fa-shopping-cart"></i> Newly Ordered Items</a>
                                                </li>
                                                <li class="ss_megamenu_lv3 ">
                                                    <a href="{{ Route::has('goTostoreHome') ? Route('goTostoreHome') :'javascript:;' }}" title=""><i class="fa fa-shopping-cart"></i> View Store</a>
                                                </li>

                                                <li class="ss_megamenu_lv3 ">
                                                    <a href="{{ Route::has('goToProductUpload') ? Route('goToProductUpload') :'javascript:;' }}" title=""><i class="fa fa-shopping-cart"></i> Upload Product</a>
                                                </li>

                                                <li class="ss_megamenu_lv3 ">
                                                    <a href="{{ Route::has('listItemComment') ? Route('listItemComment') :'javascript:;' }}" title=""><i class="fa fa-comment"></i> Product Comment</a>
                                                </li>

                                                <li class="ss_megamenu_lv3 ">
                                                    <a href="{{ Route::has('listTrashedProduct') ? Route('listTrashedProduct') :'javascript:;' }}" title=""><i class="fa fa-trash"></i> Trashed Product</a>
                                                </li>

                                                <li class="ss_megamenu_lv3 ">
                                                    <a href="{{ Route::has('blockedProduct') ? Route('blockedProduct') :'javascript:;' }}" title=""><i class="fa fa-exclamation"></i> Block Product</a>
                                                </li>

                                                <li class="ss_megamenu_lv3 ">
                                                    <a href="{{ Route::has('viewStoreSetting') ? Route('viewStoreSetting') :'javascript:;' }}" title=""><i class="fa fa-gear"></i> Store Setting</a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                  </div>
                                </div>
                                </div>
                                <!--Show/Display Product-->
                                    @includeif('share.product.productListMenu', ['show'=>1, 'showScrollable'=>0, 'notScrollableData'=>3, 'other'=>null] )
                                <!--//End Show/Display Product-->
                            </div>
                        </div>
                    </li>

                    @endif

                    {{-- <li class="ss_menu_lv1 menu_item">
                        <a href="#" title="">FAQs</a>
                    </li> --}}

                    <li class="ss_menu_lv1 menu_item">
                        <a href="#" title="">
                            <span class="ss_megamenu_title">How It Works</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!--MOBILE MENU-->
        <div class="navigation-mobile mobile-menu d-block d-lg-none">
            <div class="logo-nav">
                <a href="{{ (Route::has('index') ? Route('index') : '#') }}"  class="site-header-logo-image">
                    <img src="{{ asset('assets/images/logo_149x40.png') }}" srcset="{{ asset('assets/images/logo_149x40.png') }}" alt=" ">
                </a>
                <div class="menu-remove">
                    <div class="close-megamenu"><i class="material-icons">clear</i></div>
                </div>
            </div>
            <ul class="site_nav_mobile active_mobile">
                <li class="menu-item toggle-menu active ">
                    <a href="{{ (Route::has('index') ? Route('index') : '#') }}" title="" class="ss_megamenu_title">
                        <i class="fa fa-home fa-2x"></i>
                    </a>
                </li>

                @if(!Auth::check())
                    <li class="menu-item">
                        <a href="{{ (Route::has('login') ? Route('login') : '#') }}" title="">
                            <span class="ss_megamenu_title">Login</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ (Route::has('register') ? Route('register') : '#') }}" title="">
                            <span class="ss_megamenu_title">Sign up</span>
                        </a>
                    </li>
                @endif

                @if(Auth::check())
                    <li class="menu-item toggle-menu  dropdown">
                        <a  class="ss_megamenu_title ss_megamenu_head" href="#" title="">
                            Profile
                            <span class="caret"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="menu_item ">
                                <a class="menu-title" href="{{ (Route::has('myProfile') ? Route('myProfile') : 'javascript:;') }}" title="">My Profile</a>
                            </li>
                            <li class="menu_item ">
                                <a class="menu-title" href="{{ (Route::has('updateAccountAuth') ? Route('updateAccountAuth') : 'javascript:;') }}" title="">Change Password</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="{{ (Route::has('confirmItemDelivery') ? Route('confirmItemDelivery') : 'javascript:;') }}" title="">
                            <span class="ss_megamenu_title">Confirm New Delivery</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ (Route::has('inbox') ? Route('inbox') : 'javascript:;' ) }}" title="">
                            <span class="ss_megamenu_title">Inbox</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ (Route::has('logout') ? Route('logout') : 'javascript:;' ) }}" title="">
                            <span class="ss_megamenu_title">Logout</span>
                        </a>
                    </li>
                @endif

    </ul>
  </div>
  <div class="mobile-screen d-block d-lg-none">&nbsp;</div>
  </div>
</div>
