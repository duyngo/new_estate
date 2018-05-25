<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_amenities";
$table_name_j = "Amenities";

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
include "/home/newpropertylist.my/model/admin/listings_amenities/common.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/original.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/list.php";
include "/home/newpropertylist.my/model/admin/listings/common.php";
include "/home/newpropertylist.my/model/admin/amenities/common.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings_amenities']['listings_id'] = $_POST['listings_id'];
	$_SESSION['listings_amenities']['amenities_id'] = $_POST['amenities_id'];
	$_SESSION['listings_amenities']['display_flag'] = $_POST['display_flag'];
	header('Location:/admin/listings_amenities/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['listings_amenities']['listings_id'] = NULL;
	$_SESSION['listings_amenities']['amenities_id'] = NULL;
	$_SESSION['listings_amenities']['display_flag'] = NULL;
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