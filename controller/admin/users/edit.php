<?php
//ini_set( 'display_errors', 1 );
$tables_name = "users";
$tables_logical_name = "Internal User";
$err_check = $tables_name . "_err_check";
$update = $tables_name . "_update";
$insert = $tables_name . "_insert";

session_start();
include "/home/".$_SERVER['SERVER_NAME']."/model/common/common.php";
include "/home/".$_SERVER['SERVER_NAME']."/model/common/list.php";
include "/home/".$_SERVER['SERVER_NAME']."/model/mysql/common.php";
include "/home/".$_SERVER['SERVER_NAME']."/model/admin/common/common.php";
include "/home/".$_SERVER['SERVER_NAME']."/model/admin/" . $tables_name . "/edit.php";
include "/home/".$_SERVER['SERVER_NAME']."/model/admin/" . $tables_name . "/list.php";

admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($tables_name,$_REQUEST['id'],"");
		$_POST['password'] = NULL;
	}else{
		$_SESSION[$tables_name]{'status'} = "yet";
	}
}else if( $_POST['act'] == "conf" ){
	$err_msg = $err_check();
	if(!empty($err_msg)){
		$_POST['act'] = "err";
	}
}else if( $_POST['act'] == "edit" ){
	if(!empty($_POST['id'])){
		$update();
	}else{
		if( $_SESSION[$tables_name]{'status'} == "yet" ){
			$insert();
			$_SESSION[$tables_name]{'status'} = "done";
		}
	}
	header('Location:/admin/' . $tables_name . '/');
	exit;
}
?>
