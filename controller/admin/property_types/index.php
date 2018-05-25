<?php
//ini_set( 'display_errors', 1 );
$table_name = "property_types";
$table_name_j = "Property type";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 20;

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/property_types/common.php";
include "/home/newpropertylist.my/model/admin/property_types/original.php";
include "/home/newpropertylist.my/model/admin/property_types/list.php";

session_start();
$_SESSION['property_types']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['property_types']['name'] = $_POST['name'];
	$_SESSION['property_types']['description'] = $_POST['description'];
	header('Location:/admin/property_types/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['property_types']['name'] = NULL;
	$_SESSION['property_types']['description'] = NULL;
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