<?php
function external_users_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " external_users t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/external_users/")!==false){
		if(!empty( $_SESSION['external_users']['email'])){
			$sql .= " and";
			$sql .= " t1.email like '%" . mysql_real_escape_string($_SESSION['external_users']['email']) . "%'";
		}
		if(!empty( $_SESSION['external_users']['first_name'])){
			$sql .= " and";
			$sql .= " t1.first_name like '%" . mysql_real_escape_string($_SESSION['external_users']['first_name']) . "%'";
		}
		if(!empty( $_SESSION['external_users']['last_name'])){
			$sql .= " and";
			$sql .= " t1.last_name like '%" . mysql_real_escape_string($_SESSION['external_users']['last_name']) . "%'";
		}
	}
	$sql .= " order by first_name,last_name";
	if(!empty($lines)){
		if(empty($_REQUEST['page'])){
			$offset = 0;
		}else{
			$offset = ($_REQUEST['page']-1) * $lines;
		}
		$sql .= " limit " . $lines . " offset " . $offset;
	}
	return mysql_query($sql);
}
function external_users_insert(){
	$sql = "insert into external_users(";
	$sql .= " companies_id";
	$sql .= ",email";
	$sql .= ",password";
	$sql .= ",title";
	$sql .= ",first_name";
	$sql .= ",last_name";
	$sql .= ",position";
	$sql .= ",tel";
	$sql .= ",mobile";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['companies_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['email'] ) . "'";
	$sql .= ",'" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['title'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['first_name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['last_name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['position'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['tel'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['mobile'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("external_users");
}
function external_users_update(){
	$sql = "update external_users set";
	$sql .= " companies_id = '" . mysql_real_escape_string( $_POST['companies_id'] ) . "'";
	$sql .= ",email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
	if(!empty($_POST['password'])){
		$sql .= ",password = '" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	}
	$sql .= ",title = '" . mysql_real_escape_string( $_POST['title'] ) . "'";
	$sql .= ",first_name = '" . mysql_real_escape_string( $_POST['first_name'] ) . "'";
	$sql .= ",last_name = '" . mysql_real_escape_string( $_POST['last_name'] ) . "'";
	$sql .= ",position = '" . mysql_real_escape_string( $_POST['position'] ) . "'";
	$sql .= ",tel = '" . mysql_real_escape_string( $_POST['tel'] ) . "'";
	$sql .= ",mobile = '" . mysql_real_escape_string( $_POST['mobile'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function external_users_delete( $id ){
	$sql = "update external_users set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function external_users_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="companies_id"){
		if(empty($_POST['companies_id'])){
			$err_msg .= "<li><a href=\"#companies_id\">Please Enter [Company]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="email"){
		if(empty($_POST['email'])){
			$err_msg .= "<li><a href=\"#email\">Please Enter [Email]</a></li>";
		}
		if(!empty($_POST['email'])){
			if(!preg_match("|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|", $_POST['email'])){
				$err_msg .= "<li><a href=\"#email\">The format of the e-mail address is wrong.</a></li>";
			}
		}
		if(!empty($_POST['email'])){
			if(mb_strlen($_POST['email'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#email\">Please Enter [Email] within 64 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " external_users";
		$sql .= " where";
		$sql .= " email = '" . $_POST['email'] . "'";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		if(!empty($_POST['id'])){
			$sql .= " and";
			$sql .= " id <> " . $_POST['id'];
		}
		$result = mysql_query( $sql );
		if( mysql_num_rows( $result )){
				$err_msg .= "<li><a href=\"#email\"> This [Email] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="password"){
		if(empty($_POST['id'])){
			if(empty($_POST['password'])){
				$err_msg .= "<li><a href=\"#password\">Please Enter [Password]</a></li>";
			}
		}
		if(!empty($_POST['password'])){
			if( $_POST['password'] != $_POST['password2'] ){
				$err_msg .= "<li><a href=\"#password\">Re-enter password is different from  [Password]</a></li>";
			}
		}
		if(!empty($_POST['password'])){
			if(!preg_match("/^[a-zA-Z0-9]{8,15}+$/", $_POST['password'])){
				$err_msg .= "<li><a href=\"#password\">Please Enter [Password] in [a-zA-Z0-9]{8,15}</a></li>";
			}
		}
		if(!empty($_POST['password'])){
			if(mb_strlen($_POST['password'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#password\">Please Enter [Password] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="title"){
		if(empty($_POST['title'])){
			$err_msg .= "<li><a href=\"#title\">Please Enter [Title]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="first_name"){
		if(empty($_POST['first_name'])){
			$err_msg .= "<li><a href=\"#first_name\">Please Enter [First name]</a></li>";
		}
		if(!empty($_POST['first_name'])){
			if(!preg_match("/^[a-zA-Z\s]+$/", $_POST['first_name'])){
				$err_msg .= "<li><a href=\"#first_name\">Please Enter [First name] in [a-zA-Z\s]</a></li>";
			}
		}
		if(!empty($_POST['first_name'])){
			if(mb_strlen($_POST['first_name'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#first_name\">Please Enter [First name] within 32 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="last_name"){
		if(empty($_POST['last_name'])){
			$err_msg .= "<li><a href=\"#last_name\">Please Enter [Last name]</a></li>";
		}
		if(!empty($_POST['last_name'])){
			if(!preg_match("/^[a-zA-Z]+$/", $_POST['last_name'])){
				$err_msg .= "<li><a href=\"#last_name\">Please Enter [Last name] in [a-zA-Z]</a></li>";
			}
		}
		if(!empty($_POST['last_name'])){
			if(mb_strlen($_POST['last_name'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#last_name\">Please Enter [Last name] within 32 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="position"){
		if(!empty($_POST['position'])){
			if(mb_strlen($_POST['position'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#position\">Please Enter [Position] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="tel"){
		if(!empty($_POST['tel'])){
			if(mb_strlen($_POST['tel'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#tel\">Please Enter [TEL] within 32 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="mobile"){
		if(!empty($_POST['mobile'])){
			if(mb_strlen($_POST['mobile'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#mobile\">Please Enter [Mobile] within 32 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>