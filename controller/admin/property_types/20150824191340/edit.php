<?php
//ini_set( 'display_errors', 1 );
$table_name = "property_types";
$table_name_j = "Property type";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/property_types/common.php";
include "/home/newpropertylist.my/model/admin/property_types/original.php";
include "/home/newpropertylist.my/model/admin/property_types/list.php";
include "/home/newpropertylist.my/model/admin/property_type_groups/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	$_SESSION['property_types']['image_path'] = NULL;
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_SESSION['property_types']['image_path'] = $_POST['image_path'];
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
		if(!empty($_REQUEST['property_type_groups_id'])){
			$_POST['property_type_groups_id'] = $_REQUEST['property_type_groups_id'];
		}
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
			$_POST['id'] = $insert();
			$_SESSION[$table_name]{'status'} = NULL;
		}
	}
	$_SESSION['property_types']['image_path'] = NULL;
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>