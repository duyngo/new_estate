<?php
//ini_set( 'display_errors', 1 );
$tables_name = "amenities";
$tables_logical_name = "Amenity";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/amenities/common.php";
include "/home/newpropertylist.my/model/admin/amenities/original.php";
include "/home/newpropertylist.my/model/admin/amenities/list.php";
include "/home/newpropertylist.my/model/admin/states/common.php";
include "/home/newpropertylist.my/model/admin/groups/common.php";
include "/home/newpropertylist.my/model/admin/amenity_categories/common.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/common.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/original.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "listings_amenities_delete"){
	listings_amenities_delete( $_REQUEST['listings_amenities_id'] );
	header('Location:/admin/amenities/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>