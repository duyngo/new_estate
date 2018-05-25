<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/companies/common.php";
include $_SERVER['BASE_DIR']."/model/contacts/common.php";
include $_SERVER['BASE_DIR']."/model/favorites/common.php";
include $_SERVER['BASE_DIR']."/model/groups/common.php";
include $_SERVER['BASE_DIR']."/model/listings/common.php";
include $_SERVER['BASE_DIR']."/model/prices/common.php";
include $_SERVER['BASE_DIR']."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR']."/model/states/common.php";

common_pc_sp();
session_start();
mysql_mysql_connect();
$fav_num = favorites_num();
$h1 = "Malaysian property portal specializing in new property launched for sale";

//URIのチェック及び値の設定
$tmp_arr = explode("/",$_SERVER['REQUEST_URI']);
if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
	$mode = $tmp_arr[2]; 
}else{
	$mode = $tmp_arr[3];
}
if(empty($mode)){
	if( $_POST['act'] == "contact" ){
		$err_msg = contacts_err_check();
		if(empty($err_msg)){
			contacts_send_mail_to_member($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['content']);
			contacts_send_mail_to_samurai($_POST['name'],$_POST['email'],$_POST['phone'],$_POST['content']);
			header('Location:/contact/completion');
			exit;
		}
	}
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR']."/view/contacts/index.php";
	}else{
		include $_SERVER['BASE_DIR']."/view/sp/contacts/index.php";
	}
}else if($mode == "completion"){
	if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
		include $_SERVER['BASE_DIR']."/view/contacts/completion.php";
	}else{
		include $_SERVER['BASE_DIR']."/view/sp/contacts/completion.php";
	}
}
?>
