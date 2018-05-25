<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/genba/model/common/func.php";
include "/home/genba/model/common/list.php";
include "/home/genba/model/mysql/func.php";
include "/home/genba/model/login/reissue.php";

//common_cookie_check();
//common_login_check();
mysql_mysql_connect();


if( $_POST['act'] == "conf" ){
	$err_msg = NULL;
	$err_msg = reissue_err_check();
	if(empty($err_msg)){
		$reissue_code = reissue_update();
		reissue_send_mail( $reissue_code );
		$_POST['act'] = "done";
	}
}
?>
