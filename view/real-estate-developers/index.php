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
    <title>Real estate developers in Malaysia | NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Real estate developers"/>
    <meta name="description" content="Real estate developers list in Malaysia. They are developing and selling new property launches. Choose your favourite developer and see their projects. - NewPropertyList.my"/>
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
            <span>Real estate developers list</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="LyContents">
      <div class="MdFTR01TtlBox">
        <h1> Real estate developers list </h1>
      </div>
      <div class="MdFTR02Index">
        <ul>
          <li> <a href="/real-estate-developers/">ALL</a> </li>
<?php
$result = companies_initials_index();
while( $arr = mysql_fetch_array( $result )){
        if( $initials != mb_strtolower($arr['code']) ){
?>
          <li> <a href="/real-estate-developers/<?php echo mb_strtolower($arr['code']);?>"><?php echo strtoupper($arr['code']);?></a> </li>
<?php
        }else{
?>
          <li><?php echo strtoupper($arr['code']);?></li>
<?php
        }
}
?>

        </ul>
      </div>
      <ul class="MdFTR02ParentCellBox">
<?php
$i=0;
$result = companies_developer_index( $initials,$limit,$offset );
while( $arr = mysql_fetch_array( $result )){
        $i++;
        if($i%2!=0){
?>
        <div class="MdFTR02ChildCellGroup">
<?php
}
?>
          <li class="MdFTR02ChildCellBox">
            <a href="/real-estate-developers/<?php echo $arr['code'];?>">
              <div class="MdFTR02ChildImgCell">
                <img alt="" src="/admin/images/companies/<?php echo $arr['logo_image_path'];?>" />
              </div>
              <h2><?php echo $arr['name'];?></h2>
            </a>
            <p><?php echo substr(str_replace("\n","<br />",$arr['body_1']),0,200);?>...</p>
          </li>
<?php
        if($i%2==0 || $i == $row_num ){
?>
        </div>
<?php
        }
}
?>
      </ul>
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
