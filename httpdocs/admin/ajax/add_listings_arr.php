<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
session_start();

if(empty($_POST['listings_id'])){
	$_SESSION['listings_id_array'] = NULL;
}else{
	if(empty($_SESSION['listings_id_array'])){
		$_SESSION['listings_id_array'] = $_POST['listings_id'];
	}else{
		if(strpos($_SESSION['listings_id_array'],$_POST['listings_id'])===false){
			$_SESSION['listings_id_array'] .= "," . $_POST['listings_id'];
		}else{
			$listings_id = NULL;
			$tmp_arr = explode(",",$_SESSION['listings_id_array']);
			foreach( $tmp_arr as $key ){
				if( $key != $_POST['listings_id'] ){
					if(empty($listings_id)){
						$listings_id = $key;
					}else{
						$listings_id .= "," . $key;
					}
				}
			}
			$_SESSION['listings_id_array'] = $listings_id;
		}
	}
}
if(!empty($_SESSION['listings_id_array'])){
?>

<div style="margin-bottom:10px;margin-left:1000px;">
<table>
<tr>
<td>
<form action="/admin/listings_enquiries/index.php" method="post" onsubmit="return send_mail_check();">
<input type="submit" value="Send mail checked record">
<input type="hidden" name="act" value="send_mail_all">
</form>
</td>
<td>
<form action="/admin/listings_enquiries/index.php" method="post" onsubmit="return delete_check();">
<input type="submit" value="Delete checked record">
<input type="hidden" name="act" value="delete_all">
</form>
</td>
</tr>
</table>
</div>

<?php
}
?>
