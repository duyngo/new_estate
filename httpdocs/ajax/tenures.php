<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/tenures/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['tenures_id'] = $_POST['tenures_id'];
}else{
	if(!empty($_POST['tenures_id'])){
		if( $_POST['tenures_id'] == $_SESSION['tenures_id'] ){
			$_SESSION['tenures_id'] = NULL;
		}else{
			$_SESSION['tenures_id'] = $_POST['tenures_id'];
		}
	}
}
?>

            <h4>Tenure
              <ul class="ul chkbox">
<?php
$i=0;
$result = tenures_index();
while( $arr = mysql_fetch_array( $result )){
	if(!empty($_SESSION['tenures_id'])){
		if( $arr['id'] != $_SESSION['tenures_id'] ){
			continue;
		}
	}
        $i++;
?>
                <li>
                  <input type="checkbox" name="tenures_id" id="tenures_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_tenures('',<?php echo $arr['id'];?>)" <?php if( $arr['id'] == $_SESSION['tenures_id'] ){ echo "checked";} ?>>
                  <label for="tenures_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>
              </ul>
            </h4>
