<?php
//ini_set( 'display_errors', 1 );
$table_name = "listings_enquiries";
$table_name_j = "Enquiries";

//関数の定義
$index = $table_name . "_index";
$delete = $table_name . "_delete";

//1ページあたりの表示件数
$lines = 0;

//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/companies/list.php";
include "../../../model/admin/listings/original.php";
include "../../../model/admin/listings/list.php";
include "../../../model/admin/listings_enquiries/common.php";
include "../../../model/admin/listings_enquiries/original.php";
include "../../../model/admin/listings_enquiries/list.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/states/common.php";
include "../../../model/admin/groups/common.php";

session_start();

admin_common_login_check();
mysql_mysql_connect();

if( $_POST['act'] == "search" ){
	$_SESSION['listings_enquiries_report']['rank'] = $_POST['rank'];
	$_SESSION['listings_enquiries_report']['parent_company'] = $_POST['parent_company'];
	$_SESSION['listings_enquiries_report']['evernote_id'] = $_POST['evernote_id'];
	$_SESSION['listings_enquiries_report']['name'] = $_POST['name'];
	$_SESSION['listings_enquiries_report']['status'] = $_POST['status'];
	$_SESSION['listings_enquiries_report']['states_id'] = $_POST['states_id'];
	$_SESSION['listings_enquiries_report']['groups_id'] = $_POST['groups_id'];
	$_SESSION['listings_enquiries_report']['monthly_enquiry_num'] = $_POST['monthly_enquiry_num'];
	$_SESSION['listings_enquiries_report']['charge_type'] = $_POST['charge_type'];
	header('Location:/admin/listings_enquiries/report.php');
	exit;
}else if( $_POST['act'] == "clear" ){
	$_SESSION['listings_enquiries_report']['rank'] = NULL;
	$_SESSION['listings_enquiries_report']['parent_company'] = NULL;
	$_SESSION['listings_enquiries_report']['evernote_id'] = NULL;
	$_SESSION['listings_enquiries_report']['name'] = NULL;
	$_SESSION['listings_enquiries_report']['status'] = NULL;
	$_SESSION['listings_enquiries_report']['states_id'] = NULL;
	$_SESSION['listings_enquiries_report']['groups_id'] = NULL;
	$_SESSION['listings_enquiries_report']['monthly_enquiry_num'] = NULL;
	$_SESSION['listings_enquiries_report']['charge_type'] = NULL;
}

//一覧表示用のSQL実行（まずヒット件数を知る）
$result = listings_enquiries_report_index();
$row_num = mysql_num_rows( $result );
?>
