<?php
function amenities_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " amenities t1";
	$sql .= " left join";
	$sql .= " states t2";
	$sql .= " on";
	$sql .= " ( t1.states_id = t2.id )";
	$sql .= " left join";
	$sql .= " amenity_categories t3";
	$sql .= " on";
	$sql .= " ( t1.amenity_categories_id = t3.id )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/amenities/")!==false){
		if(!empty( $_SESSION['amenities']['states_id'])){
			$sql .= " and";
			$sql .= " t1.states_id = '" . $_SESSION['amenities']['states_id'] . "'";
		}
		if(!empty( $_SESSION['amenities']['amenity_categories_id'])){
			$sql .= " and";
			$sql .= " t1.amenity_categories_id = '" . $_SESSION['amenities']['amenity_categories_id'] . "'";
		}
		if(!empty( $_SESSION['amenities']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['amenities']['name']) . "%'";
		}
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
function amenities_insert(){
	$sql = "insert into amenities(";
	$sql .= " states_id";
	$sql .= ",groups_id";
	$sql .= ",amenity_categories_id";
	$sql .= ",name";
	$sql .= ",image_path";
	$sql .= ",description";
	$sql .= ",latitude";
	$sql .= ",longitude";
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
	$sql .= ",'" . mysql_real_escape_string( $_POST['latitude'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['longitude'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("amenities");
}
function amenities_update(){
	$sql = "update amenities set";
	$sql .= " states_id = '" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",groups_id = '" . mysql_real_escape_string( $_POST['groups_id'] ) . "'";
	$sql .= ",amenity_categories_id = '" . mysql_real_escape_string( $_POST['amenity_categories_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['amenities']['image_path'] . "'";
	$sql .= ",description = '" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",latitude = '" . mysql_real_escape_string( $_POST['latitude'] ) . "'";
	$sql .= ",longitude = '" . mysql_real_escape_string( $_POST['longitude'] ) . "'";
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
function amenities_listings_amenities_index( $amenities_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_amenities t1";
	$sql .= " where";
	$sql .= " t1.amenities_id = $amenities_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['amenities']['listings_amenities']['listings_id'])){
		$sql .= " and";
		$sql .= " t1.listings_id like '%" . mysql_real_escape_string($_SESSION['amenities']['listings_amenities']['listings_id']) . "%'";
	}
	if(!empty( $_SESSION['amenities']['listings_amenities']['display_flag'])){
		$sql .= " and";
		$sql .= " t1.display_flag like '%" . $_SESSION['amenities']['listings_amenities']['display_flag'] . "%'";
	}
	$sql .= " order by t1.sort";
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
function amenities_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="states_id"){
		if(empty($_POST['states_id'])){
			$err_msg .= "<li><a href=\"#states_id\">Please Enter [State]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="groups_id"){
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
		if( $_POST['image_path'] == "delete" ){
			$upload_msg = admin_common_image_delete("amenities","image_path");
		}
		if(!empty($_FILES['image_path']["name"])){
			$upload_msg = admin_common_image_upload("amenities","image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="description"){
		if(!empty($_POST['description'])){
			if(mb_strlen($_POST['description'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#description\">Please Enter [Description] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="latitude"){
		if(!empty($_POST['latitude'])){
			if(!preg_match("/^[0-9.]{8,11}+$/", $_POST['latitude'])){
				$err_msg .= "<li><a href=\"#latitude\">Please Enter [Latitude] in [0-9.]{8,11}</a></li>";
			}
		}
		if(!empty($_POST['latitude'])){
			if(mb_strlen($_POST['latitude'],"UTF-8") > 11){
				$err_msg .= "<li><a href=\"#latitude\">Please Enter [Latitude] within 11 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="longitude"){
		if(!empty($_POST['longitude'])){
			if(!preg_match("/^[0-9.]{8,11}+$/", $_POST['longitude'])){
				$err_msg .= "<li><a href=\"#longitude\">Please Enter [Longitude] in [0-9.]{8,11}</a></li>";
			}
		}
		if(!empty($_POST['longitude'])){
			if(mb_strlen($_POST['longitude'],"UTF-8") > 11){
				$err_msg .= "<li><a href=\"#longitude\">Please Enter [Longitude] within 11 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>