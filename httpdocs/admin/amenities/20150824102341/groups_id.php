<?php
include "/home/newpropertylist.my/model/common/common.php";
include "/home/newpropertylist.my/model/common/list.php";
include "/home/newpropertylist.my/model/mysql/common.php";
mysql_mysql_connect();
$words = array();

// 現在入力中の文字を取得
$term = (isset($_GET['term']) && is_string($_GET['term'])) ? $_GET['term'] : '';

//入力値を元に部分一致で検索
$sql = "select";
$sql .= " *";
$sql .= " from";
$sql .= " groups";
$sql .= " where";
$sql .= " name like '%" . $term . "%'";
$sql .= " and";
$sql .= " is_deleted = 0";
$sql .= " order by name";
$result = mysql_query( $sql );
while( $arr = mysql_fetch_array( $result )){
	$words[] = $arr['name'];
}
header("Content-Type: application/json; charset=utf-8");
echo json_encode($words);
