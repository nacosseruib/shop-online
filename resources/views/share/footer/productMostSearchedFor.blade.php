<div class="footer-center2" style="background:black">
    <div class="container">
      <div class="footer-wrapper d-print-none">
        <div class="categories-footer">
          <div class="footer-links-w">
                <div class="text-white h5">
                    <p><b> Shopstore4me is an online shopping site in Nigeria that brings you huge discount on any product you shop for and with ease </b></p>

                    <p>
                        Shopstore4me is your number one online shopping site in Nigeria. We are an online store
                        where you can purchase all your electronics, as well as books, home appliances,
                        kiddies items, fashion items for men, women, and children; cool gadgets, computers,
                         groceries, automobile parts, and more on the go. What more? You can have them delivered
                         directly to you. Shop online with great ease as you pay with JumiaPay which guarantees
                         you the safest online shopping payment method, allowing you to make stress free payments.
                         Whatever it is you wish to buy, Jumia offers you all and lots more at prices which you
                         can trust. Jumia has payment options for everyone irrespective of taste, class, and
                         preferences. Here, you also have the option to make your payment on delivery for
                         extra convenience. Shopping online in Nigeria is easy and convenient with Jumia.
                         We provide you with a wide range of products you can trust. Take part in the deals
                         of the day and discover the best prices on a wide range of products.
                    </p>
                </div>
                <div class="label-link text-white">Our Accredited stores you can shop from</div>
                <ul>
                    @if(isset($allAccreditedStores) && $allAccreditedStores)
                        @foreach($allAccreditedStores as $storeKey => $value)
                            @if($value->store_name <> null)
                                <li class="text-white">
                                    {{-- <h2><a href="{{ (Route::has('visitShop') ? Route('visitShop', ['userID'=>$value->userID]) : 'javascript:;') }}">{{ $value->store_name }}</a></h2> --}}
                                    <h2><a href="{{ (Route::has('visitShop') ? Route('visitShop', ['userID'=>str_replace(' ', '+', $value->store_name)]) : 'javascript:;') }}">{{ $value->store_name }}</a></h2>
                                    | {{ substr($value->store_description, 0, 100) }}... | {{ $value->store_state }}, {{ $value->store_country }}
                                </li>
                            @endif
                        @endforeach
                    @endif

                </ul>
            </div>
        </div>
      </div>
    </div>
  </div>
