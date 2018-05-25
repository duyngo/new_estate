<?php
//ini_set( 'display_errors', 1 );
$table_name = "features";
$table_name_j = "Features";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 20;

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/features/common.php";
include "/home/newpropertylist.my/model/admin/features/original.php";
include "/home/newpropertylist.my/model/admin/features/list.php";

session_start();
$_SESSION['features']['image_path'] = NULL;

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['features']['id'] = $_POST['id'];
	$_SESSION['features']['name'] = $_POST['name'];
	$_SESSION['features']['code'] = $_POST['code'];
	header('Location:/admin/features/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['features']['id'] = NULL;
	$_SESSION['features']['name'] = NULL;
	$_SESSION['features']['code'] = NULL;
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