<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_photos";
$table_name_j = "Images";

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
include "../../../model/admin/listings_photos/common.php";
include "../../../model/admin/listings_photos/original.php";
include "../../../model/admin/listings_photos/list.php";
include "../../../model/admin/listings/common.php";

session_start();
$_SESSION['listings_photos']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings_photos']['listings_id'] = $_POST['listings_id'];
	header('Location:/admin/listings_photos/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['listings_photos']['listings_id'] = NULL;
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