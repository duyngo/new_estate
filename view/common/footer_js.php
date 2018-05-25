<script language="Javascript">
<!--
function ajax_cart_num(listings_id,mode){
        $.ajax({
                type: "POST",
                url: "/ajax/cart_num.php",
                data:{
                        listings_id:listings_id,
                        mode:mode,
                },
                cache: false,
                success: function(html){
                        $(".cart").html(html);
                }
        });
}
//-->
</script>
<script type="text/javascript">
$(document).ready(function(){
        ajax_cart_num(NULL,init);
});
</script>
<script language="Javascript">
<!--
function ajax_cart_num2(listings_id,mode){
        $.ajax({
                type: "POST",
                url: "/ajax/pc_footer.php",
                data:{
                        listings_id:listings_id,
                        mode:mode,
                },
                cache: false,
                success: function(html){
                        $(".cart_footer").html(html);
                }
        });
}
//-->
</script>
<script type="text/javascript">
$(document).ready(function(){
        ajax_cart_num2(NULL,init);
});
</script>
