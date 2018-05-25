<?php
//ini_set( 'display_errors', 1 );
$tables_name = "urls";
$tables_logical_name = "Urls";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/urls/common.php";
include "../../../model/admin/urls/original.php";
include "../../../model/admin/urls/list.php";
include "../../../model/admin/states/common.php";
include "../../../model/admin/groups/common.php";
include "../../../model/admin/property_type_groups/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>