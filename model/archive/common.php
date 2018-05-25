<?php
function archive_index($states_id,$limit,$offset){
	$sql = "select";
	$sql .= " t1.*";
        $sql .= ",t2.name as developer_name";
        $sql .= ",t2.logo_image_path";
	$sql .= ",t3.name as states_name";
	$sql .= ",t3.code as states_code";
	$sql .= ",t4.name as groups_name";
	$sql .= ",t4.code as groups_code";
	$sql .= ",t5.name as locations_name";
	$sql .= ",t5.code as locations_code";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.developer_id = t2.id )";
	$sql .= " left join";
	$sql .= " states t3";
	$sql .= " on";
	$sql .= " ( t1.states_id = t3.id )";
	$sql .= " left join";
	$sql .= " groups t4";
	$sql .= " on";
	$sql .= " ( t1.groups_id = t4.id )";
	$sql .= " left join";
	$sql .= " locations t5";
	$sql .= " on";
	$sql .= " ( t1.locations_id = t5.id )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	$sql .= " and";
	$sql .= " t1.status = 'archived'";
	if(!empty($states_id)){
		$sql .= " and";
		$sql .= " t1.states_id = " . $states_id;
	}
	$sql .= " order by t1.search_rank desc,t1.modified desc";
	if(!empty($limit)){
		$sql .= " limit " . $limit . " offset " . $offset;
	}
	return mysql_query($sql);
}
?>
