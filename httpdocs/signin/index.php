<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR'] ."/model/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/common/list.php";
include $_SERVER['BASE_DIR'] ."/model/mysql/common.php";
include $_SERVER['BASE_DIR'] ."/model/companies/common.php";
include $_SERVER['BASE_DIR'] ."/model/favorites/common.php";
include $_SERVER['BASE_DIR'] ."/model/groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/listings/common.php";
include $_SERVER['BASE_DIR'] ."/model/members/common.php";
include $_SERVER['BASE_DIR'] ."/model/prices/common.php";
include $_SERVER['BASE_DIR'] ."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/states/common.php";

common_pc_sp();
session_start();
common_cookie_check();
mysql_mysql_connect();
$fav_num = favorites_num();

//処理後は遷移元画面に戻す為、遷移元画面をセッション登録
$_SESSION['HTTP_REFERER'] = "/";
if( strpos($_SERVER['HTTP_REFERER'],"signin")===false && strpos($_SERVER['HTTP_REFERER'],"signup")===false ){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
}
$h1 = "Malaysian property portal specializing in new property launched for sale";

$tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
	$page = $tmp_arr[1];
	$mode = $tmp_arr[2];
}else{
	$page = $tmp_arr[2];
	$mode = $tmp_arr[3];
}

if(empty($_POST['nationality'])){
	$_POST['nationality'] = "malaysian";
}
if(empty($mode)){
	$_SESSION['signup_status'] = "yet";
	if( $page == "signin" ){
		if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
			include $_SERVER['BASE_DIR'] ."/view/signin/index.php";
		}else{
			include $_SERVER['BASE_DIR'] ."/view/sp/signin/index.php";
		}
	}else{
		include $_SERVER['BASE_DIR'] ."/view/sp/signup/index.php";
	}
}else if( $mode == "signin" ){
	$err_msg = members_signin_err_check($_POST['signin_email'],$_POST['signin_password']);
	if(empty($err_msg)){
		header('Location:' . $_SESSION['HTTP_REFERER']);
		exit;
	}
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] ."/view/signin/index.php";
	}else{
		include $_SERVER['BASE_DIR'] ."/view/sp/signin/index.php";
	}

}else if( $mode == "signup" ){
	$err_msg = members_signup_err_check();
	if(empty($err_msg)){
		if( $_SESSION['signup_status'] == "yet" ){
			members_insert();
			members_signup_send_mail( $_POST['email'],$_POST['name'],$_POST['password'] );
			$err_msg = members_signin_err_check($_POST['email'],$_POST['password']);
			$_SESSION['signup_status'] = "done";
			header('Location:' . $_SESSION['HTTP_REFERER']);
			exit;
		}
	}
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] ."/view/signin/index.php";
	}else{
		include $_SERVER['BASE_DIR'] ."/view/sp/signup/index.php";
	}
}else if( $mode == "done" ){
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR'] ."/view/signin/done.php";
	}else{
		include $_SERVER['BASE_DIR'] ."/view/sp/signin/done.php";
	}
}
?>
