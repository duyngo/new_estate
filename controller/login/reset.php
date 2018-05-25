<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/genba/model/common/func.php";
include "/home/genba/model/common/list.php";
include "/home/genba/model/mysql/func.php";
include "/home/genba/model/login/reset.php";

//common_cookie_check();
//common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	if(!empty($_REQUEST['reissue_code'])){
		$err_msg = reset_reissue_code_check( $_REQUEST['reissue_code'] );
		if(empty($err_msg)){
			$_SESSION['reissue_code'] = $_REQUEST['reissue_code'];
			header('Location:/login/reset.php');
		}else{
			$_POST['act'] = "invalid";
		}
	}
}if( $_POST['act'] == "conf" ){
	$err_msg = NULL;
	$err_msg = reset_err_check();
	if(empty($err_msg)){
		reset_update();
		$_POST['act'] = "done";
	}
}
?>
