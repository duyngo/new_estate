<?php
//ini_set( 'display_errors', 1 );
$table_name = "property_type_groups";
$table_name_j = "Property Type Group";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 0;

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/property_type_groups/common.php";
include "../../../model/admin/property_type_groups/original.php";
include "../../../model/admin/property_type_groups/list.php";

session_start();
$_SESSION['property_type_groups']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['property_type_groups']['name'] = $_POST['name'];
	header('Location:/admin/property_type_groups/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['property_type_groups']['name'] = NULL;
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