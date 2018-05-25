<?php
//ini_set( 'display_errors', 1 );
$tables_name = "bedrooms";
$tables_logical_name = "Number of Bedroom";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/bedrooms/common.php";
include "/home/newpropertylist.my/model/admin/bedrooms/original.php";
include "/home/newpropertylist.my/model/admin/bedrooms/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>