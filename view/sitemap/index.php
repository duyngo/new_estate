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
    <title>Site map of NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Site map"/>
    <meta name="description" content="Site map of NewPropertyList.my is here."/>
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
            <a href="#"><span>NewPropertyList top</span></a>
          </li>
          <li class="mdCMN06Cell01">
            <span>Site map</span>
          </li>
        </ul>
      </div>
      <div class="LyContents">
        <div class="MdSTA03TtlBox">
          <h1>
            Site map
          </h1>
        </div>
        <div class="MdSTA03MapBox">
          <h2>
            Find by Area
          </h2>
<?php
$result = states_index("");
while( $arr = mysql_fetch_array( $result )){
	if(!$arr['listings_num']){
		continue;
	}
?>
          <dl>
            <dt>
              <a href="/<?php echo $arr['code'];?>/"><?php echo $arr['name'];?></a>
            </dt>

            <div class="MdSTA03WrapBox">
              <dd>
                <a href=""></a>
                <ul>

<?php
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],"","",$arr_p['id'],"","","","","","","");
		if(mysql_num_rows($result_tmp)){
?>
                  <a href="/<?php echo $arr['code'];?>/new-<?php echo $arr_p['code'];?>-for-sale"> <li><?php echo $arr_p['name'] . " in " . $arr['name'];?></li></a>
<?php
		}
	}
	$result_tmp = listings_index("",$arr['id'],"","","","","",$completion_years_id,"","","","");
	if(mysql_num_rows($result_tmp)){
?>
                  <a href="/<?php echo $arr['code'];?>/complete-<?php echo date("Y");?>"> <li>New launch in <?php echo $arr['name'] . " " . date("Y");?></li></a>

<?php
	}
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],"","",$arr_p['id'],"","",$completion_years_id,"","","","");
		if(mysql_num_rows($result_tmp)){
?>
                  <a href="/<?php echo $arr['code'];?>/new-<?php echo $arr_p['code'];?>-for-sale_complete-<?php echo date("Y");?>"> <li>New <?php echo $arr_p['name'] . " launch in " . $arr['name'] . " " . date("Y");?></li></a>
<?php
		}
	}
?>
                </ul>
              </dd>
<?php
$i=0;
$result_g = groups_index($arr['id']);
$row_num_g = mysql_num_rows( $result_g );
while( $arr_g = mysql_fetch_array( $result_g )){
	if(!$arr_g['listings_num']){
		continue;
	}
	$i++;
	if( $i%2 == 0 ){
?>
            <div class="MdSTA03WrapBox">
<?php
	}
?>
              <dd>
                <a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>"><?php echo $arr_g['name'];?></a>
                <ul>
<?php
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],$arr_g['id'],"",$arr_p['id'],"","","","","","","");
		if(mysql_num_rows($result_tmp)){
?>
                  <a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>_new-<?php echo $arr_p['code'];?>-for-sale"> <li><?php echo $arr_p['name'] . " in " . $arr_g['name'];?></li></a>
<?php
		}
	}
	$result_tmp = listings_index("",$arr['id'],$arr_g['id'],"","","","",$completion_years_id,"","","","");
	if(mysql_num_rows($result_tmp)){
?>
                  <a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>_complete-<?php echo date("Y");?>"> <li>New launch in <?php echo $arr_g['name'] . " " . date("Y");?></li></a>

<?php
	}
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],$arr_g['id'],"",$arr_p['id'],"","",$completion_years_id,"","","","");
		if(mysql_num_rows($result_tmp)){
?>
                  <a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>_new-<?php echo $arr_p['code'];?>-for-sale_complete-<?php echo date("Y");?>"> <li>New <?php echo $arr_p['name'] . " launch in " . $arr_g['name'] . " " . date("Y");?></li></a>
<?php
		}
	}
?>
                </ul>
              </dd>
<?php
		if( $i%2 != 0 || $i == $row_num_g ){
?>
            </div>
<?php
		}
	}
?>
          </dl>
<?php
}
?>
        </div>





        <div class="MdSTA03MapBox">
          <h2>
            Find by Property types
          </h2>
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
          <dl>
            <dt> <a href="/all-state/new-<?php echo $arr['code'];?>-for-sale"><?php echo $arr['name'];?></a> </dt>
            <div class="MdSTA03WrapBox">
              <dd>
<?php
	$result_tmp = listings_index("","","","",$arr['id'],"","",$completion_years_id,"","","","");
	if(mysql_num_rows($result_tmp)){
?>
                <a href="/all-state/new-<?php echo $arr['code'];?>-for-sale_complete-<?php echo date("Y");?>">New <?php echo $arr['name'];?> launch <?php echo date("Y");?></a>
<?php
	}
?>
              </dd>
            </div>
          </dl>
<?php
}
?>
        </div>


        <div class="MdSTA03MapBox">
          <h2>Find by Prices</h2>
<?php
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
	if(!$arr['listings_num']){
		continue;
	}
?>
          <dl>
            <dt> <a href="/all-state/<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
<?php
}
?>
        </div><!-- MdSTA03MapBox -->



        <div class="MdSTA03MapBox">
          <h2>Find by Features</h2>
          <dl>
            <dt> <a href="/features/">See the list</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
        </div><!-- MdSTA03MapBox -->

        <div class="MdSTA03MapBox">
          <h2>Find by Developers</h2>
          <dl>
            <dt> <a href="/real-estate-developers/">See the list</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
        </div><!-- MdSTA03MapBox -->

        <div class="MdSTA03MapBox">
          <h2>Hot Searches</h2>
          <dl>
            <dt> <a href="/all-state/complete-2016">2016 Launch</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
          <dl>
            <dt> <a href="/features/klang-valley">Klang Valley</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
          <dl>
            <dt> <a href="/all-state/">All</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
        </div><!-- MdSTA03MapBox -->

        <div class="MdSTA03MapBox">
          <h2>Others</h2>
          <dl>
            <dt> <a href="/signin/">Sign in/Sign up</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
          <dl>
            <dt> <a href="/terms/">Terms of conditions</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
          <dl>
            <dt> <a href="/privacy/">Privacy Policy</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
          <dl>
            <dt> <a href="/disclaimers/">Disclaimers</a> </dt>
            <div class="MdSTA03WrapBox">
              <dd> <a href="#"></a> </dd>
            </div>
          </dl>
        </div><!-- MdSTA03MapBox -->




      </div>
    </div>
<?php
include "../../view/common/footer.php";
?>
    </div>
  </body>
</html>
