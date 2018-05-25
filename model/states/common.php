<?php
function states_index( $mode ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " states";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	if( $mode == "a" ){
		$sql .= " and";
		//$sql .= " code in ('kuala-lumpur','selangor')";
		$sql .= " id in (10001,10002,10003,10004,10009,10010)";
	}else if( $mode == "b"){
		$sql .= " and";
		//$sql .= " code not in ('kuala-lumpur','selangor')";
		$sql .= " id not in (10001,10002,10003,10004,10009,10010)";
	}
	$sql .= " order by sort";
	return mysql_query($sql);
}
?>
