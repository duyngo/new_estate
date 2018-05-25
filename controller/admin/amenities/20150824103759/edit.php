<?php
//ini_set( 'display_errors', 1 );
$table_name = "amenities";
$table_name_j = "Amenity";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/amenities/common.php";
include "/home/newpropertylist.my/model/admin/amenities/original.php";
include "/home/newpropertylist.my/model/admin/amenities/list.php";
include "/home/newpropertylist.my/model/admin/states/common.php";
include "/home/newpropertylist.my/model/admin/groups/common.php";
include "/home/newpropertylist.my/model/admin/amenity_categories/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	$_SESSION['amenities']['image_path'] = NULL;
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_SESSION['amenities']['image_path'] = $_POST['image_path'];
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
		if(!empty($_REQUEST['states_id'])){
			$_POST['states_id'] = $_REQUEST['states_id'];
		}
		if(!empty($_REQUEST['groups_id'])){
			$_POST['groups_id'] = $_REQUEST['groups_id'];
		}
		if(!empty($_REQUEST['amenity_categories_id'])){
			$_POST['amenity_categories_id'] = $_REQUEST['amenity_categories_id'];
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
	$_SESSION['amenities']['image_path'] = NULL;
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>