<?php
function groups_index( $states_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " groups t1";
	$sql .= " where";
	$sql .= " t1.states_id = $states_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	$sql .= " order by sort";
	return mysql_query($sql);
}
?>
