<?php
function urls_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " urls t1";
	$sql .= " left join";
	$sql .= " states t2";
	$sql .= " on";
	$sql .= " ( t1.states_id = t2.id )";
	$sql .= " left join";
	$sql .= " groups t3";
	$sql .= " on";
	$sql .= " ( t1.groups_id = t3.id )";
	$sql .= " left join";
	$sql .= " property_type_groups t4";
	$sql .= " on";
	$sql .= " ( t1.property_type_groups_id = t4.id )";
	$sql .= " where";
	$sql .= " t1.id > 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/urls/")!==false){
		if(!empty( $_SESSION['urls']['url'])){
			$sql .= " and";
			$sql .= " t1.url like '%" . mysql_real_escape_string($_SESSION['urls']['url']) . "%'";
		}
		if(!empty( $_SESSION['urls']['type'])){
			$sql .= " and";
			$sql .= " t1.type = '" . $_SESSION['urls']['type'] . "'";
		}
		if(!empty( $_SESSION['urls']['states_id'])){
			$sql .= " and";
			if( $_SESSION['urls']['states_id'] > 0 ){
				$sql .= " t1.states_id = '" . $_SESSION['urls']['states_id'] . "'";
			}else{
				$sql .= " t1.states_id > 0";
			}
		}
		if(!empty( $_SESSION['urls']['groups_id'])){
			$sql .= " and";
			if( $_SESSION['urls']['groups_id'] > 0 ){
				$sql .= " t1.groups_id = '" . $_SESSION['urls']['groups_id'] . "'";
			}else{
				$sql .= " t1.groups_id > 0";
			}
		}
		if(!empty( $_SESSION['urls']['property_type_groups_id'])){
			$sql .= " and";
			if( $_SESSION['urls']['property_type_groups_id'] > 0 ){
				$sql .= " t1.property_type_groups_id = '" . $_SESSION['urls']['property_type_groups_id'] . "'";
			}else{
				$sql .= " t1.property_type_groups_id > 0";
			}
		}
		if(!empty( $_SESSION['urls']['conditions_num'])){
			$sql .= " and";
			$sql .= " t1.conditions_num = '" . mysql_real_escape_string($_SESSION['urls']['conditions_num']) . "'";
		}
		if(!empty( $_SESSION['urls']['listings_num'])){
			$sql .= " and";
			$sql .= " t1.listings_num >= '" . mysql_real_escape_string($_SESSION['urls']['listings_num']) . "'";
		}
		if(!empty( $_SESSION['urls']['ad_flag'])){
			$sql .= " and";
			$sql .= " t1.ad_flag = '" . $_SESSION['urls']['ad_flag'] . "'";
		}
		if(!empty( $_SESSION['urls']['completion_year'])){
			$sql .= " and";
			$sql .= " t1.url like '%" . $_SESSION['urls']['completion_year'] . "%'";
		}
                $sql .= " and";
                if(empty($_SESSION['urls']['is_deleted'])){
                        $sql .= " t1.is_deleted = 0";
                }else{
                        $sql .= " t1.is_deleted = 1";
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
function urls_insert(){
	$sql = "insert into urls(";
	$sql .= " states_id";
	$sql .= ",groups_id";
	$sql .= ",property_type_groups_id";
	$sql .= ",ad_flag";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['states_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['groups_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['property_type_groups_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['ad_flag'] ) . "'";
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
	$sql .= " ad_flag = '" . mysql_real_escape_string( $_POST['ad_flag'] ) . "'";
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
	if(empty($column_name)||$column_name=="states_id"){
	}
	if(empty($column_name)||$column_name=="groups_id"){
	}
	if(empty($column_name)||$column_name=="property_type_groups_id"){
	}
	if(empty($column_name)||$column_name=="ad_flag"){
		if(empty($_POST['ad_flag'])){
			$err_msg .= "<li><a href=\"#ad_flag\">Please Enter [Ad Flag]</a></li>";
		}
	}
	return $err_msg;
}
?>
