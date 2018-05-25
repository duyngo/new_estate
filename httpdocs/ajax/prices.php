<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/prices/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['prices_id'] = $_POST['prices_id'];
}else{
	if(!empty($_POST['prices_id'])){
		if( $_POST['prices_id'] == $_SESSION['prices_id'] ){
			$_SESSION['prices_id'] = NULL;
		}else{
			$_SESSION['prices_id'] = $_POST['prices_id'];
		}
	}
}
?>

            <h4>Price
              <ul class="ul chkbox">
<?php
$i=0;
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
	if(!empty($_SESSION['prices_id'])){
		if( $arr['id'] != $_SESSION['prices_id'] ){
			continue;
		}
	}
        $i++;
?>
                <li>
                  <input type="checkbox" name="prices_id" id="prices_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_prices('',<?php echo $arr['id'];?>)" <?php if( $arr['id'] == $_SESSION['prices_id'] ){ echo "checked";} ?>>
                  <label for="prices_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>
              </ul>
            </h4>
