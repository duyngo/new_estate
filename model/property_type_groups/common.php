<?php
function property_type_groups_index(){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " property_type_groups";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
?>
