<?php
ini_set( 'display_errors', 1 );
//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/listings/original.php";
include "/home/newpropertylist.my/model/admin/enquiry_report_master/common.php";

mysql_mysql_connect();

$date = date("Y-m-d",strtotime("-1 day"));
$result = enquiry_report_master_index("");

while( $arr = mysql_fetch_array( $result )){
	enquiry_report_daily_create_data( $arr['id'],$date );
}
exit;
?>
