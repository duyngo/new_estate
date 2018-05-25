<?php
//ini_set( 'display_errors', 1 );
$base_dir = "/home/newpropertylist.my";

//ファイルインクルード
include $base_dir ."/model/common/common.php";
include $base_dir ."/model/common/list.php";
include $base_dir ."/model/mysql/common.php";
include $base_dir ."/model/admin/listings/original.php";
include $base_dir ."/model/companies/common.php";
include $base_dir ."/model/features/common.php";
include $base_dir ."/model/groups/common.php";
include $base_dir ."/model/listings/common.php";
include $base_dir ."/model/prices/common.php";
include $base_dir ."/model/property_type_groups/common.php";
include $base_dir ."/model/states/common.php";

mysql_mysql_connect();

//reset monthly_enquiry_num and achievement_rate
$sql_upd = "update listings set";
$sql_upd .= " monthly_enquiry_num = 0";
$sql_upd .= ",achievement_rate = 0";
$sql_upd .= ",modified = now()";
$sql_upd .= " where";
$sql_upd .= " is_deleted = 0";
common_exec_sql( $sql_upd );
exit;
?>
