<?php
function reset_reissue_code_check( $reissue_code ){
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " companies";
	$sql .= " where";
	$sql .= " reissue_code = '$reissue_code'";
	$sql .= " and";
	$sql .= " reissue_limit > now()";
	$result = mysql_query( $sql );
	if( mysql_num_rows( $result ) == 0 ){
		$err_msg .= "URLが不正です<br />";
	}
	return $err_msg;
}
function reset_err_check(){
        if(empty($_POST['password'])){
                $err_msg .= "「パスワード」を入力して下さい<br />";
        }else{
                if (!preg_match("/^[a-zA-Z0-9]{8,12}$/", $_POST['password'])){
                        $err_msg .= "パスワードは8桁から12桁までの半角英数字のみで入力して下さい。（記号不可）<br>";
                }
        }
        if(empty($_POST['password2'])){
                $err_msg .= "「パスワード（確認用）」を入力して下さい<br />";
        }else{
                if( $_POST['password'] != $_POST['password2'] ){
                        $err_msg .= "「パスワード」と「パスワード（確認用）」が一致しません<br />";
                }
        }
	return $err_msg;
}
function reset_update(){

        $sql = "update companies set";
        $sql .= " password = '" . hash('SHA256',$_POST['password'] . 'SecretKey') . "'";
        $sql .= ",reissue_code = ''";
        $sql .= ",reissue_limit = '0000-00-00 00:00:00'";
        $sql .= ",modified = now()";
        $sql .= " where";
        $sql .= " reissue_code = '" . $_SESSION['reissue_code'] . "'";
	common_exec_sql( $sql );
	return $reissue_code;
}
?>
