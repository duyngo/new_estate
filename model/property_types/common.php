<?php
function property_types_index( $property_type_groups_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " property_types";
	$sql .= " where";
	$sql .= " is_deleted = 0";
	if( !empty($property_type_groups_id)){
		$sql .= " and";
		$sql .= " property_type_groups_id = $property_type_groups_id";
	}
	return mysql_query( $sql );
}
function property_types_get_property_type_groups_id( $property_types_id_arr ){
	$rtn = array();
	$sql = "select";
	$sql .= " distinct property_type_groups_id";
	$sql .= " from";
	$sql .= " property_types";
	$sql .= " where";
	$sql .= " id in (" . implode(",",$property_types_id_arr) . ")";
	$result = mysql_query( $sql );
	while( $arr = mysql_fetch_array( $result )){
		$rtn[] = $arr['property_type_groups_id'];
	}
	return $rtn;
}
?>
