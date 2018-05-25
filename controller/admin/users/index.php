<?php
//ini_set( 'display_errors', 1 );
$tables_name = "users";
$tables_logical_name = "Internal User";
$index = $tables_name . "_index";

session_start();
include $_SERVER['BASE_DIR'] ."/model/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/common/list.php";
include $_SERVER['BASE_DIR'] ."/model/mysql/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/admin/" . $tables_name . "/index.php";

admin_common_login_check();
mysql_mysql_connect();

$lines = 20;
$result = $index();
?>
