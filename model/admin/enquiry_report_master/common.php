<?php
function enquiry_report_daily_index($enquiry_report_master_id,$date){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " enquiry_report_daily";
	$sql .= " where";
	$sql .= " enquiry_report_master_id = " . $enquiry_report_master_id;
	$sql .= " and";
	$sql .= " date = '" . $date . "'";
	$result = mysql_query( $sql );
	$arr = mysql_fetch_array( $result );
	return( $arr['enquiries_num'] );
}
function enquiry_report_daily_create_data($enquiry_report_master_id,$date){
	$sql = "select * from enquiry_report_master where id = " . $enquiry_report_master_id;
	$result = mysql_query( $sql );
	$arr = mysql_fetch_array( $result );
	$states_id = $arr['states_id'];
	$groups_id = $arr['groups_id'];
	$property_type_groups_id = $arr['property_type_groups_id'];

	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings";
	$sql .= " where";
	$sql .= " status = 'current'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if( $states_id != 0 ){
		$sql .= " and";
		$sql .= " states_id = " . $states_id;
	}
	if( $groups_id != 0 ){
		$sql .= " and";
		$sql .= " groups_id = " . $groups_id;
	}
	if( $property_type_groups_id != 0 ){
		$sql_p = "select";
		$sql_p .= " *";
		$sql_p .= " from";
		$sql_p .= " property_types";
		$sql_p .= " where";
		$sql_p .= " property_type_groups_id = " . $property_type_groups_id;
		$sql_p .= " and";
		$sql_p .= " is_deleted = 0";
		$sql_p .= " order by sort";
		$result_p = mysql_query( $sql_p );
		$str = NULL;
		while( $arr_p = mysql_fetch_array( $result_p )){
			if(!empty($str)){
				$str .= " or ";
			}
			$str .= "property_types_id like '%" . $arr_p['id'] . "%'";
		}
		$sql .= " and";
		$sql .= "(" . $str . ")";
	}
	$sql .= " order by id";
	$result = mysql_query( $sql );

	if(mysql_num_rows($result)){
		$listings_id_arr = array();
		while( $arr = mysql_fetch_array( $result )){
			$listings_id_arr[] = $arr['id'];
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " listings_enquiries";
		$sql .= " where";
		$sql .= " listings_id in (" . implode(",",$listings_id_arr) . ")";
		$sql .= " and";
		$sql .= " status = 'chargable'";
		$sql .= " and";
		$sql .= " send_date like '%" . $date . "%'";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		$result = mysql_query( $sql );
		$enquiries_num = mysql_num_rows( $result );
	}
	//enquiry_report_dailyに既にレコードが存在するか確認
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " enquiry_report_daily";
	$sql .= " where";
	$sql .= " enquiry_report_master_id = " . $enquiry_report_master_id;
	$sql .= " and";
	$sql .= " date = '" . date("Y-m-d") . "'";
	$result = mysql_query( $sql );
	if(!mysql_num_rows($result)){
		$sql_ins = "insert into enquiry_report_daily (";
		$sql_ins .= " enquiry_report_master_id";
		$sql_ins .= ",date";
		$sql_ins .= ",enquiries_num";
		$sql_ins .= ")values(";
		$sql_ins .= $enquiry_report_master_id;
		$sql_ins .= ",'" . $date . "'";
		$sql_ins .= "," . $enquiries_num;
		$sql_ins .= ")";
		mysql_query( $sql_ins );
	}
	return;
}
function enquiry_report_master_create_data($states_id,$groups_id,$property_type_groups_id){
	//listings_numを取得
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings";
	$sql .= " where";
	$sql .= " status = 'current'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	if( $states_id != 0 ){
		$sql .= " and";
		$sql .= " states_id = " . $states_id;
	}
	if( $groups_id != 0 ){
		$sql .= " and";
		$sql .= " groups_id = " . $groups_id;
	}
	if( $property_type_groups_id != 0 ){
		$sql_p = "select";
		$sql_p .= " *";
		$sql_p .= " from";
		$sql_p .= " property_types";
		$sql_p .= " where";
		$sql_p .= " property_type_groups_id = " . $property_type_groups_id;
		$sql_p .= " and";
		$sql_p .= " is_deleted = 0";
		$sql_p .= " order by sort";
		$result_p = mysql_query( $sql_p );
		$str = NULL;
		while( $arr_p = mysql_fetch_array( $result_p )){
			if(!empty($str)){
				$str .= " or ";
			}
			$str .= "property_types_id like '%" . $arr_p['id'] . "%'";
		}
		$sql .= " and";
		$sql .= "(" . $str . ")";
	}
	$sql .= " order by id";
	$result = mysql_query( $sql );
	$listings_num = mysql_num_rows( $result );

	$enquiries_num = 0;
	if(!empty($listings_num)){
		$listings_id_arr = array();
		while( $arr = mysql_fetch_array( $result )){
			$listings_id_arr[] = $arr['id'];
		}
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " listings_enquiries";
		$sql .= " where";
		$sql .= " listings_id in (" . implode(",",$listings_id_arr) . ")";
		$sql .= " and";
		$sql .= " status = 'chargable'";
		$sql .= " and";
		$sql .= " (";
		$sql .= " send_date like '%" . date("Y-m") . "%'";
		$sql .= " and";
		$sql .= " send_date < '" . date("Y-m-d") . " 00:00:00'";
		$sql .= " )";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		$result = mysql_query( $sql );
		$enquiries_num = mysql_num_rows( $result );
	}
	$average_enquiries_num = 0;
	if( $listings_num > 0 && $enquiries_num > 0 ){
		$average_enquiries_num = $enquiries_num/$listings_num;
	}
	//enquiry_report_masterに既にレコードが存在するか確認
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " enquiry_report_master";
	$sql .= " where";
	$sql .= " states_id = " . $states_id;
	$sql .= " and";
	$sql .= " groups_id = " . $groups_id;
	$sql .= " and";
	$sql .= " property_type_groups_id = " . $property_type_groups_id;
	$result = mysql_query( $sql );
	if(!mysql_num_rows($result)){
		$sql_ins = "insert into enquiry_report_master (";
		$sql_ins .= " states_id";
		$sql_ins .= ",groups_id";
		$sql_ins .= ",property_type_groups_id";
		$sql_ins .= ",listings_num";
		$sql_ins .= ",enquiries_num";
		$sql_ins .= ",average_enquiries_num";
		$sql_ins .= ")values(";
		$sql_ins .= $states_id;
		$sql_ins .= "," . $groups_id;
		$sql_ins .= "," . $property_type_groups_id;
		$sql_ins .= "," . $listings_num;
		$sql_ins .= "," . $enquiries_num;
		$sql_ins .= "," . $average_enquiries_num;
		$sql_ins .= ")";
		mysql_query( $sql_ins );
	}else{
		$arr = mysql_fetch_array( $result );
		$sql_upd = "update enquiry_report_master set";
		$sql_upd .= " listings_num = " . $listings_num;
		$sql_upd .= ",enquiries_num = " . $enquiries_num;
		$sql_upd .= ",average_enquiries_num = " . $average_enquiries_num;
		$sql_upd .= " where";
		$sql_upd .= " id = " . $arr['id'];
		mysql_query( $sql_upd );
	}
	return;
}
function enquiry_report_master_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= ",t2.name as states_name";
	$sql .= ",t3.name as groups_name";
	$sql .= ",t4.name as property_type_groups_name";
	$sql .= " from";
	$sql .= " enquiry_report_master t1";
	$sql .= " left join";
	$sql .= " states t2";
	$sql .= " on";
	$sql .= " (t1.states_id = t2.id)";
	$sql .= " left join";
	$sql .= " groups t3";
	$sql .= " on";
	$sql .= " (t1.groups_id = t3.id)";
	$sql .= " left join";
	$sql .= " property_type_groups t4";
	$sql .= " on";
	$sql .= " (t1.property_type_groups_id = t4.id)";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	$sql .= " and";
	$sql .= " t1.listings_num > 0";
	if(!empty($_SESSION['enquiry_report_master']['states_id'])){
		$sql .= " and";
		$sql .= " t1.states_id = " . $_SESSION['enquiry_report_master']['states_id'];
	}
	$sql .= " order by t1.id";
	if(!empty($lines)){
		if(empty($_REQUEST['page'])){
			$offset = 0;
		}else{
			$offset = ($_REQUEST['page']-1) * $lines;
		}
		$sql .= " limit " . $lines . " offset " . $offset;
	}
	return mysql_query($sql);
}
?>
