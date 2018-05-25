<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings";
$table_name_j = "Listing";

//関数の定義
$err_check = $table_name . "_err_check";
$update = $table_name . "_update";
$insert = $table_name . "_insert";

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/listings/original.php";
include "../../../model/admin/listings/list.php";
include "../../../model/admin/companies/common.php";
include "../../../model/admin/states/common.php";
include "../../../model/admin/groups/common.php";
include "../../../model/admin/locations/common.php";
include "../../../model/admin/property_types/common.php";
include "../../../model/admin/prices/common.php";
include "../../../model/admin/features/common.php";
include "../../../model/admin/completion_years/common.php";
include "../../../model/admin/bedrooms/common.php";
include "../../../model/admin/sizes/common.php";
include "../../../model/admin/sales_garellies/common.php";
include "../../../model/admin/tenures/common.php";

session_start();
admin_common_login_check();
mysql_mysql_connect();

if(empty($_POST['act'])){
	$_SESSION['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
	if(!empty($_REQUEST['tab'])){
		$_SESSION['HTTP_REFERER'] .= "&tab=" . $_REQUEST['tab'];
	}
	$_SESSION['listings']['locations_id'] = NULL;		//for ajax
	$_SESSION['listings']['image_path'] = NULL;
	$_SESSION['listings']['main_picture'] = NULL;
	if(!empty($_REQUEST['id'])){
		$_POST = common_get_value_all($table_name,$_REQUEST['id'],"");
		$_SESSION['listings']['locations_id'] = $_POST['locations_id'];		//for ajax
		$_SESSION['listings']['sales_garellies_id'] = $_POST['sales_garellies_id'];		//for ajax
		$_SESSION['listings']['image_path'] = $_POST['image_path'];
		$_SESSION['listings']['main_picture'] = $_POST['main_picture'];
	}else{
		$_SESSION[$table_name]{'edit_status'} = "yet";
		if(!empty($_REQUEST['companies_id'])){
			$_POST['companies_id'] = $_REQUEST['companies_id'];
		}
		if(!empty($_REQUEST['developer_id'])){
			$_POST['developer_id'] = $_REQUEST['developer_id'];
		}
		if(!empty($_REQUEST['billing_id'])){
			$_POST['billing_id'] = $_REQUEST['billing_id'];
		}
		if(!empty($_REQUEST['states_id'])){
			$_POST['states_id'] = $_REQUEST['states_id'];
		}
		if(!empty($_REQUEST['groups_id'])){
			$_POST['groups_id'] = $_REQUEST['groups_id'];
		}
		if(!empty($_REQUEST['locations_id'])){
			$_POST['locations_id'] = $_REQUEST['locations_id'];
		}
		if(!empty($_REQUEST['property_types_id'])){
			$_POST['property_types_id'] = $_REQUEST['property_types_id'];
		}
		if(!empty($_REQUEST['prices_id'])){
			$_POST['prices_id'] = $_REQUEST['prices_id'];
		}
		if(!empty($_REQUEST['features_id'])){
			$_POST['features_id'] = $_REQUEST['features_id'];
		}
	}
}else if( $_POST['act'] == "conf" ){
	$_SESSION['listings']['locations_id'] = $_POST['locations_id'];		//for ajax
	$_SESSION['listings']['sales_garellies_id'] = implode(",",$_POST['sales_garellies_id']);		//for ajax
	$err_msg = $err_check( NULL );
	if(!empty($err_msg)){
		$_POST['act'] = "err";
	}
}else if( $_POST['act'] == "edit" ){
	if(!empty($_POST['id'])){
		$update();
		listings_update_urls($_POST['id']);
		listings_update_achievement_rate($_POST['id'],$_POST['monthly_enquiry_limit']);
	}else{
		if( $_SESSION[$table_name]{'edit_status'} == "yet" ){
			$_POST['id'] = $insert();
			$_SESSION[$table_name]{'edit_status'} = NULL;
		}
	}
	listings_update_listings_num();
	$_SESSION['listings']['locations_id'] = NULL;		//for ajax
	$_SESSION['listings']['sales_garellies_id'] = NULL;		//for ajax
	$_SESSION['listings']['image_path'] = NULL;
	$_SESSION['listings']['main_picture'] = NULL;
	header('Location:' . $_SESSION['HTTP_REFERER']);
	exit;
}
?>
