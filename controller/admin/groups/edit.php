<?php
//ini_set( 'display_errors', 1 );
$table_name = "groups";
$table_name_j = "Area Group";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/groups/common.php";
include "../../../model/admin/groups/original.php";
include "../../../model/admin/groups/list.php";
include "../../../model/admin/states/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
	}else{
		$_SESSION[$table_name]{'status'} = "yet";
		if(!empty($_REQUEST['states_id'])){
			$_POST['states_id'] = $_REQUEST['states_id'];
		}
	}
}else if( $_POST['act'] == "conf" ){
	$err_msg = $err_check( NULL );
	if(!empty($err_msg)){
		$_POST['act'] = "err";
	}
}else if( $_POST['act'] == "edit" ){
	if(!empty($_POST['id'])){
		$update();
	}else{
		if( $_SESSION[$table_name]{'status'} == "yet" ){
			$_POST['id'] = $insert();
			$_SESSION[$table_name]{'status'} = NULL;
		}
	}
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>