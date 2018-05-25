<?php
//ini_set( 'display_errors', 1 );
$tables_name = "listings_project_details";
$tables_logical_name = "project details";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings_project_details/common.php";
include "../../../model/admin/listings_project_details/original.php";
include "../../../model/admin/listings_project_details/list.php";
include "../../../model/admin/listings/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>