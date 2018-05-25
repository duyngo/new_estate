<?php
//ini_set( 'display_errors', 1 );
session_start();
$model = "lost";
$model_j = "パスワード忘れ";

include "/home/mysma/model/mysql/func.php";
include "/home/admin/model/common/func.php";
include "/home/admin/model/common/list.php";
//include "/home/mysma/model/banner/func.php";
include "/home/mysma/model/mysma_member/func.php";
include "/home/mysma/model/mysma_member/list.php";
include "/home/mysma/model/news/func.php";
mysql_mysql_connect();

if( $_POST['act'] == "" ){
	$_SESSION['edit_status'] = "yet";
}
if( $_POST['act'] == "lost" ){
	$err_msg = mysma_member_lost();
	if( $err_msg != "" ){
		$_POST['act'] = "err";
	}
}
?>
