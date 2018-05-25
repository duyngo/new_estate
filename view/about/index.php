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
    <title>What is NewPropertyList.my?</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale, About"/>
    <meta name="description" content="What is NewPropertyList.my? NewPropertyList.my is totally New Home Buyers oriented."/>
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
            <span>About</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="MdSTA02Visual">
      <h1>
        Be careful not to regret later.<span>Buying a house might be the biggest purchase in your life.</span>
      </h1>
    </div>
    <div class="LyContents">
      <div class="MdSTA02Why">
        <h2>Why use NewPropertyList.my?</h2>
        <div class="MdSTA02WhyBox">
          <div class="MdSTA02WhyCell">
            <img alt="" src="/assets/img/about1.png" />
            <h3>
              1. New Property Only
            </h3>
            <p>
              Are you looking for new property? We are dealing with new property only, excluding resale house.
            </p>
          </div>
          <div class="MdSTA02WhyCell">
            <img alt="" src="/assets/img/about2.png" />
            <h3>
              2. Developer Only
            </h3>
            <p>
              If you think to buy a new property, it’s better to buy from real estate developer, not from agent.
            </p>
          </div>
          <div class="MdSTA02WhyCell">
            <img alt="" src="/assets/img/about3.png" />
            <h3>
              3. Easy and Fast
            </h3>
            <p>
              Our search function make you easy to find, and send your enquiry to developer securely, directly and immediately.
            </p>
          </div>
        </div>
        <div class="MdCMN03List02">
          <ul>
<?php
$i=0;
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
        $i++;
?>
            <li>
              <div class="mdCMN03Img01">
                <a href="/<?php echo $arr['code'];?>"><img alt="" src="/admin/images/states/<?php echo $arr['image_path'];?>" /></a>
              </div>
              <p class="mdCMN03Txt01">
                <a href="/<?php echo $arr['code'];?>"><?php echo $arr['name'];?>(<?php echo $arr['listings_num'];?>)</a>
              </p>
            </li>
<?php
        if( $i == 4 ){
                break;
        }
}
?>
          </ul>
        </div>
      </div>
      <div class="MdSTA02Contact">
        <div class="MdTOP02HowToUse">
          <h2>
            How to Use
          </h2>
          <div class="MdTOP02BoxList01">
            <span class="mdMdTOP02Arrow02"></span><span class="mdMdTOP02Arrow03"></span>
            <ul class="mdMdTOP02List01">
              <li>
                <div class="mdTOP02Img01">
                  <img alt="" src="/assets/img/md_howto_search.png" />
                </div>
                <div class="mdTOP02Ttl01">
                  Search
                </div>
                <div class="mdTOP02Txt01">
                  Just tick the search criteria. Easy to narrow down
                </div>
              </li>
              <li>
                <div class="mdTOP02Img01">
                  <img alt="" src="/assets/img/md_howto_collect.png" />
                </div>
                <div class="mdTOP02Ttl01">
                  Collect
                </div>
                <div class="mdTOP02Txt01">
                  Collect your favourite. Properties into the list.
                </div>
              </li>
              <li>
                <div class="mdTOP02Img01">
                  <img alt="" src="/assets/img/md_howto_send.png" />
                </div>
                <div class="mdTOP02Ttl01">
                  Send Enquiry
                </div>
                <div class="mdTOP02Txt01">
                  Send enquiry and meet developers directly.
                </div>
              </li>
            </ul>
          </div>
          <div class="MdSTA02ContactTtl">
            Your questions is our concern. Please feel free to ask anything.
          </div>
          <div class="MdSTA02ContactBtnWrap">
            <a href="/contact/"><button class="MdSTA02ContactBtn" type="button">Move to Contact</button></a>
          </div>
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
