<?php
function urls_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " urls t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/urls/")!==false){
		if(!empty( $_SESSION['urls']['url'])){
			$sql .= " and";
			$sql .= " t1.url like '%" . mysql_real_escape_string($_SESSION['urls']['url']) . "%'";
		}
		if(!empty( $_SESSION['urls']['type'])){
			$sql .= " and";
			$sql .= " t1.type = '" . $_SESSION['urls']['type'] . "'";
		}
	}
	$sql .= " order by created desc";
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
function urls_insert(){
	$sql = "insert into urls(";
	$sql .= " type";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['type'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("urls");
}
function urls_update(){
	$sql = "update urls set";
	$sql .= " type = '" . mysql_real_escape_string( $_POST['type'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function urls_delete( $id ){
	$sql = "update urls set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function urls_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="type"){
		if(empty($_POST['type'])){
			$err_msg .= "<li><a href=\"#type\">Please Enter [Type]</a></li>";
		}
	}
	return $err_msg;
}
?>