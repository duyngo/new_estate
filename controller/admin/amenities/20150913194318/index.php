<?php
//ini_set( 'display_errors', 1 );
$table_name = "amenities";
$table_name_j = "Amenity";

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
include "/home/newpropertylist.my/model/admin/amenities/common.php";
include "/home/newpropertylist.my/model/admin/amenities/original.php";
include "/home/newpropertylist.my/model/admin/amenities/list.php";

session_start();
$_SESSION['amenities']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['amenities']['name'] = $_POST['name'];
	$_SESSION['amenities']['map_coordinates'] = $_POST['map_coordinates'];
	header('Location:/admin/amenities/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['amenities']['name'] = NULL;
	$_SESSION['amenities']['map_coordinates'] = NULL;
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