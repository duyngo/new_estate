<?php
//ini_set( 'display_errors', 1 );
$table_name = "sales_garellies";
$table_name_j = "Sales Garelly";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 20;

//ファイルインクルード
include "/home/test/model/common/common.php";
include "/home/test/model/common/list.php";
include "/home/test/model/mysql/common.php";
include "/home/test/model/admin/common/common.php";
include "/home/test/model/admin/sales_garellies/common.php";
include "/home/test/model/admin/sales_garellies/original.php";
include "/home/test/model/admin/sales_garellies/list.php";
include "/home/test/model/admin/companies/common.php";

session_start();
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

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['sales_garellies']['companies_id'] = $_POST['companies_id'];
	$_SESSION['sales_garellies']['name'] = $_POST['name'];
	header('Location:/admin/sales_garellies/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['sales_garellies']['companies_id'] = NULL;
	$_SESSION['sales_garellies']['name'] = NULL;
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