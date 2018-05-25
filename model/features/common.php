<?php
function features_index( $limit,$offset ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " features";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
        if(!empty($limit)){
                $sql .= " limit " . $limit . " offset " . $offset;
        }
	return mysql_query($sql);
}
?>
