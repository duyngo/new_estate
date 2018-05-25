<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings";
$table_name_j = "Listing";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 100;

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/companies/common.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/listings/original.php";
include "../../../model/admin/listings/list.php";
include "../../../model/admin/states/common.php";

session_start();
$_SESSION['listings']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings']['id'] = $_POST['id'];
	$_SESSION['listings']['evernote_id'] = $_POST['evernote_id'];
	$_SESSION['listings']['name'] = $_POST['name'];
	$_SESSION['listings']['companies_id'] = $_POST['companies_id'];
	$_SESSION['listings']['billing_id'] = $_POST['billing_id'];
	$_SESSION['listings']['states_id'] = $_POST['states_id'];
	$_SESSION['listings']['property_name'] = $_POST['property_name'];
	$_SESSION['listings']['status'] = $_POST['status'];
	header('Location:/admin/listings/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['listings']['id'] = NULL;
	$_SESSION['listings']['evernote_id'] = NULL;
	$_SESSION['listings']['name'] = NULL;
	$_SESSION['listings']['companies_id'] = NULL;
	$_SESSION['listings']['billing_id'] = NULL;
	$_SESSION['listings']['states_id'] = NULL;
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
