<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/bedrooms/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['bedrooms_id'] = $_POST['bedrooms_id'];
}else{
	if(!empty($_POST['bedrooms_id'])){
		if( $_POST['bedrooms_id'] == $_SESSION['bedrooms_id'] ){
			$_SESSION['bedrooms_id'] = NULL;
		}else{
			$_SESSION['bedrooms_id'] = $_POST['bedrooms_id'];
		}
	}
}
?>

            <h4>Bedroom
              <ul class="ul chkbox">
<?php
$i=0;
$result = bedrooms_index();
while( $arr = mysql_fetch_array( $result )){
	if(!empty($_SESSION['bedrooms_id'])){
		if( $arr['id'] != $_SESSION['bedrooms_id'] ){
			continue;
		}
	}
        $i++;
?>
                <li>
                  <input type="checkbox" name="bedrooms_id" id="bedrooms_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_bedrooms('',<?php echo $arr['id'];?>)" <?php if( $arr['id'] == $_SESSION['bedrooms_id'] ){ echo "checked";} ?>>
                  <label for="bedrooms_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>
              </ul>
            </h4>
