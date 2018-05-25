<?php
function listings_call_clicks_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings_call_clicks t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/listings_call_clicks/")!==false){
		if(!empty( $_SESSION['listings_call_clicks']['listings_id'])){
			$sql .= " and";
			$sql .= " t1.listings_id like '%" . mysql_real_escape_string($_SESSION['listings_call_clicks']['listings_id']) . "%'";
		}
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
function listings_call_clicks_insert(){
	$sql = "insert into listings_call_clicks(";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("listings_call_clicks");
}
function listings_call_clicks_update(){
	$sql = "update listings_call_clicks set";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function listings_call_clicks_delete( $id ){
	$sql = "update listings_call_clicks set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_call_clicks_err_check( $column_name ){
	$err_msg = NULL;
	return $err_msg;
}
?>