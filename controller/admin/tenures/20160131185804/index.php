<?php
//ini_set( 'display_errors', 1 );
$table_name = "tenures";
$table_name_j = "Tenure";

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
include "../../../model/admin/tenures/common.php";
include "../../../model/admin/tenures/original.php";
include "../../../model/admin/tenures/list.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['tenures']['name'] = $_POST['name'];
	$_SESSION['tenures']['code'] = $_POST['code'];
	header('Location:/admin/tenures/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['tenures']['name'] = NULL;
	$_SESSION['tenures']['code'] = NULL;
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