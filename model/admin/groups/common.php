<?php
function groups_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " groups t1";
	$sql .= " left join";
	$sql .= " states t2";
	$sql .= " on";
	$sql .= " ( t1.states_id = t2.id )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/groups/")!==false){
		if(!empty( $_SESSION['groups']['states_id'])){
			$sql .= " and";
			$sql .= " t1.states_id = '" . $_SESSION['groups']['states_id'] . "'";
		}
		if(!empty( $_SESSION['groups']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['groups']['name']) . "%'";
		}
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
function groups_insert(){
	$sql = "insert into groups(";
	$sql .= " states_id";
	$sql .= ",name";
	$sql .= ",code";
	$sql .= ",description";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("groups");
}
function groups_update(){
	$sql = "update groups set";
	$sql .= " states_id = '" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",description = '" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function groups_delete( $id ){
	$sql = "update groups set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function groups_locations_index( $groups_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " locations t1";
	$sql .= " where";
	$sql .= " t1.groups_id = $groups_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['groups']['locations']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['groups']['locations']['name']) . "%'";
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
function groups_amenities_index( $groups_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " amenities t1";
	$sql .= " where";
	$sql .= " t1.groups_id = $groups_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['groups']['amenities']['states_id'])){
		$sql .= " and";
		$sql .= " t1.states_id like '%" . $_SESSION['groups']['amenities']['states_id'] . "%'";
	}
	if(!empty( $_SESSION['groups']['amenities']['amenity_categories_id'])){
		$sql .= " and";
		$sql .= " t1.amenity_categories_id like '%" . $_SESSION['groups']['amenities']['amenity_categories_id'] . "%'";
	}
	if(!empty( $_SESSION['groups']['amenities']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['groups']['amenities']['name']) . "%'";
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
function groups_listings_index( $groups_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " where";
	$sql .= " t1.groups_id = $groups_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['groups']['listings']['id'])){
		$sql .= " and";
		$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['groups']['listings']['id']) . "%'";
	}
	if(!empty( $_SESSION['groups']['listings']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['groups']['listings']['name']) . "%'";
	}
	if(!empty( $_SESSION['groups']['listings']['companies_id'])){
		$sql .= " and";
		$sql .= " t1.companies_id like '%" . mysql_real_escape_string($_SESSION['groups']['listings']['companies_id']) . "%'";
	}
	if(!empty( $_SESSION['groups']['listings']['property_name'])){
		$sql .= " and";
		$sql .= " t1.property_name like '%" . mysql_real_escape_string($_SESSION['groups']['listings']['property_name']) . "%'";
	}
	if(!empty( $_SESSION['groups']['listings']['status'])){
		$sql .= " and";
		$sql .= " t1.status like '%" . $_SESSION['groups']['listings']['status'] . "%'";
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
function groups_urls_index( $groups_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " urls t1";
	$sql .= " where";
	$sql .= " t1.groups_id = $groups_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['groups']['urls']['url'])){
		$sql .= " and";
		$sql .= " t1.url like '%" . mysql_real_escape_string($_SESSION['groups']['urls']['url']) . "%'";
	}
	if(!empty( $_SESSION['groups']['urls']['type'])){
		$sql .= " and";
		$sql .= " t1.type like '%" . $_SESSION['groups']['urls']['type'] . "%'";
	}
	if(!empty( $_SESSION['groups']['urls']['states_id'])){
		$sql .= " and";
		$sql .= " t1.states_id like '%" . $_SESSION['groups']['urls']['states_id'] . "%'";
	}
	if(!empty( $_SESSION['groups']['urls']['property_type_groups_id'])){
		$sql .= " and";
		$sql .= " t1.property_type_groups_id like '%" . $_SESSION['groups']['urls']['property_type_groups_id'] . "%'";
	}
	if(!empty( $_SESSION['groups']['urls']['conditions_num'])){
		$sql .= " and";
		$sql .= " t1.conditions_num like '%" . mysql_real_escape_string($_SESSION['groups']['urls']['conditions_num']) . "%'";
	}
	if(!empty( $_SESSION['groups']['urls']['listings_num'])){
		$sql .= " and";
		$sql .= " t1.listings_num like '%" . mysql_real_escape_string($_SESSION['groups']['urls']['listings_num']) . "%'";
	}
	if(!empty( $_SESSION['groups']['urls']['ad_flag'])){
		$sql .= " and";
		$sql .= " t1.ad_flag like '%" . $_SESSION['groups']['urls']['ad_flag'] . "%'";
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
function groups_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="states_id"){
		if(empty($_POST['states_id'])){
			$err_msg .= "<li><a href=\"#states_id\">Please Enter [State]</a></li>";
		}
	}
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
		$sql .= " groups";
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