<?php
//ini_set( 'display_errors', 1 );
$tables_name = "listings";
$tables_logical_name = "Listing";

//ファイルインクルード
include $_SERVER['BASE_DIR'] . "/model/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/common/list.php";
include $_SERVER['BASE_DIR'] ."/model/mysql/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings/original.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings/list.php";
include $_SERVER['BASE_DIR'] ."/model/admin/companies/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/states/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/locations/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/property_types/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/prices/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/features/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_photos/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_photos/original.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_photos/list.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_project_details/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_project_details/original.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_project_details/list.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_plans/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_plans/original.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_plans/list.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_amenities/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_amenities/original.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_amenities/list.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_enquiries/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_enquiries/original.php";
include $_SERVER['BASE_DIR'] ."/model/admin/listings_enquiries/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "listings_photos_delete"){
	listings_photos_delete( $_REQUEST['listings_photos_id'] );
	admin_common_image_delete("listings_photos","image_path",$_REQUEST['image_path']);
	header('Location:/admin/listings/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "listings_project_details_delete"){
	listings_project_details_delete( $_REQUEST['listings_project_details_id'] );
	admin_common_image_delete("listings_project_details","image_path",$_REQUEST['image_path']);
	header('Location:/admin/listings/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "listings_plans_delete"){
	listings_plans_delete( $_REQUEST['listings_plans_id'] );
	admin_common_image_delete("listings_plans","image_path",$_REQUEST['image_path']);
	header('Location:/admin/listings/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "listings_amenities_delete"){
	listings_amenities_delete( $_REQUEST['listings_amenities_id'] );
	header('Location:/admin/listings/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "listings_enquiries_delete"){
	listings_enquiries_delete( $_REQUEST['listings_enquiries_id'] );
	header('Location:/admin/listings/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>
