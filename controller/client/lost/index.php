<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/common/common.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/common/list.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/mysql/common.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/client/lost/common.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/client/external_users/list.php";

mysql_mysql_connect();

if(empty($_POST['act'])){
}else if( $_POST['act'] == "conf" ){
        $err_msg = NULL;
        $err_msg = client_lost_err_check();
        if(empty($err_msg)){
		client_lost_send_mail( $_POST['email'] );
                header('Location:/client/lost/done.php');
                exit;
        }
}
?>
