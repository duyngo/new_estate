<?php
ini_set( 'display_errors', 1 );
//error_reporting(0);
//ファイルインクルード
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
include "/home/newpropertylist.my/model/admin/listings/original.php";
include "/home/newpropertylist.my/model/companies/common.php";
include "/home/newpropertylist.my/model/features/common.php";
include "/home/newpropertylist.my/model/groups/common.php";
include "/home/newpropertylist.my/model/listings/common.php";
include "/home/newpropertylist.my/model/prices/common.php";
include "/home/newpropertylist.my/model/property_type_groups/common.php";
include "/home/newpropertylist.my/model/property_types/common.php";
include "/home/newpropertylist.my/model/states/common.php";

mysql_mysql_connect();
$fp = fopen("/home/newpropertylist.my/httpdocs/sitemap.xml", "w");

$str = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
$str .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

//掲載中and論理削除されていないListingを探す
$sql = "select";
$sql .= " *";
$sql .= " from";
$sql .= " urls";
$sql .= " where";
$sql .= " is_deleted = 0";
$sql .= " order by id";
$result = mysql_query( $sql );
while( $arr = mysql_fetch_array( $result )){
	$str .= "<url>\n";
	$str .= "\t<loc>" . $arr['url'] . "</loc>\n";
	$str .= "\t<lastmod>" . substr($arr['modified'],0,10) . "</lastmod>\n";
	$str .= "\t<changefreq>daily</changefreq>\n";
	$str .= "\t<priority>" . $arr['priority'] . "</priority>\n";
	$str .= "</url>\n";
}
$str .= "</urlset>\n";

fwrite($fp,$str);
fclose($fp);

exit;
?>
