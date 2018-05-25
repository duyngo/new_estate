<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/genba/model/common/func.php";
include "/home/genba/model/common/list.php";
include "/home/genba/model/mysql/func.php";
include "/home/genba/model/login/notification.php";

common_cookie_check();
common_login_check();
mysql_mysql_connect();

$contact_num = "5";

if( $_POST['act'] == "" ){
	$_POST = notification_init();
	$_POST['email'] = common_get_value("companies","email",$_SESSION['companies_id']);
}else if( $_POST['act'] == "conf" ){
	$err_msg = NULL;
	$err_msg = notification_err_check( $contact_num );
	if(empty($err_msg)){
		notification_main( $contact_num );
		header('Location:/login/');
		exit;
	}
}
if( $_REQUEST['act'] == "del" ){
	notification_delete( $_REQUEST['contact_id'] );
	header('Location:/login/notification.php');
}
?>
