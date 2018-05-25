<?php
//ファイルインクルード
include "../../../model/common/common.php";
include "../../../model/common/list.php";
include "../../../model/mysql/common.php";
include "../../../model/admin/common/common.php";
include "../../../model/admin/listings/common.php";
include "../../../model/admin/listings/original.php";
include "../../../model/admin/listings/list.php";

session_start();
mysql_mysql_connect();

$sql  = "SELECT";
$sql .= " *";
$sql .= " from";
$sql .= " groups";
$sql .= " where";
$sql .= " is_deleted = 0";
if(!empty($_POST['states_id'])){
	$sql .= " and";
	$sql .= " states_id = " . $_POST['states_id'];
}
$sql .= " order by name";
$result = mysql_query($sql);

echo "<option value=\"\">Not selected(NULL)</option>";

while( $arr = mysql_fetch_array($result)){
	$selected = NULL;
	if( !empty($_POST['states_id']) && $_SESSION['listings_enquiries_report']['groups_id'] == $arr['id']){
		$selected = "selected";
	}
	echo "<option value=\"" . $arr['id'] . "\" " . $selected . ">" . $arr['name'] . "</option>";
}
?>
