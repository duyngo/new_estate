<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Enquiry collection - NewPropertyList.my</title>
    <link rel="canonical" href="http://<?php echo $_SERVER['SERVER_NAME'];?><?php echo str_replace("/sp","",$_SERVER['REQUEST_URI']);?>">
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
    <header><a href="/"><img src="/assets/img/logo_kin.png" alt="" class="HeaderLogo"></a></header>
    <article>
      <div class="mdCNT01Wrap Wrap95">
        <h1>Enquiry collection</h1>
        <p>Send enquiry and meet developers directly.</p><img src="/assets/img/sp/sp_contact_flow1.png" alt="">
      </div>
      <div class="mdCNT03Wrap Wrap95">
        <h3 class="h3">You have <?php echo $fav_num;?> Enquiry collection</h3>
        <form action="/enquiry/input" method="post">
        <button type="submit" class="GoldBtn Reverse">Proceed to Enquiry</button>
	</form>
      </div>
      <div class="mdCNT02Wrap Wrap95">
<?php
while( $arr = mysql_fetch_array( $result )){
?>
        <div class="mdCNT02ItemList">
          <div class="mdCNT02Img"><a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><img src="/admin/images/listings/<?php echo $arr['main_picture'];?>" alt=""></a></div>
          <div class="mdCNT02Name">
            <h2 class="h2"><?php echo $arr['name'];?></h2>
            <p class="Gold p"><?php echo $arr['price_name'];?></p>
          </div>
          <div class="mdCNT02Btn">
            <form action="/enquiry/delete/<?php echo $arr['id'];?>" method="post">
            <button class="GoldBtn">Delete</button>
            </form>
          </div>
        </div>
<?php
}
?>
      </div>
      <div class="mdCNT03Wrap Wrap95">
        <form action="/enquiry/input" method="post">
        <button type="submit" class="GoldBtn Reverse">Proceed to Enquiry</button>
	</form>
        <a href="<?php echo $_SESSION['continue_to_search'];?>" class="a">
         <p class="Gold">Continue to search</p>
       </a>
      </div>
    </article>
    <footer>
      <div class="FooterBox">
        <div class="FooterItem">
          <p>Samurai internet</p>
          <p>© 2015 / Samurai Internet Sdn. Bhd. / All Rights Reserved.</p>
        </div>
      </div>
    </footer>
  </body>
</html>
