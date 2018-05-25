<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/members/common.php";

session_start();
$_SESSION['members_id'] = NULL;
$_SESSION['members_name'] = NULL;
setcookie("newpropertylist[members_id]","",0,"/" );

header('Location:/');
exit;
?>
