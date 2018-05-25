<?php
function property_type_groups_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " property_type_groups t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/property_type_groups/")!==false){
		if(!empty( $_SESSION['property_type_groups']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['property_type_groups']['name']) . "%'";
		}
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
function property_type_groups_insert(){
	$sql = "insert into property_type_groups(";
	$sql .= " name";
	$sql .= ",code";
	$sql .= ",image_path";
	$sql .= ",description";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . $_SESSION['property_type_groups']['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("property_type_groups");
}
function property_type_groups_update(){
	$sql = "update property_type_groups set";
	$sql .= " name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['property_type_groups']['image_path'] . "'";
	$sql .= ",description = '" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function property_type_groups_delete( $id ){
	$sql = "update property_type_groups set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function property_type_groups_property_types_index( $property_type_groups_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " property_types t1";
	$sql .= " where";
	$sql .= " t1.property_type_groups_id = $property_type_groups_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['property_type_groups']['property_types']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['property_type_groups']['property_types']['name']) . "%'";
	}
	if(!empty( $_SESSION['property_type_groups']['property_types']['description'])){
		$sql .= " and";
		$sql .= " t1.description like '%" . mysql_real_escape_string($_SESSION['property_type_groups']['property_types']['description']) . "%'";
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
function property_type_groups_urls_index( $property_type_groups_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " urls t1";
	$sql .= " where";
	$sql .= " t1.property_type_groups_id = $property_type_groups_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['property_type_groups']['urls']['url'])){
		$sql .= " and";
		$sql .= " t1.url like '%" . mysql_real_escape_string($_SESSION['property_type_groups']['urls']['url']) . "%'";
	}
	if(!empty( $_SESSION['property_type_groups']['urls']['type'])){
		$sql .= " and";
		$sql .= " t1.type like '%" . $_SESSION['property_type_groups']['urls']['type'] . "%'";
	}
	if(!empty( $_SESSION['property_type_groups']['urls']['states_id'])){
		$sql .= " and";
		$sql .= " t1.states_id like '%" . $_SESSION['property_type_groups']['urls']['states_id'] . "%'";
	}
	if(!empty( $_SESSION['property_type_groups']['urls']['groups_id'])){
		$sql .= " and";
		$sql .= " t1.groups_id like '%" . $_SESSION['property_type_groups']['urls']['groups_id'] . "%'";
	}
	if(!empty( $_SESSION['property_type_groups']['urls']['conditions_num'])){
		$sql .= " and";
		$sql .= " t1.conditions_num like '%" . mysql_real_escape_string($_SESSION['property_type_groups']['urls']['conditions_num']) . "%'";
	}
	if(!empty( $_SESSION['property_type_groups']['urls']['listings_num'])){
		$sql .= " and";
		$sql .= " t1.listings_num like '%" . mysql_real_escape_string($_SESSION['property_type_groups']['urls']['listings_num']) . "%'";
	}
	if(!empty( $_SESSION['property_type_groups']['urls']['ad_flag'])){
		$sql .= " and";
		$sql .= " t1.ad_flag like '%" . $_SESSION['property_type_groups']['urls']['ad_flag'] . "%'";
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
function property_type_groups_err_check( $column_name ){
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
		$sql .= " property_type_groups";
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
			$err_msg .= "<li><a href=\"#code\">Please Enter [code]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(!preg_match("/^[a-z-]+$/", $_POST['code'])){
				$err_msg .= "<li><a href=\"#code\">Please Enter [code] in [a-z-]</a></li>";
			}
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#code\">Please Enter [code] within 32 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " property_type_groups";
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
				$err_msg .= "<li><a href=\"#code\"> This [code] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="image_path"){
		if( $_POST['image_path'] == "delete" ){
			$upload_msg = admin_common_image_delete("property_type_groups","image_path");
		}
		if(!empty($_FILES['image_path']["name"])){
			$upload_msg = admin_common_image_upload("property_type_groups","image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="description"){
	}
	if(empty($column_name)||$column_name=="sort"){
		if(empty($_POST['sort'])){
			$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort]</a></li>";
		}
		if(!empty($_POST['sort'])){
			if(!preg_match("/^[0-9]+$/", $_POST['sort'])){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort] in [0-9]</a></li>";
			}
		}
		if(!empty($_POST['sort'])){
			if(mb_strlen($_POST['sort'],"UTF-8") > 2){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort] within 2 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>