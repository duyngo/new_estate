<?php
function banners_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " banners t1";
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
function banners_insert(){
	$sql = "insert into banners(";
	$sql .= " image_path";
	$sql .= ",url";
	$sql .= ",alt";
	$sql .= ",title";
	$sql .= ",description";
	$sql .= ",button_name";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . $_SESSION['banners']['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['url'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['alt'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['title'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['button_name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("banners");
}
function banners_update(){
	$sql = "update banners set";
	$sql .= " image_path = '" . $_SESSION['banners']['image_path'] . "'";
	$sql .= ",url = '" . mysql_real_escape_string( $_POST['url'] ) . "'";
	$sql .= ",alt = '" . mysql_real_escape_string( $_POST['alt'] ) . "'";
	$sql .= ",title = '" . mysql_real_escape_string( $_POST['title'] ) . "'";
	$sql .= ",description = '" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",button_name = '" . mysql_real_escape_string( $_POST['button_name'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function banners_delete( $id ){
	$sql = "update banners set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function banners_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="image_path"){
		if( empty($_FILES['image_path']["name"]) && empty($_SESSION['banners']['image_path'])){
			$err_msg .= "<li><a href=\"#image_path\">Please Enter [Image]</a></li>";
		}
		if( $_POST['image_path'] == "delete" ){
			$upload_msg = admin_common_image_delete("banners","image_path");
		}
		if(!empty($_FILES['image_path']["name"])){
			$upload_msg = admin_common_image_upload("banners","image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="url"){
		if(empty($_POST['url'])){
			$err_msg .= "<li><a href=\"#url\">Please Enter [Url]</a></li>";
		}
		if(!empty($_POST['url'])){
			if(mb_strlen($_POST['url'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#url\">Please Enter [Url] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="alt"){
		if(!empty($_POST['alt'])){
			if(mb_strlen($_POST['alt'],"UTF-8") > 32){
				$err_msg .= "<li><a href=\"#alt\">Please Enter [Alt] within 32 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="title"){
		if(!empty($_POST['title'])){
			if(mb_strlen($_POST['title'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#title\">Please Enter [Title] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="description"){
	}
	if(empty($column_name)||$column_name=="button_name"){
		if(!empty($_POST['button_name'])){
			if(mb_strlen($_POST['button_name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#button_name\">Please Enter [Button Name] within 64 characters.</a></li>";
			}
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