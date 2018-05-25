<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings";
$table_name_j = "Listing";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 20;

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/client/common/common.php";
include "/home/newpropertylist.my/model/client/listings/common.php";
include "/home/newpropertylist.my/model/client/listings/list.php";

session_start();
$_SESSION['listings']['image_path'] = NULL;

client_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings']['id'] = $_POST['id'];
	$_SESSION['listings']['name'] = $_POST['name'];
	$_SESSION['listings']['companies_id'] = $_POST['companies_id'];
	$_SESSION['listings']['property_name'] = $_POST['property_name'];
	$_SESSION['listings']['status'] = $_POST['status'];
	header('Location:/client/listings/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['listings']['id'] = NULL;
	$_SESSION['listings']['name'] = NULL;
	$_SESSION['listings']['companies_id'] = NULL;
	$_SESSION['listings']['property_name'] = NULL;
	$_SESSION['listings']['status'] = NULL;
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
