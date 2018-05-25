<?php
function features_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " features t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/features/")!==false){
		if(!empty( $_SESSION['features']['id'])){
			$sql .= " and";
			$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['features']['id']) . "%'";
		}
		if(!empty( $_SESSION['features']['code'])){
			$sql .= " and";
			$sql .= " t1.code like '%" . mysql_real_escape_string($_SESSION['features']['code']) . "%'";
		}
		if(!empty( $_SESSION['features']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['features']['name']) . "%'";
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
function features_insert(){
	$sql = "insert into features(";
	$sql .= " code";
	$sql .= ",name";
	$sql .= ",image_path";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . $_SESSION['features']['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("features");
}
function features_update(){
	$sql = "update features set";
	$sql .= " code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['features']['image_path'] . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function features_delete( $id ){
	$sql = "update features set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function features_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="code"){
		if(empty($_POST['code'])){
			$err_msg .= "<li><a href=\"#code\">Please Enter [code(Used as part of URL)]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#code\">Please Enter [code(Used as part of URL)] within 64 characters.</a></li>";
			}
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " features";
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
				$err_msg .= "<li><a href=\"#code\"> This [code(Used as part of URL)] is already registered.</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Name] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path"){
		$upload_msg = admin_common_image_upload("features","image_path");
		if($upload_msg){
			$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="sort"){
		if(empty($_POST['sort'])){
			$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort]</a></li>";
		}
		if(!empty($_POST['sort'])){
			if(mb_strlen($_POST['sort'],"UTF-8") > 10){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort] within 10 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>