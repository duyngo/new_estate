<?php
//ini_set( 'display_errors', 1 );
$tables_name = "countries";
$tables_logical_name = "Country";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/countries/common.php";
include "/home/newpropertylist.my/model/admin/countries/original.php";
include "/home/newpropertylist.my/model/admin/countries/list.php";
include "/home/newpropertylist.my/model/admin/companies/common.php";
include "/home/newpropertylist.my/model/admin/companies/original.php";
include "/home/newpropertylist.my/model/admin/companies/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "companies_delete"){
	companies_delete( $_REQUEST['companies_id'] );
	header('Location:/admin/countries/detail.php?id=' . $_REQUEST['id'] . '&tab=' . $_REQUEST['tab'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>