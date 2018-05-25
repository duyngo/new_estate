<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/companies/common.php";
include $_SERVER['BASE_DIR']."/model/favorites/common.php";
include $_SERVER['BASE_DIR']."/model/groups/common.php";
include $_SERVER['BASE_DIR']."/model/listings/common.php";
include $_SERVER['BASE_DIR']."/model/members/common.php";
include $_SERVER['BASE_DIR']."/model/prices/common.php";
include $_SERVER['BASE_DIR']."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR']."/model/states/common.php";

common_pc_sp();
session_start();
common_cookie_check();
mysql_mysql_connect();
$fav_num = favorites_num();

$h1 = "Malaysian property portal specializing in new property launched for sale";
if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
	include $_SERVER['BASE_DIR']."/view/about/index.php";
}else{
	include $_SERVER['BASE_DIR']."/view/sp/about/index.php";
}
?>
