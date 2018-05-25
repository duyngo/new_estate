<?php
function locations_index( $states_id,$groups_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " locations";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	if(!empty($states_id)){
		$sql .= " and";
		$sql .= " states_id = $states_id";
	}
	if(!empty($groups_id)){
		$sql .= " and";
		$sql .= " groups_id = $groups_id";
	}
	$sql .= " order by sort";
	return mysql_query($sql);
}
?>
