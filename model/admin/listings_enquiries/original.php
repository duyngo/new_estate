<?php
function listings_enquiries_report_get_parent_id( $arr ){
	if( $arr['companies_id_parent_id_class'] == "agency" ){
		$id = $arr['developer_id_parent_id_id'];
	}else{
		$id = $arr['companies_id_parent_id_id'];
	}
	return $id;
}
function listings_enquiries_report_get_parent_rank( $arr ){
	if( $arr['companies_id_parent_id_class'] == "agency" ){
		$rank = $arr['developer_id_parent_id_rank'];
	}else{
		$rank = $arr['companies_id_parent_id_rank'];
	}
	return $rank;
}
function listings_enquiries_report_get_parent_name( $arr ){
	if( $arr['companies_id_parent_id_class'] == "agency" ){
		$name = $arr['developer_id_parent_id_name'];
	}else{
		$name = $arr['companies_id_parent_id_name'];
	}
	return $name;
}
function listings_enquiries_report_index( $lines ){
        $sql = "select";
        $sql .= " t1.*";
        $sql .= ",t2.name as states_name";
        $sql .= ",t4.id as companies_id_parent_id_id";
        $sql .= ",t4.name as companies_id_parent_id_name";
        $sql .= ",t4.rank as companies_id_parent_id_rank";
        $sql .= ",t4.class as companies_id_parent_id_class";
        $sql .= ",t6.id as developer_id_parent_id_id";
        $sql .= ",t6.name as developer_id_parent_id_name";
        $sql .= ",t6.rank as developer_id_parent_id_rank";
        $sql .= ",t6.class as developer_id_parent_id_class";
        $sql .= ",t7.name as groups_name";
        $sql .= " from";
        $sql .= " listings t1";
        $sql .= " left join";
        $sql .= " states t2";
        $sql .= " on";
        $sql .= " ( t1.states_id = t2.id )";
        $sql .= " left join";
        $sql .= " companies t3";
        $sql .= " on";
        $sql .= " ( t1.companies_id = t3.id )";
        $sql .= " left join";
        $sql .= " companies t4";
        $sql .= " on";
        $sql .= " ( t3.parent_id = t4.id )";
        $sql .= " left join";
        $sql .= " companies t5";
        $sql .= " on";
        $sql .= " ( t1.developer_id = t5.id )";
        $sql .= " left join";
        $sql .= " companies t6";
        $sql .= " on";
        $sql .= " ( t5.parent_id = t6.id )";
        $sql .= " left join";
        $sql .= " groups t7";
        $sql .= " on";
        $sql .= " ( t1.groups_id = t7.id )";
        $sql .= " where";
        $sql .= " t1.status in ('current','archived')";
        $sql .= " and";
        $sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['listings_enquiries_report']['rank'])){
		$sql .= " and";
		$sql .= " (";
		$sql .= " t4.rank = '" . $_SESSION['listings_enquiries_report']['rank'] . "'";
		$sql .= " or";
		$sql .= " t6.rank = '" . $_SESSION['listings_enquiries_report']['rank'] . "'";
		$sql .= " )";
	}
	if(!empty( $_SESSION['listings_enquiries_report']['parent_company'])){
		$sql .= " and";
		$sql .= " (";
		$sql .= " t4.name like '%" . $_SESSION['listings_enquiries_report']['parent_company'] . "%'";
		$sql .= " or";
		$sql .= " t6.name like '%" . $_SESSION['listings_enquiries_report']['parent_company'] . "%'";
		$sql .= " )";
	}
	if(!empty( $_SESSION['listings_enquiries_report']['evernote_id'])){
		$sql .= " and";
		$sql .= " t1.evernote_id like '%" . mysql_real_escape_string($_SESSION['listings_enquiries_report']['evernote_id']) . "%'";
	}
	if(!empty( $_SESSION['listings_enquiries_report']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['listings_enquiries_report']['name']) . "%'";
	}
	if(!empty( $_SESSION['listings_enquiries_report']['status'])){
		$sql .= " and";
		$sql .= " t1.status = '" . $_SESSION['listings_enquiries_report']['status'] . "'";
	}
	if(!empty( $_SESSION['listings_enquiries_report']['states_id'])){
		$sql .= " and";
		$sql .= " t1.states_id = '" . $_SESSION['listings_enquiries_report']['states_id'] . "'";
	}
	if(!empty( $_SESSION['listings_enquiries_report']['groups_id'])){
		$sql .= " and";
		$sql .= " t1.groups_id = '" . $_SESSION['listings_enquiries_report']['groups_id'] . "'";
	}
	if( $_SESSION['listings_enquiries_report']['monthly_enquiry_num'] != "" ){
		$sql .= " and";
		$sql .= " t1.monthly_enquiry_num <= '" . $_SESSION['listings_enquiries_report']['monthly_enquiry_num'] . "'";
	}
	if(!empty( $_SESSION['listings_enquiries_report']['charge_type'])){
		$sql .= " and";
		$sql .= " t1.charge_type = '" . $_SESSION['listings_enquiries_report']['charge_type'] . "'";
	}
        $sql .= " order by t1.evernote_id";
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
function listings_enquiries_update_achievement_rate($listings_id){
	$monthly_enquiry_limit = common_get_value_2("listings","monthly_enquiry_limit",$listings_id,"");
	$monthly_enquiry_num = listings_enquiries_get_send_num($listings_id);
	$achievement_rate = floor(($monthly_enquiry_num/$monthly_enquiry_limit)*100);
	$sql = "update listings set";
	$sql .= " monthly_enquiry_num = " . $monthly_enquiry_num;
	$sql .= ",achievement_rate = " . $achievement_rate;
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $listings_id;
	common_exec_sql($sql);
	return;
}
function listings_enquiries_get_num_of_times($listings_id,$email,$phone,$created){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings_enquiries";
	$sql .= " where";
	$sql .= " listings_id = " . $listings_id;
	$sql .= " and";
	$sql .= " (";
	$sql .= " email = '$email'";
	$sql .= " or";
	$sql .= " phone = '$phone'";
	$sql .= " or";
	$sql .= " phone = '" . str_replace("-","",$phone) . "'";
	$sql .= " )";
	$sql .= " and";
	$sql .= " created <= '" . $created . "'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result = mysql_query( $sql );
	return mysql_num_rows($result);
}
function listings_enquiries_get_send_num($listings_id,$date){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " listings_enquiries";
	$sql .= " where";
	$sql .= " listings_id = " . $listings_id;
	$sql .= " and";
	$sql .= " status = 'chargable'";
	$sql .= " and";
	if(!empty($date)){
		$sql .= " send_date like '%" . $date . "%'";
	}else{
		$sql .= " send_date <> '0000-00-00 00:00:00'";
	}
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result = mysql_query( $sql );
	return mysql_num_rows($result);
}
function listings_enquiries_update_status($id,$status){
	$sql = "update listings_enquiries set";
	$sql .= " status = '" . $status . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_enquiries_update_send_date($id){
	$sql = "update listings_enquiries set";
	$sql .= " status = 'chargable'";
	$sql .= ",send_date = now()";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function listings_enquiries_send_mail_to_client($listings_id){
        $listings_code = common_get_value("listings","code",$listings_id,"");
        $result = listings_enquiries_listings_detail( $listings_code );
        $arr = mysql_fetch_array( $result );
	$companies_id = $arr['companies_id'];
	$listings_name = $arr['name'];
	$states_name = $arr['states_name'];
	$locations_name = $arr['locations_name'];
        $url = "http://newpropertylist.my/" . $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];

        $sql = "select";
        $sql .= " *";
        $sql .= " from";
        $sql .= " external_users";
        $sql .= " where";
        $sql .= " (";
        $sql .= " companies_id = " . $companies_id;
        $sql .= " or";
        $sql .= " published_range_of_inquiry like '%" . $companies_id . "%'";
        $sql .= " )";
        $sql .= " and";
        $sql .= " is_deleted = 0";
        $result = mysql_query( $sql );
        while( $arr = mysql_fetch_array( $result )){
                $subject = "Enquiry Notification from NewPropertyList.my";
                $body = "Dear," .  $GLOBALS['external_users_title_list'][$arr['title']] . $arr['first_name'] . "\n\n";
                $body .= "The following property has got enquiry just now.\n";
                $body .= $listings_name . "\n";
                $body .= $states_name . "," . $locations_name . "\n";
                $body .= $url . "\n";
                $body .= "\n";
                $body .= "\n";
                $body .= "You can check the user's profile through this page below.\n";
                $body .= "http://newpropertylist.my/client/listings_enquiries/\n";
                $body .= "\n";
                $body .= "Thank you.\n";
                $body .= "\n";
                $body .= "Best regards,\n";
                $body .= "\n";
                $body .= "--------------------------------------------------------------------------------------------------\n";
                $body .= "NewPropertyList.my\n";
                $body .= "\n";
                $body .= "EMAIL : info@samurai-internet.com\n";
                $body .= "TEL : 011-3921 4968\n";
                $body .= "\n";
                $body .= "SAMURAI INTERNET SDN. BHD.      [1136750-D] [MSC Status Company]\n";
                $body .= "Block 3730, Persiaran APEC, 63000 Cyberjaya, Malaysia\n";
                $body .= "URL : www.samurai-internet.com\n";
                $body .= "--------------------------------------------------------------------------------------------------\n";
                common_send_mail($arr['email'],$subject,$body);
        }
        return;
}
function listings_enquiries_listings_detail( $listings_code ){
        $sql = "select";
        $sql .= " t1.*";
        $sql .= ",t2.parent_id";
        $sql .= ",t2.name as developer_name";
        $sql .= ",t2.address as developer_address";
        $sql .= ",t2.logo_image_path as developer_logo_image_path";
        $sql .= ",t2.body_1 as developer_body_1";
        $sql .= ",t2.body_2 as developer_body_2";
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
        $sql .= " t1.code = '$listings_code'";
        $sql .= " and";
        $sql .= " t1.is_deleted = 0";
        return mysql_query($sql);
}
function listings_enquiries_send_date_index(){
        $sql = "select";
        $sql .= " distinct substr(send_date,1,7) as send_date";
        $sql .= " from";
        $sql .= " listings_enquiries";
        $sql .= " where";
        $sql .= " send_date <> '0000-00-00 00:00:00'";
        $sql .= " and";
        $sql .= " is_deleted = 0";
        return mysql_query($sql);
}
?>
