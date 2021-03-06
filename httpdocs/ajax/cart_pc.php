<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR']."/model/common/common.php";
include $_SERVER['BASE_DIR']."/model/common/list.php";
include $_SERVER['BASE_DIR']."/model/mysql/common.php";
include $_SERVER['BASE_DIR']."/model/bedrooms/common.php";
include $_SERVER['BASE_DIR']."/model/companies/common.php";
include $_SERVER['BASE_DIR']."/model/completion_years/common.php";
include $_SERVER['BASE_DIR']."/model/favorites/common.php";
include $_SERVER['BASE_DIR']."/model/groups/common.php";
include $_SERVER['BASE_DIR']."/model/listings/common.php";
include $_SERVER['BASE_DIR']."/model/listings_call_clicks/common.php";
include $_SERVER['BASE_DIR']."/model/listings_project_details/common.php";
include $_SERVER['BASE_DIR']."/model/locations/common.php";
include $_SERVER['BASE_DIR']."/model/prices/common.php";
include $_SERVER['BASE_DIR']."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR']."/model/property_types/common.php";
include $_SERVER['BASE_DIR']."/model/sizes/common.php";
include $_SERVER['BASE_DIR']."/model/states/common.php";

session_start();
common_cookie_check();
mysql_mysql_connect();

$_SESSION['fav_num'] = favorites_num();

if( $_POST['mode'] == "cart" ){
	if(strpos($_COOKIE['newpropertylist']['Favorites'],$_POST['listings_id'])===false){
		$_SESSION['fav_num']++;
		echo $_SESSION['fav_num'];
	}else{
		$_SESSION['fav_num']--;
		echo $_SESSION['fav_num'];
	}
}else if( $_POST['mode'] == "init" ){
	if(strpos($_COOKIE['newpropertylist']['Favorites'],$_POST['listings_id'])===false){
		echo "<div class=\"button\" onclick=\"ajax_" . $_POST['listings_id'] . "(" . $_POST['listings_id'] . ")\"><a href=\"javascript:void(0);\">Add Enquiry collection</a></div>";
	}else{
		echo "<div class=\"button02\" onclick=\"ajax_" . $_POST['listings_id'] . "(" . $_POST['listings_id'] . ")\"><a href=\"javascript:void(0);\">Added to collection</a></div>";
	}
}else{
	if(strpos($_COOKIE['newpropertylist']['Favorites'],$_POST['listings_id'])===false){
		favorites_add( $_POST['listings_id'] );
		echo "<div class=\"button02\" onclick=\"ajax_" . $_POST['listings_id'] . "(" . $_POST['listings_id'] . ")\"><a href=\"javascript:void(0);\">Added to collection</a></div>";
	}else{
		favorites_delete( $_POST['listings_id'] );
		echo "<div class=\"button\" onclick=\"ajax_" . $_POST['listings_id'] . "(" . $_POST['listings_id'] . ")\"><a href=\"javascript:void(0);\">Add Enquiry collection</a></div>";
	}
}
?>
