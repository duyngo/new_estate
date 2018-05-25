<?php
function urls_update_modified($listings_id){
	$sql = "update urls set";
	$sql .= " modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " type = 'detail'";
	$sql .= " and";
	$sql .= " listings_id = " . $listings_id;
	common_exec_sql($sql);
	return;
}
?>
