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
    <title>NewPropertyList.my: Malaysia new property portal</title>
    <meta name="keywords" content="NewPropertyList.my, new property for sale"/>
    <meta name="description" content="Search new property launches for sale in Malaysia. Find your next home by area, property types, number of bedrooms, size, prices and completion year on NewPropertyList.my"/>
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
  <body class="ExTop">
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
      <div class="LyHeadWrap" id="FnLyHeadWrap">
        <div class="LyHead ExTop" id="FnLyHead">
          <div class="lyHeadInner">
            <div class="MdGHD01Logo">
              <a href="/"></a>
            </div>
            <div class="MdGHD02Search ExTop" id="FnGHD02Search">
              <span>Search</span>
              <div class="MdGHD05SearchBox ExTop" id="FnGHD05SearchBox">
                <div class="MdGFT01FootBox01 ExNoBorder">
                  <div class="MdGFT01ListBox01">
                    <div class="mdGFT01Ttl01">
                      Search by Area
                    </div>
                    <ul>
<?php
$result = states_index( $type );
while( $arr = mysql_fetch_array( $result )){
	if( $arr['listings_num'] ){
?>
                      <li> <a class="ExHead" href="/<?php echo $arr['code'];?>/"><?php echo $arr['name'];?></a> </li>
<?php
	}
}
?>
                    </ul>
                  </div>
                  <div class="MdGFT01ListBox01">
                    <div class="mdGFT01Ttl01">
                      Search by Property types
                    </div>
                    <ul>
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
                      <li> <a class="ExHead" href="/all-state/new-<?php echo $arr['code'];?>-for-sale"><?php echo $arr['name'];?></a> </li>
<?php
}
?>
                    </ul>
                  </div>
                  <div class="MdGFT01ListBox01">
                    <div class="mdGFT01Ttl01">
                      Search by Prices
                    </div>
                    <ul>
<?php
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
?>
                      <li> <a class="ExHead" href="<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a> </li>
<?php
}
?>
                    </ul>
                  </div>
                  <div class="MdGFT01FloatBox01">
                    <div class="MdGFT01FloatBoxCell">
                      <div class="mdGFT01Ttl01">
                        Search by Features
                      </div>
                      <ul>
                        <li>
                          <a class="ExHead" href="/features/">See the List</a>
                        </li>
                      </ul>
                    </div>
                    <div class="MdGFT01FloatBoxCell">
                      <div class="mdGFT01Ttl01">
                        Search by Developers
                      </div>
                      <ul>
                        <li>
                          <a class="ExHead" href="/real-estate-developers/">See the List</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="MdGHD03Menu">
              <ul>
                <li>
                  <a href="/about/">About</a>
                </li>
                <li>
<?php
if(empty($_SESSION['members_id'])){
?>
                  <a href="/signin/">Login</a>
<?php
}else{
?>
                  <a href="/signout/">Logout</a>
<?php
}
?>
                </li>
              </ul>
            </div>
            <div class="MdGHD03Enquiry">
              <a href="/enquiry/collection">Enquiry collection</a>
            </div>
            <div class="MdGHD06SendIcon"><?php echo favorites_num();?></div>
          </div>
        </div>
      </div>
      <div class="MdTOP00Head">
        <div class="lyHeadInner">
          <div class="MdGHD01Logo ExTop">
            <a href="/"></a>
          </div>
          <div class="MdGHD02SearchTop" id="FnGHD02SearchTop">
            <span>Search</span>
            <div class="MdGHD05SearchBoxTop ExTop" id="FnGHD05SearchBoxTop">
              <div class="MdGFT01FootBox01 ExNoBorder">
                <div class="MdGFT01ListBox01">
                  <div class="mdGFT01Ttl01">
                    Search by Area
                  </div>
                  <ul>
<?php
$result = states_index( $type );
while( $arr = mysql_fetch_array( $result )){
	if( $arr['listings_num'] ){
?>
                    <li> <a class="ExHead" href="/<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a> </li>
<?php
	}
}
?>
                  </ul>
                </div>
                <div class="MdGFT01ListBox01">
                  <div class="mdGFT01Ttl01"> Search by Property types </div>
                  <ul>
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
                    <li> <a class="ExHead" href="/all-state/new-<?php echo $arr['code'];?>-for-sale"><?php echo $arr['name'];?></a> </li>
<?php
}
?>
                  </ul>
                </div>
                <div class="MdGFT01ListBox01">
                  <div class="mdGFT01Ttl01"> Search by Prices </div>
                  <ul>
<?php
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
?>
                    <li> <a class="ExHead" href="/all-state/<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a> </li>
<?php
}
?>
                  </ul>
                </div>
                <div class="MdGFT01FloatBox01">
                  <div class="MdGFT01FloatBoxCell">
                    <div class="mdGFT01Ttl01">
                      Search by Features
                    </div>
                    <ul>
                      <li>
                        <a class="ExHead" href="/features/">See the List</a>
                      </li>
                    </ul>
                  </div>
                  <div class="MdGFT01FloatBoxCell">
                    <div class="mdGFT01Ttl01">
                      Search by Developers
                    </div>
                    <ul>
                      <li>
                        <a class="ExHead" href="/real-estate-developers/">See the List</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="MdGHD03Menu">
            <ul>
              <li>
                <a class="ExTop" href="/about/">About</a>
              </li>
              <li>
<?php
if(empty($_SESSION['members_id'])){
?>
                  <a class="ExTop" href="/signin/">Login</a>
<?php
}else{
?>
                  <a class="ExTop" href="/signout/">Logout</a>
<?php
}
?>
              </li>
            </ul>
          </div>
          <div class="MdGHD03Enquiry">
            <a class="ExTop" href="/enquiry/collection">Enquiry collection</a>
          </div>
          <div class="MdGHD06SendIcon ExTop"><?php echo favorites_num();?></div>
        </div>
      </div>


      <div class="MdTOP01TopVisual" id="FnTOP01TopVisual">
        <div class="MdTOP03Loading" id="FnTOP03Loading">
          <div class="MdTop03Img01"></div>
        </div>
<?php
$i=0;
$result = banners_index();
while($arr = mysql_fetch_array( $result )){
	$i++;
?>
        <span class="MdTOP01Item<?php if( $i == 1 ){ ?> ExActive<?php } ?>" id="FnTOP01Item"><img src="/admin/images/banners/<?php echo $arr['image_path'];?>" alt="<?php echo $arr['alt'];?>"/></span>
        <div class="MdTOP01MainTtl" <?php if( $i > 1){ ?>style="display:none;"<?php } ?>>
<?php if( $i==1){ ?> <h1> <?php } ?> <?php echo $arr['title'];?> <?php if( $i==1){ ?> </h1> <?php } ?>
        </div>
        <p <?php if( $i > 1){ ?>style="display:none;"<?php } ?>><?php echo $arr['description'];?></p>
        <a class="mdLearnMore" href="<?php echo $arr['url'];?>" <?php if( $i > 1){ ?>style="display:none;"<?php } ?>><?php echo $arr['button_name'];?></a>
<?php
}
?>

        <div class="MdTOP01Filter"></div>
      </div>

        <div class="MdTOP02HowToUse">
          <h2>
            How to Use (3 Steps)
          </h2>
          <div class="MdTOP02BoxList01">
            <span class="mdMdTOP02Arrow02"></span><span class="mdMdTOP02Arrow03"></span>
            <ul class="mdMdTOP02List01">
              <li>
                <div class="mdTOP02Img01">
                  <a href="/all-state/"><img alt="" src="/assets/img/md_howto_search.png" /></a>
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
        </div>


      <div class="LyContents">

        <div class="MdCMN01ListTitle01">
          <div class="mdCMN01Ttl01"> <h3>Popular areas</h3> </div>
          <div class="mdCMN01Btn01">
            <a href="/areas/">See all areas</a>
          </div>
        </div><!--mdCMN01Ttl01-->
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
              <div class="mdCMN03Txt01">
                <a href="/<?php echo $arr['code'];?>"><?php echo $arr['name'];?> (<?php echo $arr['listings_num'];?>)</a>
              </div>
            </li>
<?php
	if( $i == 4 ){
		break;
	}
}
?>
          </ul>
        </div><!--MdCMN03List02-->




        <div class="MdCMN01ListTitle01">
          <div class="mdCMN01Ttl01">
            <h3> Recommended </h3>
          </div>
        </div><!--MdCMN01ListTitle01-->
        <div class="MdCMN02List01">
          <ul>
<?php
$result = listings_top_index();
while( $arr = mysql_fetch_array( $result )){
?>
            <li>
              <div class="mdCMN02Img01"> <a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><img alt="" src="/admin/images/listings/<?php echo $arr['main_picture'];?>" /></a> </div>
              <div class="mdCMN02Ttl01"> <a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><?php echo $arr['name'];?></a> </div>
              <div class="mdCMN02Txt01"><?php echo str_replace("\n","<br />",$arr['price_name']);?></div>
              <div class="mdCMN02Txt02"><?php echo $arr['address'];?></div>
            </li>
<?php
}
?>
          </ul>
        </div><!--MdCMN02List01-->





        <div class="MdCMN01ListTitle01">
          <div class="mdCMN01Ttl01"><h3>Search by features</h3></div>
          <div class="mdCMN01Btn01">
            <a href="/features/">See all features</a>
          </div>
        </div>
        <div class="MdCMN03List02">
          <ul>
<?php
$i=0;
$result = features_index();
while( $arr = mysql_fetch_array( $result )){
	$i++;
?>
            <li>
              <div class="mdCMN03Img01"> <a href="/features/<?php echo $arr['code'];?>"><img alt="" src="/admin/images/features/<?php echo $arr['image_path'];?>" /></a> </div>
              <div class="mdCMN03Txt01">
                <a href="/features/<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a>
              </div>
            </li>
<?php
	if( $i == 4 ){
		break;
	}
}
?>
          </ul>
        </div>
        <div class="MdCMN01ListTitle01">
          <div class="mdCMN01Ttl01"><h3>Search by developers</h3></div>
          <div class="mdCMN01Btn01">
            <a href="/real-estate-developers/">See all developers</a>
          </div>
        </div>
        <div class="MdCMN04List03">
          <ul>
<?php
$result = companies_index("on");
while( $arr = mysql_fetch_array( $result )){
?>
            <li>
              <div class="mdCMN04Img01">
                <a href="/real-estate-developers/<?php echo $arr['code'];?>"><img alt="" src="/admin/images/companies/<?php echo $arr['logo_image_path'];?>" /></a>
              </div>
              <div class="mdCMN04Txt01">
                <a href="/real-estate-developers/<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a>
              </div>
            </li>
<?php
}
?>
          </ul>
        </div>

<?php
if(!empty($_COOKIE['newpropertylist']['RecentSearches'])){
?>

        <div class="MdCMN01ListTitle01">
          <div class="mdCMN01Ttl01"><h3>Recent searches</h3></div>
        </div>
        <div class="MdCMN04List03 ExBorderNone">
          <ul>
<?php
$i=0;
$rs = explode(",",$_COOKIE['newpropertylist']['RecentSearches']);
foreach( $rs as $key ){
        if( listings_display_check( $key )){
		$i++;
                $listings_code = common_get_value("listings","code",$key,"");
                $result = listings_detail( $listings_code );
                $arr = mysql_fetch_array( $result );
?>
            <li>
              <div class="mdCMN04Img01">
                <a href="/<?php echo $arr['states_code'];?>/<?php echo $arr['code'];?>-in-<?php echo $arr['locations_code'];?>"><img alt="" src="/admin/images/listings/<?php echo $arr['main_picture'];?>" /></a>
              </div>
            </li>
<?php
	if( $i == 8 ){
		break;
	}
}
}
?>
          </ul>
        </div>
<?php
}
?>


      </div>
<?php
include "../view/common/footer.php";
?>
    </div>
  </body>
</html>
