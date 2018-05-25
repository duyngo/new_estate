<?php
//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/listings/original.php";
include "../../../model/admin/listings/list.php";
include "../../../model/admin/companies/common.php";

session_start();
mysql_mysql_connect();

//Company(companies_id)の親会社を探す

$sql  = "SELECT";
$sql .= " *";
$sql .= " from";
$sql .= " companies";
$sql .= " where";
$sql .= " id = " . $_POST['companies_id'];
$result = mysql_query($sql);
$arr = mysql_fetch_array($result);
$parent_id = $arr['parent_id'];

$sql  = "SELECT";
$sql .= " *";
$sql .= " from";
$sql .= " sales_garellies";
$sql .= " where";
$sql .= " is_deleted = 0";
if(!empty($_POST['companies_id'])){
	$sql .= " and";
	$sql .= " companies_id = " . $parent_id;
}
$sql .= " order by sort";
$result = mysql_query($sql);
while( $arr = mysql_fetch_array($result)){
	$checked = NULL;
	if(strpos($_SESSION['listings']['sales_garellies_id'],$arr['id'])!==false){
		$checked = "checked";
	}
	echo "<input type=\"checkbox\" name=\"sales_garellies_id[]\" value=\"" . $arr['id'] . "\"" . $checked . ">" . $arr['name'] . "<br />";
}
?>
