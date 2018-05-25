<?php
//ini_set( 'display_errors', 1 );
//ファイルインクルード
include $_SERVER['BASE_DIR'] ."/model/common/common.php";
include $_SERVER['BASE_DIR'] ."/model/common/list.php";
include $_SERVER['BASE_DIR'] ."/model/mysql/common.php";
include $_SERVER['BASE_DIR'] ."/model/bedrooms/common.php";
include $_SERVER['BASE_DIR'] ."/model/companies/common.php";
include $_SERVER['BASE_DIR'] ."/model/completion_years/common.php";
include $_SERVER['BASE_DIR'] ."/model/favorites/common.php";
include $_SERVER['BASE_DIR'] ."/model/features/common.php";
include $_SERVER['BASE_DIR'] ."/model/groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/listings/common.php";
include $_SERVER['BASE_DIR'] ."/model/listings_project_details/common.php";
include $_SERVER['BASE_DIR'] ."/model/locations/common.php";
include $_SERVER['BASE_DIR'] ."/model/prices/common.php";
include $_SERVER['BASE_DIR'] ."/model/property_type_groups/common.php";
include $_SERVER['BASE_DIR'] ."/model/property_types/common.php";
include $_SERVER['BASE_DIR'] ."/model/sizes/common.php";
include $_SERVER['BASE_DIR'] ."/model/states/common.php";

common_pc_sp();
session_start();
common_cookie_check();
mysql_mysql_connect();
$fav_num = favorites_num();
$result = states_index("","");
if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){
        include $_SERVER['BASE_DIR']."/view/areas/index.php";
}else{
        include $_SERVER['BASE_DIR']."/view/sp/areas/index.php";
}
?>
