<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/genba/model/common/func.php";
include "/home/genba/model/common/list.php";
include "/home/genba/model/mysql/func.php";
include "/home/genba/model/login/area.php";

common_cookie_check();
common_login_check();
mysql_mysql_connect();
if( $_POST['act'] == "" ){
	$_POST = common_get_value_all("companies",$_SESSION['companies_id']);
}else if( $_POST['act'] == "conf" ){
	$err_msg = NULL;
	$err_msg = area_err_check();
	if(empty($err_msg)){
		area_update();
		header('Location:/login/');
		exit;
	}
}
?>
