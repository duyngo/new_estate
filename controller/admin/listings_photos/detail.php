<?php
//ini_set( 'display_errors', 1 );
$tables_name = "listings_photos";
$tables_logical_name = "Images";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings_photos/common.php";
include "../../../model/admin/listings_photos/original.php";
include "../../../model/admin/listings_photos/list.php";
include "../../../model/admin/listings/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>