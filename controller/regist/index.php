<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/uluru/model/common/func.php";
include "/home/uluru/model/common/list.php";
include "/home/uluru/model/mysql/func.php";
include "/home/uluru/model/regist/index.php";

mysql_mysql_connect();

if(!empty($_REQUEST['act'])){
	$_POST['act'] = $_REQUEST['act'];
}
if(empty($_POST['act'])){
	$_SESSION['regist']{'status'} = "yet";
}else if( $_POST['act'] == "conf" ){
	$err_msg = regist_err_check();
	if(!empty($err_msg)){
		$_POST['act'] = "err";
	}
}else if( $_POST['act'] == "main" ){
	if( $_SESSION['regist']{'status'} == "yet" ){
		regist_main();
		$_SESSION['regist']{'status'} = "done";
		$_POST['act'] = "done";
	}
}else if( $_POST['act'] == "auth" ){
	$search_code = regist_auth( $_REQUEST['auth_code'] );
	$_POST['act'] = "auth_done";
}
?>
