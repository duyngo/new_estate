<?php
function listings_plans_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_plans t1";
	$sql .= " left join";
	$sql .= " listings t2";
	$sql .= " on";
	$sql .= " ( t1.listings_id = t2. )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/listings_plans/")!==false){
		if(!empty( $_SESSION['listings_plans']['listings_id'])){
			$sql .= " and";
			$sql .= " t2.name like '%" . mysql_real_escape_string($_SESSION['listings_plans']['listings_id']) . "%'";
		}
		if(!empty( $_SESSION['listings_plans']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['listings_plans']['name']) . "%'";
		}
		if(!empty( $_SESSION['listings_plans']['display_flag'])){
			$sql .= " and";
			$sql .= " t1.display_flag = '" . $_SESSION['listings_plans']['display_flag'] . "'";
		}
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
function listings_plans_insert(){
	$sql = "insert into listings_plans(";
	$sql .= " listings_id";
	$sql .= ",name";
	$sql .= ",image_path";
	$sql .= ",size";
	$sql .= ",bedrooms";
	$sql .= ",bathrooms";
	$sql .= ",price";
	$sql .= ",sort";
	$sql .= ",display_flag";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . $_SESSION['listings_plans']['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['size'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['bedrooms'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['bathrooms'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['price'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['display_flag'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("listings_plans");
}
function listings_plans_update(){
	$sql = "update listings_plans set";
	$sql .= " listings_id = '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['listings_plans']['image_path'] . "'";
	$sql .= ",size = '" . mysql_real_escape_string( $_POST['size'] ) . "'";
	$sql .= ",bedrooms = '" . mysql_real_escape_string( $_POST['bedrooms'] ) . "'";
	$sql .= ",bathrooms = '" . mysql_real_escape_string( $_POST['bathrooms'] ) . "'";
	$sql .= ",price = '" . mysql_real_escape_string( $_POST['price'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",display_flag = '" . mysql_real_escape_string( $_POST['display_flag'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function listings_plans_delete( $id ){
	$sql = "update listings_plans set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_plans_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="listings_id"){
		if(empty($_POST['listings_id'])){
			$err_msg .= "<li><a href=\"#listings_id\">Please Enter [Listing]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Name] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path"){
		$upload_msg = admin_common_image_upload("listings_plans","image_path");
		if($upload_msg){
			$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="size"){
		if(!empty($_POST['size'])){
			if(mb_strlen($_POST['size'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#size\">Please Enter [Size] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="bedrooms"){
		if(!empty($_POST['bedrooms'])){
			if(mb_strlen($_POST['bedrooms'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#bedrooms\">Please Enter [Bedrooms] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="bathrooms"){
		if(!empty($_POST['bathrooms'])){
			if(mb_strlen($_POST['bathrooms'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#bathrooms\">Please Enter [Bathrooms] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="price"){
		if(!empty($_POST['price'])){
			if(mb_strlen($_POST['price'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#price\">Please Enter [Price] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="sort"){
		if(empty($_POST['sort'])){
			$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort]</a></li>";
		}
		if(!empty($_POST['sort'])){
			if(mb_strlen($_POST['sort'],"UTF-8") > 2){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort] within 2 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="display_flag"){
		if(empty($_POST['display_flag'])){
			$err_msg .= "<li><a href=\"#display_flag\">Please Enter [Display Flag]</a></li>";
		}
	}
	return $err_msg;
}
?>