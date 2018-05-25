<?php
//ini_set( 'display_errors', 1 );
session_start();
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/common/common.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/common/list.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/mysql/common.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/client/reset/common.php";
include "/home/" . $_SERVER['SERVER_NAME'] . "/model/client/external_users/list.php";

mysql_mysql_connect();

if(empty($_POST['act'])){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " external_users";
	$sql .= " where";
	$sql .= " reset_code = '" . mysql_real_escape_string( $_REQUEST['reset_code'] ) . "'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result = mysql_query( $sql );
	if( mysql_num_rows( $result )){
		$arr = mysql_fetch_array( $result );
		$_POST['email'] = $arr['email'];
	}else{
                header('Location:/client/reset/error.php');
		exit;
	}
}else if( $_POST['act'] == "conf" ){
        $err_msg = NULL;
        $err_msg = client_reset_err_check();
        if(empty($err_msg)){
		$err_msg = client_reset_update_password();
                header('Location:/client/reset/done.php');
                exit;
        }
}
?>
