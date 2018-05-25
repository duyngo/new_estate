<?php
//ini_set( 'display_errors', 1 );
$table_name = "companies";
$table_name_j = "Company";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 20;

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/companies/common.php";
include "../../../model/admin/companies/original.php";
include "../../../model/admin/companies/list.php";

session_start();
$_SESSION['companies']['logo_image_path'] = NULL;
$_SESSION['companies']['desc_image_path_1'] = NULL;
$_SESSION['companies']['desc_image_path_2'] = NULL;
$_SESSION['companies']['desc_image_path_3'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['companies']['name'] = $_POST['name'];
	$_SESSION['companies']['class'] = $_POST['class'];
	$_SESSION['companies']['pickup_flag'] = $_POST['pickup_flag'];
	$_SESSION['companies']['developers_list_display_flag'] = $_POST['developers_list_display_flag'];
	header('Location:/admin/companies/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['companies']['name'] = NULL;
	$_SESSION['companies']['class'] = NULL;
	$_SESSION['companies']['pickup_flag'] = NULL;
	$_SESSION['companies']['developers_list_display_flag'] = NULL;
}
if( $_REQUEST['act'] == "delete" ){
	$delete( $_REQUEST['id'] );
	header('Location:./index.php');
	exit;
}

//一覧表示用のSQL実行（まずヒット件数を知る）
$result = $index();
$row_num = mysql_num_rows( $result );
?>