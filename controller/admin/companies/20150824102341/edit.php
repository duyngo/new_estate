<?php
//ini_set( 'display_errors', 1 );
$table_name = "companies";
$table_name_j = "Company";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/companies/common.php";
include "/home/newpropertylist.my/model/admin/companies/original.php";
include "/home/newpropertylist.my/model/admin/companies/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	$_SESSION['companies']['logo_image_path'] = NULL;
	$_SESSION['companies']['desc_image_path_1'] = NULL;
	$_SESSION['companies']['desc_image_path_2'] = NULL;
	$_SESSION['companies']['desc_image_path_3'] = NULL;
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_SESSION['companies']['logo_image_path'] = $_POST['logo_image_path'];
		$_SESSION['companies']['desc_image_path_1'] = $_POST['desc_image_path_1'];
		$_SESSION['companies']['desc_image_path_2'] = $_POST['desc_image_path_2'];
		$_SESSION['companies']['desc_image_path_3'] = $_POST['desc_image_path_3'];
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
		if(!empty($_REQUEST['class'])){
			$_POST['class'] = $_REQUEST['class'];
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
	$_SESSION['companies']['logo_image_path'] = NULL;
	$_SESSION['companies']['desc_image_path_1'] = NULL;
	$_SESSION['companies']['desc_image_path_2'] = NULL;
	$_SESSION['companies']['desc_image_path_3'] = NULL;
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>