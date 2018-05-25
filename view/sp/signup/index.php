<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign up to NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Sign up"/>
    <meta name="description" content="Sign up to NewPropertyList.my from here"/>
    <link rel="canonical" href="http://newpropertylist.my/signin/">
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
      <div class="mdSIG01Wrap Wrap95">
        <div class="panels">
          <div id="cont1" class="panel active">
            <div class="mdSIG01Error">
              <ul class="ul"><?php echo $err_msg;?></ul>
            </div>
            <div class="mdSIG01Items inputtext">
              <form action="/sp/signup/signup" method="post">
              <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');?>" placeholder="Email (Required)">
              <input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');?>" placeholder="Password (Required)">
              <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');?>" placeholder="Name (Required)">
              <input type="text" name="phone" value="<?php echo htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');?>" placeholder="Phone (Required)">
              <!--p>Your Nationality</p>
              <ul class="ul radio"> 
                <li>
                  <input type="radio" name="nationality" value="malaysian" id="FnNation1" <?php if( $_POST['nationality'] == "malaysian" ){ echo "checked"; } ?>>
                  <label for="FnNation1">Malaysian</label>
                </li>
                <li>
                  <input type="radio" name="nationality" value="not_malaysian" id="FnNation2" <?php if( $_POST['nationality'] == "not_malaysian" ){ echo "checked"; } ?>>
                  <label for="FnNation2">Not Malaysian</label>
                </li>
              </ul-->
              <div class="mdCNT04Agree" align="center" style="margin:10px;">
                <input class="mdCNT04CheckBox" id="agree" name="agree" type="checkbox" value="yes" <?php if( $_POST['agree'] == "yes" ){ echo "checked"; }?>/>
                <label for="agree">I agree to our <span><a href="/terms/" target="_blank">Terms of Conditions</a></span> and <span><a href="/privacy/" target="_blank">Privacy Policy</a></span></label>
              </div>
              <div class="mdCNT04Agree" align="center" style="margin:10px;">
                <input class="mdCNT04CheckBox" id="newsletter" name="newsletter" type="checkbox" value="yes" <?php if( $_POST['newsletter'] == "yes" ){ echo "checked"; }?>/>
                <label for="newsletter">Subscribe to recieve updates and newsletters</label>
              </div>
              <input type="submit" value="Sign up" class="GoldBtn Reverse">
              </form>
            </div>
          </div>
        </div>
      </div>
    </article>
<?php
include $_SERVER['BASE_DIR'] . "/view/sp/common/footer.php";
?>
  </body>
</html>
