<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <title>Contact form | NewPropertyList.my</title>
    <script src="/assets/js/pack.js"></script>
    <script src="/assets/js/npl.js"></script>
    <link href="/assets/css/npl.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/add.css" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Lato&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/assets/img/icon.ico" >
    <link rel="alternate" media="only screen and (max-width:768px)" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/sp<?php echo $_SERVER['REQUEST_URI'];?>">
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
include "../../view/common/header.php";
?>
        <div class="LyContents">
          <div class="MdCNT01TtlBox">
            <div class="MdCNT01LeftBox">
              <h2> Enquiry form </h2>
              <p>
                Send enquiry and meet developers directly.
              </p>
            </div>
            <div class="MdCNT01RightBox">
              <img src="/assets/img/md_contact_flow2.png" />
            </div>
          </div>
          <div class="MdCNT04FormBox">
            <div class="MdCNT04Box01">
              <div class="mdCNT04Ttl01">
                Customer Information
              </div>
<?php
if(empty($_SESSION['members_id'])){
?>
              <div class="mdCNT04Link01">
                <a href="/signin/">Log in if already had your account</a>
              </div>
<?php
}
?>
            </div>
            <form action="/enquiry/input" id="FnContactForm" method="POST">
              <div class="MdCNT04ErrBox01">
<?php
echo $err_msg;
?>
              </div>

              <dl>
                <dt class="ExMiddle">
                  Name<span>*</span>
                </dt>
                <dd>
                  <input class="mdCNT04Text" type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');?>" />
                </dd>
              </dl>
              <dl>
                <dt class="ExMiddle">
                  E-mail<span>*</span>
                </dt>
                <dd>
                  <input class="mdCNT04Text" type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');?>" />
                </dd>
              </dl>
              <dl class="ExSpace40">
                <dt class="ExMiddle">
                  Phone<span>*</span>
                </dt>
                <dd>
                  <input class="mdCNT04Text" type="text" name="phone" value="<?php echo htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');?>" />
                </dd>
              </dl>
              <dl class="ExSpace40">
                <dt class="ExMiddle">
                  Remarks
                </dt>
                <dd>
                  <textarea class="mdCNT04remark" name="remarks" ><?php echo htmlspecialchars($_POST['remarks'], ENT_QUOTES, 'UTF-8');?></textarea>
                </dd>
              </dl>
              <div class="mdCNT04Agree">
                <input class="mdCNT04CheckBox" id="agree" name="agree" type="checkbox" value="yes" <?php if( $_POST['signup'] == "yes" ){ echo "checked";} ?> />
		<label for="agree">I agree to our <span><a href="/terms/" target="_blank">Terms of Conditions</a></span> and <span><a href="/privacy/" target="_blank">Privacy Policy</a></span></label>
              </div>
              <div class="mdCNT04Btn01" id="FnCNT04Btn01">
                <a href="#"><Send>Enquiry with this content</Send></a>
              </div>
<?php
if(empty($_SESSION['members_id'])){
?>
              <div class="mdCNT04Agree">
                <input class="mdCNT04CheckBox" id="signup" name="signup" type="checkbox" value="yes" <?php if( $_POST['signup'] == "yes" ){ echo "checked";} ?> />
		<label for="signup">Sign up and create My Account</label>
              </div>
<?php
}
?>
<?php
if(empty($_SESSION['members_newsletter'])){
?>
              <div class="mdCNT04Agree">
                <input class="mdCNT04CheckBox" id="newsletter" name="newsletter" type="checkbox" value="yes" <?php if( $_POST['newsletter'] == "yes" ){ echo "checked";} ?> />
		<label for="newsletter">Subscribe to recieve updates and newsletters</label>
              </div>
<?php
}
?>
              <div class="mdCNT04Btn01" id="FnCNT04Btn01">
              <div class="mdCNT04Txt01"></div>
              <input type="hidden" name="act" value="enquiry">
            </form>
          </div>
        </div>
        <div class="LyFoot">
          <div class="MdGFT03FootBox01">
            <div class="MdGFT03InnerBox01">
              <div class="mdGFT03Company">
                Samurai internet
              </div>
              <div class="mdGFT03Copyright">
               &copy;    2015-2016 / <a href="http://samurai-internet.com/" target="_blank">Samurai Internet Sdn Bhd</a> / All Rights Reserved.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
