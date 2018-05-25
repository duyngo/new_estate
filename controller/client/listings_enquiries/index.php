<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_enquiries";
$table_name_j = "Enquiries";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 20;

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/client/listings_enquiries/list.php";
include "../../../model/client/common/common.php";
include "../../../model/client/listings_enquiries/common.php";
include "../../../model/client/listings_enquiries/original.php";

session_start();

client_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings_enquiries']['name'] = $_POST['name'];
	$_SESSION['listings_enquiries']['email'] = $_POST['email'];
	$_SESSION['listings_enquiries']['phone'] = $_POST['phone'];
	header('Location:/client/listings_enquiries/');
	exit;
}
if( $_POST['act'] == "clear" ){
	$_SESSION['listings_enquiries']['name'] = NULL;
	$_SESSION['listings_enquiries']['email'] = NULL;
	$_SESSION['listings_enquiries']['phone'] = NULL;
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
