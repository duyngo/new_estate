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
    <title>Sign up or Log in to NewPropertyList.my</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, Sign up, Log in"/>
    <meta name="description" content="Sign up or Log in to NewPropertyList.my from here"/>
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
        <ul class="mdCMN06List01">
          <li class="mdCMN06Cell01">
            <a href="/"><span>NewPropertyList top</span></a>
          </li>
          <li class="mdCMN06Cell01">
            <span>Singup</span>
          </li>
        </ul>
      </div>
      <div class="LyContents">
        <div class="MdSUP01TtlBox">
          <div class="MdSUP01LeftBox">
            <h2>
              Sign up
            </h2>
            <hr />
            <div class="MdSUP01FormBox">
              <div class="MdSUPErrBox">
<?php
if( $mode == "signup" ){
        echo $err_msg;
}
?>
              </div>
              <form id="signup" name="signup" action="/signin/signup" method="post" >
                <dl>
                  <dt>
                    Email<span>*</span>
                  </dt>
                  <dd>
                    <input class="mdSUP01Text" type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');?>"/>
                  </dd>
                </dl>
                <dl>
                  <dt>
                    Password<span>*</span>
                  </dt>
                  <dd>
                    <input class="mdSUP01Text" type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');?>"/>
                  </dd>
                </dl>
                <dl>
                  <dt>
                    Name<span>*</span>
                  </dt>
                  <dd>
                    <input class="mdSUP01Text" type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');?>"/>
                  </dd>
                </dl>
                <dl>
                  <dt>
                    Phone<span>*</span>
                  </dt>
                  <dd>
                    <input class="mdSUP01Text" type="text" name="phone" value="<?php echo htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');?>"/>
                  </dd>
                </dl>
                <!--dl>
                  <dd>
                    <div class="mdSUP01RadioBox">
                      <input class="mdSUP01RadioForm" id="FnNation1" name="nationality" type="radio" value="malaysian" <?php if( $_POST['nationality'] == "malaysian" ){ echo "checked"; }?>/><label for="FnNation1">Malaysia</label>
                    </div>
                  </dd>
                  <dd>
                    <div class="mdSUP01RadioBox">
                      <input class="mdSUP01RadioForm" id="FnNation2" name="nationality" type="radio" value="not_malaysian" <?php if( $_POST['nationality'] == "not_malaysian" ){ echo "checked"; }?>/><label for="FnNation2">Not Malaysia</label>
                    </div>
                  </dd>
                </dl-->
              <div class="mdCNT04Agree">
                <input class="mdCNT04CheckBox" id="agree" name="agree" type="checkbox" value="yes" <?php if( $_POST['agree'] == "yes" ){ echo "checked"; }?> />
		<label for="agree">I agree to our <span><a href="/terms/" target="_blank">Terms of Conditions</a></span> and <span><a href="/privacy/" target="_blank">Privacy Policy</a></span></label>
              </div>
              <div class="mdCNT04Agree">
                <input class="mdCNT04CheckBox" id="newsletter" name="newsletter" type="checkbox" value="yes"  <?php if( $_POST['newsletter'] == "yes" ){ echo "checked"; }?>/>
		<label for="newsletter">Subscribe to recieve updates and newsletters</label>
              </div>
                <div class="mdSUP01SbtBtn">
                  <button id="btnLeft" name="signup" type="submit">Sign up</button>
                </div>
              </form>
            </div>
          </div>
          <div class="MdSUP01RightBox">
            <h2>
              Log in
            </h2>
            <hr />
            <div class="MdSUP01FormBox">
              <div class="MdSUPErrBox">
<?php
if( $mode == "signin" ){
        echo $err_msg;
}
?>
              </div>
              <form id="signin" name="signin" action="/signin/signin" method="post">
                <dl>
                  <dt>
                    Email<span>*</span>
                  </dt>
                  <dd>
                    <input class="mdSUP01Text" type="text" name="signin_email" value="<?php echo htmlspecialchars($_POST['signin_email'], ENT_QUOTES, 'UTF-8');?>" />
                  </dd>
                </dl>
                <dl>
                  <dt>
                    Password<span>*</span>
                  </dt>
                  <dd>
                    <input class="mdSUP01Text" type="password" name="signin_password" value="<?php echo htmlspecialchars($_POST['signin_password'], ENT_QUOTES, 'UTF-8');?>"/>
                  </dd>
                </dl>
                <div class="mdSUP01SbtBtn">
                  <button id="btnRight" name="login" type="submit">Log in</button>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
<?php
include "../../view/common/footer.php";
?>
    </div>
  </body>
</html>
