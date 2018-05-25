<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <script src="/assets/js/pack.js"></script>
    <script src="/assets/js/npl.js"></script>
    <link href="/assets/css/npl.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/add.css" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Lato&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/assets/img/icon.ico" >
    <link rel="alternate" media="only screen and (max-width:768px)" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/sp<?php echo $_SERVER['REQUEST_URI'];?>">
    <title><?php echo $title;?></title>
    <meta name="keywords" content="<?php echo $keywords;?>"/>
    <meta name="description" content="<?php echo $description;?>"/>
    <meta name="robots" content="<?php echo $robots;?>" />
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
  <body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64858864-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
    <div class="LyWrap">
<?php
include "../../view/common/header.php";
?>
      <div class="MdCMN06Pankuzu">
        <ul class="mdCMN06List01"> <?php echo $bread;?> </ul>
      </div>
      <div class="LyContents">



        <div class="LySide">
          <div class="MdSAC04SideTitle"> <p> Filter your results </p> </div>

<?php
$i=0;
include $_SERVER['BASE_DIR'] . "/view/features/states.php";
include $_SERVER['BASE_DIR'] . "/view/features/groups.php";
include $_SERVER['BASE_DIR'] . "/view/features/locations.php";
include $_SERVER['BASE_DIR'] . "/view/features/property_type_groups.php";
include $_SERVER['BASE_DIR'] . "/view/features/prices.php";
include $_SERVER['BASE_DIR'] . "/view/features/completion_years.php";
include $_SERVER['BASE_DIR'] . "/view/features/bedrooms.php";
include $_SERVER['BASE_DIR'] . "/view/features/sizes.php";
?>

        </div><!--LySide-->


        <div class="LyMain">
          <div class="MdSAC01MainContents">
            <div class="MdFTR02SearchCellBox">
              <div class="MdFTR02ChildImgCell">
                <img alt="" src="/admin/images/features/<?php echo $features_image_path;?>" />
              </div>
              <h1><?php echo $features_name;?></h1>
              <p><?php echo str_replace("\n","<br />",$features_description);?></p>
            </div>

            <!--div class="MdSAC01Filter"></div>
            <div class="MdSAC01Box02">
              <div class="MdSAC01TtlBox">
                <span>Applied filter :</span>
              </div>
              <div class="MdSAC01TagBox">
                <ul class="mdSAC01List01">
<?php
$column_arr = array("states","groups","property_type_groups","prices","sizes","bedrooms","completion_years");
foreach( $column_arr as $column ){
	$url = NULL;
	$code = $column . "_code";
	$name = $column . "_name";
	if( !empty( $$code ) && !( $column == "states" && $states_code == "all-state" )){
		$url = listings_get_url( $column,$states_code,$groups_code,$property_type_groups_code,$prices_code,$sizes_code,$bedrooms_code,$completion_years_code );
?>
                  <li class="mdSAC01Cell01"> <a href="<?php echo $url;?>"><span><?php echo $$name;?></span></a> </li>
<?php
	}
}
?>
                </ul>
              </div>
            </div-->
          </div>
          <div class="MdSAC02List01">
            <ul>
<?php
$i=0;
while( $arr = mysql_fetch_array( $result_main )){
	$i++;
	if($i%2!=0){
?>
              <div class="MdSAC02CellWrap01">
<?php
	}
?>
              <li class="MdSAC02Cell01">
                <div class="mdSAC02Img01">
                  <a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>" target="_blank"><img alt="" src="/admin/images/listings/<?php echo $arr['main_picture'];?>" /></a>
                </div>
<div class="mdSAC02Txth">
                <div class="mdSAC02Ttl01">
                  <a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>" target="_blank"><span><?php echo $arr['name'];?></span></a>
                </div>
                <div class="mdSAC02Txt01"><?php echo $arr['price_name'];?></div>
                <div class="mdSAC02Txt01"><?php echo $arr['property_name'];?></div>
                <div class="mdSAC02Txt02"><?php echo $arr['address'];?></div>
</div>
                <!--div class="div_<?php echo $arr['id'];?>" ></div-->
              </li>
<?php
	if($i%2==0||$i==$row_num){
?>
              </div>
<?php
	}
}
?>
            </ul>
          </div>
          <div class="MdSAC03Pager">
            <div class="MdSAC03PagerBox">
              <ul class="MdSAC03List01">
<?php
include "../../view/common/pager.php";
?>
              </ul>
            </div>
          </div>
        </div>


      </div>
<?php
if(!empty($groups_code)){
        if(!empty($groups_description)){
?>
      <div class="MdSAC07ExplainBox">
        <div class="mdSAC07Ttl01">Area guides in <?php echo $groups_name . "," . $states_name;?></div>
        <div class="mdSAC07Txt01"><?php echo str_replace("\n","<br />",$groups_description);?></div>
      </div>
<?php
        }
}else if(!empty($states_code) && $states_code != "all-state" ){
        if(!empty($states_description)){
?>
      <div class="MdSAC07ExplainBox">
        <div class="mdSAC07Ttl01">Area guides in <?php echo $states_name . ", Malaysia";?></div>
        <div class="mdSAC07Txt01"><?php echo str_replace("\n","<br />",$states_description);?></div>
      </div>
<?php
        }
}
?>

      <div class="cart_footer"></div>

<?php
include "../../view/common/footer.php";
?>
    </div>

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
                url: "/ajax/cart_pc.php",
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
include $_SERVER['BASE_DIR'] . "/view/common/footer_js.php";
?>

  </body>
</html>
