<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/sizes/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['sizes_id'] = $_POST['sizes_id'];
}else{
	if(!empty($_POST['sizes_id'])){
		if( $_POST['sizes_id'] == $_SESSION['sizes_id'] ){
			$_SESSION['sizes_id'] = NULL;
		}else{
			$_SESSION['sizes_id'] = $_POST['sizes_id'];
		}
	}
}
?>

            <h4>Size
              <ul class="ul chkbox">
<?php
$i=0;
$result = sizes_index();
while( $arr = mysql_fetch_array( $result )){
	if(!empty($_SESSION['sizes_id'])){
		if( $arr['id'] != $_SESSION['sizes_id'] ){
			continue;
		}
	}
        $i++;
?>
                <li>
                  <input type="checkbox" name="sizes_id" id="sizes_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_sizes('',<?php echo $arr['id'];?>)" <?php if( $arr['id'] == $_SESSION['sizes_id'] ){ echo "checked";} ?>>
                  <label for="sizes_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>
              </ul>
            </h4>
