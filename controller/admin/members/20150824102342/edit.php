<?php
//ini_set( 'display_errors', 1 );
$table_name = "members";
$table_name_j = "Members";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/members/common.php";
include "/home/newpropertylist.my/model/admin/members/original.php";
include "/home/newpropertylist.my/model/admin/members/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_POST['password'] = NULL;
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
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
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>