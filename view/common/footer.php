      <div class="MdCMN05FaceBookBox">
        <div class="MdCMN05InnerBox">
          <a href="https://www.facebook.com/newpropertylist.my/" target="_blank">
            <div class="mdCMN05Logo">
              <img alt="" src="/assets/img/cmn_fb_logo.png" />
            </div>
            <div class="mdCMN05Txt01">
              Follow us on Facebook
            </div>
          </a>
        </div>
      </div>
      <div class="LyFoot">
        <div class="MdGFT01FootBox01">

          <div class="MdGFT01InnerBox01">
            <div class="MdGFT01ListBox01">
              <div class="mdGFT01Ttl01"> NewPropertyList.my </div>
              <ul>
                <li>Are you looking for new property in Malaysia? Smart new property finder for new home buyers is here.
Buying a house might be the biggest purchase in your life. You should be careful not to regret later. If you think to buy a new property development, it’s better for you to buy from real estate developer, not from agent. NewPropertyList.my provide reliable and adequate information for you, new home buyers. Our listings is being provided directly only from real estate developers. So you can get all of the information which trustable and good for you is only on NewPropertyList.my</li>
              </ul>
            </div>
           </div>




          <div class="MdGFT01InnerBox01">
            <div class="MdGFT01ListBox01">
              <div class="mdGFT01Ttl01">
                Search by Area
              </div>
<?php
$type_list = array("a","b");
foreach( $type_list as $type ){
$result = states_index( $type );
while( $arr = mysql_fetch_array( $result )){
	if( $arr['listings_num'] ){
?>
              <dl>
                <dt><a href="/<?php echo $arr['code'];?>"><?php echo $arr['name'];?></a></dt>
                <dd>
                  <ul>
<?php
        $result2 = groups_index( $arr['id'] );
        while( $arr2 = mysql_fetch_array( $result2 )){
		if( $arr2['listings_num'] ){
?>
                    <li><?php if( $arr2['listings_num'] ){ ?><a href="/<?php echo $arr['code'];?>/<?php echo $arr2['code'];?>"><?php } ?><?php echo $arr2['name'];?><?php if( $arr2['listings_num'] ){ ?></a><?php } ?></li>
<?php
		}
	}
?>
                  </ul>
                </dd>
              </dl>
<?php
		}
	}
}
?>

             </div>

            <div class="MdGFT01ListBox01">
              <div class="mdGFT01Ttl01"> Search by Property types </div>
              <ul>
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
                <li><?php if( $arr['listings_num'] ){ ?><a href="/all-state/new-<?php echo $arr['code'];?>-for-sale"><?php } ?><?php echo $arr['name'];?><?php if( $arr['listings_num'] ){ ?></a><?php } ?></li>
<?php
}
?>
              </ul>
            </div>

            <div class="MdGFT01ListBox01">
              <div class="mdGFT01Ttl01"></div>
              <ul>
                <li><a href="/">NewPropertyList.my top</a></li>
                <li><a href="/sitemap/">Site map</a></li>
                <li><a href="/terms/">Terms of conditions</a></li>
                <li><a href="/privacy/">Privacy Policy</a></li>
                <li><a href="/disclaimers/">Disclaimers</a></li>
                <li><a href="/contact/">Contact Us</a></li>
                <li><a href="/archive/">Archive</a></li>
              </ul>
            </div>


          </div>
        </div>
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
