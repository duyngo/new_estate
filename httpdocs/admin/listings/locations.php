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

$sql  = "SELECT";
$sql .= " *";
$sql .= " from";
$sql .= " locations";
$sql .= " where";
$sql .= " is_deleted = 0";
if(!empty($_POST['states_id'])){
	$sql .= " and";
	$sql .= " states_id = " . $_POST['states_id'];
}
if(!empty($_POST['groups_id'])&& $_POST['groups_id'] != "msg" ){
	$sql .= " and";
	$sql .= " groups_id = " . $_POST['groups_id'];
}
$sql .= " order by name";
$result = mysql_query($sql);
while( $arr = mysql_fetch_array($result)){
	$selected = NULL;
	if( $_SESSION['listings']['locations_id'] == $arr['id']){
		$selected = "selected";
	}
	echo "<option value=\"" . $arr['id'] . "\" " . $selected . ">" . $arr['name'] . "</option>";
}
?>
