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
    <title>Archived Listings of NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Archived Listings"/>
    <meta name="description" content="Archived Listings of NewPropertyList.my is here."/>
    <meta name="robots" content="" />
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
if( $states_code != "all-state" || ( $row_num_pager > 1 && $states_code == "all-state" && count($states_id_arr) > 1) ){
?>
          <div class="MdSAC05SideList">
            <div class="mdSAC05Ttl01"><h2>State</h2></div>
            <ul class="mdSAC05List01">
<?php
$i=0;   //using for keep same checkbox and label
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
	$url = "/archive/";
        if( $arr['code'] != $states_code ){
                $url .= $arr['code'];
        }
?>
              <li class="mdSAC05Cell01"> <input class="cuctom-check" value="<?php echo $url;?>" id="checkbox-id<?php echo $i;?>" type="checkbox" onChange="location.href=value;" <?php if( $arr['code'] == $states_code ){ echo "checked"; } ?> /><label for="checkbox-id<?php echo $i;?>"><?php echo $arr['name'];?></label> </li>
<?php
	}
?>
            </ul>
          </div>
<?php
}
?>
        </div><!--LySide-->



        <div class="LyMain">
          <div class="MdSAC01MainContents">
            <div class="MdFTR02SearchCellBox">
              <!--div class="MdFTR02ChildImgCell">
                <img alt="" src="/admin/images/features/<?php echo $features_image_path;?>" />
              </div-->
              <h2>Archive</h2>
              <p></p>
            </div>
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
                  <a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>"><img alt="" src="/admin/images/listings/<?php echo $arr['main_picture'];?>" /></a>
                </div>
                <div class="mdSAC02Ttl01">
                  <a href="/<?php echo $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];?>"><span><?php echo $arr['name'];?></span></a>
                </div>
                <div class="mdSAC02Txt01"><?php echo $arr['price_name'];?></div>
                <div class="mdSAC02Txt02"><?php echo $arr['address'];?></div>
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
