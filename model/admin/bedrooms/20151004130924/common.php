<?php
function bedrooms_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " bedrooms t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	$sql .= " order by sort";
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
function bedrooms_insert(){
	$sql = "insert into bedrooms(";
	$sql .= " name";
	$sql .= ",code";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("bedrooms");
}
function bedrooms_update(){
	$sql = "update bedrooms set";
	$sql .= " name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function bedrooms_delete( $id ){
	$sql = "update bedrooms set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function bedrooms_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Name] within 64 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " bedrooms";
		$sql .= " where";
		$sql .= " name = '" . $_POST['name'] . "'";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		if(!empty($_POST['id'])){
			$sql .= " and";
			$sql .= " id <> " . $_POST['id'];
		}
		$result = mysql_query( $sql );
		if( mysql_num_rows( $result )){
				$err_msg .= "<li><a href=\"#name\"> This [Name] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="code"){
		if(empty($_POST['code'])){
			$err_msg .= "<li><a href=\"#code\">Please Enter [Code(Url)]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(!preg_match("/^[a-z0-9-]+$/", $_POST['code'])){
				$err_msg .= "<li><a href=\"#code\">Please Enter [Code(Url)] in [a-z0-9-]</a></li>";
			}
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#code\">Please Enter [Code(Url)] within 32 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " bedrooms";
		$sql .= " where";
		$sql .= " code = '" . $_POST['code'] . "'";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		if(!empty($_POST['id'])){
			$sql .= " and";
			$sql .= " id <> " . $_POST['id'];
		}
		$result = mysql_query( $sql );
		if( mysql_num_rows( $result )){
				$err_msg .= "<li><a href=\"#code\"> This [Code(Url)] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="sort"){
		if(empty($_POST['sort'])){
			$err_msg .= "<li><a href=\"#sort\">Please Enter [sort]</a></li>";
		}
		if(!empty($_POST['sort'])){
			if(mb_strlen($_POST['sort'],"UTF-8") > 2){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [sort] within 2 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>