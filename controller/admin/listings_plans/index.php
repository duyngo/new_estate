<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_plans";
$table_name_j = "Plans";

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
include "/home/newpropertylist.my/model/admin/listings_plans/common.php";
include "/home/newpropertylist.my/model/admin/listings_plans/original.php";
include "/home/newpropertylist.my/model/admin/listings_plans/list.php";
include "/home/newpropertylist.my/model/admin/listings/common.php";

session_start();
$_SESSION['listings_plans']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings_plans']['listings_id'] = $_POST['listings_id'];
	$_SESSION['listings_plans']['name'] = $_POST['name'];
	$_SESSION['listings_plans']['display_flag'] = $_POST['display_flag'];
	header('Location:/admin/listings_plans/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['listings_plans']['listings_id'] = NULL;
	$_SESSION['listings_plans']['name'] = NULL;
	$_SESSION['listings_plans']['display_flag'] = NULL;
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