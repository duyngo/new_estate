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
    <title>Contact Us</title>
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
            <span>Contact</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="LyContents">
      <div class="MdINQ01TtlBox">
        <h1>
          Contact Us
        </h1>
      </div>
      <div class="MdINQ02FormBox">
        <div class="mdINQ02ErrBox">
          <p>
<?php
echo $err_msg;
?>
          </p>
        </div>
        <form action="/contact/" method="POST">
          <dl>
            <dt>
              Name<span>*</span>
            </dt>
            <dd>
              <input class="mdINQ02FormText" type="text" name="name" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');?>" />
            </dd>
          </dl>
          <dl>
            <dt>
              E-mail<span>*</span>
            </dt>
            <dd>
              <input class="mdINQ02FormText" type="text" name="email" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');?>" />
            </dd>
          </dl>
          <dl>
            <dt>
              Phone
            </dt>
            <dd>
              <input class="mdINQ02FormText" type="text" name="phone" value="<?php echo htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');?>" />
            </dd>
          </dl>
          <dl>
            <dt>
              Content<span>*</span>
            </dt>
            <dd>
              <textarea class="mdINQ02FormContent" name="content"><?php echo htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');?></textarea>
            </dd>
          </dl>
          <div class="mdINQ02SbtBtnWrap">
            <button class="mdINQ02SbtBtn" name="inquiry" type="submit">Submit</button>
          </div>
          <input type="hidden" name="act" value="contact">
        </form>
      </div>
    </div>
<?php
include "../../view/common/footer.php";
?>
    </div>
  </body>
</html>
