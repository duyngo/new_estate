<?php
function client_reset_update_password(){
	$sql = "update external_users set";
	$sql .= " password = '" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " email = '" . $_POST['email'] . "'";
	common_exec_sql($sql);
	return;
}
function client_reset_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="password"){
		if(empty($_POST['id'])){
			if(empty($_POST['password'])){
				$err_msg .= "Please Enter [Password]<br />";
			}
		}
		if(!empty($_POST['password'])){
			if( $_POST['password'] != $_POST['password2'] ){
				$err_msg .= "Re-enter password is different from [Password]<br />";
			}
		}
		if(!empty($_POST['password'])){
			if(!preg_match("/^[a-zA-Z0-9]{8,15}+$/", $_POST['password'])){
				$err_msg .= "Please Enter [Password] in [a-zA-Z0-9]{8,15}<br />";
			}
		}
		if(!empty($_POST['password'])){
			if(mb_strlen($_POST['password'],"UTF-8") > 128){
				$err_msg .= "Please Enter [Password] within 128 characters.<br />";
			}
		}
	}
	return $err_msg;
}
?>
