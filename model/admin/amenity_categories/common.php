<?php
function amenity_categories_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " amenity_categories t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/amenity_categories/")!==false){
		if(!empty( $_SESSION['amenity_categories']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['amenity_categories']['name']) . "%'";
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
function amenity_categories_insert(){
	$sql = "insert into amenity_categories(";
	$sql .= " name";
	$sql .= ",code";
	$sql .= ",image_path";
	$sql .= ",icon";
	$sql .= ",hit_radius";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . $_SESSION['amenity_categories']['image_path'] . "'";
	$sql .= ",'" . $_SESSION['amenity_categories']['icon'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['hit_radius'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("amenity_categories");
}
function amenity_categories_update(){
	$sql = "update amenity_categories set";
	$sql .= " name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['amenity_categories']['image_path'] . "'";
	$sql .= ",icon = '" . $_SESSION['amenity_categories']['icon'] . "'";
	$sql .= ",hit_radius = '" . mysql_real_escape_string( $_POST['hit_radius'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function amenity_categories_delete( $id ){
	$sql = "update amenity_categories set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function amenity_categories_amenities_index( $amenity_categories_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " amenities t1";
	$sql .= " where";
	$sql .= " t1.amenity_categories_id = $amenity_categories_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['amenity_categories']['amenities']['states_id'])){
		$sql .= " and";
		$sql .= " t1.states_id like '%" . $_SESSION['amenity_categories']['amenities']['states_id'] . "%'";
	}
	if(!empty( $_SESSION['amenity_categories']['amenities']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['amenity_categories']['amenities']['name']) . "%'";
	}
	$sql .= " order by t1.states_id,t1.groups_id,t1.amenity_categories_id";
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
function amenity_categories_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Category name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Category name] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="code"){
		if(empty($_POST['code'])){
			$err_msg .= "<li><a href=\"#code\">Please Enter [Code]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 16){
				$err_msg .= "<li><a href=\"#code\">Please Enter [Code] within 16 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " amenity_categories";
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
				$err_msg .= "<li><a href=\"#code\"> This [Code] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="image_path"){
		if( $_POST['image_path'] == "delete" ){
			$upload_msg = admin_common_image_delete("amenity_categories","image_path");
		}
		if(!empty($_FILES['image_path']["name"])){
			$upload_msg = admin_common_image_upload("amenity_categories","image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="icon"){
		if( $_POST['icon'] == "delete" ){
			$upload_msg = admin_common_image_delete("amenity_categories","icon");
		}
		if(!empty($_FILES['icon']["name"])){
			$upload_msg = admin_common_image_upload("amenity_categories","icon");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#icon\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="hit_radius"){
		if(empty($_POST['hit_radius'])){
			$err_msg .= "<li><a href=\"#hit_radius\">Please Enter [Hit radius]</a></li>";
		}
		if(!empty($_POST['hit_radius'])){
			if(mb_strlen($_POST['hit_radius'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#hit_radius\">Please Enter [Hit radius] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="sort"){
		if(empty($_POST['sort'])){
			$err_msg .= "<li><a href=\"#sort\">Please Enter [sort]</a></li>";
		}
		if(!empty($_POST['sort'])){
			if(!preg_match("/^[0-9]+$/", $_POST['sort'])){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [sort] in [0-9]</a></li>";
			}
		}
		if(!empty($_POST['sort'])){
			if(mb_strlen($_POST['sort'],"UTF-8") > 10){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [sort] within 10 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>