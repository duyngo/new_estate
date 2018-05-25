<?php
function notification_index( $companies_id ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " contacts";
	$sql .= " where";
	$sql .= " companies_id = " . $companies_id;
	$sql .= " order by id";
	return mysql_query( $sql );
}
function notification_init(){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " contacts";
	$sql .= " where";
	$sql .= " companies_id = " . $_SESSION['companies_id'];
	$sql .= " order by id";
	$result = mysql_query( $sql );
	if( mysql_num_rows( $result ) > 0 ){
		$i = 0;
		while( $arr = mysql_fetch_array( $result ) ){
			$i++;
			$contact_id = "contact_id" . $i;
			$email = "email" . $i;
			$threads_table_name = "threads_table_name" . $i;
			$_POST[$contact_id] = $arr['id'];
			$_POST[$email] = $arr['email'];
			$_POST[$threads_table_name] = $arr['threads_table_name'];
		}
	}
	return $_POST;
}
function notification_err_check( $contact_num ){
	for($i=1;$i<=$contact_num;$i++){
		$email = "email" . $i;
		$threads_table_name = "threads_table_name" . $i;
		if(!empty($_POST[$email])){
			if(!preg_match("|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|", $_POST[$email])) {
				$err_msg .= "「E-mail " . $i . "」の形式が正しくありません。<br>";
			}
			if( $_POST[$email] == $_POST['email'] ){
				$err_msg .= "「メイン E-mail」と同一のメールアドレスは登録できません。<br>";
			}
			if(empty($_POST[$threads_table_name])){
				$err_msg .= "「E-mail " . $i . "」の受信タイプを選択して下さい。<br>";
			}
		}
	}
	return $err_msg;	
}
function notification_main( $contact_num ){

	$sql = "delete from contacts where companies_id = " . $_SESSION['companies_id'];
	common_exec_sql( $sql );

	for($i=1;$i<=$contact_num;$i++){

		$email = "email" . $i;
		$threads_table_name = "threads_table_name" . $i;
		if(!empty($_POST[$email])){
			$sql = "insert into contacts (";
			$sql .= " companies_id";
			$sql .= ",email";
			$sql .= ",threads_table_name";
			$sql .= ",created";
			$sql .= ")values(";
			$sql .= " " . $_SESSION['companies_id'];
			$sql .= ",'" . mysql_real_escape_string( $_POST[$email] ) . "'";
			$sql .= ",'" . implode(",",$_POST[$threads_table_name]) . "'";
			$sql .= ",now()";
			$sql .= ")";
			common_exec_sql( $sql );
		}

	}
	return;
}
function notification_delete( $id ){
	$sql = "delete from contacts where id = " . $id;
	common_exec_sql( $sql );
	return;
}
?>
