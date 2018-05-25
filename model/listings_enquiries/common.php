<?php
function listings_enquiries_insert($listings_id,$members_id){
	$sql = "insert into listings_enquiries(";
	$sql .= " listings_id";
	$sql .= ",members_id";
	$sql .= ",name";
	$sql .= ",email";
	$sql .= ",phone";
	//$sql .= ",good_point";
	//$sql .= ",contact_type";
	$sql .= ",nationality";
	$sql .= ",message";
	//$sql .= ",signup_flag";
	//$sql .= ",password";
	$sql .= ",created";
	$sql .= ")values(";
	$sql .= " '" . $listings_id . "'";
	$sql .= ",'" . $members_id . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['email'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['phone'] ) . "'";
	//$sql .= ",'" . implode(",",$_POST['good_point']) . "'";
	//$sql .= ",'" . implode(",",$_POST['contact_type']) . "'";
	$sql .= ",'" . $_POST['nationality'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['remarks'] ) . "'";
	//$sql .= ",'" . $_POST['signup_flag'] . "'";
	//$sql .= ",'" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	$sql .= ",now()";
	$sql .= ")";
	common_exec_sql($sql);
	return;
}
function listings_enquiries_update_members_newsletter($members_id,$newsletter){
	//20160615 members.newsletterという項目を追加した事による処理追加
	$sql = "update members set";
	$sql .= " newsletter = '" . $_POST['newsletter'] . "'";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $members_id;
	common_exec_sql($sql);
	return;
}
function listings_enquiries_err_check( $column ){
	$err_msg = NULL;
	if( empty( $column) || $column == "name" ){
		if(empty($_POST['name'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Name is required.</p>";
			}else{
				$err_msg .= "<li>Name is required.</li>";
			}
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>Please Enter Name within 64 characters.</p>";
				}else{
					$err_msg .= "<li>Please Enter Name within 64 characters.</li>";
				}
			}
		}
	}
	if( empty( $column) || $column == "email" ){
		if(empty($_POST['email'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Email is required.</p>";
			}else{
				$err_msg .= "<li>Email is required.</li>";
			}
		}
		if(!empty($_POST['email'])){
			if(!preg_match("|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|", $_POST['email'])){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>The format of the e-mail address is wrong.</p>";
				}else{
					$err_msg .= "<li>The format of the e-mail address is wrong.</li>";
				}
			}
		}
		if(!empty($_POST['email'])){
			if(mb_strlen($_POST['email'],"UTF-8") > 128){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>Please Enter [email] within 128 characters.</p>";
				}else{
					$err_msg .= "<li>Please Enter [email] within 128 characters.</li>";
				}
			}else{
				if( $_POST['signup_flag'] == "on" ){
					$sql = "select";
					$sql .= " *";
					$sql .= " from";
					$sql .= " members";
					$sql .= " where";
					$sql .= " email = '" . mysql_real_escape_string($_POST['email']) . "'";
					$sql .= " and";
					$sql .= " is_deleted = 0";
					$result = mysql_query( $sql );
					if( mysql_num_rows( $result )){
						$err_msg .= "<p>This mail is already registered.</p>";
					}
				}
			}
		}
	}
	if( empty($column) || $column == "password" ){
		if(empty($_POST['password'])){
			if($_POST['signup_flag'] == "on" ){
				$err_msg .= "<p>Password is required.</p>";
			}
		}else{
			if(!preg_match("/^[a-zA-Z0-9]{8,15}+$/", $_POST['password'])){
       				$err_msg .= "<p>Please Enter [Password] in [a-zA-Z0-9]{8,15}</p>";
			}
		}
	}
	if( empty( $column) || $column == "phone" ){
		if(empty($_POST['phone'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Phone is required.</p>";
			}else{
				$err_msg .= "<li>Phone is required.</li>";
			}
		}
		if(!empty($_POST['phone'])){
			if(mb_strlen($_POST['phone'],"UTF-8") > 64){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>Please Enter [phone] within 64 characters.</p>";
				}else{
					$err_msg .= "<li>Please Enter [phone] within 64 characters.</li>";
				}
			}
		}
	}
/*
	if( empty( $column) || $column == "nationality" ){
		if(empty($_POST['nationality'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Nationality is required.</p>";
			}else{
				$err_msg .= "<li>Nationality is required.</li>";
			}
		}
	}
*/
	if(!empty($_POST['remarks'])){
		if(mb_strlen($_POST['remarks'],"UTF-8") > 200){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Please enter in 200 characters or less.</p>";
			}else{
				$err_msg .= "<li>Please enter in 200 characters or less.</li>";
			}
		}
	}
	if(empty($_POST['agree'])){
		if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
			$err_msg .= "<p>Please agree to our Terms of Conditions and Privacy Policy.</p>";
		}else{
			$err_msg .= "<li>Please agree to our Terms of Conditions and Privacy Policy.</li>";
		}
	}
	if($_POST['newsletter'] == "yes"){
		if($_POST['signup'] != "yes" && empty( $_SESSION['members_id'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>To sign up is needed for subscribing to recieve updates and newsletters.</p>";
			}else{
				$err_msg .= "<li>To sign up is needed for subscribing to recieve updates and newsletters.</li>";
			}
		}
	}
	return $err_msg;
}
function listings_enquiries_send_mail_to_member($to,$name,$listings_arr){
        $subject = "Thank you for your enquiry | NewPropertyList.my";
        $body = "Dear Mr/Ms." . $name . ",\n";
        $body .= "\n";
        $body .= "Your enquiry was successfully sent about the following property.\n";
        $body .= "\n";
	foreach( $listings_arr as $listings_id ){
	        $listings_code = common_get_value("listings","code",$listings_id,"");
	        $result = listings_detail( $listings_code );
	        $arr = mysql_fetch_array( $result );
	        $url = "http://newpropertylist.my/" . $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];
	        $body .= $arr['name'] . "\n";
	        $body .= $url . "\n";
	        $body .= "\n";
	}
        $body .= "\n";
        $body .= "The developer will respond to you soon.\n";
        $body .= "--------------------------------------------------------------------------------------------------\n";
        $body .= "NewPropertyList.my\n";
        $body .= "EMAIL : info@samurai-internet.com\n";
        $body .= "TEL : 011-3921 4968\n";
        $body .= "\n";
        $body .= "SAMURAI INTERNET SDN. BHD.      [1136750-D] [MSC Status Company]\n";
        $body .= "Block 3730, Persiaran APEC, 63000 Cyberjaya, Malaysia\n";
        $body .= "URL : www.samurai-internet.com\n";
        $body .= "--------------------------------------------------------------------------------------------------\n";
        common_send_mail($to,$subject,$body);
	return;
}
function listings_enquiries_send_mail_to_client($companies_id,$listings_name,$states_name,$locations_name,$url){
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
function listings_enquiries_send_mail_to_samurai($listings_arr){
	$to = "info@samurai-internet.com";
        $subject = "Enquiry Notification to Samurai Admin user";
        $body .= "http://newpropertylist.my/admin/listings_enquiries/\n";
        $body .= "\n";
        foreach( $listings_arr as $listings_id ){
                $listings_code = common_get_value("listings","code",$listings_id,"");
                $result = listings_detail( $listings_code );
                $arr = mysql_fetch_array( $result );
                $url = "http://newpropertylist.my/" . $arr['states_code'] . "/" . $arr['code'] . "-in-" . $arr['locations_code'];
                $body .= $arr['name'] . "\n";
                $body .= $url . "\n";
                $body .= "\n";
        }
        common_send_mail($to,$subject,$body);
	return;
}
?>
