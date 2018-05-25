<?php
function users_index(){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " users";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	$sql .= " order by id";
        return mysql_query( $sql );
}
?>
