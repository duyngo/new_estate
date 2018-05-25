<?php
session_start();
$tmp_arr = explode(".",$_SERVER['SERVER_NAME']);
$cookie = $tmp_arr[0] . "_client";
if (isset($_COOKIE[$cookie])) {
        setcookie($cookie,"","0","/");
}
//session_destroy();
$_SESSION['external_users_id'] = NULL;
$_SESSION['external_users_companies_id'] = NULL;
$_SESSION['external_users_name'] = NULL;
header("Location:/client/login/");
exit;
?>
