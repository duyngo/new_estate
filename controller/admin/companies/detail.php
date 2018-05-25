<?php
//ini_set( 'display_errors', 1 );
$tables_name = "companies";
$tables_logical_name = "Company";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/companies/common.php";
include "../../../model/admin/companies/original.php";
include "../../../model/admin/companies/list.php";
include "../../../model/admin/external_users/common.php";
include "../../../model/admin/external_users/original.php";
include "../../../model/admin/external_users/list.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/listings/original.php";
include "../../../model/admin/listings/list.php";
include "../../../model/admin/sales_garellies/common.php";
include "../../../model/admin/sales_garellies/original.php";
include "../../../model/admin/sales_garellies/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "companies_delete"){
	companies_delete( $_REQUEST['companies_id'] );
	header('Location:/admin/companies/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
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
if( $_REQUEST['act'] == "sales_garellies_delete"){
	sales_garellies_delete( $_REQUEST['sales_garellies_id'] );
	header('Location:/admin/companies/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>
