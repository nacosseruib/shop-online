@if(isset($showSideBarStoreSideBarView) && $showSideBarStoreSideBarView ==1 && Auth::check())

      <div class="quick-view"></div>
      <div class="page-container" id="PageContainer">
        <div class="main-content" id="MainContent">
        <div class="container positon-sidebar">
        <div class="row">
            <div class="col-sidebar sidebar-fixed col-lg-3">
            <span id="close-sidebar" class="btn-fixed d-lg-none"><i class="fa fa-times"></i></span>
            <div class="block block-category spaceBlock p-2">
                <h3 class="block-title text-center">
                    Quick Menu
                </h3>
                <div class="text-center">
                    <b>
                        <i class="fa fa-user"></i> Hey, {{ (isset($userFullName)  ? $userFullName : null) }}!
                    </b>
                </div>
                <hr />
                @if(Auth::check() && isset($checkAndGetUserTypeID) && $checkAndGetUserTypeID)
                    <div class="widget-content bg-light p-2">
                        <div align="center">
                            <a href="{{ (Route::has('goTostoreHome') ? Route('goTostoreHome') : 'javascript:;') }}" class="btn btn-success btn-block mt-2">
                                <i class="fa fa-shopping-cart"></i> My Store (Active)
                            </a>
                        </div>

                        @if(isset($userStorestatus) && $userStorestatus)
                        <div align="center">
                            <a href="{{ (Route::has('goToProductUpload') ? Route('goToProductUpload') : 'javascript:;') }}" class="btn btn-info btn-block mt-2">
                                <i class="fa fa-shopping-cart"></i> Upload New Product
                            </a>
                        </div>
                        @endif

                        <ul class="toggle-menu list-menu">
                            <li class=" toggle-content">
                                <div class="p-1">
                                    <a href="javascript:;" class="btn btn-block text-left"><i class="fa fa-bookmark"></i> My Products<span class="count"> </span><span class="caret"><i class="fa fa-angle-down"></i></span></a>
                                    <ul class="sub-menu level-1">
                                        <li>
                                            <div class="p-1">
                                                <a href="{{ (Route::has('goTostoreHome') ? Route('goTostoreHome') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-shopping-bag"></i> All Products <span class="count"> </span></a>
                                            </div>
                                        </li>
                                        <li >
                                            <div class="p-1">
                                                <a href="{{ (Route::has('blockedProduct') ? Route('blockedProduct') : 'javascript:;' ) }}" class="btn btn-block text-left"> <i class="fa fa-exclamation-triangle"></i> Blocked Products <span class="count"> </span></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-1">
                                                <a href="{{ (Route::has('listItemComment') ? Route('listItemComment') : 'javascript:;') }}" class="btn btn-block text-left"> <i class="fa fa-comment"></i> View Product Comment</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-1">
                                                <a href="{{ (Route::has('listTrashedProduct') ? Route('listTrashedProduct') : 'javascript:;') }}" class="btn btn-block text-left"> <i class="fa fa-trash"></i> Trashed Product <span class="count"> </span></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li  class="active">
                                <div class="p-1">
                                    <a href="{{ (Route::has('viewStoreSetting') ? Route('viewStoreSetting') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-gear"></i> Store Setting <span class="count"></span></a>
                                </div>
                            </li>
                            <li class=" toggle-content">
                                <div class="p-1">
                                    <a href="javascript:;" class="btn btn-block text-left"><i class="fa fa-bookmark"></i> Transaction<span class="count"> </span><span class="caret"><i class="fa fa-angle-down"></i></span></a>
                                    <ul class="sub-menu level-1">
                                        <li >
                                            <div class="p-1">
                                                <a href="{{ (Route::has('storeOrder') ? Route('storeOrder') : 'javascript:;') }}" class="btn btn-block text-left"> <i class="fa fa-shopping-bag"></i> Newly Ordered Items <span class="count"> </span></a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif

                @if(Auth::check())
                <div class="widget-content bg-light p-2">
                    <div align="center">
                        <a href="{{ (Route::has('myProfile') ? Route('myProfile') : 'javascript:;') }}" class="btn btn-info btn-block mt-2">
                            <i class="fa fa-user"></i> My Profile
                        </a>
                    </div>
                    <div align="center">
                        <a href="{{ (Route::has('listDeliveryAgent') ? Route('listDeliveryAgent') : 'javascript:;') }}" class="btn btn-info btn-block mt-2">
                            <i class="fa fa-users"></i> View Delivery Agents
                        </a>
                    </div>
                    <div align="center">
                        <a href="{{ (Route::has('confirmItemDelivery') ? Route('confirmItemDelivery') : 'javascript:;') }}" class="btn btn-warning btn-block mt-2 text-white" title="You will need delivery code of the user you've delivered to">
                            <i class="fa fa-key"></i> Confirm New Delivery
                        </a>
                    </div>

                    <ul class="toggle-menu list-menu">
                        <li class=" toggle-content">
                            <div class="p-1">
                                <a href="{{ (Route::has('inbox') ? Route('inbox') : 'javascript:;' ) }}" class="btn btn-block text-left">
                                    <i class="fa fa-bell"></i> Inbox
                                    <span class="count">
                                        @if(isset($newMessage) && $newMessage)
                                            <div class="text-white bg-danger text-center p-1 mb-1" style="border-radius: 100%; height: 23px; width: 23px;"><b>{{ (isset($newMessage) && $newMessage ? $newMessage : 0) }}</b></div>
                                        @endif
                                    </span>
                                </a>
                            </div>
                        </li>

                        <li class=" toggle-content">
                            <div class="p-1">
                                <a href="javascript:;" class="btn btn-block text-left"><i class="fa fa-bookmark"></i> Item Delivered To Me<span class="count"> </span><span class="caret"><i class="fa fa-angle-down"></i></span></a>
                                <ul class="sub-menu level-1">
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('myPendingDelivery') ? Route('myPendingDelivery') : 'javascript:;' ) }}" class="btn btn-block text-left"><i class="fa fa-shopping-bag"></i> Pending Item To Be Delivered To Me <span class="count"> </span></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('myOrderDelivery') ? Route('myOrderDelivery') : 'javascript:;' ) }}" class="btn btn-block text-left"><i class="fa fa-shopping-cart"></i> All Items Delivered To Me <span class="count"> </span></a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class=" toggle-content">
                            <div class="p-1">
                                <a href="javascript:;" class="btn btn-block text-left"><i class="fa fa-bookmark"></i> Item I Needd To Deliver<span class="count"> </span><span class="caret"><i class="fa fa-angle-down"></i></span></a>
                                <ul class="sub-menu level-1">
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('pendingItemNeedToDeliver') ? Route('pendingItemNeedToDeliver') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-shopping-bag"></i> Pending Items I Need to Deliver </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('myItemDelivery') ? Route('myItemDelivery') : 'javascript:;' ) }}" class="btn btn-block text-left"><i class="fa fa-shopping-cart"></i> All Items I have Delivered<span class="count"> </span></a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class=" toggle-content">
                            <div class="p-1">
                                <a href="javascript:;" class="btn btn-block text-left"><i class="fa fa-bookmark"></i> Order History<span class="count"> </span><span class="caret"><i class="fa fa-angle-down"></i></span></a>
                                <ul class="sub-menu level-1">
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('checkoutOrder') ? Route('checkoutOrder') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-shopping-bag"></i> My Orders </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class=" toggle-content">
                            <div class="p-1">
                                <a href="javascript:;" class="btn btn-block text-left"><i class="fa fa-bookmark"></i> My Profile<span class="count"> </span><span class="caret"><i class="fa fa-angle-down"></i></span></a>
                                <ul class="sub-menu level-1">
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('myProfile') ? Route('myProfile') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-user"></i> View Profile </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('updateAccountAuth') ? Route('updateAccountAuth') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-key"></i> Change Password </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class=" toggle-content">
                            <div class="p-1">
                                <a href="javascript:;" class="btn btn-block text-left"><i class="fa fa-bookmark"></i> Delivery Agent<span class="count"> </span><span class="caret"><i class="fa fa-angle-down"></i></span></a>
                                <ul class="sub-menu level-1">
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ Route::has('listDeliveryAgent') ? Route('listDeliveryAgent') : 'javascript:;' }}" class="btn btn-block text-left" title="Allow our agents to deliver your items"><i class="fa fa-users"></i> View All Delivery Agents</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="p-1">
                                            <a href="{{ (Route::has('registerNewAgent') ? Route('registerNewAgent') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-user"></i> Apply as an agent </a>
                                        </div>
                                    </li>
                                    @if(isset($is_User_Agent) && $is_User_Agent)
                                        <li>
                                            <div class="p-1">
                                                <a href="{{ Route::has('agentAllOrder') ? Route('agentAllOrder') : 'javascript:;' }}" class="btn btn-block text-left" title="View all order sent to me"><i class="fa fa-shopping-bag"></i> View all Orders</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-1">
                                                <a href="{{ (Route::has('updateAccountAuth') ? Route('updateAccountAuth') : 'javascript:;') }}" class="btn btn-block text-left"><i class="fa fa-cancel"></i> Unsubscribe as an agent </a>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        <li class=" toggle-content">
                            <div class="p-1">
                                <div class="p-1">
                                    <a href="{{ Route::has('logout') ? Route('logout') : 'javascript:;' }}" class="btn btn-block text-left"><i class="fa fa-sign-out"></i> Logout <span class="count"> </span></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                @endif

            </div>
            {{-- <div class="block sidebar-banner spaceBlock banners">
                <div>
                    <a href="javascript:;" title="">
                        <img class="img-responsive lazyload" data-sizes="auto" src="{{ asset('assets/js/3817/t/3/assets/icon-loadings.svg?v=17303354247329670281')}}" alt="files/bn-sb1.png" data-src="{{ asset('assets/js/3817/files/bn-sb14f2d.png?v=1534736066') }}" />
                    </a>
                </div>
            </div> --}}
        </div>
        <div class="sidebar-overlay"></div>
        <div class="col-main col-lg-9 col-12 bg-light">
            <a href="javascript:void(0)" class="open-sidebar d-lg-none"><i class="fa fa-bars"></i> Quick Menu</a>
            <div id="shopify-section-collection-infos" class="shopify-section">
                <div class="collection-info banners">
                    <div class="collection-info-full"></div>
                </div>

                <!--Filter-->
                @if(isset($showFilter) && $showFilter == 1)
                <hr>
                <div class="collection-main">
                    <div class="filters-toolbar-wrapper">
                        <div class="filters-toolbar">
                            <div class="row">
                                <div class="col col-2 col-sm-2 col-lg-2">
                                    <div class="view-mode sn">
                                        <i class="fa fa-shopping-bag  text-white bg-dark p-3"></i>
                                    </div>
                                </div>
                                <div class="col col-7 col-sm-7 col-lg-7">
                                    <div class="h4 text-center text-dark font-weight-bolder">
                                        <strong class="text-uppercase"><b> @yield('pageTitle') </b></strong>
                                    </div>
                                </div>
                                @if(isset($showSortBy) && $showSortBy == 1)
                                <div class="col col-3 col-sm-3 col-lg-3">
                                    <form id="submitSortByForm" action="{{ (Route::has('sortItemBy') ? Route('sortItemBy') :'#') }}" method="POST">
                                        @csrf
                                        <div class="filters-toolbar-item filter-fiel"><label for="SortBy" class="label-sortby hidden-xs">Sort By:</label>
                                            <select name="sortBy" id="sortByItem" class="filters-toolbar__input filters-toolbar__input--sort filters-toolbar-sort">
                                                <option value="All" {{ (Session::get('sortBy') == 'all' ? 'selected' : '') }}>All products</option>
                                                {{-- <option value="best-selling">Newly uploaded products</option> --}}
                                                @if(Auth::check())
                                                    <option value="online" {{ (Session::get('sortBy') == 'online' ? 'selected' : '') }}>Online products</option>
                                                    <option value="offline" {{ (Session::get('sortBy') == 'offline' ? 'selected' : '') }}>Offline products</option>
                                                @endif
                                                <option value="ascending" {{ (Session::get('sortBy') == 'ascending' ? 'selected' : '') }}>Alphabetically, A-Z</option>
                                                <option value="descending" {{ (Session::get('sortBy') == 'descending' ? 'selected' : '') }}>Alphabetically, Z-A</option>
                                                <option value="random" {{ (Session::get('sortBy') == 'random' ? 'selected' : '') }}>Randomize Products</option>
                                                {{--  <option value="price-descending">Price, high to low</option> --}}
                                            </select>
                                            <input class="collection-header__default-sort" type="hidden" value="created-ascending">
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <hr>
            </div>
            <!--Yield view-->
            @yield('pageSubContent')
        </div>
        </div>
    </div>

    <script>
        $(".open-sidebar").click(function(e){
            $(".sidebar-overlay").toggleClass("show");
            $(".sidebar-fixed").toggleClass("active");
        });
        $( ".open-fiter" ).click(function() {
            $('.sidebar-fixed').slideToggle(200);
            $(this).toggleClass('active');
        });
        $(".sidebar-overlay").click(function(e){
            $(".sidebar-overlay").toggleClass("show");
            $(".sidebar-fixed").toggleClass("active");
        });
        $('#close-sidebar').click(function() {
            $('.sidebar-overlay').removeClass('show');
            $('.sidebar-fixed').removeClass('active');
        });
    </script>
</div>

@else
    <section id="breadcrumbs" class=" breadcrumbbg">
        <div class="breadcrumbwrapper">
            <div class="container">
                <!--Yield view-->
                @yield('pageSubContent')
            </div>
        </div>
        <hr />
    </section>
@endif
