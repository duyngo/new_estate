<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/listings/original.php";
include "/home/newpropertylist.my/model/companies/common.php";
include "/home/newpropertylist.my/model/features/common.php";
include "/home/newpropertylist.my/model/groups/common.php";
include "/home/newpropertylist.my/model/listings/common.php";
include "/home/newpropertylist.my/model/prices/common.php";
include "/home/newpropertylist.my/model/property_type_groups/common.php";
include "/home/newpropertylist.my/model/states/common.php";

mysql_mysql_connect();

//change to current
$sql = "select";
$sql .= " *";
$sql .= " from";
$sql .= " listings";
$sql .= " where";
$sql .= " status = 'upcoming'";
$sql .= " and";
$sql .= " posted_date = '" . date("Y-m-d") . "'";
$sql .= " and";
$sql .= " is_deleted = 0";
$result = mysql_query( $sql );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
		$sql_upd = "update listings set";
		$sql_upd .= " status = 'current'";
		$sql_upd .= ",modified = now()";
		$sql_upd .= " where";
		$sql_upd .= " id = " . $arr['id'];
		common_exec_sql( $sql_upd );
	}
}
//change to completed
$sql = "select";
$sql .= " *";
$sql .= " from";
$sql .= " listings";
$sql .= " where";
$sql .= " status = 'current'";
$sql .= " and";
$sql .= " (";
$sql .= " expiry_date < '" . date("Y-m-d") . "'";
$sql .= " and";
$sql .= " expiry_date <> '0000-00-00'";
$sql .= " )";
$sql .= " and";
$sql .= " is_deleted = 0";
$result = mysql_query( $sql );
if(mysql_num_rows($result)){
        while( $arr = mysql_fetch_array( $result )){
                $sql_upd = "update listings set";
                $sql_upd .= " status = 'completed'";
                $sql_upd .= ",modified = now()";
                $sql_upd .= " where";
                $sql_upd .= " id = " . $arr['id'];
                common_exec_sql( $sql_upd );
        }
}
listings_update_listings_num();
exit;
?>
