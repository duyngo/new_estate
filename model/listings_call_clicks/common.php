<?php
function listings_call_clicks_index( $listings_id ){
        $sql = "select";
        $sql .= " *";
        $sql .= " from";
        $sql .= " listings_call_clicks";
        $sql .= " where";
        $sql .= " listings_id = " . $listings_id;
        $sql .= " and";
        $sql .= " is_deleted = 0";
        return mysql_query($sql);
}
function listings_call_clicks_insert($listings_id,$members_id){
	$sql = "insert into listings_call_clicks(";
	$sql .= " listings_id";
	$sql .= ",members_id";
	$sql .= ",created";
	$sql .= ")values(";
	$sql .= $listings_id;
	$sql .= ",'" . $members_id . "'";
	$sql .= ",now()";
	$sql .= ")";
	common_exec_sql($sql);
	return;
}
?>
