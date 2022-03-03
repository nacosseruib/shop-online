<div class="popup popup-recent popup-hidden" id="popup-recent">
    <div class="popup-screen">
      <div class="popup-position">
        <div class="popup-container popup-small">
          <div class="popup-html">
            <div class="popup-header">
              <span>Recent Viewed Products</span>
              <a class="popup-close" data-target="popup-close" data-popup-close="#popup-recent">&times;</a>
            </div>
            <div class="popup-content">
              <div class="form-content">
                <div class="space">
                  <div id="recently-viewed-products" class="row" style="display:none">
                  </div>

                  <script id="recently-viewed-product-template"  type="text/x-jquery-tmpl">
                      <div id="product-${handle}" class="product col col-sm-6 col-xs-6">
                          <div class="form-box">
                            <div class="item">
                                <div class="product-thumb transition">
                                      <div class="image">
                                        {if compare_at_price}
                                        <span class="bt-sale">Sale</span>
                                        {/if}
                                        <a href="${url}">
                                              <img src="${Shopify.Products.resizeImage(featured_image, "medium")}" />
                    </a>
                    </div>
                                    <div class="caption">
                                        <h4><a href="${url}" title="${title}">${title}</a></h4>
                                        <p class="price">
                                            <span class="price-new">${Shopify.formatMoney(price)}</span>
                                            <span class="price-old">{if compare_at_price}${Shopify.formatMoney(compare_at_price)}{/if}</span>
                    </p>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                  </script>


                  <script>
                    var limit_product = 6;
                    Shopify.Products.showRecentlyViewed( { howManyToShow: limit_product } );
                  </script>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
