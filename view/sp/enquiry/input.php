<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Contact form | NewPropertyList.my</title>
    <link rel="canonical" href="http://<?php echo $_SERVER['SERVER_NAME'];?><?php echo str_replace("/sp","",$_SERVER['REQUEST_URI']);?>">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.1.2/flickity.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/drawer/3.1.0/css/drawer.min.css">
    <link rel="stylesheet" href="/assets/css/sp.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="/assets/css/add_sp.css" media="screen" title="no title" charset="utf-8">
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
        <h1>Contact Form</h1>
        <p>Please type in your information.</p><img src="/assets/img/sp/sp_contact_flow2.png" alt="">
      </div>
      <div class="mdCNT04Wrap Wrap95">
        <div class="mdCNT04Login">
          <a href="/sp/signin/" class="a">
          <button type="button" class="GoldBtn">Log in if already had your account</button>
          </a>
        </div>
        <div class="mdCNT04Input" id="mdCNT04Input">
          <!--h2>Customer Information</h2-->
          <div class="mdCNT04Error">
            <ul class="ul"><?php echo $err_msg;?></ul>
          </div>
          <div class="mdCNT04InputItems">
            <form action="/sp/enquiry/input/#mdCNT04Input" method="post">
              <div class="mdCNT04Inputtext inputtext">
                <input type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');?>" placeholder="Name (Required)">
                <input type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');?>" placeholder="Email (Required)">
                <input type="text" name="phone" value="<?php echo htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');?>" placeholder="Phone (Required)">
		<p>Remarks</p>
		<textarea class="mdCNT04remark" name="remarks" /><?php echo htmlspecialchars($_POST['remarks'], ENT_QUOTES, 'UTF-8');?></textarea>
              </div>
              <!--p>Nationality</p>
              <ul class="ul radio"> 
                <li>
                  <input type="radio" name="nationality" value="malaysian" id="FnNation1" <?php if($_POST['nationality'] == "malaysian" || empty($_POST['nationality'])){ echo "checked";} ?>>
                  <label for="FnNation1">Malaysian</label>
                </li>
                <li>
                  <input type="radio" name="nationality" value="not_malaysian" id="FnNation2" <?php if( $_POST['nationality'] == "not_malaysian"){ echo "checked";} ?>>
                  <label for="FnNation2">Not Malaysian</label>
                </li>
              </ul-->
              <!--p>Contact me via</p>
              <ul class="ul chkbox">
                <li>
                  <input type="checkbox" name="via" value="1" id="FnVia1" checked="checked">
                  <label for="FnVia1">Call</label>
                </li>
                <li>
                  <input type="checkbox" name="via" value="2" id="FnVia2">
                  <label for="FnVia2">SMS</label>
                </li>
                <li>
                  <input type="checkbox" name="via" value="3" id="FnVia3">
                  <label for="FnVia3">WhatsApp</label>
                </li>
                <li>
                  <input type="checkbox" name="via" value="4" id="FnVia4">
                  <label for="FnVia4">WeChat</label>
                </li>
                <li>
                  <input type="checkbox" name="via" value="5" id="FnVia5">
                  <label for="FnVia5">Email</label>
                </li>
                <li>
                  <input type="checkbox" name="via" value="6" id="FnVia6">
                  <label for="FnVia6">LINE</label>
                </li>
              </ul-->
              <div class="mdCNT04Agree" align="center" >
		<input class="mdCNT04CheckBox" id="agree" name="agree" type="checkbox" value="yes" <?php if( $_POST['signup'] == "yes" ){ echo "checked";} ?> />
                <label for="agree">I agree to our <span><a href="/terms/" target="_blank">Terms of Conditions</a></span> and <span><a href="/privacy/" target="_blank">Privacy Policy</a></span></label>
              </div>

              <input type="submit" value="Enquiry with this content">

<?php
if(empty($_SESSION['members_id'])){
?>
              <div class="mdCNT04Agree" align="center" style="margin:10px;">
		<input class="mdCNT04CheckBox" id="signup" name="signup" type="checkbox" value="yes" <?php if( $_POST['signup'] == "yes" ){ echo "checked";} ?> />
                <label for="signup">Sign up and create My Account</label>
              </div>
<?php
}
?>
<?php
if(empty($_SESSION['members_newsletter'])){
?>
              <div class="mdCNT04Agree" align="center">
                <input class="mdCNT04CheckBox" id="newsletter" name="newsletter" type="checkbox" value="yes" <?php if( $_POST['newsletter'] == "yes" ){ echo "checked";} ?> />
                <label for="newsletter">Subscribe to recieve updates and newsletters</label>
              </div>
<?php
}
?>
              <input type="hidden" name="act" value="enquiry">
            </form>
          </div>
        </div>
      </div>
    </article>
    <footer>
      <div class="FooterBox" style="margin-top:20px;">
        <div class="FooterItem">
          <p>Samurai internet</p>
          <p>© 2015 / Samurai Internet Sdn. Bhd. / All Rights Reserved.</p>
        </div>
      </div>
    </footer>
  </body>
</html>
