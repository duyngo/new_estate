<?php
//ini_set( 'display_errors', 1 );
$tables_name = "amenity_categories";
$tables_logical_name = "Amenity Category";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/amenity_categories/common.php";
include "../../../model/admin/amenity_categories/original.php";
include "../../../model/admin/amenity_categories/list.php";
include "../../../model/admin/amenities/common.php";
include "../../../model/admin/amenities/original.php";
include "../../../model/admin/amenities/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "amenities_delete"){
	amenities_delete( $_REQUEST['amenities_id'] );
	header('Location:/admin/amenity_categories/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>