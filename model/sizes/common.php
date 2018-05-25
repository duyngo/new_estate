<?php
function sizes_index(){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " sizes";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
?>
