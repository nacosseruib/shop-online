@if($loadScript == 1)
<script>
    $(document).ready( function(){

        //FUNCTION TO UPDATE IS PRODUCT ONLINE OF OFFLINE
        $('.updateOnlineOfflineProduct').click(function() {
            var getID = this.id;
            var productStatus = $('#productStatusToUpdate' + getID).val();
            if(getID != "")
            {
                $.ajax({
                    url: '{{url("/product/push-online-offline/")}}' + '/' + getID,
                    type: 'get',
                    data: { format: 'json' },
                    dataType: 'json',
                    success: function(data) {
                        if(data == 1)
                        {
                            $('#updateOnlineOfflineProductReplyMessage').html('Update was success. This product is now online');
                        }else{
                            $('#updateOnlineOfflineProductReplyMessage').html('Update was success. This product is now offline');
                        }
                        location.reload(true);
                    },
                    error: function(error) {
                        alert("Please we are having issue getting your collection list. Check your network/refresh this page !");
                    }
                });
            }else{
                $('#updateOnlineOfflineProductReplyMessage').html('Sorry, we cannot update this product now!');
                location.reload(true);
            }//end if
        });

    });
</script>
@endif
