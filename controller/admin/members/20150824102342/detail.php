<?php
//ini_set( 'display_errors', 1 );
$tables_name = "members";
$tables_logical_name = "Members";

//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/common/common.php";
include "/home/newpropertylist.my/model/admin/members/common.php";
include "/home/newpropertylist.my/model/admin/members/original.php";
include "/home/newpropertylist.my/model/admin/members/list.php";
include "/home/newpropertylist.my/model/admin/listings_enquiries/common.php";
include "/home/newpropertylist.my/model/admin/listings_enquiries/original.php";
include "/home/newpropertylist.my/model/admin/listings_enquiries/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if( $_REQUEST['act'] == "listings_enquiries_delete"){
	listings_enquiries_delete( $_REQUEST['listings_enquiries_id'] );
	header('Location:/admin/members/detail.php?id=' . $_REQUEST['id'] );
	exit;
}
if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>