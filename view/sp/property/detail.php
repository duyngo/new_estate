<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $arr['name'];?> in <?php echo $arr['locations_name'];?> | NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, <?php echo $arr['name'];?>, <?php echo $arr['locations_name'];?>, <?php echo $arr['developer_name'];?>"/>
    <meta name="description" content="New condominium for sale at <?php echo $arr['name'];?> in <?php echo $arr['locations_name'];?>, <?php echo $arr['states_name'];?> by <?php echo $arr['developer_name'];?>.<?php echo $arr['catch_copy'];?>.See the details of <?php echo $arr['name'];?> - NewPropertyList.my"/>
    <link rel="canonical" href="http://<?php echo $_SERVER['SERVER_NAME'];?><?php echo str_replace("/sp","",$_SERVER['REQUEST_URI']);?>">
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

    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <link href="http://fonts.googleapis.com/css?family=Lato&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css" />
    <script>
      function initialize() {
          var myLatlng = new google.maps.LatLng(<?php echo $arr['latitude'];?>,<?php echo $arr['longitude'];?>);
          var myOptions = {
              zoom: 13,
              center: myLatlng,
              scrollwheel: false,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("FnGoogleMap"), myOptions);

          var LatLng1 = new google.maps.LatLng(<?php echo $arr['latitude'];?>,<?php echo $arr['longitude'];?>);
          var image1 = new google.maps.MarkerImage('/img/property/icon1.png',
              new google.maps.Size(39, 68),
              new google.maps.Point(0,0),
              new google.maps.Point(19, 68));
          var infowindow1 = new google.maps.InfoWindow();
          var marker1 = new google.maps.Marker({
              position: LatLng1,
              map: map,
              title: "<?php echo $arr['name'];?>",
              icon: image1,
          });
          google.maps.event.addListener(marker1, "click", function (e) {
          infowindow1.setPosition(e.LatLng1);
          infowindow1.setContent("<?php echo $arr['name'];?>");
          infowindow1.open(map, marker1);
          });
<?php
/*
        $sql3 = "select";
        $sql3 .= " t2.name";
        $sql3 .= ",t2.description";
        $sql3 .= ",t2.latitude";
        $sql3 .= ",t2.longitude";
        $sql3 .= ",t3.image_path";
        $sql3 .= " from";
        $sql3 .= " listings_amenities t1";
        $sql3 .= " left join";
        $sql3 .= " amenities t2";
        $sql3 .= " on";
        $sql3 .= " (t1.amenities_id = t2.id)";
        $sql3 .= " left join";
        $sql3 .= " amenity_categories t3";
        $sql3 .= " on";
        $sql3 .= " (t2.amenity_categories_id = t3.id)";
        $sql3 .= " where";
        $sql3 .= " t1.listings_id = $listings_id";
        $sql3 .= " and";
        $sql3 .= " t1.is_deleted = 0";
        $sql3 .= " order by t1.sort";
        $result3 = mysql_query( $sql3 );
        $row_num3 = mysql_num_rows($result3);
        if($row_num3){
                $i=1;
                while( $arr3 = mysql_fetch_array( $result3 )){
                        $i++;
?>
          var LatLng<?php echo $i;?> = new google.maps.LatLng(<?php echo $arr3['latitude'];?>,<?php echo $arr3['longitude'];?>);
          var image<?php echo $i;?> = new google.maps.MarkerImage('/admin/images/amenity_categories/<?php echo $arr3['image_path'];?>',
              new google.maps.Size(26, 46),
              new google.maps.Point(0,0),
              new google.maps.Point(13, 46));
          var infowindow<?php echo $i;?> = new google.maps.InfoWindow();
          var marker<?php echo $i;?> = new google.maps.Marker({
              position: LatLng<?php echo $i;?>,
              map: map,
              title: "<?php echo $arr3['name'];?>",
              icon: image<?php echo $i;?>,
          });
          google.maps.event.addListener(marker<?php echo $i;?>, "click", function (e) {
          infowindow1.setPosition(e.LatLng<?php echo $i;?>);
          infowindow1.setContent("<?php echo $arr3['name'];?>");
          infowindow1.open(map, marker<?php echo $i;?>);
          });
<?php
        }
}
*/
?>
      }
    </script>
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
  <body onload="initialize();">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64858864-1', 'auto');
  ga('require', 'displayfeatures');
  ga('set','dimension1','<?php echo $arr['id'];?>');
  ga('set','dimension2',’offerdetail’);
  ga('send', 'pageview');

</script>

    <!--header><a href="#"><img src="/assets/img/logo_kin.png" alt="" class="HeaderLogo"></a><img src="/assets/img/sp/sp_menu_icn.png" alt="" class="HeaderMenu"><a href="#" class="a"><img src="/assets/img/sp/sp_cart_icn.png" alt="" class="HeaderCart"><span class="HeaderCart Num">5</span></a></header-->
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/header.php";
?>


    <article>
      <div id="top" class="mdDTL01Wrap Wrap95">
        <div id="mdDTL01CallIcn"><a href="<?php echo $_SERVER['REQUEST_URI'];?>:call_to_developer"><img src="/assets/img/sp/sp_call_icn.png" alt=""></a></div>
        <ul class="mdDTL01Gallery main-gallery">
<?php
$i=0;
while( $arr_listings_photos = mysql_fetch_array( $result_listings_photos3 )){
	$i++;
?>
          <li class="mdDTL01GalBox gallery-cell li"><a href="#"><img src="/admin/images/listings_photos/<?php echo $arr_listings_photos['image_path'];?>" alt=""></a></li>
<?php
	if($i==7){
		break;
	}
}
?>
        </ul>
        <div class="mdDTL01TxtBox"><img src="/admin/images/listings/<?php echo $arr['image_path'];?>" alt="">
          <h1 class="Gray"><?php echo $arr['name'];?></h1>
          <p class="Gold"><?php echo $arr['price_name'];?></p>
        </div>
        <div class="mdDTL01ItemBox clearfix">
          <dt class="Gray">Property Type</dt> <dd><?php echo $arr['property_name'];?></dd>
          <dt class="Gray">Completion year</dt> <dd><?php echo $arr['completion_year'];?></dd>
          <dt class="Gray">Location</dt> <dd><?php echo $arr['address'];?></dd>
          <dt class="Gray">Developed by</dt> <dd><?php echo common_get_value_2("companies","name",$arr['developer_id'],"");?></dd>
        </div>

        <div class="mdDTL01AddBtn" id="mdDTL01AddBtn">
<?php
if( $arr['status'] == "current" ){
        if(strpos($_COOKIE['newpropertylist']['Favorites'],$listings_id)===false){
?>
           <a href="<?php echo $favorites_url;?>"> <button>Add Enquiry collection</button> </a>
<?php
        }else{
?>
           <a href="<?php echo $favorites_url;?>"> <button>Added to collection</button> </a>
<?php
        }
}else if( $arr['status'] == "archived"){
?>
           <button>Already expired</button>
<?php
}
?>
        </div>
<?php
if( $arr['call_option'] == "on" ){
	if(!$_SESSION['call_to_developer']){
?>
        <div class="mdDTL01CallBtn"><a href="<?php echo $_SERVER['REQUEST_URI'];?>:call_to_developer" class="a">
            <button class="GoldBtn"><img src="/assets/img/sp/sp_call_icn.png" alt="">Customer Service</button></a>
        </div>
<?php
	}else{
?>
        <div class="mdDTL01CallBtn"><a href="tel:<?php echo $arr['contact_no'];?>" class="a">
            <button class="GoldBtn"><img src="/assets/img/sp/sp_call_icn.png" alt=""><?php echo $arr['contact_no'];?></button></a>
        </div>
<?php
	}
	$_SESSION['call_to_developer'] = 0;
}
?>
      </div>
      <div class="mdDTL02Wrap Wrap95">

        <h2 class="TtlCenter"></h2>
        <div class="mdDTL02ItemBox">
          <p style="font-weight:bold;"><?php echo $arr['catch_copy'];?></p>
        </div>

<?php
while( $arr_listings_project_details = mysql_fetch_array( $result_listings_project_details )){
?>
        <h2 class="TtlCenter clearfix"><?php echo $arr_listings_project_details['head'];?></h2>
        <div class="mdDTL02ItemBox">
          <!--p>We did the interview with Mr. Yau Wen Soon which is the Managing Director of the YGS property development on 9th October 2015 at 4:00pm.</p-->
          <div class="mdDTL02QABox clearfix">
            <p class="Gray bold"><?php echo $arr_listings_project_details['sub_head'];?></p>
<?php
if(!empty($arr_listings_project_details['image_path'])){
?>
            <img src="/admin/images/listings_project_details/<?php echo $arr_listings_project_details['image_path'];?>" alt="" class="mdDTL02QAimg">
            <div class="mdDTL02QATxt">
<?php
}
?>
              <p><?php echo str_replace("\n","<br />",$arr_listings_project_details['body']);?></p>
<?php
if(!empty($arr_listings_project_details['image_path'])){
?>
            </div>
<?php
}
?>
          </div>
        </div>
<?php
}
?>
        <!--h2 class="TtlCenter clearfix">About Armanee Terrace II</h2>
        <div class="mdDTL02ItemBox">
          <p>We did the interview with Mr. Yau Wen Soon which is the Managing Director of the YGS property development on 9th October 2015 at 4:00pm.</p>
          <div class="mdDTL02QABox clearfix">
            <p class="Gray bold">Q: What is the concept that you use for this property project?</p><img src="http://placehold.jp/108x108.png" alt="" class="mdDTL02QAimg">
            <div class="mdDTL02QATxt">
              <p>A: Twinz Residences are design in mind of uplift the new urban lifestyle in tandem with sustainable principles by providing sufficient social interaction spaces and promoting green features within the high-rise living. Its oasis of life is set to sprout out amidst the bustling cityscape of Puchong offering a blend of modern living and the serenity of nature.</p>
            </div>
          </div>
        </div-->





        <h2 class="TtlCenter clearfix">Location Map</h2>
        <div class="mdDTL02ItemBox">
          <p><?php echo $arr['address'];?></p>
          <div class="mdDTL02Map" id="FnGoogleMap"></div>
          
          <!--div class="mdDTL02Map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3983.7247657842363!2d101.60915160092058!3d3.167026603912911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sNo.8%2C+Jalan+PJU+8%2F1%2C+Bandar+Damansara+Perdana%2C+Petaling+Jaya%2C+Selangor!5e0!3m2!1sja!2sjp!4v1452758731209" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div-->
        </div>

<?php
$result_listings_plans = listings_plans_index( $arr['id'] );
if(mysql_num_rows($result_listings_plans)){
?>
        <h2 class="TtlCenter">Floor Plan</h2>
        <div class="mdDTL02ItemBox">
          <ul class="main-gallery ul mdDTL02PlanBox">
<?php
	while( $arr_listings_plans = mysql_fetch_array( $result_listings_plans )){
?>
            <li class="gallrey-cell li">
              <p class="Gold bold mdDTL02PlanTtl"><?php echo $arr_listings_plans['name'];?></p>
              <p>Price : <?php echo $arr_listings_plans['price'];?></p>
              <p>Size : <?php echo $arr_listings_plans['size'];?></p>
              <p>Bedroom : <?php echo $arr_listings_plans['bedrooms'];?></p>
              <p>Bathroom : <?php echo $arr_listings_plans['bathrooms'];?></p>
              <!--img src="/admin/images/listings_plans/<?php echo $arr_listings_plans['image_path'];?>" alt=""-->
            </li>
<?php
	}
?>
          </ul>
        </div>

<?php
}
?>


        <h2 class="TtlCenter">Company Information</h2>
        <div class="mdDTL02ItemBox">
          <div class="mdDTL02Company"><img src="/admin/images/companies/<?php echo $arr_parent['logo_image_path'];?>" alt="">
            <h3><?php echo $arr_parent['name'];?></h3>
            <p class="Gray"><?php echo $arr_parent['address'];?></p>
          </div>
        </div>
        <div class="mdDTL02ItemBox">
          <div class="mdDTL02AddBtn">
<?php
if( $arr['status'] == "current" ){
        if(strpos($_COOKIE['newpropertylist']['Favorites'],$listings_id)===false){
?>
           <a href="<?php echo $favorites_url;?>"> <button>Add Enquiry collection</button> </a>
<?php
        }else{
?>
           <a href="<?php echo $favorites_url;?>"> <button>Added to collection</button> </a>
<?php
        }
}else if( $arr['status'] == "archived"){
?>
           <button>Already expired</button>
<?php
}
?>
          </div>
        </div>
      </div>
      <!--div class="mdTOP05Wrap Wrap95">
        <h2 class="TtlCenter">Recently Search</h2>
        <ul class="ul">
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
          <li class="li"><a href="/<?php echo $arr_rs['states_code'];?>/<?php echo $arr_rs['code'];?>-in-<?php echo $arr_rs['locations_code'];?>"><img src="/admin/images/listings/sq_<?php echo $arr_rs['main_picture'];?>" alt="#"></a></li>
<?php
		if($i==3){
			break;
		}
	}
}
?>
        </ul>
      </div-->
      <a href="#top" class="a">
        <button class="GoldBtn center BackBtn">Back to page top</button>
      </a>
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>

  </body>
</html>
