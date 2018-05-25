<?php
function mysql_mysql_connect(){
	$link = mysql_connect("localhost","newpropertylist","romancrew20130204") or die("db connect error");
	$sdb = mysql_select_db("newpropertylist",$link) or die("db select error");
	return;
}
?>
