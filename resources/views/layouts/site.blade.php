<!--HEADER STARTS-->
<!doctype html>
<html class="no-js" lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Basic page -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,user-scalable=1">
    <meta name="theme-color" content="#7796a8">
    <link rel="canonical" href="{{ (Route::has('index') ? route('index') : '#') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/site/favicon7b76.png?v=12858991228386271960" type="image/x-icon') }}" />
    <!-- Title and description -->
    <title>@yield('pageTitle', 'Welcome to shopstore4me.com')</title>
    <meta name="description" content="Shopstore4me - The best online store where you can get huge discount on all the items you shop for.">
    <meta name="description" content="We are an online store where you can purchase all your food items, men and women clothes, electronics, books, home appliances, kiddies items, fashion items for men, women, and children; cool gadgets, computers, groceries, automobile parts, and lot more.">
    <meta name="keywords" content="electronics, books, home appliances, kiddies items, fashion items for men, women, and children; cool gadgets, computers, groceries, automobile parts">

    <!--//-meta-tags.liquid -->
    <meta property="og:site_name" content="Shopstore4me - The best online store where you can get huge discount on all the items you shop for.">
    <meta property="og:url" content="https://shopstore4me.com/">
    <meta property="og:title" content="Shopstore4me - The best online store where you can get huge discount on all the items you shop for.">
    <meta property="og:type" content="Shopstore4me - The best online store where you can get huge discount on all the items you shop for.">
    <meta property="og:description" content="We are an online store where you can purchase all your food items, men and women clothes, electronics, books, home appliances, kiddies items, fashion items for men, women, and children; cool gadgets, computers, groceries, automobile parts, and lot more.">

    <meta name="twitter:site" content="@MagenTech">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Shopstore4me">
    <meta name="twitter:description" content="We are an online store where you can purchase all your food items, men and women clothes, electronics, books, home appliances, kiddies items, fashion items for men, women, and children; cool gadgets, computers, groceries, automobile parts, and lot more.">

    <!-- Script -->
    <script src="{{ asset('assets/js/ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js') }}" ></script>
    <script src="{{ asset('assets/js/bootstrap/4.0.0/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/slick.minfcc6.js?v=8998077448227001557') }}" ></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/ss_customb6fd.js?v=3819275139416486953') }}" ></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/jquery-cookie.min60ca.js?v=960734920700172582') }}" ></script>
    <script src="{{ asset('assets/js/themes_support/api.jquery-e94e010e92e659b566dbc436fdfe5242764380e00398907a14955ba301a4749f.js') }}" ></script>
    <script src="{{ asset('assets/js/libs84d2.js?v=3609920471657809931') }}" ></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/wish-list3510.js?v=15548216350467102194') }}" ></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/owl.carousel.min29bc.js?v=7581371558069594612') }}" ></script>
    <script src="{{ asset('assets/js/themes_support/option_selection-fe6b72c2bbdd3369ac0bfefe8648e3c889efca213baefd4cfb0dd9363563831f.js') }}" ></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/sticky-kit.min045c.js?v=3910486122095080407') }}" ></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/jquery.fancybox.pack5863.js?v=9838807461683025595')}}" ></script>

    <!-- CSS Script -->
    <link rel="stylesheet" href="{{  asset('assets/css/font-awesome/4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{  asset('assets/css/slick.css') }}"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('assets/css/theme-config.scss78eb.css?v=6135627095362450949') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets/css/theme-style.scss9808.css?v=16450673109996609623') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets/css/theme-sections.scssba55.css?v=8711581198599265801')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets/css/theme-responsive.scssb71e.css?v=5163833865268672797')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets/css/animate16ee.css?v=5907909024836615851')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets/css/owl.carousel.min22a5.css?v=10084739304461680995') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets/css/jquery.fancyboxa619.css?v=13709203629119909210') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('assets/js/3817/t/3/assets/jquery.fancyboxa619.css?v=13709203629119909210')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Summernote css -->
    <link href="{{ asset('assets/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <!--Language Translation-->

        <!--<div id="google_translate_element"></div>-->
        <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script>
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({
                    pageLanguage: 'en'
                }, 'google_translate_element');
            }
        </script>
        <!--//Translation-->

    @yield('style')

    {{-- <!--Boostrap 4.19.1 CSS-->
     <!-- Font Awesome -->
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <!-- Google Fonts -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">-->
    <!-- Bootstrap core CSS -->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Material Design Bootstrap -->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">-->
    <!--//End Boostrap 4.19.1 CSS--> --}}
        <style>
            .element-border-radius{
                border-radius: 6px !important;
            }
            .slider-border-radius{
                border-radius: 0 0 6px 6px !important;
            }
            .checked {
                color: orange;
            }
            body{
                background: #000;
                background-image: url("{{ asset('assets/images/body-bg.jpg')}}");
                background-size: cover;
               /*  background-repeat: no-repeat; */
                background-repeat: repeat;
                background-attachment: fixed;
            }
            .top-header-bg{
                background: #ffffff;
                /* background-image: url("{{ asset('assets/images/top-header-bg.jpg')}}");
                background-size: cover;
                background-repeat: no-repeat; */
            }
            .index-slider-section{
               /*  background: #000;
                background-image: url("{{ asset('assets/images/main-bg.png')}}");
                background-size: cover;
                background-repeat: repeat; */
            }
        </style>
  </head>

 {{--  background: #f4f4f4; {{asset('assets/images/uploadInstruction.jpg')}} --}}
  <body class="{{ ((isset($openCategoryMenu) && $openCategoryMenu == 1) ? 'template-index' : 'template-collection') }}">

    <div id="wrapper" class="page-wrapper wrapper-full effect_10">
        <!--   Loading Site -->
        <div id="loadingSite">
            <div class="cssload-loader">
                <span class="block-1"></span>
                <span class="block-2"></span>
                <span class="block-3"></span>
                <span class="block-4"></span>
                <span class="block-5"></span>
                <span class="block-6"></span>
                <span class="block-7"></span>
                <span class="block-8"></span>
                <span class="block-9"></span>
                <span class="block-10"></span>
                <span class="block-11"></span>
                <span class="block-12"></span>
                <span class="block-13"></span>
                <span class="block-14"></span>
                <span class="block-15"></span>
                <span class="block-16"></span>
            </div>
        </div>
        <div id="shopify-section-header" class="shopify-section"></div>


        <!--Top Header-->
        @includeif('share.header.topHeader')
        <!--//End Top Header-->

    <script>
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 36) {
            $('.header.header-fixed').addClass('stickytop');
        }
        else {
            $('.header.header-fixed').removeClass('stickytop');
        }
    });
    </script>
    <!--HEADER ENDS-->

    @if(isset($showHeaderNav) && $showHeaderNav == 1)
        <section id="breadcrumbs" class=" breadcrumbbg">
            <div class="breadcrumbwrapper">
            <div class="container">
                <nav>
                    <ol class="breadcrumb" itemscope itemtype="">
                        <li itemprop="itemlistelement" itemscope itemtype="">
                            <a href="{{ (Route::has('index') ? Route('index') : '#') }}" title="Back to home page" itemprop="item">
                                <span itemprop="name">Home</span>
                            </a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li class="active" itemprop="itemlistelement" itemscope itemtype="">
                            <span itemprop="item"><span itemprop="name">@yield('pageTitle')</span></span>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </nav>

                    @includeIf('share.operationCallBackAlert', ['showAlert' => (isset($showAlert) ? $showAlert : 1) ])
            </div>
            </div>
        </section>
    @endif


<!--PAGE CONTENTS START-->
    @yield('pageContent')
<!--PAGE CONTENTS END-->


<!--FOOTER STARTS-->
    <div id="shopify-section-footer" class="shopify-section d-print-none">
        <footer data-section-id="footer" data-section-type="header-section" class="site-footer clearfix">
        <div class="footer-1">

        <!--Product most searched for-->
        @includeif('share.footer.productMostSearchedFor')

        <div class="footer-bottom" style="background:#f3f4f8">
            <div class="container">
            <div class="row">
                <div class="col-sm-7 ft-copyright">
                <span>Shopstore4me © {{ date('Y') }}. All Rights Reserved</span>
                </div>
                <div class="col-sm-5 ft-payment">
                <a href="{{ (Route::has('index') ? Route('index') : 'javascript:;') }}" title=" ">
                    <img class="img-payment lazyload" data-sizes="auto" src="{{ asset('assets/js/3817/t/3/assets/icon-loadings.svg?v=17303354247329670281')}}" alt=" " data-src="{{ asset('assets/js/3817/files/paymente949.png?v=1534760202')}}" />
                </a>
                </div>
            </div>
            </div>
            <div id="goToTop" class="hidden-xs"><span></span></div>
        </div>
        </div>
        </footer>
    </div>


        {{-- <!--Right Sticky Popup page on every page -->
            <!--includeif('share.rightStickyPopupOnPages.rightStickyPopup')-->
        <!--Right Sticky Popup page on every page --> --}}

        <div id="shopify-section-ss-facebook-message" class="shopify-section"></div>

        <!--Welcome Index Page Popup -->
        @if(isset($showWelcomePopupModal) && $showWelcomePopupModal == 1)
            @includeif('share.index.welcomePopupLayout')
        @endif

    </div>

    <script src="{{ asset('assets/js/currencies.js') }}"></script>
    <script src="{{ asset('assets/js/3817/t/3/assets/jquery.currencies.mindb8f.js?v=439216395977994554') }}" ></script>
    <script>
        //eraseCookie('currency');
      function createCookie(name,value,days) {
          var expires = "";
          if (days) {
              var date = new Date();
              date.setTime(date.getTime() + (days*24*60*60*1000));
              expires = "; expires=" + date.toUTCString();
          }
          document.cookie = name + "=" + value + expires + "; path=/";
      }

      function readCookie(name) {
          var nameEQ = name + "=";
          var ca = document.cookie.split(';');
          for(var i=0;i < ca.length;i++) {
              var c = ca[i];
              while (c.charAt(0)==' ') c = c.substring(1,c.length);
              if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
          }
          return null;
      }

      function eraseCookie(name) {
          createCookie(name,"",-1);
      }

      //jQuery(document).ready(function() {
        Currency.format = 'money_format';
        var shopCurrency = 'USD';
        Currency.moneyFormats[shopCurrency].money_with_currency_format = "${amount}";
        Currency.moneyFormats[shopCurrency].money_format = "${amount}";

        //var cookieCurrency = Currency.cookie.read();
          var cookieCurrency = readCookie('currency');

        jQuery('span.money span.money').each(function() {
          jQuery(this).parent('span.money').removeClass('money');
        });

        jQuery('span.money').each(function() {
          jQuery(this).attr('data-currency-USD', jQuery(this).html());
        });

        var currencySwitcher = jQuery('select[name=currencies]');
        // When the page loads.
        if (cookieCurrency == null || cookieCurrency == shopCurrency) {
          Currency.currentCurrency = shopCurrency;
        }
        else {
          Currency.currentCurrency = cookieCurrency;
          currencySwitcher.val(cookieCurrency);
          Currency.convertAll(shopCurrency, cookieCurrency);
        }

        currencySwitcher.change(function() {
            eraseCookie('currency');
              var newCurrency =  jQuery(this).val();
              createCookie('currency', newCurrency, 30);
            Currency.convertAll(Currency.currentCurrency, newCurrency);
        });

        $('body').on('ajaxCart.afterCartLoad', function(cart) {
          Currency.convertAll(shopCurrency, jQuery('select[name=currencies]').val());
        });

        var original_selectCallback = window.selectCallback;
        var selectCallback = function(variant, selector) {
            original_selectCallback(variant, selector);
            Currency.convertAll(shopCurrency, jQuery('select[name=currencies]').val());
        };
    </script>
    </div>

     <!--Boostrap 4.19.1 JS-->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
    <!--//End Boostrap 4.19.1 JS-->

    <!--Text Editor-->
    <!-- Summernote js -->
    <script src="{{ asset('assets/summernote/summernote-bs4.min.js') }}"></script>
    <!--tinymce js-->
    <script src="{{ asset('assets/summernote/tinymce.min.js') }}"></script>
    <!-- init js -->
    <script src="{{ asset('assets/summernote/form-editor.init.js') }}"></script>
    <script>
        $(document).ready(function() {
            var getVale;
            $('.summernoteShort').summernote({
                height: 100,
                tabsize: 2,
            });
            $('.summernoteLong').summernote({
                height: 220,
                tabsize: 2,
            });

        });
    </script>
    <!--//Text Editor-->

    <!--Format Amount while typing-->
    <script>
        (function($, undefined) {
            "use strict";
            // When ready.
            $(function() {
            var $form = $( ".formFormatAmount" );
            var $input = $form.find( ".format-amount" );
            $input.on( "keyup", function( event ) {
                // When user select text in the document, also abort.
                var selection = window.getSelection().toString();
                if ( selection !== '' ) {
                    return;
                }
                // When the arrow keys are pressed, abort.
                if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                return;
                }
                var $this = $( this );
                // Get the value.
                var input = $this.val();
                var input = input.replace(/[\D\s\._\-]+/g, "");
                input = input ? parseInt( input, 10 ) : 0;
                $this.val( function() {
                    return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                });
            } );
            });
        })(jQuery);

    </script>


   {{--  LIVE SEARCH FOR VOUCHER --}}
    {{-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script> --}}
    <script>
        $(document).ready(function(){
            var table = $('#tblSearchGet'); //
           $("#txtSearchJquery").keyup(function()
           {
                var str =  $("#txtSearchJquery").val();
                    //$('#tblSearchGet').append("<tbody><tr style='background: #ffffff;'><td></td></tr></tbody>");
                if(str.length == 0) {
                    table.find("tbody tr").remove();
                    //$('#tblSearchGet').append("<tr><td align='center' class='text-danger'><b>No match found...</b></td></tr>");
                }else {
                    $.get( "{{ url('/search-product-from-db-JSON/') }}" + '/' + str, function( data )
                    {
                        var table = $('#tblSearchGet'); //
                        table.find("tbody tr").remove();
                        if(data)
                        {
                            $.each(data, function (index, value)
                            {
                                table.append("<tbody><tr style='background: #ffffff;'><td class='p-3 h5 font-weight-bolder' align='left'><a href='{{url('/')}}/collection/" + value.category.replace(' ', '+') +"' class='text-left'>" + value.product_name +"</a></td></tr></tbody>");
                            });
                        }else{
                            table.find("tbody tr").remove();
                        }
                    });
               }
           });

            //SORT STORE ITEM BY FILTER
            $('#sortByItem').change(function() {
                $('#submitSortByForm').submit();
            });

        });
        /* //END LIVE SEARCH FOR VOUCHER */
    </script>


    @yield('script')

    </body>
    </html>

<!--FOOTER ENDS-->
