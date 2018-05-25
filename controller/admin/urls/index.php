<?php
//ini_set( 'display_errors', 1 );
$table_name = "urls";
$table_name_j = "Urls";

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
include "../../../model/admin/urls/common.php";
include "../../../model/admin/urls/original.php";
include "../../../model/admin/urls/list.php";
include "../../../model/admin/states/common.php";
include "../../../model/admin/groups/common.php";
include "../../../model/admin/property_type_groups/common.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['urls']['url'] = $_POST['url'];
	$_SESSION['urls']['type'] = $_POST['type'];
	$_SESSION['urls']['states_id'] = $_POST['states_id'];
	$_SESSION['urls']['groups_id'] = $_POST['groups_id'];
	$_SESSION['urls']['property_type_groups_id'] = $_POST['property_type_groups_id'];
	$_SESSION['urls']['conditions_num'] = $_POST['conditions_num'];
	$_SESSION['urls']['listings_num'] = $_POST['listings_num'];
	$_SESSION['urls']['ad_flag'] = $_POST['ad_flag'];
	$_SESSION['urls']['completion_year'] = $_POST['completion_year'];
	$_SESSION['urls']['is_deleted'] = $_POST['is_deleted'];
	header('Location:/admin/urls/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['urls']['url'] = NULL;
	$_SESSION['urls']['type'] = NULL;
	$_SESSION['urls']['states_id'] = NULL;
	$_SESSION['urls']['groups_id'] = NULL;
	$_SESSION['urls']['property_type_groups_id'] = NULL;
	$_SESSION['urls']['conditions_num'] = NULL;
	$_SESSION['urls']['listings_num'] = NULL;
	$_SESSION['urls']['ad_flag'] = NULL;
	$_SESSION['urls']['completion_year'] = NULL;
	$_SESSION['urls']['is_deleted'] = NULL;
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
