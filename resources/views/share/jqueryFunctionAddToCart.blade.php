@if($loadScript == 1)
<script>
    $(document).ready( function(){

        //FUNCTION TO ADD TO CART
        $('.addProductToCart').click(function() {
            var productID = this.id;
            var quantity = $('#qty').val();
            if(productID != "")
            {
                $.ajax({
                    url: '{{url("/add-product-to-cart/")}}' + '/' + productID + '/' + quantity,
                    type: 'get',
                    data: { format: 'json' },
                    dataType: 'json',
                    success: function(data)
                    {
                        if(data.status == 1)
                        {
                            $('#productAddedToCartFeedBack').html(data.message).css('color', 'green').show();
                        }else{
                            $('#productAddedToCartFeedBack').html(data.message).css('color', 'red').show();
                        }
                        //location.reload(true);
                    },
                    error: function(error) {
                        alert("Please we are having issue adding your product to cart. Check your network/refresh this page !");
                        return;
                    }
                });
            }else{
                $('#productAddedToCartFeedBack').html("Sorry, we cannot add this item to your cart now! Try again.").css('color', 'yellow').show();
            }//end if
        });


         //FUNCTION TO ADD COMMENT
         $('.addProductComment').click(function() {
            var productID = this.id;
            var comment = $('#getComment').val();
            var name = $('#getName').val();
            var email = $('#getEmail').val();
            if(comment == ''){
                alert('Please enter your question/comment !');
                return;
            }
            if(name == ''){
                alert('Please enter your name !');
                return;
            }
            if(productID != "")
            {
                $.ajax({
                    url: '{{url("/add-comment-or-question-for-product/")}}' + '/' + productID + '/' + comment + '/' + name + '/' + email,
                    type: 'get',
                    data: { format: 'json' },
                    dataType: 'json',
                    success: function(data)
                    {
                        if(data.status == 1)
                        {
                            $('#productAddedToCartFeedBack').html(data.message).css('color', 'green').show();
                            $('#getComment').val('');
                            $('#getName').val('');
                            $('#getEmail').val('');
                        }else{
                            $('#productAddedToCartFeedBack').html(data.message).css('color', 'red').show();
                        }

                        //location.reload(true);
                    },
                    error: function(error) {
                        alert("Please we are having issue adding your product to cart. Check your network/refresh this page !");
                        return;
                    }
                });
            }else{
                $('#productAddedToCartFeedBack').html("Sorry, we cannot add this item to your cart now! Try again.").css('color', 'yellow').show();
                //location.reload(true);
            }//end if
        });


        //FUNCTION TO REPLY COMMENT
        $('.sendComment').click(function() {
            var comment = this.id;
            var message = $('#replyMessage' + comment).val();
            var receiver = $('#receiverID' + comment).val();
            if(comment == ''){
                alert('Sorry, we cannot send your reply now! Please try again');
                return;
            }
            if(message == ''){
                alert('Please enter your message !');
                return;
            }
            if(receiver != "")
            {
                $.ajax({
                    url: '{{url("reply-comment/")}}' + '/' + comment + '/' + receiver + '/' + message,
                    type: 'get',
                    //data: {'receiverID': receiver, 'commentID' : comment, 'message': message, '_token': $('input[name=_token]').val()},
                    data: { format: 'json' },
                    dataType: 'json',
                    success: function(data)
                    {
                        if(data.status == 1)
                        {
                            $('#replyCommentFeedBack' + comment).html(data.message).css('color', 'green').show();
                            $('#replyMessage' + comment).val('');
                        }else{
                            $('#replyCommentFeedBack' + comment).html(data.message).css('color', 'red').show();
                        }
                        //location.reload(true);
                    },
                    error: function(error) {
                        alert("Please we are having issue when sending your reply. Check your network/refresh this page !");
                        return;
                    }
                });
            }else{
                $('#replyCommentFeedBack' + comment).html("Sorry, we cannot send your reply! Try again.").css('color', 'yellow').show();
                //location.reload(true);
            }//end if
        });


        //FUNCTION TO REMOVE ITEM FROM CART
        $('.removeItemFromProductCart').click(function() {
            var cartID = this.id;
            if(cartID != "")
            {
                $.ajax({
                    url: '{{url("/remove-item-from-cart/")}}' + '/' + cartID,
                    type: 'get',
                    data: { format: 'json' },
                    dataType: 'json',
                    success: function(data)
                    {
                        alert(data.message);
                        location.reload(true);
                    },
                    error: function(error) {
                        alert("Please we are having issue removing your item from cart. Check your network/refresh this page !");
                        return;
                    }
                });
            }else{
                alert("Sorry, we cannot remove this item from your cart now! Try again.");
            }//end if
        });


        //FUNCTION TO UPDATE SHOP CART
        $('.updateShopCartQty').change(function() {
            var cartID = this.id;
            var quantity = $('.getQuantity' + cartID).val();
            if(cartID != "")
            {
                $.ajax({
                    url: '{{url("/update-cart-item-quantity/")}}' + '/' + cartID + '/' + quantity,
                    type: 'get',
                    data: { format: 'json' },
                    dataType: 'json',
                    success: function(data)
                    {
                        alert(data.message);
                        location.reload(true);
                    },
                    error: function(error) {
                        alert("Please we are having issue while updating your item quantity. Check your network/refresh this page !");
                        return;
                    }
                });
            }else{
                alert("Sorry, we cannot update this item now! Try again.");
            }//end if
        });


    });
</script>
@endif
