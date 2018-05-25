<?php
function states_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " states t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/states/")!==false){
		if(!empty( $_SESSION['states']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['states']['name']) . "%'";
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
function states_insert(){
	$sql = "insert into states(";
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
	$sql .= ",'" . $_SESSION['states']['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("states");
}
function states_update(){
	$sql = "update states set";
	$sql .= " name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['states']['image_path'] . "'";
	$sql .= ",description = '" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function states_delete( $id ){
	$sql = "update states set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function states_locations_index( $states_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " locations t1";
	$sql .= " where";
	$sql .= " t1.states_id = $states_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['states']['locations']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['states']['locations']['name']) . "%'";
	}
	$sql .= " order by t1.states_id,t1.groups_id,t1.name";
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
function states_groups_index( $states_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " groups t1";
	$sql .= " where";
	$sql .= " t1.states_id = $states_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['states']['groups']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['states']['groups']['name']) . "%'";
	}
	$sql .= " order by t1.states_id,t1.name";
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
function states_amenities_index( $states_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " amenities t1";
	$sql .= " where";
	$sql .= " t1.states_id = $states_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['states']['amenities']['amenity_categories_id'])){
		$sql .= " and";
		$sql .= " t1.amenity_categories_id like '%" . $_SESSION['states']['amenities']['amenity_categories_id'] . "%'";
	}
	if(!empty( $_SESSION['states']['amenities']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['states']['amenities']['name']) . "%'";
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
function states_listings_index( $states_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " where";
	$sql .= " t1.states_id = $states_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['states']['listings']['id'])){
		$sql .= " and";
		$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['states']['listings']['id']) . "%'";
	}
	if(!empty( $_SESSION['states']['listings']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['states']['listings']['name']) . "%'";
	}
	if(!empty( $_SESSION['states']['listings']['companies_id'])){
		$sql .= " and";
		$sql .= " t1.companies_id like '%" . mysql_real_escape_string($_SESSION['states']['listings']['companies_id']) . "%'";
	}
	if(!empty( $_SESSION['states']['listings']['property_name'])){
		$sql .= " and";
		$sql .= " t1.property_name like '%" . mysql_real_escape_string($_SESSION['states']['listings']['property_name']) . "%'";
	}
	if(!empty( $_SESSION['states']['listings']['status'])){
		$sql .= " and";
		$sql .= " t1.status like '%" . $_SESSION['states']['listings']['status'] . "%'";
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
function states_urls_index( $states_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " urls t1";
	$sql .= " where";
	$sql .= " t1.states_id = $states_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['states']['urls']['url'])){
		$sql .= " and";
		$sql .= " t1.url like '%" . mysql_real_escape_string($_SESSION['states']['urls']['url']) . "%'";
	}
	if(!empty( $_SESSION['states']['urls']['type'])){
		$sql .= " and";
		$sql .= " t1.type like '%" . $_SESSION['states']['urls']['type'] . "%'";
	}
	if(!empty( $_SESSION['states']['urls']['groups_id'])){
		$sql .= " and";
		$sql .= " t1.groups_id like '%" . $_SESSION['states']['urls']['groups_id'] . "%'";
	}
	if(!empty( $_SESSION['states']['urls']['property_type_groups_id'])){
		$sql .= " and";
		$sql .= " t1.property_type_groups_id like '%" . $_SESSION['states']['urls']['property_type_groups_id'] . "%'";
	}
	if(!empty( $_SESSION['states']['urls']['conditions_num'])){
		$sql .= " and";
		$sql .= " t1.conditions_num like '%" . mysql_real_escape_string($_SESSION['states']['urls']['conditions_num']) . "%'";
	}
	if(!empty( $_SESSION['states']['urls']['listings_num'])){
		$sql .= " and";
		$sql .= " t1.listings_num like '%" . mysql_real_escape_string($_SESSION['states']['urls']['listings_num']) . "%'";
	}
	if(!empty( $_SESSION['states']['urls']['ad_flag'])){
		$sql .= " and";
		$sql .= " t1.ad_flag like '%" . $_SESSION['states']['urls']['ad_flag'] . "%'";
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
function states_err_check( $column_name ){
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
	if(empty($column_name)||$column_name=="code"){
		if(empty($_POST['code'])){
			$err_msg .= "<li><a href=\"#code\">Please Enter [code(URL用)]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#code\">Please Enter [code(URL用)] within 32 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " states";
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
				$err_msg .= "<li><a href=\"#code\"> This [code(URL用)] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="image_path"){
		if( $_POST['image_path'] == "delete" ){
			$upload_msg = admin_common_image_delete("states","image_path",$_SESSION['states']['image_path']);
		}
		if(!empty($_FILES['image_path']["name"])){
			$upload_msg = admin_common_image_upload("states","image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="description"){
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
