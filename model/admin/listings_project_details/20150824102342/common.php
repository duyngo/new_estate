<?php
function listings_project_details_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_project_details t1";
	$sql .= " left join";
	$sql .= " listings t2";
	$sql .= " on";
	$sql .= " ( t1.listings_id = t2. )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/listings_project_details/")!==false){
		if(!empty( $_SESSION['listings_project_details']['listings_id'])){
			$sql .= " and";
			$sql .= " t1.listings_id = '" . $_SESSION['listings_project_details']['listings_id'] . "'";
		}
		if(!empty( $_SESSION['listings_project_details']['head'])){
			$sql .= " and";
			$sql .= " t1.head like '%" . mysql_real_escape_string($_SESSION['listings_project_details']['head']) . "%'";
		}
		if(!empty( $_SESSION['listings_project_details']['body'])){
			$sql .= " and";
			$sql .= " t1.body like '%" . mysql_real_escape_string($_SESSION['listings_project_details']['body']) . "%'";
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
function listings_project_details_insert(){
	$sql = "insert into listings_project_details(";
	$sql .= " listings_id";
	$sql .= ",head";
	$sql .= ",body";
	$sql .= ",sort";
	$sql .= ",display_flag";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['head'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['body'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['display_flag'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return;
}
function listings_project_details_update(){
	$sql = "update listings_project_details set";
	$sql .= " listings_id = '" . mysql_real_escape_string( $_POST['listings_id'] ) . "'";
	$sql .= ",head = '" . mysql_real_escape_string( $_POST['head'] ) . "'";
	$sql .= ",body = '" . mysql_real_escape_string( $_POST['body'] ) . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",display_flag = '" . mysql_real_escape_string( $_POST['display_flag'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function listings_project_details_delete( $id ){
	$sql = "update listings_project_details set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_project_details_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="listings_id"){
		if(empty($_POST['listings_id'])){
			$err_msg .= "<li><a href=\"#listings_id\">Please Enter [Listings]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="head"){
		if(empty($_POST['head'])){
			$err_msg .= "<li><a href=\"#head\">Please Enter [Head]</a></li>";
		}
		if(!empty($_POST['head'])){
			if(mb_strlen($_POST['head'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#head\">Please Enter [Head] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="body"){
		if(empty($_POST['body'])){
			$err_msg .= "<li><a href=\"#body\">Please Enter [Body]</a></li>";
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