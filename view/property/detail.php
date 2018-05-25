<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="/assets/img/icon.ico" >
    <link rel="alternate" media="only screen and (max-width:768px)" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/sp<?php echo $_SERVER['REQUEST_URI'];?>">
    <title><?php echo $arr['name'];?> in <?php echo $arr['locations_name'];?> | NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, <?php echo $arr['name'];?>, <?php echo $arr['locations_name'];?>, <?php echo $arr['developer_name'];?>"/>
    <meta name="description" content="New condominium for sale at <?php echo $arr['name'];?> in <?php echo $arr['locations_name'];?>, <?php echo $arr['states_name'];?> by <?php echo $arr['developer_name'];?>.<?php echo $arr['catch_copy'];?>.See the details of <?php echo $arr['name'];?> - NewPropertyList.my"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <script src="/assets/js/pack.js"></script>
    <script src="/assets/js/npl.js"></script>
    <link href="/assets/css/npl.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/add.css" rel="stylesheet" type="text/css" />
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
  <body class="ExDetail" onload="initialize();">
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
    <div class="LyWrap">
<?php
include "../../view/common/header.php";
?>
      <div class="MdCMN06Pankuzu">
        <ul class="mdCMN06List01">
          <li class="mdCMN06Cell01"> <a href="/all-state/"><span>New Properties</span></a> </li>
          <li class="mdCMN06Cell01"> <a href="/<?php echo $arr['states_code'];?>"><span><?php echo $arr['states_name'];?></span></a> </li>
          <li class="mdCMN06Cell01"> <a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['groups_code'];?>"><span><?php echo $arr['groups_name'];?></span></a> </li>
          <li class="mdCMN06Cell01"> <span><?php echo $arr['name'];?></span> </li>
        </ul>
      </div>
      <div class="LyContents" id="FnContents">
        <div class="LyMain02">
          <div class="MdDTL01Slick" id="FnDTL01Slick">
            <div class="MdDTL01SlickList" id="FnDTL01SlickList">
<?php
if(!empty($arr['youtube_url'])){
?>
              <!--div class="MdDTL01Img01">
                <iframe allowfullscreen="" height="428" iv_load_policy="3&amp;quot;" modestbranding="0&amp;quot;" showinfo="0&amp;quot;" src="<?php echo $arr['youtube_url'];?>?rel=0" width="570" 　frameborder="0"></iframe>
              </div-->
<?php
}
?>
<?php
while( $arr_listings_photos = mysql_fetch_array( $result_listings_photos )){
?>
              <div class="MdDTL01Img01"> <img alt="" src="/admin/images/listings_photos/<?php echo $arr_listings_photos['image_path'];?>" /> </div>
<?php
}
?>
            </div>


            <div class="MdDTL01Caption" id="FnDTL01Caption">
<?php
$i=0;
while( $arr_listings_photos = mysql_fetch_array( $result_listings_photos2 )){
        $i++;
        if( $i == 1){
                $class = "";
        }else{
                $class = "ExHide";
        }
?>
              <p class="<?php echo $class;?>"><?php echo $arr_listings_photos['caption'];?></p>
<?php
}
?>
            </div>


            <div class="MdDTL01SlickNavi" id="FnDTL01SlickNavi">
<?php
$i=0;
if(!empty($arr['youtube_url'])){
	//$i++;
?>
              <!--div class="MdDTL01Img02 ExActive"><img src="/assets/img/foryoutube.png" /></div-->
<?php
}
?>
<?php
while( $arr_listings_photos = mysql_fetch_array( $result_listings_photos3 )){
        $i++;
        if( $i == 1){
                $class = "MdDTL01Img02 ExActive";
        }else{
                $class = "MdDTL01Img02";
        }
?>
              <div class="<?php echo $class;?>"> <img src="/admin/images/listings_photos/<?php echo $arr_listings_photos['image_path'];?>" /> </div>
<?php
}
?>
            </div>
            <div class="mdDTL01Prev ExHide" id="FnDTL01Prev"></div>
            <div class="mdDTL01Next" id="FnDTL01Next"></div>
          </div>
          <div class="MdDTL02AboutBox">
            <div class="MdDTL02Img01"> <img alt="" src="/admin/images/listings/<?php echo $arr['image_path'];?>" /> </div>
            <div class="MdDTL02TxtBox">
              <div class="mdDTL02Ttl01"><h1><?php echo $arr['name'];?></h1></div>
              <div class="mdDTL02Txt01"><?php echo $arr['price_name'];?></div>
              <dl>
                <dt> Property Type </dt> <dd><?php echo $arr['property_name'];?></dd>
              </dl>
              <dl>
                <dt> Completion year </dt> <dd><?php echo $arr['completion_year'];?></dd>
              </dl>
              <dl>
                <dt> Location </dt> <dd><?php echo $arr['address'];?></dd>
              </dl>
              <dl>
                <dt> Developed by </dt> <dd><?php echo common_get_value_2("companies","name",$arr['developer_id'],"");?></dd>
              </dl>
            </div>
          </div>

          <div class="MdDTL11ExSplitBox">
            <div class="mdDTL11Ttl01"><h2><?php echo $arr['catch_copy'];?></h2></div>
          </div><!-- MdDTL11ExSplitBox -->

<?php
while( $arr_listings_project_details = mysql_fetch_array( $result_listings_project_details )){
?>
          <div class="MdDTL11ExSplitBox">
            <div class="mdDTL11Ttl01"><h2><?php echo $arr_listings_project_details['head'];?></h2></div>
            <div class="MdDTL11Box01">
              <div class="MdDTL11QABox01">
                <div class="MdDTL11TxtBox01">
                  <p class="ExBold"><?php echo $arr_listings_project_details['sub_head'];?></p>
                  <p><?php echo str_replace("\n","<br />",$arr_listings_project_details['body']);?></p>
                </div>
<?php
if(!empty($arr_listings_project_details['image_path'])){
?>
                <div class="MdDTL11ImgBox01">
                  <img alt="" src="/admin/images/listings_project_details/<?php echo $arr_listings_project_details['image_path'];?>" />
                </div>
<?php
}
?>
              </div>
            </div>
          </div><!-- MdDTL11ExSplitBox -->
<?php
}
?>
          <div class="MdDTL04MapBox">
            <div class="mdDTL04Ttl01"><h2>Location Map</h2></div>
            <div class="mdDTL04Txt01"><?php echo $arr['address'];?></div>
            <div class="mdDTL04Box01" id="FnGoogleMap"></div>
          </div>
          <div class="MdDTL05TblBox">
            <table class="MdDTL05Tbl">
<?php
$sql_ac = "select * from amenity_categories where is_deleted = 0 order by sort";
$result_ac = mysql_query( $sql_ac );
while( $arr_ac = mysql_fetch_array( $result_ac )){
        $i=0;
        $sql3 = "select";
        $sql3 .= " t2.name";
        $sql3 .= ",t2.description";
        $sql3 .= ",t2.latitude";
        $sql3 .= ",t2.longitude";
        $sql3 .= " from";
        $sql3 .= " listings_amenities t1";
        $sql3 .= " left join";
        $sql3 .= " amenities t2";
        $sql3 .= " on";
        $sql3 .= " (t1.amenities_id = t2.id)";
        $sql3 .= " where";
        $sql3 .= " t1.listings_id = $listings_id";
        $sql3 .= " and";
        $sql3 .= " t1.is_deleted = 0";
        $sql3 .= " and";
        $sql3 .= " t2.amenity_categories_id = " . $arr_ac['id'];
        $sql3 .= " order by t1.sort";
        $result3 = mysql_query( $sql3 );
        $row_num3 = mysql_num_rows($result3);
        if($row_num3){
?>
              <tr class="MdDTL05TR">
                <th class="MdDTL05TH">
                  <span><?php echo $arr_ac['name'];?></span>
                    <img alt="" src="/admin/images/amenity_categories/<?php echo $arr_ac['icon'];?>" />
                </th>
<?php
                while( $arr3 = mysql_fetch_array( $result3 )){
                        $i++;
?>
                <td class="MdDTL05TD">
                  <p><?php echo $arr3['name'];?></p>
                  <p class="ExGray"><?php echo $arr3['description'];?></p>
                  <!--span><?php echo number_format(common_getPointsDistance($arr['latitude'],$arr['longitude'],$arr3['latitude'],$arr3['longitude']));?>m</span-->
                </td>
<?php
			if($i==$row_num3){
?>
		</tr>
<?php
			}else if($i%2==0){
?>

		</tr>
		<tr class="MdDTL05TR">
		<th class="MdDTL05TH"><span></span></th>
<?php
			}
		}
	}
}
?>
            </table>
          </div>
<?php
$result_listings_plans = listings_plans_index( $arr['id'] );
if(mysql_num_rows($result_listings_plans)){
?>


          <div class="MdDTL06FloorBox">
            <div class="mdDTL06Ttl01"><h2>Floor Plan</h2></div>
            <ul class="mdDTL06List01" id="FnDTL06List01">
<?php
$i=0;
while( $arr_listings_plans = mysql_fetch_array( $result_listings_plans )){
        $i++;
        if( $i == 1 ){
                $class = "mdDTL06Cell01 ExActive";
        }else{
                $class = "mdDTL06Cell01";
        }
?>
              <li class="<?php echo $class;?>"><?php echo $arr_listings_plans['name'];?></li>
<?php
}
?>
            </ul>
            <div class="MdDTL06Box01">
<?php
$i=0;
$result_listings_plans = listings_plans_index( $arr['id'] );
while( $arr_listings_plans = mysql_fetch_array( $result_listings_plans )){
        if( $i == 0 ){
                $class = "MdDTL06Content";
        }else{
                $class = "MdDTL06Content ExHide";
        }
?>
              <div class="<?php echo $class;?>" id="FnContent<?php echo $i;?>">
                <div class="MdDTL06Box02">
                  <div class="mdDTL06Img01">
                    <img src="/admin/images/listings_plans/<?php echo $arr_listings_plans['image_path'];?>" />
                  </div>
                </div>
                <div class="MdDTL06Box03">
                  <div class="MdDTL06TxtBox01">
                    <div class="mdDTL06Ttl02"> Price </div>
                    <div class="mdDTL06Txt02"><?php echo $arr_listings_plans['price'];?></div>
                  </div>
                  <div class="MdDTL06TxtBox01">
                    <div class="mdDTL06Ttl02"> Size </div>
                    <div class="mdDTL06Txt02"><?php echo $arr_listings_plans['size'];?></div>
                  </div>
                  <div class="MdDTL06TxtBox01">
                    <div class="mdDTL06Ttl02"> Bedroom </div>
                    <div class="mdDTL06Txt02"><?php echo $arr_listings_plans['bedrooms'];?></div>
                  </div>
                  <div class="MdDTL06TxtBox01">
                    <div class="mdDTL06Ttl02"> Bathroom </div>
                    <div class="mdDTL06Txt02"><?php echo $arr_listings_plans['bathrooms'];?></div>
                  </div>
                </div>
              </div>
<?php
        $i++;
}
?>
            </div>
          </div>
<?php
}
?>
          <div class="MdDTL07CompanyBox">
            <div class="mdDTL07Ttl01"><h2>Company Information</h2></div>
            <ul class="mdDTL07List01">
              <li class="mdDTL07Cell01">
                <img alt="" src="/admin/images/companies/<?php echo $arr_parent['logo_image_path'];?>" />
              </li>
              <li class="mdDTL07Cell02">
                <p class="mdTDL07Ttl02"><?php echo $arr_parent['name'];?></p>
                <p class="mdTDL07Txt01"><?php echo $arr_parent['address'];?></p>
                <p class="mdTDL07Txt01"><?php echo str_replace("\n","<br />",$arr_parent['body_1']);?></p>
                <p class="mdTDL07Txt01"><?php echo str_replace("\n","<br />",$arr_parent['body_2']);?></p>
              </li>
            </ul>
          </div><!-- MdDTL07CompanyBox -->

<?php
if(!empty($arr['sales_garellies_id'])){
?>

          <div class="MdDTL07CompanyBox">
            <div class="mdDTL07Ttl01"><h2>Sales Gallery</h2></div>
<?php
	$sales_garellies_arr = explode(",",$arr['sales_garellies_id']);
	foreach( $sales_garellies_arr as $sales_garellies_id ){
		$result_sales_garellies = common_get_value_all_2("sales_garellies","id",$sales_garellies_id);
		$arr_sales_garellies = mysql_fetch_array( $result_sales_garellies );

?>
            <ul class="mdDTL07List01">
<?php
if(!empty($arr_sales_garellies['image_path_1'])){
	//画像は表示不要との事
?>
              <!--li class="mdDTL07Cell01">
                <img alt="" src="/admin/images/sales_garellies/<?php echo $arr_sales_garellies['image_path_1'];?>" />
              </li-->
<?php
}
?>
              <li class="mdDTL07Cell02">
                <p class="mdTDL07Ttl02"><?php echo $arr_sales_garellies['name'];?></p>
                <p class="mdTDL07Txt01"><?php echo str_replace("\n","<br />",$arr_sales_garellies['description']);?></p>
              </li>
            </ul>
<?php
	}
?>
          </div><!-- MdDTL07CompanyBox -->
<?php
}
?>


        </div>





        <div class="LySide02" id="FnSide">
          <div class="lySideWrap" id="FnSideWrap">
            <div class="MdDTL08SideBox">
              <div class="mdDTL08Ttl01"><?php echo $arr['name'];?></div>
<?php
if(!empty($arr['price_minimum'])){
?>
              <div class="mdDTL08Txt01"> From RM </div>
              <div class="mdDTL08Txt02"> <?php echo number_format($arr['price_minimum']);?>〜 </div>
<?php
}else{
?>
              <div class="mdDTL08Txt01">　　</div>
              <div class="mdDTL08Txt02">Please Ask</div>
<?php
}
?>
<?php
if( $arr['status'] == "current" ){
	if(strpos($_COOKIE['newpropertylist']['Favorites'],$listings_id)===false){
?>
              <div class="mdDTL08Box01">
                <a href="<?php echo $favorites_url;?>">Add Enquiry collection</a>
              </div>
<?php
	}else{
?>
              <div class="mdDTL08Box01" style="background-color:#dddddd;">
                <a href="<?php echo $favorites_url;?>">Added to collection</a>
              </div>
<?php
	}
}else if( $arr['status'] == "archived"){
?>
              <div class="mdDTL08Box01" style="background-color:#dddddd;">
                <a>Already expired</a>
              </div>
<?php
}
?>

<?php
if( $arr['call_option'] == "on" ){
        if(!$_SESSION['call_to_developer']){
?>
              <div class="mdDTL08Box02">
                <a href="<?php echo $_SERVER['REQUEST_URI'];?>:call_to_developer"><span>Customer Service</span></a>
              </div>
<?php
        }else{
?>
              <div class="mdDTL08Box02">
		<a href="#"><span><?php echo $arr['contact_no'];?></span></a>
              </div>
<?php
        }
        $_SESSION['call_to_developer'] = 0;
}
?>


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
                <a href="/recent_searches/">See the list</a>
              </div>
            </div--><!-- MdDTL09SideTitle -->
          </div>
        </div>
      </div>
      <div class="MdCMN08ListTitle02">
        <div class="mdCMN08Ttl01"><h3>Frequently compared together in the same area</h3></div>
      </div>
      <div class="MdCMN07List04">
        <ul>
<?php
$i=0;
while( $arr_compare = mysql_fetch_array( $result_compare )){
	if( $arr_compare['id'] == $listings_id ){
		continue;
	}
	$i++;
	if(!empty($arr_compare['price_minimum'])){
		$price_minimum = "RM" . number_format($arr_compare['price_minimum']);
	}else{
		"Please ask";
	}
?>
          <li>
            <div class="mdCMN07Img01">
              <a href="/<?php echo $arr_compare['states_code'];?>/<?php echo $arr_compare['code'];?>-in-<?php echo $arr_compare['locations_code'];?>"><img alt="" src="/admin/images/listings/<?php echo $arr_compare['main_picture'];?>" /></a>
            </div>
            <div class="mdCMN07Ttl01"> <a href="/<?php echo $arr_compare['states_code'];?>/<?php echo $arr_compare['code'];?>-in-<?php echo $arr_compare['locations_code'];?>"><?php echo $arr_compare['name'];?></a> </div>
            <div class="mdCMN07Txt01"><?php echo $price_minimum;?></div>
            <div class="mdCMN07Txt02"><?php echo $arr_compare['address'];?></div>
          </li>
<?php
	if($i==8){
		break;
	}
}
?>
        </ul>
      </div>


<?php
if($fav_num){
?>
      <div class="MdSAC06SendEnquiry">
        <div class="MdSAC06InnerBox01">
          <div class="mdSAC06Txt01">
            <span><?php echo $fav_num;?></span>
          </div>
          <div class="mdSAC06Btn01">
            <a href="/enquiry/input"><span>Send Enquiry</span></a>
          </div>
        </div>
      </div>
<?php
}
?>


<?php
include "../../view/common/footer.php";
?>
    </div>
  </body>
</html>
