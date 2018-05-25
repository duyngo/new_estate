<?php
//ini_set( 'display_errors', 1 );
$table_name = "sales_garellies";
$table_name_j = "Sales Garelly";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/sales_garellies/common.php";
include "../../../model/admin/sales_garellies/original.php";
include "../../../model/admin/sales_garellies/list.php";
include "../../../model/admin/companies/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	$_SESSION['sales_garellies']['image_path_1'] = NULL;
	$_SESSION['sales_garellies']['image_path_2'] = NULL;
	$_SESSION['sales_garellies']['image_path_3'] = NULL;
	$_SESSION['sales_garellies']['image_path_4'] = NULL;
	$_SESSION['sales_garellies']['image_path_5'] = NULL;
	$_SESSION['sales_garellies']['image_path_6'] = NULL;
	$_SESSION['sales_garellies']['image_path_7'] = NULL;
	$_SESSION['sales_garellies']['image_path_8'] = NULL;
	$_SESSION['sales_garellies']['image_path_9'] = NULL;
	$_SESSION['sales_garellies']['image_path_10'] = NULL;
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_SESSION['sales_garellies']['image_path_1'] = $_POST['image_path_1'];
		$_SESSION['sales_garellies']['image_path_2'] = $_POST['image_path_2'];
		$_SESSION['sales_garellies']['image_path_3'] = $_POST['image_path_3'];
		$_SESSION['sales_garellies']['image_path_4'] = $_POST['image_path_4'];
		$_SESSION['sales_garellies']['image_path_5'] = $_POST['image_path_5'];
		$_SESSION['sales_garellies']['image_path_6'] = $_POST['image_path_6'];
		$_SESSION['sales_garellies']['image_path_7'] = $_POST['image_path_7'];
		$_SESSION['sales_garellies']['image_path_8'] = $_POST['image_path_8'];
		$_SESSION['sales_garellies']['image_path_9'] = $_POST['image_path_9'];
		$_SESSION['sales_garellies']['image_path_10'] = $_POST['image_path_10'];
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
		if(!empty($_REQUEST['companies_id'])){
			$_POST['companies_id'] = $_REQUEST['companies_id'];
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
	$_SESSION['sales_garellies']['image_path_1'] = NULL;
	$_SESSION['sales_garellies']['image_path_2'] = NULL;
	$_SESSION['sales_garellies']['image_path_3'] = NULL;
	$_SESSION['sales_garellies']['image_path_4'] = NULL;
	$_SESSION['sales_garellies']['image_path_5'] = NULL;
	$_SESSION['sales_garellies']['image_path_6'] = NULL;
	$_SESSION['sales_garellies']['image_path_7'] = NULL;
	$_SESSION['sales_garellies']['image_path_8'] = NULL;
	$_SESSION['sales_garellies']['image_path_9'] = NULL;
	$_SESSION['sales_garellies']['image_path_10'] = NULL;
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>