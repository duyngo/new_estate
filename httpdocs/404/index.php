<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/companies/common.php";
include "../../model/favorites/common.php";
include "/home/newpropertylist.my/model/features/common.php";
include "/home/newpropertylist.my/model/groups/common.php";
include "/home/newpropertylist.my/model/listings/common.php";
include "/home/newpropertylist.my/model/prices/common.php";
include "/home/newpropertylist.my/model/property_type_groups/common.php";
include "/home/newpropertylist.my/model/states/common.php";
session_start();
mysql_mysql_connect();
$fav_num = favorites_num();

header("HTTP/1.1 404 Not Found");
include "../../view/404/index.php";
?>
