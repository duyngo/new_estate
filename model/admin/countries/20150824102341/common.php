<?php
function countries_index( $lines ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " countries";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/countries/")!==false){
		if(!empty( $_SESSION['countries']['code'])){
			$sql .= " and";
			$sql .= " code like '%" . mysql_real_escape_string($_SESSION['countries']['code']) . "%'";
		}
		if(!empty( $_SESSION['countries']['name'])){
			$sql .= " and";
			$sql .= " name like '%" . mysql_real_escape_string($_SESSION['countries']['name']) . "%'";
		}
		if(!empty( $_SESSION['countries']['logical_name'])){
			$sql .= " and";
			$sql .= " logical_name like '%" . mysql_real_escape_string($_SESSION['countries']['logical_name']) . "%'";
		}
	}
	$sql .= " order by id";
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
function countries_insert(){
	$sql = "insert into countries(";
	$sql .= " code";
	$sql .= ",name";
	$sql .= ",logical_name";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['logical_name'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return;
}
function countries_update(){
	$sql = "update countries set";
	$sql .= " code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",logical_name = '" . mysql_real_escape_string( $_POST['logical_name'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function countries_delete( $id ){
	$sql = "update countries set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function countries_property_types_index( $countries_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " property_types";
	$sql .= " where";
	$sql .= " countries_id = $countries_id";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if(!empty( $_SESSION['countries']['property_types']['name'])){
		$sql .= " and";
		$sql .= " name like '%" . mysql_real_escape_string($_SESSION['countries']['property_types']['name']) . "%'";
	}
	if(!empty( $_SESSION['countries']['property_types']['description'])){
		$sql .= " and";
		$sql .= " description like '%" . mysql_real_escape_string($_SESSION['countries']['property_types']['description']) . "%'";
	}
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
function countries_states_index( $countries_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " states";
	$sql .= " where";
	$sql .= " countries_id = $countries_id";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if(!empty( $_SESSION['countries']['states']['name'])){
		$sql .= " and";
		$sql .= " name like '%" . mysql_real_escape_string($_SESSION['countries']['states']['name']) . "%'";
	}
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
function countries_locations_index( $countries_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " locations";
	$sql .= " where";
	$sql .= " countries_id = $countries_id";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if(!empty( $_SESSION['countries']['locations']['name'])){
		$sql .= " and";
		$sql .= " name like '%" . mysql_real_escape_string($_SESSION['countries']['locations']['name']) . "%'";
	}
	$sql .= " order by name";
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
function countries_groups_index( $countries_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " groups";
	$sql .= " where";
	$sql .= " countries_id = $countries_id";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if(!empty( $_SESSION['countries']['groups']['name'])){
		$sql .= " and";
		$sql .= " name like '%" . mysql_real_escape_string($_SESSION['countries']['groups']['name']) . "%'";
	}
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
function countries_companies_index( $countries_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " companies";
	$sql .= " where";
	$sql .= " countries_id = $countries_id";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if(!empty( $_SESSION['countries']['companies']['name'])){
		$sql .= " and";
		$sql .= " name like '%" . mysql_real_escape_string($_SESSION['countries']['companies']['name']) . "%'";
	}
	if(!empty( $_SESSION['countries']['companies']['class'])){
		$sql .= " and";
		$sql .= " class like '%" . $_SESSION['countries']['companies']['class'] . "%'";
	}
	$sql .= " order by name";
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
function countries_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="code"){
		if(empty($_POST['code'])){
			$err_msg .= "<li><a href=\"#code\">Please Enter [コード（3桁）]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(!preg_match("/^A-Z+$/", $_POST['code'])){
				$err_msg .= "<li><a href=\"#code\">Please Enter [コード（3桁）] in A-Z</a></li>";
			}
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 4){
				$err_msg .= "<li><a href=\"#code\">Please Enter [コード（3桁）] within 4 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [英名]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(!preg_match("/^a-z,A-Z+$/", $_POST['name'])){
				$err_msg .= "<li><a href=\"#name\">Please Enter [英名] in a-z,A-Z</a></li>";
			}
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#name\">Please Enter [英名] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="logical_name"){
		if(empty($_POST['logical_name'])){
			$err_msg .= "<li><a href=\"#logical_name\">Please Enter [日本語名]</a></li>";
		}
		if(!empty($_POST['logical_name'])){
			if(mb_strlen($_POST['logical_name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#logical_name\">Please Enter [日本語名] within 64 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>