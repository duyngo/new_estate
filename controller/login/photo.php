<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/genba/model/common/func.php";
include "/home/genba/model/common/list.php";
include "/home/genba/model/mysql/func.php";
include "/home/genba/model/login/photo.php";

common_cookie_check();
common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "" ){

}else if( $_POST['act'] == "conf" ){
	$err_msg = NULL;
	$err_msg .= photo_err_check();
	$err_msg .= photo_image_upload();
	if(empty($err_msg)){
		photo_insert();
		header('Location:/login/photo.php');
		exit;
	}
}else if( $_POST['act'] == "del" ){
	photo_delete();
	header('Location:/login/photo.php');
	exit;
}
if( $_REQUEST['act'] == "update_sort" ){
	photo_update_sort($_REQUEST['type'],$_REQUEST['id']);
	header('Location:/login/photo.php#table');
	exit;
}
$result = photo_index( $_SESSION['companies_id'] );
?>
