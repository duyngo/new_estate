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
    <title>npl</title>
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
      <div class="LyContents">
        <div class="MdSTA04TtlBox">
          <h1>
            404 Not Found
          </h1>
        </div>
        <div class="MdSTA04Txt">
          <p>
            We are sorry, but it seems the page that you are looking for cannot be found.
          </p>
          <p>
            It is possible that the page you tried to access has been deleted or the URL of which has been changed.
          </p>
          <p>
            Find your desired page again from the following methods.
          </p>
        </div>
      </div>
    </div>
<?php
include "../../view/common/footer.php";
?>
    </div>
<?php
include $_SERVER['BASE_DIR'] . "/view/common/footer_js.php";
?>
  </body>
</html>
