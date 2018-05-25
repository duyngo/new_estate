<?php
function completion_years_index(){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " completion_years";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
?>
