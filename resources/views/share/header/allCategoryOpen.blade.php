<div class="vertical_menu col-xl-3 d-print-none">
    <div id="shopify-section-ss-vertical-menu" class="shopify-section">
        <div class="widget-verticalmenu">
            <div class="vertical-content">
                <div class="navbar-vertical">
                    <button style="background: rgba(0,0,0,0)" type="button" id="show-verticalmenu" class="navbar-toggles">
                    <i class="fa fa-bars"></i>
                    <span class="title-nav">ALL CATEGORIES</span>
                    </button>
                </div>
                <div class="vertical-wrapper d-print-none slider-border-radius">
                    <div class="menu-remove d-block d-lg-none">
                        <div class="close-vertical"><i class="material-icons">&#xE14C;</i></div>
                    </div>
                    <ul class="vertical-group slider-border-radius">
                        @if(isset($getAllProductCategory) && $getAllProductCategory)
                            @foreach($getAllProductCategory as $categorykey => $value)
                                <li class="vertical-item level1 toggle-menu mega_parent {{ ! ((isset($getAllProductCollection) && count($getAllProductCollection[$categorykey]) > 0) ? 'vertical_drop' : '') }}">
                                    <a class="menu-link" href="{{ (Route::has('productCollection') ? Route('productCollection', ['categoryName'=>$value->category]) : 'javascript:;') }}">
                                        <span class="icon_items">
                                            <i class="{{ $value->icon }}"></i>
                                        </span>
                                        <span class="menu-title">{{ $value->category }}</span>
                                        <span class="caret"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                    </a>
                                    @if(! isset($getAllProductCollection) && count($getAllProductCollection[$categorykey]) > 0 )
                                        <div class="row vertical-drop drop-mega drop-lv1 sub-menu" style="width: 750px;">
                                            <div class="col-md-4">
                                            <div class="row">
                                                <div class="ss_megamenu_col col_menu col-lg-12">
                                                    <div class="row55">
                                                        <div class="ss_megamenu_col col-lg-12">
                                                            <ul class="content-links">
                                                                @foreach($getAllProductCollection[$categorykey] as $collectionkey => $collectionValue)
                                                                    <li class="ss_megamenu_lv3 ">
                                                                        <a href="{{ (Route::has($collectionValue->url) ? Route($collectionValue->url) : 'javascript:;') }}">{{ $collectionValue->collection }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                        <li class="vertical-item level1 toggle-menu mega_parent">
                            <a class="menu-link" href="{{ (Route::has('productCollection') ? Route('productCollection') : 'javascript:;') }}">
                               <div class="m-0" style="padding: 6px;">
                                    <b><i class="fa fa-plus"></i> View More</b>
                               </div>
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="vertical-screen d-block d-lg-none">&nbsp;</div>
        </div>
    </div>
