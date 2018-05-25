<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/completion_years/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

if( $_POST['mode'] == "init" ){
	$_SESSION['completion_years_id'] = $_POST['completion_years_id'];
}else{
	if(!empty($_POST['completion_years_id'])){
		if( $_POST['completion_years_id'] == $_SESSION['completion_years_id'] ){
			$_SESSION['completion_years_id'] = NULL;
		}else{
			$_SESSION['completion_years_id'] = $_POST['completion_years_id'];
		}
	}
}
?>

            <h4>Completion Year
              <ul class="ul chkbox">
<?php
$i=0;
$result = completion_years_index();
while( $arr = mysql_fetch_array( $result )){
	if(!empty($_SESSION['completion_years_id'])){
		if( $arr['id'] != $_SESSION['completion_years_id'] ){
			continue;
		}
	}
        $i++;
?>
                <li>
                  <input type="checkbox" name="completion_years_id" id="completion_years_<?php echo $i;?>" value="<?php echo $arr['id'];?>" onclick="ajax_completion_years('',<?php echo $arr['id'];?>)" <?php if( $arr['id'] == $_SESSION['completion_years_id'] ){ echo "checked";} ?>>
                  <label for="completion_years_<?php echo $i;?>"><?php echo $arr['name'];?></label>
                </li>
<?php
}
?>
              </ul>
            </h4>
