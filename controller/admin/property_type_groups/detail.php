<?php
//ini_set( 'display_errors', 1 );
$tables_name = "property_type_groups";
$tables_logical_name = "Property Type Group";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/property_type_groups/common.php";
include "../../../model/admin/property_type_groups/original.php";
include "../../../model/admin/property_type_groups/list.php";
include "../../../model/admin/property_types/common.php";
include "../../../model/admin/property_types/original.php";
include "../../../model/admin/property_types/list.php";
include "../../../model/admin/urls/common.php";
include "../../../model/admin/urls/original.php";
include "../../../model/admin/urls/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "property_types_delete"){
	property_types_delete( $_REQUEST['property_types_id'] );
	header('Location:/admin/property_type_groups/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if( $_REQUEST['act'] == "urls_delete"){
	urls_delete( $_REQUEST['urls_id'] );
	header('Location:/admin/property_type_groups/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>