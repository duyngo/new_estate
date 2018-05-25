<?php
function contacts_err_check( $column ){
	$err_msg = NULL;
	if( empty( $column) || $column == "name" ){
		if(empty($_POST['name'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Name is required.</p>";
			}else{
				$err_msg .= "<li>Name is required.</li>";
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
			}
		}
	}
	if( empty( $column) || $column == "content" ){
		if(empty($_POST['content'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Content is required.</p>";
			}else{
				$err_msg .= "<li>Content is required.</li>";
			}
		}
	}
	return $err_msg;
}
function contacts_send_mail_to_member($name,$email,$phone,$content){
        $subject = "Thank you for your contact | NewPropertyList.my";
        $body = "Dear Mr/Ms." . $name . ",\n";
        $body .= "\n";
        $body .= "Your contact was successfully sent about the following property.\n";
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
        common_send_mail($email,$subject,$body);
	return;
}
function contacts_send_mail_to_samurai($name,$email,$phone,$content){
	$to = "info@samurai-internet.com";
	//$to = "notohantou555@gmail.com";
        $subject = "Get contact of";
        $body .= "Name:" . $name . "\n";
        $body .= "E-mail:" . $email . "\n";
        $body .= "Phone:" . $phone . "\n";
	$body .= "Content:" . str_replace("<br />","\n",$content) . "\n";
	$body .= "\n";
        common_send_mail($to,$subject,$body);
	return;
}
?>
