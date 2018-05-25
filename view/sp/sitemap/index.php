<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Site map of NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Site map"/>
    <meta name="description" content="Site map of NewPropertyList.my is here."/>
    <link rel="canonical" href="http://newpropertylist.my/sitemap/">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.1.2/flickity.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/css/drawer.min.css">
    <link rel="stylesheet" href="/assets/css/sp.css" media="screen" title="no title" charset="utf-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
      <div class="mdSTA02Wrap Wrap95">
	<h1>Site map</h1>
	<div class="mdSTA02ItemGroup">
	  <h2>Find by Area</h2>
<?php
$result = states_index("");
while( $arr = mysql_fetch_array( $result )){
	if(!$arr['listings_num']){
		continue;
	}
?>
	  <h3><a href="/<?php echo $arr['code'];?>/"><?php echo $arr['name'];?></a></h3>
<?php
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],"","",$arr_p['id'],"","","","","","","");
		if(mysql_num_rows($result_tmp)){
?>
		  <p><a href="/<?php echo $arr['code'];?>/new-<?php echo $arr_p['code'];?>-for-sale"><?php echo $arr_p['name'] . " in " . $arr['name'];?></a></p>
<?php
		}
	}
	$result_tmp = listings_index("",$arr['id'],"","","","","",$completion_years_id,"","","","");
	if(mysql_num_rows($result_tmp)){
?>
		  <p><a href="/<?php echo $arr['code'];?>/complete-<?php echo date("Y");?>">New launch in <?php echo $arr['name'] . " " . date("Y");?></a></p>
<?php
	}
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],"","",$arr_p['id'],"","",$completion_years_id,"","","","");
		if(mysql_num_rows($result_tmp)){
?>
		  <p><a href="/<?php echo $arr['code'];?>/new-<?php echo $arr_p['code'];?>-for-sale_complete-<?php echo date("Y");?>">New <?php echo $arr_p['name'] . " launch in " . $arr['name'] . " " . date("Y");?></a></p>
<?php
		}
	}
	$result_g = groups_index($arr['id']);
	$row_num_g = mysql_num_rows( $result_g );
	while( $arr_g = mysql_fetch_array( $result_g )){
		if(!$arr_g['listings_num']){
			continue;
		}
?>
		  <p><a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>"><?php echo $arr_g['name'];?></a></p>

<?php
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],$arr_g['id'],"",$arr_p['id'],"","","","","","","");
		if(mysql_num_rows($result_tmp)){
?>
		  <p><a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>_new-<?php echo $arr_p['code'];?>-for-sale"><?php echo $arr_p['name'] . " in " . $arr_g['name'];?></a></p>
<?php
		}
	}
	$result_tmp = listings_index("",$arr['id'],$arr_g['id'],"","","","",$completion_years_id,"","","","");
	if(mysql_num_rows($result_tmp)){
?>
		  <p><a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>_complete-<?php echo date("Y");?>">New launch in <?php echo $arr_g['name'] . " " . date("Y");?></a></p>
<?php
	}
	$result_p = property_type_groups_index();
	while( $arr_p = mysql_fetch_array( $result_p )){
		$result_tmp = listings_index("",$arr['id'],$arr_g['id'],"",$arr_p['id'],"","",$completion_years_id,"","","","");
			if(mysql_num_rows($result_tmp)){
?>
		  <p><a href="/<?php echo $arr['code'];?>/<?php echo $arr_g['code'];?>_new-<?php echo $arr_p['code'];?>-for-sale_complete-<?php echo date("Y");?>">New <?php echo $arr_p['name'] . " launch in " . $arr_g['name'] . " " . date("Y");?></a></p>
<?php
			}
		}
	}
?>
<?php
}
?>
	</div>
	<div class="mdSTA02ItemGroup">
	  <h2>Find by Property types</h2>
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
	  <h3><a href="/all-state/new-<?php echo $arr['code'];?>-for-sale"><?php echo $arr['name'];?></a></h3>
<?php
        $result_tmp = listings_index("","","","",$arr['id'],"","",$completion_years_id,"","","","");
        if(mysql_num_rows($result_tmp)){
?>
	  <p class="p"><a href="/all-state/new-<?php echo $arr['code'];?>-for-sale_complete-<?php echo date("Y");?>">New <?php echo $arr['name'];?> launch <?php echo date("Y");?></a></p>
<?php
	}
}
?>
	</div>
	<div class="mdSTA02ItemGroup">
	  <h2>Find by Prices</h2>
<?php
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
        if(!$arr['listings_num']){
                continue;
        }
?>
	  <h3><a href="/all-state/<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a></h3>
<?php
}
?>
	</div>
        <div class="mdSTA02ItemGroup">
          <h2>Find by Features</h2>
          <h3><a href="/features/">See the list</a></h3>
        </div>
        <div class="mdSTA02ItemGroup">
          <h2>Find by Developers</h2>
          <h3><a href="/real-estate-developers/">See the list</a></h3>
        </div>
        <div class="mdSTA02ItemGroup">
          <h2>Hot Searches</h2>
          <h3><a href="/all-state/complete-2016">2016 Launch</a></h3>
          <h3><a href="/features/klang-valley">Klang Valley</a></h3>
          <h3><a href="/all-state/">All</a></h3>
        </div>
        <div class="mdSTA02ItemGroup">
          <h2>Others</h2>
          <h3><a href="/signin/">Sign in/Sign up</a></h3>
          <h3><a href="/terms/">Terms of conditions</a></h3>
          <h3><a href="/privacy/">Privacy Policy</a></h3>
          <h3><a href="/disclaimers/">Disclaimers</a></h3>
        </div>


      </div>
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>
  </body>
</html>
