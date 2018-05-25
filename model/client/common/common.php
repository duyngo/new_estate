<?php
function client_common_login_check(){
	if(empty($_SESSION['external_users_id'])) {
		$tmp_arr = explode(".",$_SERVER['SERVER_NAME']);
		$cookie = $tmp_arr[0] . "_client";
                if(isset($_COOKIE[$cookie])){
                        $tmp_arr = explode(",",$_COOKIE[$cookie]);
                        $_SESSION['external_users_id'] = $tmp_arr[0];
                        $_SESSION['external_users_companies_id'] = $tmp_arr[1];
                        $_SESSION['external_users_name'] = $tmp_arr[5];
                }else{
			header("Location:/client/login/");
		}
		exit;
	}
	return;
}
function client_common_cookie_check(){
        if (empty($_SESSION['users_id'])) {
		$tmp_arr = explode(".",$_SERVER['SERVER_NAME']);
		$cookie = $tmp_arr[0] . "_client";
                if(isset($_COOKIE[$cookie])){
                        $tmp_arr = explode(",",$_COOKIE[$cookie]);
                        $_SESSION['external_users_id'] = $tmp_arr[0];
                        $_SESSION['external_users_companies_id'] = $tmp_arr[1];
                        $_SESSION['external_users_name'] = $tmp_arr[5];
                }
        }
        return;
}
?>
