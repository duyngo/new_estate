<?php
//ini_set( 'display_errors', 1 );
$tables_name = "states";
$tables_logical_name = "State";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/states/common.php";
include "../../../model/admin/states/original.php";
include "../../../model/admin/states/list.php";
include "../../../model/admin/locations/common.php";
include "../../../model/admin/locations/original.php";
include "../../../model/admin/locations/list.php";
include "../../../model/admin/groups/common.php";
include "../../../model/admin/groups/original.php";
include "../../../model/admin/groups/list.php";
include "../../../model/admin/amenities/common.php";
include "../../../model/admin/amenities/original.php";
include "../../../model/admin/amenities/list.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/listings/original.php";
include "../../../model/admin/listings/list.php";
include "../../../model/admin/urls/common.php";
include "../../../model/admin/urls/original.php";
include "../../../model/admin/urls/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "locations_delete"){
	locations_delete( $_REQUEST['locations_id'] );
	header('Location:/admin/states/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "groups_delete"){
	groups_delete( $_REQUEST['groups_id'] );
	header('Location:/admin/states/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "amenities_delete"){
	amenities_delete( $_REQUEST['amenities_id'] );
	header('Location:/admin/states/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "listings_delete"){
	listings_delete( $_REQUEST['listings_id'] );
	header('Location:/admin/states/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "urls_delete"){
	urls_delete( $_REQUEST['urls_id'] );
	header('Location:/admin/states/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>