<?php
function account_err_check(){
	if(empty($_POST['family_name'])){
		$err_msg .= "「姓」を入力して下さい。<br />";
	}
	if(empty($_POST['first_name'])){
		$err_msg .= "「名」を入力して下さい。<br />";
	}
	if(empty($_POST['email'])){
		$err_msg .= "「メールアドレス」を入力して下さい。<br />";
	}
	if(!empty($_POST['password'])){
		if (!preg_match("/^[a-zA-Z0-9]{8,12}$/", $_POST['password'])){
			$err_msg .= "パスワードは8桁から12桁までの半角英数字のみで入力して下さい。（記号不可）<br>";
		}
		if(empty($_POST['password2'])){
			$err_msg .= "「パスワード（確認用）」を入力して下さい。<br />";
		}else{
			if( $_POST['password'] != $_POST['password2'] ){
				$err_msg .= "「パスワード」と「パスワード（確認用）」が一致していません。<br />";
			}
		}
	}
	return $err_msg;	
}
function account_update(){
	$sql = "update companies set";
	$sql .= " family_name = '" . mysql_real_escape_string( $_POST['family_name'] ) . "'";
	$sql .= ",first_name = '" . mysql_real_escape_string( $_POST['first_name'] ) . "'";
	$sql .= ",email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
	$sql .= ",mobile1 = '" . mysql_real_escape_string( $_POST['mobile1'] ) . "'";
	$sql .= ",mobile2 = '" . mysql_real_escape_string( $_POST['mobile2'] ) . "'";
	$sql .= ",mobile3 = '" . mysql_real_escape_string( $_POST['mobile3'] ) . "'";
	if(!empty($_POST['password'])){
		$sql .= ",password = '" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
	}
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $_SESSION['companies_id'];
	mysql_query( $sql );
	return;
}
?>
