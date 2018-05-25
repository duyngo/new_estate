<?php
function sales_garellies_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " sales_garellies t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.companies_id = t2.id )";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/sales_garellies/")!==false){
		if(!empty( $_SESSION['sales_garellies']['companies_id'])){
			$sql .= " and";
			$sql .= " t2.name like '%" . mysql_real_escape_string($_SESSION['sales_garellies']['companies_id']) . "%'";
		}
		if(!empty( $_SESSION['sales_garellies']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['sales_garellies']['name']) . "%'";
		}
	}
	$sql .= " order by t1.sort";
	if(!empty($lines)){
		if(empty($_REQUEST['page'])){
			$offset = 0;
		}else{
			$offset = ($_REQUEST['page']-1) * $lines;
		}
		$sql .= " limit " . $lines . " offset " . $offset;
	}
	return mysql_query($sql);
}
function sales_garellies_insert(){
	$sql = "insert into sales_garellies(";
	$sql .= " companies_id";
	$sql .= ",name";
	$sql .= ",description";
	$sql .= ",image_path_1";
	$sql .= ",image_path_2";
	$sql .= ",image_path_3";
	$sql .= ",image_path_4";
	$sql .= ",image_path_5";
	$sql .= ",image_path_6";
	$sql .= ",image_path_7";
	$sql .= ",image_path_8";
	$sql .= ",image_path_9";
	$sql .= ",image_path_10";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['companies_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_1'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_2'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_3'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_4'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_5'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_6'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_7'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_8'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_9'] . "'";
	$sql .= ",'" . $_SESSION['sales_garellies']['image_path_10'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("sales_garellies");
}
function sales_garellies_update(){
	$sql = "update sales_garellies set";
	$sql .= " companies_id = '" . mysql_real_escape_string( $_POST['companies_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",description = '" . mysql_real_escape_string( $_POST['description'] ) . "'";
	$sql .= ",image_path_1 = '" . $_SESSION['sales_garellies']['image_path_1'] . "'";
	$sql .= ",image_path_2 = '" . $_SESSION['sales_garellies']['image_path_2'] . "'";
	$sql .= ",image_path_3 = '" . $_SESSION['sales_garellies']['image_path_3'] . "'";
	$sql .= ",image_path_4 = '" . $_SESSION['sales_garellies']['image_path_4'] . "'";
	$sql .= ",image_path_5 = '" . $_SESSION['sales_garellies']['image_path_5'] . "'";
	$sql .= ",image_path_6 = '" . $_SESSION['sales_garellies']['image_path_6'] . "'";
	$sql .= ",image_path_7 = '" . $_SESSION['sales_garellies']['image_path_7'] . "'";
	$sql .= ",image_path_8 = '" . $_SESSION['sales_garellies']['image_path_8'] . "'";
	$sql .= ",image_path_9 = '" . $_SESSION['sales_garellies']['image_path_9'] . "'";
	$sql .= ",image_path_10 = '" . $_SESSION['sales_garellies']['image_path_10'] . "'";
	$sql .= ",sort = '" . mysql_real_escape_string( $_POST['sort'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function sales_garellies_delete( $id ){
	$sql = "update sales_garellies set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function sales_garellies_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="companies_id"){
		if(empty($_POST['companies_id'])){
			$err_msg .= "<li><a href=\"#companies_id\">Please Enter [Company]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Sales Garelly Name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 64){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Sales Garelly Name] within 64 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="description"){
	}
	if(empty($column_name)||$column_name=="image_path_1"){
		if( $_POST['image_path_1'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_1");
		}
		if(!empty($_FILES['image_path_1']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_1");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_1\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_2"){
		if( $_POST['image_path_2'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_2");
		}
		if(!empty($_FILES['image_path_2']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_2");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_2\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_3"){
		if( $_POST['image_path_3'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_3");
		}
		if(!empty($_FILES['image_path_3']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_3");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_3\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_4"){
		if( $_POST['image_path_4'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_4");
		}
		if(!empty($_FILES['image_path_4']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_4");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_4\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_5"){
		if( $_POST['image_path_5'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_5");
		}
		if(!empty($_FILES['image_path_5']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_5");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_5\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_6"){
		if( $_POST['image_path_6'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_6");
		}
		if(!empty($_FILES['image_path_6']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_6");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_6\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_7"){
		if( $_POST['image_path_7'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_7");
		}
		if(!empty($_FILES['image_path_7']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_7");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_7\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_8"){
		if( $_POST['image_path_8'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_8");
		}
		if(!empty($_FILES['image_path_8']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_8");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_8\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_9"){
		if( $_POST['image_path_9'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_9");
		}
		if(!empty($_FILES['image_path_9']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_9");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_9\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="image_path_10"){
		if( $_POST['image_path_10'] == "delete" ){
			$upload_msg = admin_common_image_delete("sales_garellies","image_path_10");
		}
		if(!empty($_FILES['image_path_10']["name"])){
			$upload_msg = admin_common_image_upload("sales_garellies","image_path_10");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#image_path_10\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="sort"){
		if(empty($_POST['sort'])){
			$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort]</a></li>";
		}
		if(!empty($_POST['sort'])){
			if(mb_strlen($_POST['sort'],"UTF-8") > 10){
				$err_msg .= "<li><a href=\"#sort\">Please Enter [Sort] within 10 characters.</a></li>";
			}
		}
	}
	return $err_msg;
}
?>