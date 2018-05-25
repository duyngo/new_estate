<?php
//ini_set( 'display_errors', 1 );
$tables_name = "companies";
$tables_logical_name = "Company";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/companies/common.php";
include "/home/newpropertylist.my/model/admin/companies/original.php";
include "/home/newpropertylist.my/model/admin/companies/list.php";
include "/home/newpropertylist.my/model/admin/external_users/common.php";
include "/home/newpropertylist.my/model/admin/external_users/original.php";
include "/home/newpropertylist.my/model/admin/external_users/list.php";
include "/home/newpropertylist.my/model/admin/listings/common.php";
include "/home/newpropertylist.my/model/admin/listings/original.php";
include "/home/newpropertylist.my/model/admin/listings/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "external_users_delete"){
	external_users_delete( $_REQUEST['external_users_id'] );
	header('Location:/admin/companies/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "listings_delete"){
	listings_delete( $_REQUEST['listings_id'] );
	header('Location:/admin/companies/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>