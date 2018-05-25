<?php
function amenities_index( $lines ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " amenities";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/amenities/")!==false){
		if(!empty( $_SESSION['amenities']['name'])){
			$sql .= " and";
			$sql .= " name like '%" . mysql_real_escape_string($_SESSION['amenities']['name']) . "%'";
		}
		if(!empty( $_SESSION['amenities']['map_coordinates'])){
			$sql .= " and";
			$sql .= " map_coordinates like '%" . mysql_real_escape_string($_SESSION['amenities']['map_coordinates']) . "%'";
		}
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
function amenities_insert(){
	$sql = "insert into amenities(";
	$sql .= " states_id";
	$sql .= ",groups_id";
	$sql .= ",amenity_categories_id";
	$sql .= ",name";
	$sql .= ",image_path";
	$sql .= ",description";
	$sql .= ",map_coordinates";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['groups_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['amenity_categories_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . $_SESSION['amenities']['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['map_coordinates'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return;
}
function amenities_update(){
	$sql = "update amenities set";
	$sql .= " states_id = '" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",groups_id = '" . mysql_real_escape_string( $_POST['groups_id'] ) . "'";
	$sql .= ",amenity_categories_id = '" . mysql_real_escape_string( $_POST['amenity_categories_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['amenities']['image_path'] . "'";
	$sql .= ",description = '" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",map_coordinates = '" . mysql_real_escape_string( $_POST['map_coordinates'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function amenities_delete( $id ){
	$sql = "update amenities set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function amenities_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="states_id"){
		if(empty($_POST['states_id'])){
			$err_msg .= "<li><a href=\"#states_id\">Please Enter [State]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="groups_id"){
		if(empty($_POST['groups_id'])){
			$err_msg .= "<li><a href=\"#groups_id\">Please Enter [Area Group]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="amenity_categories_id"){
		if(empty($_POST['amenity_categories_id'])){
			$err_msg .= "<li><a href=\"#amenity_categories_id\">Please Enter [Category]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Amenity name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Amenity name] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path"){
		$upload_msg = admin_common_image_upload("amenities","image_path");
		if($upload_msg){
			$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="description"){
	}
	if(empty($column_name)||$column_name=="map_coordinates"){
		if(empty($_POST['map_coordinates'])){
			$err_msg .= "<li><a href=\"#map_coordinates\">Please Enter [Map coordinates]</a></li>";
		}
		if(!empty($_POST['map_coordinates'])){
			if(mb_strlen($_POST['map_coordinates'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#map_coordinates\">Please Enter [Map coordinates] within 32 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>