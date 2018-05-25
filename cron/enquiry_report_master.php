<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/listings/original.php";
include "/home/newpropertylist.my/model/admin/enquiry_report_master/common.php";

mysql_mysql_connect();

$sql = "delete from enquiry_report_master";
mysql_query( $sql );

$states_id_arr = array();
$states_id_arr[] = "0";
$sql = "select";
$sql .= " *";
$sql .= " from";
$sql .= " states";
$sql .= " where";
$sql .= " is_deleted = 0";
$sql .= " order by sort";
$result = mysql_query( $sql );
while( $arr = mysql_fetch_array( $result )){
	$states_id_arr[] = $arr['id'];
}


$property_type_groups_id_arr = array();
$property_type_groups_id_arr[] = "0";
$sql = "select";
$sql .= " *";
$sql .= " from";
$sql .= " property_type_groups";
$sql .= " where";
$sql .= " is_deleted = 0";
$sql .= " order by sort";
$result = mysql_query( $sql );
while( $arr = mysql_fetch_array( $result )){
	$property_type_groups_id_arr[] = $arr['id'];
}


foreach( $states_id_arr as $states_id ){
	$groups_id = 0;
	$property_type_groups_id = 0;
	enquiry_report_master_create_data($states_id,$groups_id,$property_type_groups_id);
}
foreach( $states_id_arr as $states_id ){
	foreach( $property_type_groups_id_arr as $property_type_groups_id ){
		$groups_id = 0;
		enquiry_report_master_create_data($states_id,$groups_id,$property_type_groups_id);
	}
}
foreach( $states_id_arr as $states_id ){
	$groups_id_arr = array();
	$groups_id_arr[] = "0";
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " groups";
	$sql .= " where";
	$sql .= " states_id = " . $states_id;
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	$result = mysql_query( $sql );
	while( $arr = mysql_fetch_array( $result )){
		$groups_id_arr[] = $arr['id'];
	}
	foreach( $groups_id_arr as $groups_id ){
		$property_type_groups_id = 0;
		enquiry_report_master_create_data($states_id,$groups_id,$property_type_groups_id);
	}
}


foreach( $states_id_arr as $states_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " groups";
	$sql .= " where";
	$sql .= " states_id = " . $states_id;
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$sql .= " order by sort";
	$result = mysql_query( $sql );
	while( $arr = mysql_fetch_array( $result )){
		$groups_id = $arr['id'];
		foreach( $property_type_groups_id_arr as $property_type_groups_id ){
			enquiry_report_master_create_data($states_id,$groups_id,$property_type_groups_id);
		}
	}
}
exit;
?>
