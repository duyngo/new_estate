<?php
function profile_err_check(){
	if(empty($_POST['profile_title'])){
		$err_msg .= "「タイトル」を入力して下さい。<br />";
	}
	if(empty($_POST['profile_body'])){
		$err_msg .= "「本文」を入力して下さい。<br />";
	}
	return $err_msg;	
}
function profile_update(){
	$sql = "update companies set";
	$sql .= " profile_title = '" . mysql_real_escape_string( $_POST['profile_title'] ) . "'";
	$sql .= ",profile_body = '" . mysql_real_escape_string( $_POST['profile_body'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $_SESSION['companies_id'];
	mysql_query( $sql );
}
?>
