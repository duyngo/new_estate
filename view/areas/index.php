<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <script src="/assets/js/pack.js"></script>
    <script src="/assets/js/npl.js"></script>
    <link href="/assets/css/npl.css" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Lato&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/assets/img/icon.ico" >
    <link rel="alternate" media="only screen and (max-width:768px)" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/sp<?php echo $_SERVER['REQUEST_URI'];?>">
    <title>Find your new property for sale by Areas | NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Find by Areas"/>
    <meta name="description" content="Are you looking for new house in Malaysia? You can find new property for Sale by Areas - NewPropertyList.my"/>
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
        <ul class="mdCMN06List01">
          <li class="mdCMN06Cell01">
            <a href="/"><span>NewPropertyList top</span></a>
          </li>
          <li class="mdCMN06Cell01">
            <span>Area</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="LyContents">
      <div class="MdFTR01TtlBox">
        <h1>Area</h1>
      </div>

<?php
$i=0;
$result = states_index();
$row_num = mysql_num_rows( $result );
while( $arr = mysql_fetch_array( $result )){
	if($arr['listings_num']){
	        $i++;
		if(($i-1)%4==0){
?>
        <div class="MdCMN03List02">
          <ul>
<?php

		}
?>

            <li>
              <div class="mdCMN03Img01">
                <a href="/<?php echo $arr['code'];?>"><img alt="" src="/admin/images/states/<?php echo $arr['image_path'];?>" /></a>
              </div>
              <div class="mdCMN03Txt01">
                <a href="/<?php echo $arr['code'];?>"><?php echo $arr['name'];?> (<?php echo $arr['listings_num'];?>)</a>
              </div>
            </li>

<?php
		if($i%4==0||$i==$row_num){
?>
          </ul>
        </div><!--MdCMN03List02-->
<?php
		}
	}
}
?>




      <div class="MdFTR03RcheckBox">
        <h4>
          Recently check property
        </h4>
        <div class="MdFTR03RcheckImgBody">
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
          <div class="MdFTR03RcheckImgChild">
            <a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><img alt="" src="/admin/images/listings/sq_<?php echo $arr['main_picture'];?>" /></a>
          </div>
<?php
		if( $i == 8 ){
			break;
		}
	}
}
?>
        </div>
      </div><!-- MdFTR03RcheckBox -->
    </div>
<?php
include "../../view/common/footer.php";
?>
    </div>
  </body>
</html>
