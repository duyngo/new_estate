<?php
function reissue_err_check(){
	if( empty($_POST['tel']) || empty($_POST['email']) ){
		if(empty($_POST['tel'])){
			$err_msg .= "電話番号を入力して下さい<br />";
		}
		if(empty($_POST['email'])){
			$err_msg .= "メールアドレスを入力して下さい<br />";
		}
	}else{
		$sql = "select";
		$sql .= " *";
		$sql .= " from";
		$sql .= " companies";
		$sql .= " where";
		$sql .= " concat(tel1,tel2,tel3) = '" . mysql_real_escape_string( $_POST['tel'] ) . "'";
		$sql .= " and";
		$sql .= " email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
		$sql .= " and";
		$sql .= " is_deleted = 0";
		$result =  mysql_query( $sql );
		if( mysql_num_rows( $result ) == 0 ){
			$err_msg .= "電話番号とメールアドレスの組み合わせが正しくありません<br />";
		}
	}
	return $err_msg;
}
function reissue_update(){

        $reissue_code = hash('SHA256',$_POST['email'] . date("YmdHis"));
        $sql = "update companies set";
        $sql .= " reissue_code = '$reissue_code'";
        $sql .= ",reissue_limit = '" . date("Y-m-d H:i:s",strtotime("+30 minute")) . "'";
        $sql .= ",modified = now()";
        $sql .= " where";
        $sql .= " concat(tel1,tel2,tel3) = '" . mysql_real_escape_string( $_POST['tel'] ) . "'";
        $sql .= " and";
        $sql .= " email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
	common_exec_sql( $sql );
	return $reissue_code;
}
function reissue_send_mail( $reissue_code ){

	$arr = common_get_value_all("companies",$reissue_code,"reissue_code");

        $subject = "【現場の窓口】パスワード再設定用URL";
        $body = $arr['family_name'] . " " . $arr['first_name'] . "様\n";
        $body .= "\n";
        $body .= "いつもお世話になっております。\n";
        $body .= "「現場の窓口」運営事務局でございます。\n";
        $body .= "\n";
        $body .= "平素は「現場の窓口」をご利用頂き誠にありがとうございます。\n";
        $body .= "以下のURLからパスワードの再設定を行って下さい。\n";
        $body .= "\n";
        $body .= "http://" . $_SERVER['SERVER_NAME'] . ":8080/login/reset.php?reissue_code=" . $reissue_code . "\n";
        $body .= "\n";
        $body .= "以上宜しくお願いいたします。\n";
        $body .= "\n";
        $body .= "===========================================================\n";
        $body .= "===========================================================\n";
        $body .= "「現場の窓口」運営事務局\n";
        $body .= "E-mail info@genba.com\n";
        $body .= "URL http:///\n";
        $body .= "\n";
        $body .= "===========================================================\n";
        $body .= "===========================================================\n";

        common_send_mail($_POST['email'],$subject,$body,"info@genba.com");
        return;
}
?>
