<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/genba/model/common/func.php";
include "/home/genba/model/mysql/func.php";

common_cookie_check();
common_login_check();
mysql_mysql_connect();
?>
