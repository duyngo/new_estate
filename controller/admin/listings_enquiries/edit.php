<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_enquiries";
$table_name_j = "Enquiries";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings_enquiries/common.php";
include "../../../model/admin/listings_enquiries/original.php";
include "../../../model/admin/listings_enquiries/list.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/members/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
		if(!empty($_REQUEST['listings_id'])){
			$_POST['listings_id'] = $_REQUEST['listings_id'];
		}
		if(!empty($_REQUEST['members_id'])){
			$_POST['members_id'] = $_REQUEST['members_id'];
		}
	}
}else if( $_POST['act'] == "conf" ){
	$err_msg = $err_check( NULL );
	if(!empty($err_msg)){
		$_POST['act'] = "err";
	}
}else if( $_POST['act'] == "edit" ){
	if(!empty($_POST['id'])){
		$update();
	}else{
		if( $_SESSION[$table_name]{'status'} == "yet" ){
			$_POST['id'] = $insert();
			$_SESSION[$table_name]{'status'} = NULL;
		}
	}
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>