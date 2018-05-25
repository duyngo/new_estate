<?php
function members_insert(){
	$sql = "insert into members(";
	$sql .= " name";
	$sql .= ",email";
	$sql .= ",password";
	$sql .= ",phone";
	$sql .= ",nationality";
	$sql .= ",newsletter";
	$sql .= ",created";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['email'] ) . "'";
	$sql .= ",'" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['phone'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['nationality'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['newsletter'] ) . "'";
	$sql .= ",now()";
	$sql .= ")";
	common_exec_sql($sql);
	$members_id = common_get_max("members");
	return $members_id;
}
function members_signin_err_check($email,$password){
	if(empty($email)){
		if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
			$err_msg .= "<p>Incorrect Email and Password combination</p>";
		}else{
			$err_msg .= "<li class=\"Red\">Incorrect Email and Password combination</li>";
		}
	}else{
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " members";
	$sql .= " where";
	$sql .= " email = '" . mysql_real_escape_string( $email ) . "'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result =  mysql_query( $sql );
	if( mysql_num_rows( $result ) == 0) {
		if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
			$err_msg .= "<p>Incorrect Email and Password combination</p>";
		}else{
			$err_msg .= "<li class=\"Red\">Incorrect Email and Password combination</li>";
		}
	}else{
		$arr = mysql_fetch_array( $result );
		$password = hash('SHA256',$password . 'SecretKey');
		if( $password != $arr['password'] ){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Incorrect Email and Password combination</p>";
			}else{
				$err_msg .= "<li class=\"Red\">Incorrect Email and Password combination</li>";
			}
		}else{
			$_SESSION['members_id'] = $arr['id'];
			$_SESSION['members_name'] = $arr['name'];
			$_SESSION['members_email'] = $arr['email'];
			$_SESSION['members_phone'] = $arr['phone'];
			$_SESSION['members_nationality'] = $arr['nationality'];
			$_SESSION['members_newsletter'] = $arr['newsletter'];
			setcookie("newpropertylist[members_id]","$arr[id]",time() + 1825 * 24 * 60 * 60,"/" );
			setcookie("newpropertylist[members_name]","$arr[name]",time() + 1825 * 24 * 60 * 60,"/" );

                        //Copy Cookie Data to DB
                        $favorites = NULL;
                        $favorites = $arr['favorites'];
                        if(!empty($_COOKIE['newpropertylist']['Favorites'])){
                                if(!empty($favorites)){
                                        $favorites .= ",";
                                }
                                $favorites .= $_COOKIE['newpropertylist']['Favorites'];
                        }
                        $tmp_arr = explode(",",$favorites);
			$favorites = implode(",",array_unique ($tmp_arr));

			setcookie("newpropertylist[Favorites]","$favorites",time() + 1825 * 24 * 60 * 60,"/" );

                        $sql = "update members set";
                        $sql .= " recent_searches = '" . $_COOKIE['newpropertylist']['RecentSearches'] . "'";
                        $sql .= ",favorites = '" . $favorites . "'";
                        $sql .= ",modified = now()";
                        $sql .= " where";
                        $sql .= " id = " . $arr['id'];
                        common_exec_sql( $sql );
		}
	}
	}
	return $err_msg;
}
function members_signup_err_check( $column ){
	$err_msg = NULL;
	if( empty( $column) || $column == "name" ){
		if(empty($_POST['name'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Name is required.</p>";
			}else{
				$err_msg .= "<li class=\"Red\">Name is required.</li>";
			}
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>Please Enter Name within 64 characters.</p>";
				}else{
					$err_msg .= "<li class=\"Red\">Please Enter Name within 64 characters.</li>";
				}
			}
		}
	}
	if( empty( $column) || $column == "email" ){
		if(empty($_POST['email'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Email is required.</p>";
			}else{
				$err_msg .= "<li class=\"Red\">Email is required.</li>";
			}
		}
		if(!empty($_POST['email'])){
			if(!preg_match("|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|", $_POST['email'])){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>The format of the e-mail address is wrong.</p>";
				}else{
					$err_msg .= "<li class=\"Red\">The format of the e-mail address is wrong.</li>";
				}
			}
		}
		if(!empty($_POST['email'])){
			if(mb_strlen($_POST['email'],"UTF-8") > 128){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>Please Enter [email] within 128 characters.</p>";
				}else{
					$err_msg .= "<li class=\"Red\">Please Enter [email] within 128 characters.</li>";
				}
			}
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
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>This email is already registered.</p>";
				}else{
					$err_msg .= "<li class=\"Red\">This email is already registered.</li>";
				}
			}
		}
	}
	if( empty( $column) || $column == "password" ){
		if(empty($_POST['password'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Password is required.</p>";
			}else{
				$err_msg .= "<li class=\"Red\">Password is required.</li>";
			}
		}else{
			if(!preg_match("/^[a-zA-Z0-9]{8,15}+$/", $_POST['password'])){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
       					$err_msg .= "<p>Please Enter [Password] in [a-zA-Z0-9]{8,15}</p>";
				}else{
					$err_msg .= "<li class=\"Red\">Please Enter [Password] in [a-zA-Z0-9]{8,15}</li>";
				}
			}
		}
	}
	if( empty( $column) || $column == "phone" ){
		if(empty($_POST['phone'])){
			if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
				$err_msg .= "<p>Phone is required.</p>";
			}else{
				$err_msg .= "<li class=\"Red\">Phone is required.</li>";
			}
		}
		if(!empty($_POST['phone'])){
			if(mb_strlen($_POST['phone'],"UTF-8") > 64){
				if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
					$err_msg .= "<p>Please Enter [phone] within 64 characters.</p>";
				}else{
					$err_msg .= "<li class=\"Red\">Please Enter [phone] within 64 characters.</li>";
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
				$err_msg .= "<li class=\"Red\">Nationality is required.</li>";
			}
		}
	}
*/
        if(empty($_POST['agree'])){
                if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
                        $err_msg .= "<p>Please agree to our Terms of Conditions and Privacy Policy.</p>";
                }else{
                        $err_msg .= "<li class=\"Red\">Please agree to our Terms of Conditions and Privacy Policy.</li>";
                }
        }
	return $err_msg;
}
function members_signup_send_mail( $to,$name,$password ){
	$subject = "Thank you for your registering with NewPropertyList.my. ";
	$body = "Dear Mr/Ms." . $name . ",\n";
	$body .= "\n";
	$body .= "Your NewPropertyList.my account has been activated.\n";
	$body .= "Your account is this email address and password is [" . $password . "].\n";
	$body .= "Please kindly visit newpropertylist.my and start finding your favourite new home in Malaysia.\n";
	$body .= "\n";
	$body .= "Warm regards,\n";
	$body .= "---\n";
	$body .= "NewPropertyList.my\n";
	$body .= "The best way to find a new home in Malaysia.\n";
	$body .= "If anything, could you please contact us via email (newpropertylist@samurai-internet.com)\n";
	$body .= "---\n";
	common_send_mail($to,$subject,$body);
	return;
}
?>
