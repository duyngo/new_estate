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
    <link rel="canonical" href="http://newpropertylist.my/archive/">
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
      <div id="acMenu" class="mdSAC03IconBox">
        <div id="icn" class="mdSAC03Icon"><img src="/assets/img/md_howto_search.png" alt="" class="center"><span>Filters</span></div>
        <div id="acMenu" class="Wrap95">
          <form>

<?php
if( $states_code != "all-state" || ( $row_num_pager > 1 && $states_code == "all-state" && count($states_id_arr) > 1) ){
?>
            <h4>State
              <ul class="ul chkbox">
<?php
$i=0;
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
        $display_flag = "off";
        foreach( $states_id_arr as $key ){
                if( $arr['id'] == $key ){
                        $display_flag = "on";
                }
        }
        if( $display_flag == "off" ){
                continue;
        }
        $i++;
        if( $arr['code'] != $states_code ){
                $url = "/archive/" . $arr['code'] . "/";
                if(!empty($property_type_groups_code)){
                        $url .= "new-" . $property_type_groups_code . "-for-sale";
                }
                if(!empty($prices_code)){
                        if(!empty($property_type_groups_code)){
                                $url .= "_";
                        }
                        $url .= $prices_code;
                }
                if(!empty($sizes_code)){
                        if(!empty($property_type_groups_code)||!empty($prices_code)){
                                $url .= "_";
                        }
                        $url .= $sizes_code;
                }
                if(!empty($bedrooms_code)){
                        if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
                                $url .= "_";
                        }
                        $url .= $bedrooms_code;
                }
                if(!empty($completion_years_code)){
                        if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
                                $url .= "_";
                        }
                        $url .= $completion_years_code;
                }
        }else{
                $url = "/archive/";
                if(!empty($property_type_groups_code)){
                        $url .= "new-" . $property_type_groups_code . "-for-sale";
                }
                if(!empty($prices_code)){
                        if(!empty($property_type_groups_code)){
                                $url .= "_";
                        }
                        $url .= $prices_code;
                }
                if(!empty($sizes_code)){
                        if(!empty($property_type_groups_code)||!empty($prices_code)){
                                $url .= "_";
                        }
                        $url .= $sizes_code;
                }
                if(!empty($bedrooms_code)){
                        if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)){
                                $url .= "_";
                        }
                        $url .= $bedrooms_code;
                }
                if(!empty($completion_years_code)){
                        if(!empty($property_type_groups_code)||!empty($prices_code)||!empty($sizes_code)||!empty($bedrooms_code)){
                                $url .= "_";
                        }
                        $url .= $completion_years_code;
                }
        }
?>
                <li>
                  <input type="checkbox" name="name1" id="Area<?php echo $i;?>" value="<?php echo $url;?>" onChange="location.href=value;" <?php if( $arr['code'] == $states_code ){ echo "checked"; } ?>>
                  <label for="Area<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>

              </ul>
            </h4>
<?php
}
?>

          </form>
        </div>
      </div>
      <div class="mdSAC01Ttl">
        <h1 class="TtlCenter"><?php echo $row_num_pager;?> <span>launch Condominiums sale</span></h1>
      </div>
      <div class="mdSAC02Wrap Wrap95">

<?php
$i=0;
while( $arr = mysql_fetch_array( $result_main )){
	$i++;
	if( $i%2 != 0 ){
?>
        <div class="mdSAC02ListGroups">
<?php
	}
?>

          <div class="mdSAC02ListItem"><a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>"><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" alt=""></a>
            <h2><?php echo $arr['name'];?></h2>
            <p class="Gold"><?php echo $arr['price_name'];?></p>
          </div>

<?php
	if($i%2==0 || $i == $row_num ){
?>
        </div>
<?php
	}
}
?>

<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/pager.php";
?>
      </div>
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>
  </body>
</html>
