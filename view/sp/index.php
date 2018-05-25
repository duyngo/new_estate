<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>NewPropertyList.my: Malaysia new property portal</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale"/>
    <meta name="description" content="Search new property launches for sale in Malaysia. Find your next home by area, property types, number of bedrooms, size, prices and completion year on NewPropertyList.my"/>
    <link rel="canonical" href="http://newpropertylist.my/">
    <!--link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.1.2/flickity.min.css"-->
    <link rel="stylesheet" href="//npmcdn.com/flickity@1.1/dist/flickity.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/css/drawer.min.css">
    <link rel="stylesheet" href="/assets/css/sp.css" media="screen" title="no title" charset="utf-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--script src="//npmcdn.com/flickity@1.1/dist/flickity.pkgd.min.js"></script-->
    <script src="//npmcdn.com/flickity@1.1/dist/flickity.pkgd.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/iScroll/5.1.3/iscroll.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/js/drawer.min.js"></script>
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
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/header.php";
?>
    <article>
      <div class="mdTOP01Wrap">
        <div class="mdTOP01SecItem">
          <h1>New life at New Property</h1>
          <p>Looking for New Property in Malaysia?</p>
        </div>
      </div>
      <div class="mdTOP02Wrap Wrap95">
        <h2 class="TtlCenter">You can use only 3steps</h2><img src="/assets/img/top_steps.png" alt=""><a href="/all-state/" class="a">
          <button type="button" class="mdTOP02Btn GoldBtn">Search Now</button></a>
      </div>
      <div class="mdTOP03Wrap Wrap95">
        <h2 class="TtlCenter">Recommend Properties</h2>
        <ul class="mdTOP03ItemBox main-gallery">
<?php
$result = listings_top_index();
while( $arr = mysql_fetch_array( $result )){
?>
          <li class="mdTOP03SecItem gallery-cell"><a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" alt="<?php echo $arr['name'];?>" class="mdTOP03Img"></a>
            <h3 class="Gray"><?php echo $arr['name'];?></h3>
            <p class="Gold"><?php echo str_replace("\n","<br />",$arr['price_name']);?></p>
            <p class="Gray"><?php echo $arr['address'];?></p>
          </li>
<?php
}
?>
        </ul>
      </div>
      <div class="mdTOP04Wrap Wrap95">
        <h2 class="TtlCenter">Search by Area</h2>
        <ul class="ul">
<?php
$i=0;
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
        $i++;
?>
          <li class="li mdTOP04ItemBox"><a href="/<?php echo $arr['code'];?>"><img src="/admin/images/states/<?php echo $arr['image_path'];?>" alt="<?php echo $arr['name'];?>" class="center"><p><?php echo $arr['name'];?></p></a></li>
<?php
        if( $i == 4 ){
                break;
        }
}
?>
        </ul><a href="/areas/" class="a">
          <button type="button" class="mdTOP04Btn GoldBtn center">See All Area </button></a>
      </div>
      <div class="mdTOP04Wrap Wrap95">
        <h2 class="TtlCenter">Search by Developers</h2>
        <ul class="ul">
<?php
$i=0;
$result = companies_index("on");
while( $arr = mysql_fetch_array( $result )){
	$i++;
?>
          <li class="li mdTOP04ItemBox"><a href="/real-estate-developers/<?php echo $arr['code'];?>"><img src="/admin/images/companies/<?php echo $arr['logo_image_path'];?>" alt="<?php echo $arr['name'];?>" class="center"></a></li>
<?php
	if($i==4){
		break;
	}
}
?>
        </ul><a href="/real-estate-developers/" class="a">
          <button type="button" class="mdTOP04Btn GoldBtn center">See All Developers</button></a>
      </div>
      <div class="mdTOP05Wrap Wrap95">
        <h2 class="TtlCenter">Recently Search</h2>
        <ul class="ul">
<?php
$i=0;
$rs = explode(",",$_COOKIE['newpropertylist']['RecentSearches']);
foreach( $rs as $key ){
        if( listings_display_check( $key )){
                $i++;
                $listings_code = common_get_value("listings","code",$key,"");
                $result = listings_detail( $listings_code );
                $arr = mysql_fetch_array( $result );
?>
          <li class="li"><a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" alt="<?php echo $arr['name'];?>"></a></li>
<?php
        if( $i == 3 ){
                break;
        }
}
}
?>
        </ul>
      </div>
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>
  </body>
</html>
