<?php
//ini_set( 'display_errors', 1 );
$table_name = "states";
$table_name_j = "State";

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
include "../../../model/admin/states/common.php";
include "../../../model/admin/states/original.php";
include "../../../model/admin/states/list.php";

session_start();
$_SESSION['states']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['states']['name'] = $_POST['name'];
	header('Location:/admin/states/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['states']['name'] = NULL;
}
if( $_REQUEST['act'] == "delete" ){
	$delete( $_REQUEST['id'] );
	admin_common_image_delete($table_name,"image_path",$_REQUEST['image_path']);
	header('Location:./index.php');
	exit;
}

//一覧表示用のSQL実行（まずヒット件数を知る）
$result = $index();
$row_num = mysql_num_rows( $result );
?>
