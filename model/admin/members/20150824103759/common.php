<?php
function members_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " members t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/members/")!==false){
		if(!empty( $_SESSION['members']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['members']['name']) . "%'";
		}
		if(!empty( $_SESSION['members']['email'])){
			$sql .= " and";
			$sql .= " t1.email like '%" . mysql_real_escape_string($_SESSION['members']['email']) . "%'";
		}
		if(!empty( $_SESSION['members']['phone'])){
			$sql .= " and";
			$sql .= " t1.phone like '%" . mysql_real_escape_string($_SESSION['members']['phone']) . "%'";
		}
	}
	$sql .= " order by t1.name";
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
function members_insert(){
	$sql = "insert into members(";
	$sql .= " name";
	$sql .= ",email";
	$sql .= ",password";
	$sql .= ",phone";
	$sql .= ",nationality";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['email'] ) . "'";
	$sql .= ",'" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['phone'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['nationality'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("members");
}
function members_update(){
	$sql = "update members set";
	$sql .= " name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
	if(!empty($_POST['password'])){
		$sql .= ",password = '" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	}
	$sql .= ",phone = '" . mysql_real_escape_string( $_POST['phone'] ) . "'";
	$sql .= ",nationality = '" . mysql_real_escape_string( $_POST['nationality'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function members_delete( $id ){
	$sql = "update members set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function members_listings_enquiries_index( $members_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_enquiries t1";
	$sql .= " where";
	$sql .= " t1.members_id = $members_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['members']['listings_enquiries']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['members']['listings_enquiries']['name']) . "%'";
	}
	if(!empty( $_SESSION['members']['listings_enquiries']['email'])){
		$sql .= " and";
		$sql .= " t1.email like '%" . mysql_real_escape_string($_SESSION['members']['listings_enquiries']['email']) . "%'";
	}
	if(!empty( $_SESSION['members']['listings_enquiries']['phone'])){
		$sql .= " and";
		$sql .= " t1.phone like '%" . mysql_real_escape_string($_SESSION['members']['listings_enquiries']['phone']) . "%'";
	}
	$sql .= " order by t1.created desc";
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
function members_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#name\">Please Enter [name] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="email"){
		if(empty($_POST['email'])){
			$err_msg .= "<li><a href=\"#email\">Please Enter [email]</a></li>";
		}
		if(!empty($_POST['email'])){
			if(!preg_match("|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|", $_POST['email'])){
				$err_msg .= "<li><a href=\"#email\">The format of the e-mail address is wrong.</a></li>";
			}
		}
		if(!empty($_POST['email'])){
			if(mb_strlen($_POST['email'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#email\">Please Enter [email] within 128 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " members";
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
				$err_msg .= "<li><a href=\"#email\"> This [email] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="password"){
		if(!empty($_POST['password'])){
			if( $_POST['password'] != $_POST['password2'] ){
				$err_msg .= "<li><a href=\"#password\">Re-enter password is different from  [password]</a></li>";
			}
		}
		if(!empty($_POST['password'])){
			if(mb_strlen($_POST['password'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#password\">Please Enter [password] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="phone"){
		if(empty($_POST['phone'])){
			$err_msg .= "<li><a href=\"#phone\">Please Enter [phone]</a></li>";
		}
		if(!empty($_POST['phone'])){
			if(mb_strlen($_POST['phone'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#phone\">Please Enter [phone] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="nationality"){
		if(empty($_POST['nationality'])){
			$err_msg .= "<li><a href=\"#nationality\">Please Enter [Nationality]</a></li>";
		}
	}
	return $err_msg;
}
?>