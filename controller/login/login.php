<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/genba/model/common/func.php";
include "/home/genba/model/common/list.php";
include "/home/genba/model/mysql/func.php";
include "/home/genba/model/login/login.php";

common_cookie_check();
//common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "" ){
		if(!empty($_COOKIE['genba'])){
		$tmp_arr = explode(",",$_COOKIE['genba']);
		$_POST['email'] = $tmp_arr[3];
		$_POST['password'] = $tmp_arr[4];
		$_POST['save'] = $tmp_arr[5];
	}
}else if( $_POST['act'] == "conf" ){
	$err_msg = NULL;
	$err_msg = login_err_check();
	if(empty($err_msg)){
		header('Location:/login/');
		exit;
	}
}
?>
