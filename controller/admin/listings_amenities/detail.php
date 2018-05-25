<?php
//ini_set( 'display_errors', 1 );
$tables_name = "listings_amenities";
$tables_logical_name = "Amenities";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/common.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/original.php";
include "/home/newpropertylist.my/model/admin/listings_amenities/list.php";
include "/home/newpropertylist.my/model/admin/listings/common.php";
include "/home/newpropertylist.my/model/admin/amenities/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>