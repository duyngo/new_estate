<?php
//ini_set( 'display_errors', 1 );
$table_name = "banners";
$table_name_j = "Banners";

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
include "../../../model/admin/banners/common.php";
include "../../../model/admin/banners/original.php";
include "../../../model/admin/banners/list.php";

session_start();
$_SESSION['banners']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "delete" ){
	$delete( $_REQUEST['id'] );
	header('Location:./index.php');
	exit;
}

//一覧表示用のSQL実行（まずヒット件数を知る）
$result = $index();
$row_num = mysql_num_rows( $result );
?>