      <div class="LyHeadWrap" id="FnLyHeadWrap">
        <div class="LyHead" id="FnLyHead">
          <div class="lyHeadInner">
            <div class="MdGHD01Logo">
              <a href="/"></a>
            </div>
<?php
if( strpos($_SERVER['REQUEST_URI'],"/enquiry/input")===false && strpos($_SERVER['REQUEST_URI'],"/enquiry/completion")===false ){
?>
            <div class="MdGHD02Search" id="FnGHD02Search">
              <span>Search</span>
              <div class="MdGHD05SearchBox" id="FnGHD05SearchBox">
                <div class="MdGFT01FootBox01 ExNoBorder">
                  <div class="MdGFT01ListBox01">
                    <div class="mdGFT01Ttl01">
                      Search by Area
                    </div>
                    <ul>
<?php
$result_h = states_index( $type );
while( $arr_h = mysql_fetch_array( $result_h )){
        if( $arr_h['listings_num'] ){
?>
                      <li> <a class="ExHead" href="/<?php echo $arr_h['code'];?>/"><?php echo $arr_h['name'];?></a> </li>
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
$result_h = property_type_groups_index();
while( $arr_h = mysql_fetch_array( $result_h )){
?>
                      <li> <a class="ExHead" href="/all-state/new-<?php echo $arr_h['code'];?>-for-sale"><?php echo $arr_h['name'];?></a> </li>
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
$result_h = prices_index();
while( $arr_h = mysql_fetch_array( $result_h )){
?>
                      <li> <a class="ExHead" href="<?php echo $arr_h['code'];?>"><?php echo $arr_h['name'];?></a> </li>
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
                        <li> <a class="ExHead" href="/features/">See the List</a> </li>
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
<?php
}
if( strpos($_SERVER['REQUEST_URI'],"/enquiry/input")===false && strpos($_SERVER['REQUEST_URI'],"/enquiry/completion")===false ){
?>
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
<?php
}
if( strpos($_SERVER['REQUEST_URI'],"/enquiry/completion")===false ){
?>
            <div class="MdGHD03Enquiry">
              <a href="/enquiry/collection">Enquiry collection</a>
            </div>
            <div class="MdGHD06SendIcon cart"><?php echo $fav_num;?></div>
<?php
}
?>
          </div>
        </div>
      </div>
