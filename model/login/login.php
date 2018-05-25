<?php
function login_err_check(){
	if( empty($_POST['email']) || empty($_POST['password']) ){
		if(empty($_POST['email'])){
			$err_msg .= "メールアドレスを入力して下さい<br />";
		}
		if(empty($_POST['password'])){
			$err_msg .= "パスワードを入力して下さい<br />";
		}
	}else{
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " companies";
		$sql .= " where";
		$sql .= " email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
		$sql .= " and";
		$sql .= " auth_datetime <> '0000-00-00 00:00:00'";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		$result =  mysql_query( $sql );
		if( mysql_num_rows( $result ) == 0) {
			$err_msg .= "入力されたメールアドレスは登録されていません<br>";
		}else{
			$arr = mysql_fetch_array( $result );
			$password = hash('SHA256',$_POST['password'] . 'SecretKey');
			if( $password != $arr['password'] ){
				$err_msg .= "パスワードが間違えています<br>";
			}else{
				$_SESSION['companies_id'] = $arr['id'];
				$_SESSION['companies_code'] = $arr['code'];
				$_SESSION['companies_name'] = $arr['name'];

				//セッションを保持するがチェックされていたらクッキーを作成
				if( $_POST['save'] == "on" ) {
					setcookie("genba", "$arr[id],$arr[code],$arr[name],$_POST[email],$_POST[password],$_POST[save]",time() + 1825 * 24 * 60 * 60,"/");
				}else{
					setcookie("genba","","0");	  //クッキーの削除
				}
				header('Location:/login/');
				exit;
			}
		}
	}
	return $err_msg;
}
?>
