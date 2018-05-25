<?php
function companies_index( $pickup_flag ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " companies t1";
	$sql .= " where";
	$sql .= " t1.class like '%developer%'";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty($pickup_flag)){
		$sql .= " and";
		$sql .= " t1.pickup_flag = '" . $pickup_flag . "'";
	}
	$sql .= " order by modified desc";
	$sql .= " limit 8";
	return mysql_query($sql);
}
function companies_developer_index( $initials,$limit,$offset ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " companies";
	$sql .= " where";
	$sql .= " class like '%developer%'";
	$sql .= " and";
	$sql .= " developers_list_display_flag = 'on'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if(!empty($initials)){
		$sql .= " and";
		$sql .= " code like '" . $initials . "%'";
	}
	$sql .= " order by modified desc";
        if(!empty($limit)){
                $sql .= " limit " . $limit . " offset " . $offset;
        }
	return mysql_query($sql);
}
function companies_initials_index(){
	$sql = "select";
	$sql .= " distinct SUBSTRING(code,1,1) as code";
	$sql .= " from";
	$sql .= " companies";
	$sql .= " where";
	$sql .= " class like '%developer%'";
	$sql .= " and";
	$sql .= " developers_list_display_flag = 'on'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$sql .= " order by code";
	return mysql_query($sql);
}
?>
