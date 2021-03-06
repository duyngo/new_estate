<?php
//ini_set( 'display_errors', 1 );
$table_name = "external_users";
$table_name_j = "External users";

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
include "/home/newpropertylist.my/model/admin/external_users/common.php";
include "/home/newpropertylist.my/model/admin/external_users/original.php";
include "/home/newpropertylist.my/model/admin/external_users/list.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['external_users']['email'] = $_POST['email'];
	$_SESSION['external_users']['first_name'] = $_POST['first_name'];
	$_SESSION['external_users']['last_name'] = $_POST['last_name'];
	header('Location:/admin/external_users/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['external_users']['email'] = NULL;
	$_SESSION['external_users']['first_name'] = NULL;
	$_SESSION['external_users']['last_name'] = NULL;
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