<?php
//ini_set( 'display_errors', 1 );
$table_name = "amenity_categories";
$table_name_j = "Amenity Category";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/amenity_categories/common.php";
include "../../../model/admin/amenity_categories/original.php";
include "../../../model/admin/amenity_categories/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	$_SESSION['amenity_categories']['image_path'] = NULL;
	$_SESSION['amenity_categories']['icon'] = NULL;
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_SESSION['amenity_categories']['image_path'] = $_POST['image_path'];
		$_SESSION['amenity_categories']['icon'] = $_POST['icon'];
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
			$_POST['id'] = $insert();
			$_SESSION[$table_name]{'status'} = NULL;
		}
	}
	$_SESSION['amenity_categories']['image_path'] = NULL;
	$_SESSION['amenity_categories']['icon'] = NULL;
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>