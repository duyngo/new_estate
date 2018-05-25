<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_plans";
$table_name_j = "Plans";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/listings_plans/common.php";
include "/home/newpropertylist.my/model/admin/listings_plans/original.php";
include "/home/newpropertylist.my/model/admin/listings_plans/list.php";
include "/home/newpropertylist.my/model/admin/listings/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	$_SESSION['listings_plans']['image_path'] = NULL;
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_SESSION['listings_plans']['image_path'] = $_POST['image_path'];
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
		if(!empty($_REQUEST['listings_id'])){
			$_POST['listings_id'] = $_REQUEST['listings_id'];
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
			$insert();
			$_SESSION[$table_name]{'status'} = "done";
		}
	}
	$_SESSION['listings_plans']['image_path'] = NULL;
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>