<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_project_details";
$table_name_j = "project details";

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
include "/home/newpropertylist.my/model/admin/listings_project_details/common.php";
include "/home/newpropertylist.my/model/admin/listings_project_details/original.php";
include "/home/newpropertylist.my/model/admin/listings_project_details/list.php";
include "/home/newpropertylist.my/model/admin/listings/common.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings_project_details']['listings_id'] = $_POST['listings_id'];
	$_SESSION['listings_project_details']['head'] = $_POST['head'];
	$_SESSION['listings_project_details']['body'] = $_POST['body'];
	header('Location:/admin/listings_project_details/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['listings_project_details']['listings_id'] = NULL;
	$_SESSION['listings_project_details']['head'] = NULL;
	$_SESSION['listings_project_details']['body'] = NULL;
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