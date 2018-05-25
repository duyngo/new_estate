<?php
//ini_set( 'display_errors', 1 );
$table_name = "amenity_categories";
$table_name_j = "Amenity Category";

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
include "../../../model/admin/amenity_categories/common.php";
include "../../../model/admin/amenity_categories/original.php";
include "../../../model/admin/amenity_categories/list.php";

session_start();
$_SESSION['amenity_categories']['image_path'] = NULL;
$_SESSION['amenity_categories']['icon'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['amenity_categories']['name'] = $_POST['name'];
	header('Location:/admin/amenity_categories/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['amenity_categories']['name'] = NULL;
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