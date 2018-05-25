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
    <title>Enquiry collection - NewPropertyList.my</title>
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
  <body class="ExContactTop">
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
include "../../view/common/header.php";
?>
        <div class="LyContents" id="FnContents">
          <div class="MdCNT01TtlBox">
            <div class="MdCNT01LeftBox">
              <h2>
                Enquiry collection
              </h2>
              <p>
                Send enquiry and meet developers directly.
              </p>
            </div>
            <div class="MdCNT01RightBox">
              <img src="/assets/img/md_contact_flow1.png" />
            </div>
          </div>
          <div class="LyMain02">
            <div class="MdCNT02ListBox">
              <ul class="mdCNT02List01">
<?php
while( $arr = mysql_fetch_array( $result )){
?>
                <li class="mdCNT02Cell01">
                  <div class="mdCNT02Img01">
                    <a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" /></a>
                  </div>
                  <div class="mdCNT02TxtBox">
                    <div class="mdCNT02Txt01"><a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><?php echo $arr['name'];?></a> </div>
                    <div class="mdCNT02Txt02"><?php echo $arr['price_name'];?></div>
                    <div class="mdCNT02Txt03"><?php echo $arr['address'];?></div>
                  </div>
                  <div class="mdCNT02Btn01">
                    <a href="/enquiry/delete/<?php echo $arr['id'];?>">Delete</a>
                  </div>
                </li>
<?php
}
?>
              </ul>
            </div>
          </div>
          <div class="LySide02" id="FnSide">
            <div class="lySideWrap" id="FnSideWrap">
              <div class="MdCNT03SideBox">
                <div class="mdCNT03Ttl01"><?php echo $fav_num;?></div>
                <div class="mdCNT03Txt01">
                  Enquiry collection
                </div>
                <div class="mdCNT03Box01">
                  <a href="/enquiry/input"><span>Proceed to Enquiry</span></a>
                </div>
                <div class="mdCNT03Txt02">
                  <a href="<?php echo $_SESSION['continue_to_search'];?>">Continue to search</a>
                </div>
              </div>
              <!--div class="MdDTL09SideTitle">
                <span>Recent Searches (<?php echo $rs_num;?>)</span>
              </div>
              <div class="MdDTL10SideListBox">
<?php
$i=0;
$tmp_arr = explode(",",$_COOKIE['newpropertylist']['RecentSearches']);
foreach( $tmp_arr as $key ){
        if( listings_display_check( $key )){
                $i++;
                $listings_code = common_get_value("listings","code",$key,"");
                $result_rs = listings_detail( $listings_code );
                $arr_rs = mysql_fetch_array( $result_rs );
?>
                <dl class="mdDTL10List01">
                  <dt class="mdDTL10Cell01">
                    <a href="/<?php echo $arr_rs['states_code'];?>/<?php echo $arr_rs['code'];?>-in-<?php echo $arr_rs['locations_code'];?>"><img src="/admin/images/listings/sq_<?php echo $arr_rs['main_picture'];?>" /></a>
                  </dt>
                  <dd class="mdDTL10Cell02">
                    <div class="mdDTL10Ttl01">
                      <a href="/<?php echo $arr_rs['states_code'];?>/<?php echo $arr_rs['code'];?>-in-<?php echo $arr_rs['locations_code'];?>"><?php echo $arr_rs['name'];?></a>
                    </div>
                    <div class="mdDTL10Txt01">
                      <a href="/<?php echo $arr_rs['states_code'];?>/<?php echo $arr_rs['code'];?>-in-<?php echo $arr_rs['locations_code'];?>"><?php echo $arr_rs['price_name'];?></a>
                    </div>
                  </dd>
                </dl>
<?php
                if($i==5){
                        break;
                }
        }
}
?>
                <div class="mdDTL10Link">
                  <a href="#">See the list</a>
                </div>
              </div-->
            </div>
          </div>
        </div>
        <div class="LyFoot">
          <div class="MdGFT03FootBox01">
            <div class="MdGFT03InnerBox01">
              <div class="mdGFT03Company">
                Samurai internet
              </div>
              <div class="mdGFT03Copyright">
               &copy;    2015-2016 / <a href="http://samurai-internet.com/" target="_blank">Samurai Internet Sdn Bhd</a> / All Rights Reserved.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
