<?php
//ini_set( 'display_errors', 1 );
session_start();
include $_SERVER['BASE_DIR'] . "/model/common/common.php";
include $_SERVER['BASE_DIR'] . "/model/common/list.php";
include $_SERVER['BASE_DIR'] . "/model/mysql/common.php";
include $_SERVER['BASE_DIR'] . "/model/admin/login/common.php";
include $_SERVER['BASE_DIR'] . "/model/admin/users/list.php";

mysql_mysql_connect();

if(empty($_POST['act'])){
	$tmp_arr = explode(".",$_SERVER['SERVER_NAME']);
	$cookie = $tmp_arr[0];
	if(!empty($_COOKIE[$cookie])){
                $tmp_arr = explode(",",$_COOKIE[$cookie]);
                $_POST['email'] = $tmp_arr[1];
                $_POST['password'] = $tmp_arr[2];
                $_POST['autoLogin'] = $tmp_arr[3];
        }
}else if( $_POST['act'] == "conf" ){
        $err_msg = NULL;
        $err_msg = admin_login_err_check();
        if(empty($err_msg)){
                header('Location:/admin/users/');
                exit;
        }
}
?>
