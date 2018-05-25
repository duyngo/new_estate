<?php
function bedrooms_index(){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " bedrooms";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
?>
