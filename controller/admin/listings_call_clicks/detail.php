<?php
//ini_set( 'display_errors', 1 );
$tables_name = "listings_call_clicks";
$tables_logical_name = "Listing Call Click Log";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings_call_clicks/common.php";
include "../../../model/admin/listings_call_clicks/original.php";
include "../../../model/admin/listings_call_clicks/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>