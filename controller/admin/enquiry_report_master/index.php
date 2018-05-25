<?php
//ini_set( 'display_errors', 1 );
$table_name = "enquiry_report_master";
$table_name_j = "enquiry_report_master";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 500;

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/enquiry_report_master/common.php";
include "/home/newpropertylist.my/model/admin/states/common.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
        $_SESSION[$table_name]['states_id'] = $_POST['states_id'];
        header('Location:/admin/enquiry_report_master/');
        exit;
}
if( $_POST['act'] == "clear" ){
        $_SESSION[$table_name]['states_id'] = NULL;
        header('Location:/admin/enquiry_report_master/');
        exit;
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
