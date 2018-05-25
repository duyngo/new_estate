<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $keywords;?>"/>
    <meta name="description" content="<?php echo $description;?>"/>
    <meta name="robots" content="<?php echo $robots;?>" />
    <link rel="canonical" href="http://<?php echo $_SERVER['SERVER_NAME'];?><?php echo str_replace("/sp","",$_SERVER['REQUEST_URI']);?>">
    <link rel="stylesheet" href="//npmcdn.com/flickity@1.1/dist/flickity.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/css/drawer.min.css">
    <link rel="stylesheet" href="/assets/css/remodal-default-theme.css">
    <link rel="stylesheet" href="/assets/css/remodal.css">
    <link rel="stylesheet" href="/assets/css/sp.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//npmcdn.com/flickity@1.1/dist/flickity.pkgd.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/js/drawer.min.js"></script>
    <script src="/assets/js/remodal.min.js"></script>
    <script src="/assets/js/sp.js"></script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '895744797210221');
fbq('track', "PageView");

</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=895744797210221&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
  </head>
  <body<?php if(empty($_SESSION['modal'])){ echo " onload=\"modal()\"";}?>>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64858864-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/header.php";
?>
    <article>
      <div data-remodal-id="modal" class="remodal">
        <h1>Welcome to NewPropertyList.my!</h1>
        <p>We're providing New Property Project only. For Living or Investment? Search Now and then Send Enquiry!</p><img src="/assets/img/top_steps.png" alt=""><a href="#" class="remodal-close">Close</a>
      </div>
      <div class="mdSAC01Ttl">
        <h1 class="TtlCenter"><?php echo $h1;?></h1>
      </div>
      <div id="acMenu" class="mdSAC03IconBox">
        <div id="icn" class="mdSAC03Icon"><img src="/assets/img/md_howto_search.png" alt="" class="center"><span>Filter your results</span></div>
        <div id="acMenu" class="Wrap95">
          <form method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
           <div class="states"></div>
           <div class="groups"></div>
           <!--div class="locations"></div-->
           <div class="property_type_groups"></div>
           <div class="prices"></div>

            <button class="GoldBtn center">submit</button>

           <div class="tenures"></div>
           <div class="completion_years"></div>
           <div class="bedrooms"></div>
           <div class="sizes"></div>


            <button class="GoldBtn center">submit</button>
            <input type="hidden" name="act" value="src">
          </form>
        </div>
      </div>
      <div class="mdSAC02Wrap Wrap95">
<?php
while( $arr = mysql_fetch_array( $result_main )){
        if(strlen($arr['name'])>18){
                $name = substr($arr['name'],0,18) . "...";
        }else{
                $name = $arr['name'];
        }
        if(empty($arr['price_name'])){
                $price_name = "Please Ask";
        }else{
		$price_name = $arr['price_name'];
	}
?>
        <div class="mdSAC02ListItem"><a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>" ><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" alt=""></a>
          <h2><?php echo $arr['name'];?></h2>
          <p class="Gold"><?php echo $price_name;?></p>
          <p class="Gold"><?php echo $arr['property_name'];?></p>
          <p class="Gray"><?php echo $arr['address'];?></p>
          <div class="div_<?php echo $arr['id'];?>"></div>
        </div>
<?php
}
?>

	      <div class="data"></div>
      </div>
      <div class="mdSAC04EnquiryBox">
       <div class="cart_footer">
        <p><?php echo $fav_num;?> Enquiry Collection</p>
         <a href="/sp/enquiry/collection"><button>Send Enquiry</button></a>
       </div>
      </div>
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>




<script language="Javascript">
<!--
function ajax_states(mode,states_id){
        $.ajax({
                type: "POST",
                url: "/ajax/states.php",
                data:{
                        mode:mode,
                        states_id:states_id,
                },
                cache: false,
                success: function(html){
                        $(".states").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_groups(mode,groups_id){
        $.ajax({
                type: "POST",
                url: "/ajax/groups.php",
                data:{
                        mode:mode,
                        groups_id:groups_id,
                },
                cache: false,
                success: function(html){
                        $(".groups").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_locations(mode,locations_id){
        $.ajax({
                type: "POST",
                url: "/ajax/locations.php",
                data:{
                        mode:mode,
                        locations_id:locations_id,
                },
                cache: false,
                success: function(html){
                        $(".locations").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_property_type_groups(mode,property_type_groups_id){
        $.ajax({
                type: "POST",
                url: "/ajax/property_type_groups.php",
                data:{
                        mode:mode,
                        property_type_groups_id:property_type_groups_id,
                },
                cache: false,
                success: function(html){
                        $(".property_type_groups").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_completion_years(mode,completion_years_id){
        $.ajax({
                type: "POST",
                url: "/ajax/completion_years.php",
                data:{
                        mode:mode,
                        completion_years_id:completion_years_id,
                },
                cache: false,
                success: function(html){
                        $(".completion_years").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_prices(mode,prices_id){
        $.ajax({
                type: "POST",
                url: "/ajax/prices.php",
                data:{
                        mode:mode,
                        prices_id:prices_id,
                },
                cache: false,
                success: function(html){
                        $(".prices").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_bedrooms(mode,bedrooms_id){
        $.ajax({
                type: "POST",
                url: "/ajax/bedrooms.php",
                data:{
                        mode:mode,
                        bedrooms_id:bedrooms_id,
                },
                cache: false,
                success: function(html){
                        $(".bedrooms").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_sizes(mode,sizes_id){
        $.ajax({
                type: "POST",
                url: "/ajax/sizes.php",
                data:{
                        mode:mode,
                        sizes_id:sizes_id,
                },
                cache: false,
                success: function(html){
                        $(".sizes").html(html);
                }
        });
}
//-->
</script>
<script language="Javascript">
<!--
function ajax_tenures(mode,tenures_id){
        $.ajax({
                type: "POST",
                url: "/ajax/tenures.php",
                data:{
                        mode:mode,
                        tenures_id:tenures_id,
                },
                cache: false,
                success: function(html){
                        $(".tenures").html(html);
                }
        });
}
//-->
</script>
<script type="text/javascript">
$(document).ready(function(){
        ajax_states("init","<?php echo $states_id;?>");
        ajax_groups("init","<?php echo $groups_id;?>");
        ajax_locations("init","<?php echo $locations_id;?>");
        ajax_property_type_groups("init","<?php echo $property_type_groups_id;?>");
        ajax_completion_years("init","<?php echo $completion_years_id;?>");
        ajax_prices("init","<?php echo $prices_id;?>");
        ajax_bedrooms("init","<?php echo $bedrooms_id;?>");
        ajax_sizes("init","<?php echo $sizes_id;?>");
        ajax_tenures("init","<?php echo $tenures_id;?>");
});
</script>






<?php
while( $arr = mysql_fetch_array( $result_ajax )){
?>

<script language="Javascript">
<!--
function ajax_<?php echo $arr['id'];?>(listings_id,mode){
        ajax_cart_num(listings_id,mode);
        ajax_cart_num2(listings_id,mode);
        $.ajax({
                type: "POST",
                url: "/ajax/cart.php",
                data:{
                        listings_id:listings_id,
                        mode:mode,
                },
                cache: false,
                success: function(html){
                        $(".div_<?php echo $arr['id'];?>").html(html);
                }
        });
}
//-->
</script>

<script type="text/javascript">
$(document).ready(function(){
        ajax_<?php echo $arr['id'];?>(<?php echo $arr['id'];?>,"init");
});
</script>

<?php
}
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer_js.php";
?>


<?php
//未使用ここから
$tables_array = array("states","groups","locations","property_type_groups","completion_years","tenures","prices","bedrooms","sizes");
foreach( $tables_array as $tables_name ){
?>
        <script type="text/javascript">
        jQuery(function($){
            $(function(){
              $('.<?php echo $tables_name;?>').on('click', function() {
                if ($(this).prop('checked')){
                    // 一旦全てをクリアして再チェックする
                    $('.<?php echo $tables_name;?>').prop('checked', false);
                    $(this).prop('checked', true);
                }
              });
            });
        });
        </script>
<?php
}
//未使用ここまで
?>

<script type="text/javascript">
function modal() {
  var inst = $('[data-remodal-id=modal]').remodal();
  inst.open();
  console.log('Modal is opened');
}
</script>

<script src="/assets/js/jquery.bottom-1.0.js"></script>
<script>
$(function ()
{
  var page = 0; //ページ番号
  var end_flag = 0; //最後のページまでいったら1にして次から読み込ませない
  $(window).bottom({proximity: 0.1}); //proximityを0.5にするとページの50％までスクロールするとloadingがはじまる
  $(window).bind("bottom", function() {
 
    if(end_flag==0){ //ページが最後までいってなければ
 
      var obj = $(this);
  
        if (!obj.data("loading")) {
  
          obj.data("loading", true);
  
          $('.loading').append('loading...'); //画面にloading...と表示
  
          setTimeout(function() {
 
            $.ajax('/ajax/data.php', { //data.phpが実際に表示するデータを読み込むファイル
               method: 'GET',
               data:{page:++page},
               error: function(xhr, error) {
                console.log('失敗しました');
                console.log(error);
               },
               success: function(response) {
                  $(".loading").empty(); //画面に出ているloading...を空にする
                  if(response!="end"){
                    $(".data").append(response); //コンテンツを追加
                  }else{
                    end_flag=1;
                  }
               } //success
            }); //ajax
 
            obj.data("loading", false);
          }, 1000);
        }
 
      } //end_flag
  });
 
});
</script>




  </body>
</html>
<?php
$_SESSION['modal'] = "done";
?>
