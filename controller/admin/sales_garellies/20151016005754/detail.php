<?php
//ini_set( 'display_errors', 1 );
$tables_name = "sales_garellies";
$tables_logical_name = "Sales Garelly";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/sales_garellies/common.php";
include "../../../model/admin/sales_garellies/original.php";
include "../../../model/admin/sales_garellies/list.php";
include "../../../model/admin/companies/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>