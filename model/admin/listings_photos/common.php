<?php
function listings_photos_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_photos t1";
	$sql .= " left join";
	$sql .= " listings t2";
	$sql .= " on";
	$sql .= " ( t1.listings_id = t2.id )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/listings_photos/")!==false){
		if(!empty( $_SESSION['listings_photos']['listings_id'])){
			$sql .= " and";
			$sql .= " t2.name like '%" . mysql_real_escape_string($_SESSION['listings_photos']['listings_id']) . "%'";
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
function listings_photos_insert(){
	$sql = "insert into listings_photos(";
	$sql .= " listings_id";
	$sql .= ",image_path";
	$sql .= ",caption";
	$sql .= ",sort";
	$sql .= ",display_flag";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",'" . $_SESSION['listings_photos']['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['caption'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['display_flag'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("listings_photos");
}
function listings_photos_update(){
	$sql = "update listings_photos set";
	$sql .= " listings_id = '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",image_path = '" . $_SESSION['listings_photos']['image_path'] . "'";
	$sql .= ",caption = '" . mysql_real_escape_string( $_POST['caption'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",display_flag = '" . mysql_real_escape_string( $_POST['display_flag'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function listings_photos_delete( $id ){
	$sql = "update listings_photos set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_photos_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="listings_id"){
		if(empty($_POST['listings_id'])){
			$err_msg .= "<li><a href=\"#listings_id\">Please Enter [Listing]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="image_path"){
		if(!empty($_FILES['image_path']["name"])){
			admin_common_image_delete("listings_photos","image_path",$_SESSION['listings_photos']['image_path']);
			$upload_msg = admin_common_image_upload("listings_photos","image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path\">" . $upload_msg . "</a></li>";
			}
		}else{
			if( $_POST['image_path'] == "delete" ){
				admin_common_image_delete("listings_photos","image_path",$_SESSION['listings_photos']['image_path']);
			}
		}
	}
	if(empty($column_name)||$column_name=="caption"){
		if(!empty($_POST['caption'])){
			if(mb_strlen($_POST['caption'],"UTF-8") > 256){
				$err_msg .= "<li><a href=\"#caption\">Please Enter [caption] within 256 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="sort"){
		if(empty($_POST['sort'])){
			$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort]</a></li>";
		}
		if(!empty($_POST['sort'])){
			if(!preg_match("/^[0-9]{1,2}+$/", $_POST['sort'])){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort] in [0-9]{1,2}</a></li>";
			}
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
