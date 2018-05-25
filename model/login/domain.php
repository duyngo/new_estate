<?php
function domain_category_index() {
        $sql = "select";
        $sql .= " *";
        $sql .= " from";
        $sql .= " domain_categories";
        $sql .= " where";
        $sql .= " display_flag = 'on'";
        $sql .= " and";
        $sql .= " is_deleted = 0";
        $sql .= " order by sort";
        return mysql_query( $sql );
}
function domain_index( $domain_category_id ) {
        $sql = "select";
        $sql .= " *";
        $sql .= " from";
        $sql .= " domains";
        $sql .= " where";
        $sql .= " domain_category_id = $domain_category_id";
        $sql .= " and";
        $sql .= " display_flag = 'on'";
        $sql .= " and";
        $sql .= " is_deleted = 0";
        $sql .= " order by sort";
        return mysql_query( $sql );
}
function domain_err_check(){
	if(empty($_POST['domain'])){
		$err_msg .= "「事業領域」を１つ以上選択して下さい。<br />";
	}
	return $err_msg;	
}
function domain_update(){
	$sql = "update companies set";
	$sql .= " domain = '" . implode(",",$_POST['domain']) . "'";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $_SESSION['companies_id'];
	mysql_query( $sql );
	return;
}
?>
