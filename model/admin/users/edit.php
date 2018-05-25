<?php
function users_insert(){
        $sql = "insert into users(";
        $sql .= " name";
        $sql .= ",email";
        $sql .= ",password";
        $sql .= ",title";
        $sql .= ",first_name";
        $sql .= ",last_name";
        $sql .= ",created";
        $sql .= ",created_by";
        $sql .= ")values(";
        $sql .= " '" . mysql_real_escape_string($_POST['first_name']) . " " . mysql_real_escape_string($_POST['last_name']) . "'";
        $sql .= ",'" . mysql_real_escape_string($_POST['email']) . "'";
        $sql .= ",'" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
        $sql .= ",'" . $_POST['title'] . "'";
        $sql .= ",'" . mysql_real_escape_string($_POST['first_name']) . "'";
        $sql .= ",'" . mysql_real_escape_string($_POST['last_name']) . "'";
        $sql .= ",now()";
        $sql .= "," . $_SESSION['users_id'];
        $sql .= ")";
	common_exec_sql( $sql );
        return;
}
function users_update() {
        $sql = "update users set";
        $sql .= " name = '" . mysql_real_escape_string($_POST['first_name']) . " " . mysql_real_escape_string($_POST['last_name']) . "'";
        $sql .= ",email = '" . mysql_real_escape_string($_POST['email']) . "'";
	if(!empty($_POST['password'])){
		$sql .= ",password = '" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	}
        $sql .= ",title = '" . $_POST['title'] . "'";
        $sql .= ",first_name = '" . $_POST['first_name'] . "'";
        $sql .= ",last_name = '" . $_POST['last_name'] . "'";
        $sql .= ",modified = now()";
        $sql .= ",modified_by = " . $_SESSION['users_id'];
        $sql .= " where";
        $sql .= " id = " . $_POST['id'];
        common_exec_sql( $sql );
        return;
}
function users_err_check() {
	if(empty($_POST['email'])){
		$err_msg .= "Please enter Email.<br>";
	}else{
		if (!preg_match("|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|", $_POST['email'])) {
			$err_msg .= "Sorry,Invalid Email.<br>";
		}else{
			$sql = "select";
			$sql .= " *";
			$sql .= " from";
			$sql .= " users";
			$sql .= " where";
			$sql .= " email = '" . mysql_real_escape_string($_POST['email']) . "'";
			$sql .= " and";
			$sql .= " is_deleted = 0";
			if(!empty($_POST['id'])){
				$sql .= " and";
				$sql .= " id <> " . $_POST['id'];
			}
			$result = mysql_query( $sql );
			if(mysql_num_rows($result)){
				$err_msg .= "This Email Address is already registered";
			}
		}
	}
	if(empty($_POST['password'])){
		if(empty($_POST['id'])){
			$err_msg .= "Please enter Password.<br />";
		}
	}else{
		if (!preg_match("/^[a-zA-Z0-9]{8,15}$/", $_POST['password'])){
			$err_msg .= "Password must be 8-15 alphanumeric characters with these requirements 
- number (0-9) 
- lowercase letter (a-z) 
- uppercase letter (A-Z)<br>";
		}
		if(empty($_POST['password2'])){
			$err_msg .= "Please re-enter Password.<br />";
		}else{
			if( $_POST['password'] != $_POST['password2'] ){
				$err_msg .= "The initial password and the re-typed password do not match.<br />";
			}
		}
	}
        if(empty($_POST['title'])){
                $err_msg .= "Please choice Title.<br>";
        }
        if(empty($_POST['first_name'])){
                $err_msg .= "Please enter First name.<br>";
        }else{
                if (!preg_match("/^[A-Za-z]+$/", $_POST['first_name'])){
			$err_msg .= "Enter First name as per passport/IC in roman alphabets (A-Z,a-z) only.<br>";
		}
	}
        if(empty($_POST['last_name'])){
                $err_msg .= "Please enter Last name.<br>";
        }else{
                if (!preg_match("/^[A-Za-z]+$/", $_POST['last_name'])){
			$err_msg .= "Enter Last name as per passport/IC in roman alphabets (A-Z,a-z) only.<br>";
		}
	}
        return $err_msg;
}
?>
