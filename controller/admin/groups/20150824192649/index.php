<?php
//ini_set( 'display_errors', 1 );
$table_name = "groups";
$table_name_j = "Area Group";

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
include "/home/newpropertylist.my/model/admin/groups/common.php";
include "/home/newpropertylist.my/model/admin/groups/original.php";
include "/home/newpropertylist.my/model/admin/groups/list.php";
include "/home/newpropertylist.my/model/admin/states/common.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['groups']['states_id'] = $_POST['states_id'];
	$_SESSION['groups']['name'] = $_POST['name'];
	header('Location:/admin/groups/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['groups']['states_id'] = NULL;
	$_SESSION['groups']['name'] = NULL;
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