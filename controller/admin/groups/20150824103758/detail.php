<?php
//ini_set( 'display_errors', 1 );
$tables_name = "groups";
$tables_logical_name = "Area Group";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/groups/common.php";
include "/home/newpropertylist.my/model/admin/groups/original.php";
include "/home/newpropertylist.my/model/admin/groups/list.php";
include "/home/newpropertylist.my/model/admin/states/common.php";
include "/home/newpropertylist.my/model/admin/locations/common.php";
include "/home/newpropertylist.my/model/admin/locations/original.php";
include "/home/newpropertylist.my/model/admin/locations/list.php";
include "/home/newpropertylist.my/model/admin/amenities/common.php";
include "/home/newpropertylist.my/model/admin/amenities/original.php";
include "/home/newpropertylist.my/model/admin/amenities/list.php";
include "/home/newpropertylist.my/model/admin/listings/common.php";
include "/home/newpropertylist.my/model/admin/listings/original.php";
include "/home/newpropertylist.my/model/admin/listings/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "locations_delete"){
	locations_delete( $_REQUEST['locations_id'] );
	header('Location:/admin/groups/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "amenities_delete"){
	amenities_delete( $_REQUEST['amenities_id'] );
	header('Location:/admin/groups/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "listings_delete"){
	listings_delete( $_REQUEST['listings_id'] );
	header('Location:/admin/groups/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>