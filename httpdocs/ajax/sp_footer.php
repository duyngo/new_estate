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


if( $_POST['mode'] == "init" ){
	$_SESSION['fav_num'] = favorites_num();
}else{
	$_SESSION['fav_num'] = favorites_num();
	if(strpos($_COOKIE['newpropertylist']['Favorites'],$_POST['listings_id'])===false){
		$_SESSION['fav_num']++;
	}else{
		$_SESSION['fav_num']--;
	}
}
if(!empty($_SESSION['fav_num'])){
?>
        <p><?php echo $_SESSION['fav_num'];?> Enquiry Collection</p><a href="/sp/enquiry/collection">
          <button>Send Enquiry</button></a>

<?php
}
?>
