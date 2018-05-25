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
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/amenities/common.php";
include "../../../model/admin/amenities/original.php";
include "../../../model/admin/amenities/list.php";
include "../../../model/admin/states/common.php";
include "../../../model/admin/amenity_categories/common.php";

session_start();
$_SESSION['amenities']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['amenities']['states_id'] = $_POST['states_id'];
	$_SESSION['amenities']['amenity_categories_id'] = $_POST['amenity_categories_id'];
	$_SESSION['amenities']['name'] = $_POST['name'];
	header('Location:/admin/amenities/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['amenities']['states_id'] = NULL;
	$_SESSION['amenities']['amenity_categories_id'] = NULL;
	$_SESSION['amenities']['name'] = NULL;
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