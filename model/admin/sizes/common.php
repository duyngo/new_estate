<?php
function sizes_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " sizes t1";
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
function sizes_insert(){
	$sql = "insert into sizes(";
	$sql .= " name";
	$sql .= ",short_name";
	$sql .= ",code";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['short_name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("sizes");
}
function sizes_update(){
	$sql = "update sizes set";
	$sql .= " name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",short_name = '" . mysql_real_escape_string( $_POST['short_name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function sizes_delete( $id ){
	$sql = "update sizes set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function sizes_listings_index( $sizes_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " where";
	$sql .= " t1.sizes_id = $sizes_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['sizes']['listings']['id'])){
		$sql .= " and";
		$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['sizes']['listings']['id']) . "%'";
	}
	if(!empty( $_SESSION['sizes']['listings']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['sizes']['listings']['name']) . "%'";
	}
	if(!empty( $_SESSION['sizes']['listings']['companies_id'])){
		$sql .= " and";
		$sql .= " t1.companies_id like '%" . mysql_real_escape_string($_SESSION['sizes']['listings']['companies_id']) . "%'";
	}
	if(!empty( $_SESSION['sizes']['listings']['property_name'])){
		$sql .= " and";
		$sql .= " t1.property_name like '%" . mysql_real_escape_string($_SESSION['sizes']['listings']['property_name']) . "%'";
	}
	if(!empty( $_SESSION['sizes']['listings']['status'])){
		$sql .= " and";
		$sql .= " t1.status like '%" . $_SESSION['sizes']['listings']['status'] . "%'";
	}
	$sql .= " order by t1.id desc";
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
function sizes_err_check( $column_name ){
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
		$sql .= " sizes";
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
	if(empty($column_name)||$column_name=="short_name"){
		if(empty($_POST['short_name'])){
			$err_msg .= "<li><a href=\"#short_name\">Please Enter [Name in short]</a></li>";
		}
		if(!empty($_POST['short_name'])){
			if(mb_strlen($_POST['short_name'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#short_name\">Please Enter [Name in short] within 32 characters.</a></li>";
			}
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
		$sql .= " sizes";
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