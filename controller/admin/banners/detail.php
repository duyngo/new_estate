<?php
//ini_set( 'display_errors', 1 );
$tables_name = "banners";
$tables_logical_name = "Banners";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/banners/common.php";
include "../../../model/admin/banners/original.php";
include "../../../model/admin/banners/list.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(!empty($_REQUEST['id'])){
	$arr = common_get_value_all($tables_name,$_REQUEST['id'],"");
}
?>