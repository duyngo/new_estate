<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Find your new property for sale by Areas | NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Find by Areas"/>
    <meta name="description" content="Are you looking for new house in Malaysia? You can find new property for Sale by Areas - NewPropertyList.my"/>
    <link rel="canonical" href="http://newpropertylist.my/areas/">
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
      <div class="mdFTR01Wrap Wrap95">
        <h1>Areas</h1>
<?php
$row_num = mysql_num_rows( $result );
while( $arr = mysql_fetch_array( $result )){
        if($arr['listings_num']){
?>
        <div class="mdFTR01Items">
          <div class="mdFTR01Img"><a href="/<?php echo $arr['code'];?>/"><img src="/admin/images/states/<?php echo $arr['image_path'];?>" alt="<?php echo $arr['name'];?>"></a></div>
          <div class="mdFTR01Txt">
            <h2 class="h2"><?php echo $arr['name'];?></h2>
            <!--h2 class="Gold h2"><?php echo $arr['name'];?></h2-->
            <!--p class="p">text text text text text text text text text text text text text text text text text text text text text text text text</p-->
          </div>
        </div><!--mdFTR01Items-->
<?php
	}
}
?>
      </div>
      <!--div class="mdSAC02Wrap Wrap95">
        <div class="mdSAC02NavBox center">
          <div class="mdSAC02ItemNum center">1 / 7 page</div><a href="#">
            <button class="mdSAC02Btn left hidden"><span></span></button></a><a href="#">
            <button class="mdSAC02Btn right"><span></span></button></a>
        </div>
      </div-->
      <!--div class="mdFTR02Wrap Wrap95">
        <div class="mdFTR02ItemGroup"><span> <a href="#" class="a">A</a></span><span><a href="#" class="a">B</a></span><span><a href="#" class="a">C</a></span><span><a href="#" class="a">D</a></span><span><a href="#" class="a">E</a></span><span><a href="#" class="a">F</a></span></div>
        <div class="mdFTR02ItemGroup"><span> <a href="#" class="a">G</a></span><span><a href="#" class="a">H</a></span><span><a href="#" class="a">I</a></span><span><a href="#" class="a">J</a></span><span><a href="#" class="a">K</a></span><span><a href="#" class="a">L</a></span></div>
        <div class="mdFTR02ItemGroup"><span> <a href="#" class="a">M</a></span><span><a href="#" class="a">N</a></span><span><a href="#" class="a">O</a></span><span><a href="#" class="a">P</a></span><span><a href="#" class="a">Q</a></span><span><a href="#" class="a">R </a></span></div>
        <div class="mdFTR02ItemGroup"><span> <a href="#" class="a">S</a></span><span><a href="#" class="a">T</a></span><span><a href="#" class="a">U</a></span><span><a href="#" class="a">V</a></span><span><a href="#" class="a">W</a></span><span><a href="#" class="a">X </a></span></div>
        <div class="mdFTR02ItemGroup"><span> <a href="#" class="a">S</a></span><span><a href="#" class="a">T</a></span>
          <div class="mdFTR02ItemOthre"><a href="#" class="a">Other</a></div>
        </div>
      </div-->
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>
  </body>
</html>
