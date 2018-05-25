<?php
session_start();
$tmp_arr = explode(".",$_SERVER['SERVER_NAME']);
$cookie = $tmp_arr[0] . "_admin";
if (isset($_COOKIE[$cookie])) {
        setcookie($cookie,"","0","/");
}
//session_destroy();
$_SESSION['users_id'] = NULL;
$_SESSION['users_name'] = NULL;
header("Location:/admin/login/");
exit;
?>
