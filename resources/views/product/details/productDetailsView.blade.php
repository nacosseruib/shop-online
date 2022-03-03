
<div id="ProductSection-product-template" class="product-template__containe product p-0" itemscope >

    <div class="product-single p-5">
      <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12 col-12  horizontal">
          <div class=" product-media thumbnais-bottom">
            <div class="product-photo-container slider-for horizontal">

                @if(isset($getProductDetailsImages) && $getProductDetailsImages)
                    @foreach($getProductDetailsImages as $key => $getImage)
                        <div class="thumb">
                            <a class="fancybox" rel="gallery1" href="@if(isset($productDetailsPath) && isset($productDetailsPath500x500))
                                    @if(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                        {{$productDetailsPath500x500 . $getImage->file_name}}
                                    @else
                                        {{$productDetailsPath . $getImage->file_name}}
                                    @endif
                                @endif">
                            <img id="product-featured-image-3947096834137" class="product-featured-img"
                            src="
                                @if(isset($productDetailsPath) && isset($productDetailsPath300x300) && isset($productDetailsPath500x500))
                                    @if(@getimagesize($productDetailsPath300x300 . $getImage->file_name))
                                        {{$productDetailsPath300x300 . $getImage->file_name}}
                                    @elseif(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                        {{$productDetailsPath500x500 . $getImage->file_name}}
                                    @else
                                        {{$productDetailsPath . $getImage->file_name}}
                                    @endif
                                @endif"
                            data-zoom-image="
                                @if(isset($productDetailsPath) && isset($productDetailsPath300x300) && isset($productDetailsPath500x500))
                                    @if(@getimagesize($productDetailsPath300x300 . $getImage->file_name))
                                        {{$productDetailsPath300x300 . $getImage->file_name}}
                                    @elseif(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                        {{$productDetailsPath500x500 . $getImage->file_name}}
                                    @else
                                        {{$productDetailsPath . $getImage->file_name}}
                                    @endif
                                @endif " alt =" ">
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="slider-nav horizontal" id="gallery_01">
                  @if(isset($getProductDetailsImages) && $getProductDetailsImages)
                  @foreach($getProductDetailsImages as $thumbKey => $getImage)
                      <div class="item">
                          <a class="thumb" href="javascript:void(0)" data-image="@if(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                  {{$productDetailsPath500x500 . $getImage->file_name}}
                              @else(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                  {{$productDetailsPath . $getImage->file_name}}
                              @endif"
                              data-zoom-image="@if(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                  {{$productDetailsPath500x500 . $getImage->file_name}}
                              @else(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                  {{$productDetailsPath . $getImage->file_name}}
                              @endif">

                          <img src="@if(isset($productDetailsPath) && isset($productDetailsPath300x300) && isset($productDetailsPath500x500))
                                  @if(@getimagesize($productDetailsPath300x300 . $getImage->file_name))
                                      {{$productDetailsPath300x300 . $getImage->file_name}}
                                  @elseif(@getimagesize($productDetailsPath500x500 . $getImage->file_name))
                                      {{$productDetailsPath500x500 . $getImage->file_name}}
                                  @else
                                      {{$productDetailsPath . $getImage->file_name}}
                                  @endif
                              @endif"
                              alt="{{$getImage->file_description}}">
                          </a>
                      </div>
                  @endforeach
              @endif
            </div>

          </div>
        </div>
        <div class="col-lg-7 col-md-12 col-sm-12 col-12 product-single__detail grid__item ">
            <div class="product-single__meta">
                <h1 itemprop="name" class="product-single__title">
                    {{ ((isset($product) && $product) ? $product->product_name : '') }}
                </h1>
                    <!--<div class="custom-reviews a-left hidden-xs d-flex justify-content-between">
                        <span class="shopify-product-reviews-badge" data-id="1441980350553"></span>
                        <div class="product-single__sold"><i class="fa fa-free-code-camp" aria-hidden="true"></i> 40 sold. Only 60 remain</div>
                    </div>-->
                    <div class="product-info">
                        <p class="product-single__alb instock">
                            <label>Availability</label>:  {{ (isset($product) && $product ? $product->is_available : 'Out of stock') }} ✓
                        </p>
                        <p class="product-single__type"><label>Product Brand</label>:  {{ (isset($product) && $product ? $product->brand : '-') }} </p>
                        <p itemprop="brand" class="product-single__vendor">
                            <label>Vendor</label>: <a href="javascript:;" title="visit seller's store">{{ ((isset($product) && $product) ? $product->store_name : '') }}</a>
                            <br /><label>Vendor's Note: </label>: <span>{!! ((isset($product) && $product) ? $product->store_description : null) !!}</span>
                        </p>
                    </div>

                    <!--Price-->
                    <div class="clearfix product-price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="priceCurrency" content="USD">
                            <link itemprop="availability" href="http://schema.org/InStock">
                        <p class="price-box product-single__price-product-template">
                            <span class="special-price product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                            <span id="ProductPrice-product-template" itemprop="price" content="54.0">
                            <span class=money>${{ ((isset($product) && $product) ? number_format($product->original_price, 2) : '') }}</span>
                            </span>
                            </span>
                            <span class="old-price" id="ComparePrice-product-template">
                            <span class=money>${{ ((isset($product) && $product) ? number_format($product->old_price, 2) : '') }}</span></span>

                        </p>
                    </div>

                    <!--Color-->
                    @if(isset($getColour) && count($getColour) > 0)
                        <div class="swatch clearfix" data-option-index="0">
                            <div class="header">Color</div>
                            @foreach($getColour as $colourKey => $value)
                                <div data-value="{{ $value->colour_name }}" class="swatch-element color {{ $value->colour_name }} available">
                                    <div class="tooltip">{{ $value->colour_name }}</div>
                                    <input id="swatch-0-{{ $value->colourID }}" type="radio" name="option-0" value="{{ $value->colourID }}" checked  />
                                    <label for="swatch-0-{{ $value->colourID }}" style="background-color: #{{ $value->colour_code }};">
                                        <img class="crossed-out" src="{{ asset('assets/js/3817/t/3/assets/soldoutf89f.png')}}" />
                                    </label>
                                </div>
                                <script>
                                jQuery('.swatch[data-option-index="0"] .{{ $value->colour_name }}').removeClass('soldout').addClass('available').find(':radio').removeAttr('disabled');
                                </script>
                            @endforeach
                        </div>
                    @endif

                     <!--Size-->
                     @if(isset($getSize) && count($getSize) > 0)
                     <div class="swatch clearfix" data-option-index="0">
                         <div class="header">Size</div>
                         @foreach($getSize as $szeKey => $value)
                             <div data-value="{{ $value->size_code }}" class="swatch-element color {{ $value->size_code }} available">
                                 <div class="tooltip">{{ $value->size_name }}</div>
                                 <input id="swatch-0-{{ $value->sizeID }}" type="radio" name="option-0" value="{{ $value->sizeID }}" checked  />
                                 <label for="swatch-0-{{ $value->sizeID }}" style="background-color: white;">
                                    {{ $value->size_code }}
                                 </label>
                             </div>
                             <script>
                             jQuery('.swatch[data-option-index="0"] .{{ $value->colour_name }}').removeClass('soldout').addClass('available').find(':radio').removeAttr('disabled');
                             </script>
                         @endforeach
                     </div>
                 @endif

                </div>

                    <!--Quantity-->
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="priceCurrency" content="USD">
                        <link itemprop="availability" href="http://schema.org/InStock">

                        <form action="https://ss-bigsale.myshopify.com/cart/add" method="post" enctype="multipart/form-data" class="product-form product-form-product-template product-form--hide-variant-labels" data-section="product-template">
                            <div id="product-variants">
                                <input type="hidden" name="id" value="13068096864345" />
                            </div>
                            <div class="product-options-bottom">

                                <div class="m-2 p-2 text-center bg-light" id="productAddedToCartFeedBack" style="font-size: 15px; font-weight: bold; display:none;"></div>

                                <div class="product-form__item product-form__item--quantity">
                                    <label for="Quantity" class="quantity-selector">Qty:</label>
                                    <div class="form_qty">
                                        <input type="text" id="qty" readonly name="quantity" value="1" min="1" class="quantity-selector">
                                        <div class="inline">
                                            <div class="increase items" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++; updatePricing(); return false;"></div>
                                            <div class="reduced items" onclick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty > 1 ) result.value--; updatePricing(); return false;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--Add product to cart-->
                                <div class="product-form__item product-form__item--submit">
                                    <button type="button" name="addToCart" id="{{ (isset($product) && $product ? $product->productID : null) }}"  class="btn addProductToCart product-form__cart-submit">
                                    <span id="AddToCartText-product-template">
                                        <i class="fa fa-shopping-bag"> Add This Item To Cart</i>
                                    </span>
                                    </button>
                                </div>
                            </div>
                            <div class="product-options-bottom">
                                <div class="product-form__item product-form__item--submit">
                                    <a href="{{ (Route::has('shopCart') ? Route('shopCart') : 'javascript:;' ) }}"  class="btn btn-warning p-2">
                                        <span id="AddToCartText-product-template">
                                            <i class="fa fa-shopping-cart"></i> View Shopping Cart
                                        </span>
                                    </a>
                                </div>
                                <div class="product-form__item product-form__item--submit">
                                    <a href="{{ (Route::has('allProductCollection') ? Route('allProductCollection') : 'javascript:;') }}" name="shop" class="btn btn-default p-2">
                                        <span id="AddToCartText-product-template">
                                            <i class="fa fa-shopping-cart"></i> Continue Shopping
                                        </span>
                                    </a>
                                </div>
                                {{-- <div class="product-form__item product-form__item--submit">
                                    <a href="#" name="shop" class="btn btn-default p-2">
                                        <span id="AddToCartText-product-template">
                                            <i class="fa fa-shopping-bag"></i> Wishlist
                                        </span>
                                    </a>
                                </div> --}}
                            </div>
                        </form>

                    </div>


                    <style type="text/css">
                        #simpAskQuestion{clear: both; margin:20px auto 0; max-width:1200px; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
                        #simpAskQuestion.simpAsk-container h2{display:inline-block; vertical-align:middle; margin:7px 0 7px!important; float:none !important;}
                        #simpAskQuestion .simpAsk-title-container{margin-bottom:10px!important;}
                        #simpAskQuestion .simpAskForm-container{padding:10px !important; margin-bottom:10px!important;background:#fafafa;}
                        #simpAskQuestion .simpAskForm-container p{margin:0 0 10px !important;}
                        #simpAskQuestion .simpAskForm-container form{margin:0 !important;}
                        #simpAskQuestion #askQuestion textarea{margin-bottom:10px!important; width:100%!important; padding:10px !important; border:1px solid #ECEBEB!important; overflow:auto; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;background:#fff;}
                        #simpAskQuestion #askQuestion input.simpAsk-fifty-percent{width:49.40%!important; padding:10px!important; border:1px solid #ECEBEB!important; -webkit-appearance:none; margin:0 0 10px!important; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;background:#ffffff;}
                        #simpAskQuestion #askQuestion input.fleft{float:left!important;}
                        #simpAskQuestion #askQuestion input.fright{float:right!important;}
                        #simpAskQuestion .button, #simpAskQuestion a.btn ,#simpAskQuestion input.btn{-webkit-box-shadow:none; -moz-box-shadow:none; box-shadow:none; display:inline-block; border:none; padding:5px 15px; text-transform:none; width:auto; border-radius:3px;}
                        #simpAskQuestion .simpAskSubmitForm{clear:both;}
                        #simpAskQuestion #askQuestion input, #simpAskQuestion textarea{-webkit-appearance:none; vertical-align:top; display:inline-block;}
                        #simpAskQuestion .simpAsk-error-msg{ background-color: #de4343;color: #fff;padding: 5px;box-shadow: none;margin-top: 10px;}
                        #simpAskQuestion .simpAsk-success-msg{     background-color: #61b832;color: #fff;padding: 5px;box-shadow: none;margin-top: 10px;}
                        #simpAskQuestion .simpAskSubmitForm .simpAskForm-cancel-btn.button{display:inline-block; cursor:pointer; background:0 0; color:initial; padding:5px 15px;}
                        #simpAskQuestion .simpAskSubmitForm .simpAskForm-cancel-btn.button:hover{text-decoration:underline;}
                        #simpAskQuestion .simpAskForm-container p.simpAskForm-title{font-weight:700;padding-left:4px!important;}
                        #simpAskQuestion .qa-display{border-left:1px solid #000;padding-left:8px!important; line-height:12px!important;-webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
                        #simpAskQuestion .simpAsk-title-container a.simpAskQuestionForm-btnOpen{float:right; cursor:pointer; margin-top: 9px;}
                        .simpAskQuestion-btn{-webkit-box-shadow:none; -moz-box-shadow:none; box-shadow:none; display:inline-block; border:none; margin:0;padding:7px 20px!important; color:#000; text-transform:none; background:#ddd; width:auto;}
                        .simpAskQuestion-btn:hover{color:#fff;}
                        .accordionSimpQA{padding:0px!important; display:inline-block !important; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
                        .accordionSimpQA ul{margin:0; padding:0; list-style:none; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
                        .accordionSimpQA ul li{margin:0 !important; padding:0 !important; width:100% !important; float:left !important; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box;}
                        .accordionSimpQA ul li p{font-weight:normal !important; margin:0 0 7px !important; line-height:18px !important; padding-left:20px; position:relative; }
                        .accordionSimpQA ul li p.simpQuestionHolder{font-weight:bold !important;}
                        .accordionSimpQA ul li p.simpActionHolder{ margin:0 0 20px !important; text-align:right !important;}
                        .accordionSimpQA ul li p.simpQuestionHolder:before{content:"Q"; font-weight:700; font-size: 16px; position:absolute; left:0; top:1px;}
                        .accordionSimpQA ul li p.simpAnswerHolder:before{content:"A"; font-weight:700; font-size: 16px; position:absolute; left:0; top:1px;}
                        .accordionSimpQA ul li p.simpAnswerHolder{margin-bottom: 20px !important;}

                        .simp-ask-question-header{background-color: #fafafa; padding: 30px;position: relative;}
                            .simpAskQuestion-Qcontent{width: 275px; display: inline-block;}
                            .simp-ask-question-header .simpAskQuestionForm-btnOpen{position: absolute; top: 50%; right: 24px; margin-top: -18px;}
                            .simpAskQuestion-Qcontent h3{margin:0;}
                            .simpAskQuestion-Qcontent p{font-size: 0.9em; margin: 0 !important;}
                            @font-face {
                            font-family: 'simpqafonticons';
                            src: url('data:application/octet-stream;base64,d09GRgABAAAAAA94AA8AAAAAGbwAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAABHU1VCAAABWAAAADMAAABCsP6z7U9TLzIAAAGMAAAAQwAAAFY+IEiqY21hcAAAAdAAAABeAAABtsit7NdjdnQgAAACMAAAABMAAAAgBtX/BGZwZ20AAAJEAAAFkAAAC3CKkZBZZ2FzcAAAB9QAAAAIAAAACAAAABBnbHlmAAAH3AAABJ4AAAYW2/Yh7mhlYWQAAAx8AAAAMwAAADYKI5llaGhlYQAADLAAAAAfAAAAJAc5A1hobXR4AAAM0AAAABwAAAAcFZz/+2xvY2EAAAzsAAAAEAAAABADqgVBbWF4cAAADPwAAAAgAAAAIAEZDBhuYW1lAAANHAAAAZIAAAMhqigaa3Bvc3QAAA6wAAAATAAAAGXK6oDycHJlcAAADvwAAAB6AAAAhuVBK7x4nGNgZGBg4GKQY9BhYHRx8wlh4GBgYYAAkAxjTmZ6IlAMygPKsYBpDiBmg4gCAIojA08AeJxjYGQWY5zAwMrAwFTFtIeBgaEHQjM+YDBkZAKKMrAyM2AFAWmuKQwOLxhesDIH/c9iiGIOYpgGFGYEyQEAxqcLSAB4nO2RwQ3AMAgDLw3Jo+ooHSivzs8WqaGMUaSzZAvxMMAAuriFQXtoxCylLfPOmbnVjkXuY28pofKWemjXdHHKTP65Ule5GX19ZIOFWsOL+IQX0akX8SUvmC9LtBM1AAB4nGNgQAMSEMgc9D8LhAESbAPdAHicrVZpd9NGFB15SZyELCULLWphxMRpsEYmbMGACUGyYyBdnK2VoIsUO+m+8Ynf4F/zZNpz6Dd+Wu8bLySQtOdwmpOjd+fN1czbZRJaktgL65GUmy/F1NYmjew8CemGTctRfCg7eyFlisnfBVEQrZbatx2HREQiULWusEQQ+x5ZmmR86FFGy7akV03KLT3pLlvjQb1V334aOsqxO6GkZjN0aD2yJVUYVaJIpj1S0qZlqPorSSu8v8LMV81QwohOImm8GcbQSN4bZ7TKaDW24yiKbLLcKFIkmuFBFHmU1RLn5IoJDMoHzZDyyqcR5cP8iKzYo5xWsEu20/y+L3mndzk/sV9vUbbkQB/Ijuzg7HQlX4RbW2HctJPtKFQRdtd3QmzZ7FT/Zo/ymkYDtysyvdCMYKl8hRArP6HM/iFZLZxP+ZJHo1qykRNB62VO7Es+gdbjiClxzRhZ0N3RCRHU/ZIzDPaYPh788d4plgsTAngcy3pHJZwIEylhczRJ2jByYCVliyqp9a6YOOV1WsRbwn7t2tGXzmjjUHdiPFsPHVs5UcnxaFKnmUyd2knNoykNopR0JnjMrwMoP6JJXm1jNYmVR9M4ZsaERCICLdxLU0EsO7GkKQTNoxm9uRumuXYtWqTJA/Xco/f05la4udNT2g70s0Z/VqdiOtgL0+lp5C/xadrlIkXp+ukZfkziQdYCMpEtNsOUgwdv/Q7Sy9eWHIXXBtju7fMrqH3WRPCkAfsb0B5P1SkJTIWYVYhWQGKta1mWydWsFqnI1HdDmla+rNMEinIcF8e+jHH9XzMzlpgSvt+J07MjLj1z7UsI0xx8m3U9mtepxXIBcWZ5TqdZlu/rNMfyA53mWZ7X6QhLW6ejLD/UaYHlRzodY3lBC5p038GQizDkAg6QMISlA0NYXoIhLBUMYbkIQ1gWYQjLJRjC8mMYwnIZhrC8rGXV1FNJ49qZWAZsQmBijh65zEXlaiq5VEK7aFRqQ54SbpVUFM+qf2WgXjzyhjmwFkiXyJpfMc6Vj0bl+NYVLW8aO1fAsepvH472OfFS1ouFPwX/1dZUJb1izcOTq/Abhp5sJ6o2qXh0TZfPVT26/l9UVFgL9BtIhVgoyrJscGcihI86nYZqoJVDzGzMPLTrdcuan8P9NzFCFlD9+DcUGgvcg05ZSVnt4KzV19uy3DuDcjgTLEkxN/P6VvgiI7PSfpFZyp6PfB5wBYxKZdhqA60VvNknMQ+Z3iTPBHFbUTZI2tjOBIkNHPOAefOdBCZh6qoN5E7hhg34BWFuwXknXKJ6oyyH7kXs8yik/Fun4kT2qGiMwLPZG2Gv70LKb3EMJDT5pX4MVBWhqRg1FdA0Um6oBl/G2bptQsYO9CMqdsOyrOLDxxb3lZJtGYR8pIjVo6Of1l6iTqrcfmYUl++dvgXBIDUxf3vfdHGQyrtayTJHbQNTtxqVU9eaQ+NVh+rmUfW94+wTOWuabronHnpf06rbwcVcLLD2bQ7SUiYX1PVhhQ2iy8WlUOplNEnvuAcYFhjQ71CKjf+r+th8nitVhdFxJN9O1LfR52AM/A/Yf0f1A9D3Y+hyDS7P95oTn2704WyZrqIX66foNzBrrblZugbc0HQD4iFHrY64yg18pwZxeqS5HOkh4GPdFeIBwCaAxeAT3bWM5lMAo/mMOT7A58xh0GQOgy3mMNhmzhrADnMY7DKHwR5zGHzBnHWAL5nDIGQOg4g5DJ4wJwB4yhwGXzGHwdfMYfANc+4DfMscBjFzGCTMYbCv6dYwzC1e0F2gtkFVoANTT1jcw+JQU2XI/o4Xhv29Qcz+wSCm/qjp9pD6Ey8M9WeDmPqLQUz9VdOdIfU3Xhjq7wYx9Q+DmPpMvxjLZQa/jHyXCgeUXWw+5++J9w/bxUC5AAEAAf//AA94nG2Uy28bdRDHZ377e+zL9r68a7v22rGTjWOnruLE6zS4qUFRUrWmgipUEUIigUupmxQhoapNkFDpueKMOCGEeuBUlJQD4gJCRSpH/oEKCcGhpwpxIAm/dUgQElrN77GamdV3PjMLBODwU7KkVKAOM/Bif9FAILgiDZDAJgBFoENQ5E3BdY6UMboqN8rWgFE2aEy1Tk/NNGZqbqsnWK6JftYTPINccOE1sdqJu4t4HuNu3JmbjGpVwbM1eZltK20/jS1cRHx2tWEOWnWVE+tDi+asfi7nm8VCsb9UKH7Bbyyv3703vUB7a9LIL4t3+j2vF1YLVjFtvlXw56y05UwX6tH4dKP92XJj/0Lv9ZgsvBEDgHL41+HHyifKNKjgw3lY6782HxOFuVILWQFOGeVsE5hCmSIlEqqQoUApmQNdV5EgklW5EVyT6nGgawiTUbVSOmWnNV/3GQUVVY1JmTE4QIGA2447cSRlS/F+4ErNI8kiO9uZ68bt4Lg4R/U5eiuLgz98ixY/+OPg3sEzjuY3YUSikBTlWnxQuH6lX1+iW5Z12bQs1fR1PWvwNL1BuV9sKQ1y8OdRmI476OyHUTGMxqURvFCdvjwoNK5RWijmPC/n+KaaEaqtqd6CSk3Ls5wqSLmHz5UheQwM+FcM8XRTI90AleH+bwdfbn+Pn5PB/gO8svMd/ihLmvgDkA1yHwzpz0H6u0E3EIGYFJPdye3d3e29RztyfbRH7u/u7jz8+vbe3p1HD0dh8luPFUGewyJ8AO/1b5ZRKNcXCBdDSjQ9jaDRFUBVUVHZBMp0RvVN0DWma0PQgGkwlFm2ZB5JRV2XTSm4ItaBM8ZXgfOkJTkb3L717tbbG6uvvnzpwsrSS53Z5lQx79mG5DThy6onxicj+WQ9LlFFHXsufgHbfinp0tGziLOSVUKLi6OTkMZFC2XjLmI0WY3kIZY5RvFzx/3dwpokn8aErZ+EJb6jIJkyIr9bmpb3xssrvVeWzp01HeMnwxktY+Wcb5kaGvP18FTJdq2UM1UZt5xUGtG+o3Ku5kOSDwRjIvBZxspfdLKqa3JVEznDsolYPtNuXV2fvVhuWX5ZE5yXPUcEP1fGQrc/VuIspTu2uWA6jolPDds2xvx6pVkeC/hM7Hrjja7fy6cypWo7KAR1HTXhlwNURX7MTLkydCKfCewwn81n7fbduXnvadPRKHphUaCm6XrRT9geHkq2XLI9B9uw2b+eRh3eocTQr50lqigjVRO2gDfB0JluJHPHdcaHQKgm6cs/DegG6JImCJVLqipQotJ10BRFWwVNU9ZA0ZTBrfe3bmy8OVtzT081O/M5k5WabiSZJRYnNQ86Rziz9hHec6NZS7DUqgn2ZOa6R8eutLjb9nmtmkY/GB14iKNobzSjWS8IZTMkLSGjOknXRIlriNJVpvSLCdPsxL9MnyRVfmI409EpP0NS8VQpISrUtFuvTEikqf9DWs5dclzVHhENjIx7TLS7HJ5JiHIuyp4tcvjrMVJqniA9CEdISwuNzoTR7jjexNR8UKzkToiq6gnQ/H94+tbMR//wVNA94Zn7G2V44DoAAHicY2BkYGAA4jS+CQzx/DZfGbiZXwBFGC5P0HoEo///+T+B+QWzDpDLwcAEEgUAUV4NKAB4nGNgZGBgDvqfBSRf/P/z/x/zCwagCApgBwC2RweWAAPoAAACRAAAA5j//ANrAAACYQAAAwUAAAMG//8AAAAAAG4BAAEYATYCJAMLAAEAAAAHAH4AAwAAAAAAAgAYACgAcwAAAIMLcAAAAAB4nIWQzUrDQBSFT9qq2IKCgjtlVlIppD+gi64KlRZx10UFdzFNk5R0Jk6mha59BJ/Cje/gyrfwWTxJRpGCmpDJd889987cAXCEDzgon0t+JTs4ZFRyBXu4tlylfmu5Rr63vIMGYsu71I3lOlp4stzAMV7ZwantM1rgzbKDM6dluYID58Zylfqd5Rp5ZXkHJ86z5V3qL5brmDrvlhs4r5wOVbrRcRgZ0RxeiF6neyUeNkJRiqWXCG9lIqUzMRBzJU2QJMr11TKLl+mjlyuxr2Q2CcJV4uktdSucBjQoKbpuZyszDmSgPRPM8p2zddgzZi7mWi3FyO4pUq0WgW/cyJi0327/PAuGUEixgeblhoh4rQJNqhf899BBF1ekBzoEnaUrhoSHhIqHFSuiIpMxHvCbM5JUAzoSsguf65L5mGuKR1Z9eeIiJ5mb0B+yW8Ks/sf7d3bKTmWHPBacwOUcf9eMWSOLOq84+ex75gxrnqtH1bAun04X0wiMtuYU7J7nFlR86m5xm4ZqH22+v9zLJ6jinfIAAHicY2BigAAuBuyAnZGJkZmRhZGVkY2RnZGDgSUjNaeAB0ToJmcWJeekpjDlZ7MlJ+Ylp+ZwlmSU5iYV65YWcENZKfnleQwMAOwlEhx4nGPw3sFwIihiIyNjX+QGxp0cDBwMyQUbGVidNjEwMmiBGJu5mBg5ICw+BjCLzWkX0wGgNCeQze60i8EBwmZmcNmowtgRGLHBoSNiI3OKy0Y1EG8XRwMDI4tDR3JIBEhJJBBs5mFi5NHawfi/dQNL70YmBhcADHYj9AAA') format('woff'),
                                url('data:application/octet-stream;base64,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') format('truetype');
                        }
                            [class^="icon-simp-"]:before, [class*=" icon-simp-"]:before {
                            font-family: "simpqafonticons";
                            font-style: normal;
                            font-weight: normal;
                            speak: none;
                            display: inline-block;
                            text-decoration: inherit;
                            width: 1em;
                            margin-right: .2em;
                            text-align: center;
                            font-variant: normal;
                            text-transform: none;
                            line-height: 1em;
                            margin-left: .2em;
                        }
                        .icon-simp-help:before { content: '\e800'; }
                        .icon-simp-help-circled:before { content: '\e801'; }
                        .icon-simp-ok:before { content: '\e802'; }
                        .icon-simp-cancel:before { content: '\e803'; }
                        @media screen and (max-width:768px){
                            .simp-ask-question-header .simpAskQuestionForm-btnOpen {position:inherit;top: 0;right: 0; margin-top: 0;}
                        }
                        @media screen and (max-width:480px){
                            #simpAskQuestion .simpAsk-title-container a.simpAskQuestionForm-btnOpen{float:initial;}
                            #simpAskQuestion .simpAsk-container .h2,#simpAskQuestion .simpAsk-container h2{display:block;}
                            #simpAskQuestion #askQuestion input.simpAsk-fifty-percent{width:100%!important;margin-bottom:10px!important}
                            #simpAskQuestion #askQuestion input.simpAsk-fifty-percent{width:100% !important;}
                        }
                    </style>

                @if( (isset($product) && $product && $product->is_comment == 1) )
                <div class="simpAsk-container" id="simpAskQuestion">
                    <div class="simp-ask-question-header">
                        <div class="simpAskQuestion-Qcontent">
                            <h3>
                                Have a Comment/Question?
                            </h3>
                            <p>
                                Be the first to ask a question about this.
                            </p>
                        </div>
                        <a href="javascript:void(0)" class="simpAskQuestionForm-btnOpen btn button"><i class="demo-icon icon-simp-help-circled"></i>
                            Ask a Question
                        </a>
                    </div>

                <div class="simpAskForm-container" id="simpAskForm_container" style="display:none;">
                <form method="post" action="#" id="askQuestion" class="">
                    <div class="">
                        <textarea required style="resize:none; min-height:86px;" maxlength="20000" name="comment" id="getComment" placeholder="Type your question here" title="Please Enter Your Question."></textarea>
                        <input required type="text" name="getName" id="getName" value="" placeholder="Your Name" title="Please Enter Your Name here." class="simpAsk-fifty-percent fleft">
                        <input type="email" name="getEmail" id="getEmail" value="" placeholder="Your Email" title="Please Enter Your Email." class="simpAsk-fifty-percent fright">
                        <div class="simpAskSubmitForm">
                        <input id="{{ (isset($product) && $product ? $product->productID : null) }}" class="button button-primary btn btn-primary btn btn--fill btn--color addProductComment" type="button" name="submit" value="Submit">
                            <a href="javascript:void(0)" class="simpAskForm-cancel-btn button">Cancel</a>
                            <div class="clear"></div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        @endif
        <script type="text/javascript" src="{{ asset('assets/js/lib.minaa25.js') }}"></script>
        {{-- <!--<div class="product-wrap">
            <div class="wrap__social social_share_detail clearfix">
                <label class="">Share:</label>
                <ul>
                    <div class="addthis_inline_share_toolbox"></div>
                    <script type="text/javascript" src="{{ asset('assets/js/addthis_widget.js')}}"></script>
                </ul>
            </div>
            <div class="wrap__brand">
                <label class="">Guaranteed safe checkout:</label>
                <div class="wrap__brand_content">
                    <img src="{{ asset('assets/js/3817/files/payment25df8.png?v=1534920761')}}" alt=" " />
                </div>
            </div>
        </div>--> --}}
    </div>
</div>
</div>

<div class="panel-group detail-bottom p-5 bg-white">
        <div class="tab-vertical">
          <ul class="nav nav-tabs font-ct bg-light">
            <li class="nav-item"><a class="nav-link active" href="#tabs1" data-toggle="tab">Product Details</a></li>
            <li class="nav-item"><a class="nav-link" href="#tabs2" data-toggle="tab">Product Specifications</a></li>
            <li class="nav-item"><a class="nav-link" href="#tabs3" data-toggle="tab">Payment & Other Info. </a></li>
            <li class="nav-item"><a class="nav-link" href="#tabs4" data-toggle="tab">Reviews</a></li>
          </ul>
          <div class="tab-content">
              <!--Details-->
            <div class="tab-pane active" id="tabs1">
                <div class="rte description">
                    <label  class="d-none">Quick Overview</label>
                    {!! ((isset($product) && $product) ? nl2br($product->product_details) : '') !!}
                </div>
            </div>
            <!--specification-->
            <div class="tab-pane" id="tabs2">
                <div class="success rte">
                    {!! ((isset($product) && $product) ? nl2br($product->product_feature) : '') !!}
                </div>
            </div>
            <!--payment method and other information-->
            <div class="tab-pane" id="tabs3">
                {!! ((isset($product) && $product) ? nl2br($product->payment_method) : '') !!}
            </div>
             <!--product review-->
            <div class="tab-pane" id="tabs4">

            </div>

          </div>
        </div>
      </div>

      @includeif('share.product.relatedProductView', ['showPageRelatedProduct'=>(isset($showPageRelatedProduct) ? $showPageRelatedProduct : 1), 'headerTitle'=>'Related Products'])


      <script>
        var slider = function() {
          if (!$('.slider-for').hasClass('slick-initialized') && !$('.slider-nav').hasClass('slick-initialized')) {
            $('.slider-for').slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              nextArrow: '<div class="slick-next"><i class="fa fa-angle-right"></i></div>',
              prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left"></i></div>',
              fade: true,
              accessibility:false,
              verticalSwiping: false,
              arrows : false,
              asNavFor: '.slider-nav'
            });

            $('.slider-nav').slick({
              infinite: true,
              slidesToShow: 4,
              slidesToScroll: 1,
              asNavFor: '.slider-for',
              verticalSwiping: false,
              dots: false,
              accessibility:false,
              focusOnSelect: true,
              nextArrow: '<div class="slick-next"><i class="fa fa-angle-right"></i></div>',
              prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left"></i></div>',
              responsive: [
              {
              breakpoint: 1200,
              settings: {
              slidesToShow: 5,
              slidesToScroll: 1
            }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        dots: false
                    }
                },
                {
                    breakpoint: 321,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2,
                        dots: false
                    }
                },
                ]
            });
          }
        };

        //$(window).load(function() {
          slider();
          if ($(window).width() >= 992 && $('.zoomContainer').length === 0) {
            $(".fancybox").fancybox();
            var zoomOptions = {
              cursor: "crosshair",
              galleryActiveClass: 'active',
              imageCrossfade: false,
              scrollZoom: false,

              onImageSwapComplete: function() {
                $(".zoomWrapper div").hide();
              },
              loadingIcon: window.loading_url
            };
            $(".slider-for .slick-current img").elevateZoom(zoomOptions);

            $(".slider-for ").on("beforeChange", function(event, slick, currentSlide, nextSlide) {
              $.removeData(currentSlide, "elevateZoom");
              $(".zoomContainer").remove();
            });
            $(".slider-for ").on("afterChange", function() {
              $(".slider-for  .slick-current img").elevateZoom(zoomOptions);
            });
          }
        //});

        var timer;
        var winW = $(window).width();

        $(window).on('resize.refreshSlick', function() {
          clearTimeout(timer);
          timer = setTimeout(function() {
            var curW = $(window).width();
            if (curW >= 768 && winW < 768) {
              $('.slider-for').slick('unslick');
              $('.slider-nav').slick('unslick');
              $('.slider-nav').find('.slick-list').removeAttr('style');
              $('.slider-nav').find('.slick-track').removeAttr('style');
              $('.slider-nav').find('.slick-slide').removeAttr('style');
              $('.slider-nav').find('button.slick-arrow').remove();

              slider();
            }
            winW = curW;
          }, 500);
        });

        $(".tab-vertical>ul>li").on('click', function () {
          $(".tab-vertical>ul>li").removeClass("active");
          $(this).addClass("active");
        });
      </script>

@section('script')
    {{-- ADD PRODUCT TO CART --}}
        @includeIf('share.jqueryFunctionAddToCart', ['loadScript' => (isset($loadScript) ? $loadScript: 1) ])
    {{--  END --}}
@endsection
