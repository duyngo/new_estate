<?php
function tenures_index(){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " tenures t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	$sql .= " order by t1.sort";
	return mysql_query($sql);
}
?>
