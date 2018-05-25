<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_enquiries";
$table_name_j = "Enquiries";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 0;

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings_enquiries/common.php";
include "../../../model/admin/listings_enquiries/original.php";
include "../../../model/admin/listings_enquiries/list.php";
include "../../../model/admin/listings/common.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	if(empty($_SESSION['listings_enquiries']['send_date'])){
		$_SESSION['listings_enquiries']['send_date'] = NULL;
	}
}else if( $_POST['act'] == "search" ){
	$_SESSION['listings_enquiries']['id'] = $_POST['id'];
	$_SESSION['listings_enquiries']['listings_id'] = $_POST['listings_id'];
	$_SESSION['listings_enquiries']['status'] = $_POST['status'];
	$_SESSION['listings_enquiries']['name'] = $_POST['name'];
	$_SESSION['listings_enquiries']['email'] = $_POST['email'];
	$_SESSION['listings_enquiries']['phone'] = $_POST['phone'];
	$_SESSION['listings_enquiries']['send_date'] = $_POST['send_date'];
	//20160211如何あると検索後リダイレクトされる事によってsend_dataがセットされてしまう為コメントアウト
	//header('Location:/admin/listings_enquiries/');
	//exit;
}else if( $_POST['act'] == "clear" ){
	$_SESSION['listings_enquiries']['id'] = NULL;
	$_SESSION['listings_enquiries']['listings_id'] = NULL;
	$_SESSION['listings_enquiries']['status'] = NULL;
	$_SESSION['listings_enquiries']['name'] = NULL;
	$_SESSION['listings_enquiries']['email'] = NULL;
	$_SESSION['listings_enquiries']['phone'] = NULL;
	$_SESSION['listings_enquiries']['send_date'] = NULL;
}else if( $_POST['act'] == "send_mail" ){
	listings_enquiries_send_mail_to_client($_POST['listings_id']);
	listings_enquiries_update_send_date($_POST['id']);
	listings_enquiries_update_achievement_rate($_POST['listings_id']);
	header('Location:/admin/' . $table_name);
	exit;
}else if( $_POST['act'] == "send_mail_all" ){
	$tmp_arr = explode(",",$_SESSION['listings_id_array']);
	foreach( $tmp_arr as $key ){
		//送信状況チェック（一括処理の場合は送信済のレコードが送信対象として選択される事がある）
		$result = common_get_value_all_2("listings_enquiries","id",$key);
		$arr = mysql_fetch_array( $result );
		if( $arr['send_date'] == "0000-00-00 00:00:00" ){
			listings_enquiries_send_mail_to_client($arr['listings_id']);
			listings_enquiries_update_send_date($key);
			listings_enquiries_update_achievement_rate($arr['listings_id']);
			sleep(1);
		}
	}
	$_SESSION['listings_id_array'] = NULL;
	header('Location:/admin/' . $table_name);
	exit;
}else if( $_POST['act'] == "delete_all" ){
	$tmp_arr = explode(",",$_SESSION['listings_id_array']);
	foreach( $tmp_arr as $key ){
		listings_enquiries_delete( $key );
	}
	$_SESSION['listings_id_array'] = NULL;
	header('Location:/admin/' . $table_name);
	exit;
}
if( $_REQUEST['act'] == "delete" ){
	listings_enquiries_delete( $_REQUEST['id'] );
	header('Location:./index.php');
	exit;
}else if( $_REQUEST['act'] == "update_status" ){
	listings_enquiries_update_status($_REQUEST['id'],$_REQUEST['status']);
	header('Location:/admin/' . $table_name);
	exit;
}

//一覧表示用のSQL実行（まずヒット件数を知る）
$result = $index();
$row_num = mysql_num_rows( $result );
?>
