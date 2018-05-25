<?php
function companies_index( $lines ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " companies t1";
	$sql .= " where";
	$sql .= " t1.is_deleted = 0";
	if(strpos($_SERVER['SCRIPT_NAME'],"/companies/")!==false){
		if(!empty( $_SESSION['companies']['name'])){
			$sql .= " and";
			$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['companies']['name']) . "%'";
		}
		if(!empty( $_SESSION['companies']['class'])){
			$sql .= " and";
			$sql .= " t1.class = '" . $_SESSION['companies']['class'] . "'";
		}
		if(!empty( $_SESSION['companies']['pickup_flag'])){
			$sql .= " and";
			$sql .= " t1.pickup_flag = '" . $_SESSION['companies']['pickup_flag'] . "'";
		}
		if(!empty( $_SESSION['companies']['developers_list_display_flag'])){
			$sql .= " and";
			$sql .= " t1.developers_list_display_flag = '" . $_SESSION['companies']['developers_list_display_flag'] . "'";
		}
	}
	$sql .= " order by name";
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
function companies_insert(){
	$sql = "insert into companies(";
	$sql .= " parent_id";
	$sql .= ",name";
	$sql .= ",code";
	$sql .= ",rank";
	$sql .= ",class";
	$sql .= ",url";
	$sql .= ",address";
	$sql .= ",tel";
	$sql .= ",fax";
	$sql .= ",pickup_flag";
	$sql .= ",developers_list_display_flag";
	$sql .= ",logo_image_path";
	$sql .= ",middle_head_1";
	$sql .= ",desc_image_path_1";
	$sql .= ",body_1";
	$sql .= ",middle_head_2";
	$sql .= ",desc_image_path_2";
	$sql .= ",body_2";
	$sql .= ",middle_head_3";
	$sql .= ",desc_image_path_3";
	$sql .= ",body_3";
	$sql .= ",created";
	$sql .= ",created_by";
	$sql .= ",modified";
	$sql .= ",modified_by";
	$sql .= ")values(";
	$sql .= " '" . mysql_real_escape_string( $_POST['parent_id'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['rank'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['class'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['url'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['address'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['tel'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['fax'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['pickup_flag'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['developers_list_display_flag'] ) . "'";
	$sql .= ",'" . $_SESSION['companies']['logo_image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['middle_head_1'] ) . "'";
	$sql .= ",'" . $_SESSION['companies']['desc_image_path_1'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['body_1'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['middle_head_2'] ) . "'";
	$sql .= ",'" . $_SESSION['companies']['desc_image_path_2'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['body_2'] ) . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['middle_head_3'] ) . "'";
	$sql .= ",'" . $_SESSION['companies']['desc_image_path_3'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['body_3'] ) . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ",now()";
	$sql .= ",'" . $_SESSION['users_id'] . "'";
	$sql .= ")";
	common_exec_sql($sql);
	return common_get_max("companies");
}
function companies_update(){
	$sql = "update companies set";
	$sql .= " parent_id = '" . mysql_real_escape_string( $_POST['parent_id'] ) . "'";
	$sql .= ",name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",code = '" . mysql_real_escape_string( $_POST['code'] ) . "'";
	$sql .= ",rank = '" . mysql_real_escape_string( $_POST['rank'] ) . "'";
	$sql .= ",class = '" . mysql_real_escape_string( $_POST['class'] ) . "'";
	$sql .= ",url = '" . mysql_real_escape_string( $_POST['url'] ) . "'";
	$sql .= ",address = '" . mysql_real_escape_string( $_POST['address'] ) . "'";
	$sql .= ",tel = '" . mysql_real_escape_string( $_POST['tel'] ) . "'";
	$sql .= ",fax = '" . mysql_real_escape_string( $_POST['fax'] ) . "'";
	$sql .= ",pickup_flag = '" . mysql_real_escape_string( $_POST['pickup_flag'] ) . "'";
	$sql .= ",developers_list_display_flag = '" . mysql_real_escape_string( $_POST['developers_list_display_flag'] ) . "'";
	$sql .= ",logo_image_path = '" . $_SESSION['companies']['logo_image_path'] . "'";
	$sql .= ",middle_head_1 = '" . mysql_real_escape_string( $_POST['middle_head_1'] ) . "'";
	$sql .= ",desc_image_path_1 = '" . $_SESSION['companies']['desc_image_path_1'] . "'";
	$sql .= ",body_1 = '" . mysql_real_escape_string( $_POST['body_1'] ) . "'";
	$sql .= ",middle_head_2 = '" . mysql_real_escape_string( $_POST['middle_head_2'] ) . "'";
	$sql .= ",desc_image_path_2 = '" . $_SESSION['companies']['desc_image_path_2'] . "'";
	$sql .= ",body_2 = '" . mysql_real_escape_string( $_POST['body_2'] ) . "'";
	$sql .= ",middle_head_3 = '" . mysql_real_escape_string( $_POST['middle_head_3'] ) . "'";
	$sql .= ",desc_image_path_3 = '" . $_SESSION['companies']['desc_image_path_3'] . "'";
	$sql .= ",body_3 = '" . mysql_real_escape_string( $_POST['body_3'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $_POST['id'];
	common_exec_sql($sql);
	return;
}
function companies_delete( $id ){
	$sql = "update companies set";
	$sql .= " is_deleted = 1 ";
	$sql .= ",modified = now()";
	$sql .= ",modified_by = " . $_SESSION['users_id'];
	$sql .= " where";
	$sql .= " id = " . $id;
	common_exec_sql($sql);
	return;
}
function companies_external_users_index( $companies_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " external_users t1";
	$sql .= " where";
	$sql .= " t1.companies_id = $companies_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['companies']['external_users']['email'])){
		$sql .= " and";
		$sql .= " t1.email like '%" . mysql_real_escape_string($_SESSION['companies']['external_users']['email']) . "%'";
	}
	if(!empty( $_SESSION['companies']['external_users']['first_name'])){
		$sql .= " and";
		$sql .= " t1.first_name like '%" . mysql_real_escape_string($_SESSION['companies']['external_users']['first_name']) . "%'";
	}
	if(!empty( $_SESSION['companies']['external_users']['last_name'])){
		$sql .= " and";
		$sql .= " t1.last_name like '%" . mysql_real_escape_string($_SESSION['companies']['external_users']['last_name']) . "%'";
	}
	$sql .= " order by first_name,last_name";
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
function companies_listings_index( $companies_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " listings t1";
	$sql .= " where";
	$sql .= " t1.companies_id = $companies_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['companies']['listings']['id'])){
		$sql .= " and";
		$sql .= " t1.id like '%" . mysql_real_escape_string($_SESSION['companies']['listings']['id']) . "%'";
	}
	if(!empty( $_SESSION['companies']['listings']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['companies']['listings']['name']) . "%'";
	}
	if(!empty( $_SESSION['companies']['listings']['property_name'])){
		$sql .= " and";
		$sql .= " t1.property_name like '%" . mysql_real_escape_string($_SESSION['companies']['listings']['property_name']) . "%'";
	}
	if(!empty( $_SESSION['companies']['listings']['status'])){
		$sql .= " and";
		$sql .= " t1.status like '%" . $_SESSION['companies']['listings']['status'] . "%'";
	}
	$sql .= " order by t1.id desc";
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
function companies_sales_garellies_index( $companies_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= " from";
	$sql .= " sales_garellies t1";
	$sql .= " where";
	$sql .= " t1.companies_id = $companies_id";
	$sql .= " and";
	$sql .= " t1.is_deleted = 0";
	if(!empty( $_SESSION['companies']['sales_garellies']['name'])){
		$sql .= " and";
		$sql .= " t1.name like '%" . mysql_real_escape_string($_SESSION['companies']['sales_garellies']['name']) . "%'";
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
function companies_err_check( $column_name ){
	$err_msg = NULL;
	if(empty($column_name)||$column_name=="parent_id"){
		if(empty($_POST['parent_id'])){
			$err_msg .= "<li><a href=\"#parent_id\">Please Enter [Parent]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="name"){
		if(empty($_POST['name'])){
			$err_msg .= "<li><a href=\"#name\">Please Enter [Company name]</a></li>";
		}
		if(!empty($_POST['name'])){
			if(mb_strlen($_POST['name'],"UTF-8") > 256){
				$err_msg .= "<li><a href=\"#name\">Please Enter [Company name] within 256 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="code"){
		if(empty($_POST['code'])){
			$err_msg .= "<li><a href=\"#code\">Please Enter [Company ID(use as part of URL)]</a></li>";
		}
		if(!empty($_POST['code'])){
			if(mb_strlen($_POST['code'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#code\">Please Enter [Company ID(use as part of URL)] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="class"){
		if(empty($_POST['class'])){
			$err_msg .= "<li><a href=\"#class\">Please Enter [Classification]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="url"){
		if(!empty($_POST['url'])){
			if(mb_strlen($_POST['url'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#url\">Please Enter [Corporate site URL] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="address"){
		if(!empty($_POST['address'])){
			if(mb_strlen($_POST['address'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#address\">Please Enter [Address] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="tel"){
		if(!empty($_POST['tel'])){
			if(mb_strlen($_POST['tel'],"UTF-8") > 16){
				$err_msg .= "<li><a href=\"#tel\">Please Enter [TEL] within 16 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="fax"){
		if(!empty($_POST['fax'])){
			if(mb_strlen($_POST['fax'],"UTF-8") > 16){
				$err_msg .= "<li><a href=\"#fax\">Please Enter [FAX] within 16 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="pickup_flag"){
		if(empty($_POST['pickup_flag'])){
			$err_msg .= "<li><a href=\"#pickup_flag\">Please Enter [Pick Up]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="developers_list_display_flag"){
		if(empty($_POST['developers_list_display_flag'])){
			$err_msg .= "<li><a href=\"#developers_list_display_flag\">Please Enter [Developers list display flag]</a></li>";
		}
	}
	if(empty($column_name)||$column_name=="logo_image_path"){
		if( $_POST['logo_image_path'] == "delete" ){
			$upload_msg = admin_common_image_delete("companies","logo_image_path");
		}
		if(!empty($_FILES['logo_image_path']["name"])){
			$upload_msg = admin_common_image_upload("companies","logo_image_path");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#logo_image_path\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="middle_head_1"){
		if(!empty($_POST['middle_head_1'])){
			if(mb_strlen($_POST['middle_head_1'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#middle_head_1\">Please Enter [Middle heading 1] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="desc_image_path_1"){
		if( $_POST['desc_image_path_1'] == "delete" ){
			$upload_msg = admin_common_image_delete("companies","desc_image_path_1");
		}
		if(!empty($_FILES['desc_image_path_1']["name"])){
			$upload_msg = admin_common_image_upload("companies","desc_image_path_1");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#desc_image_path_1\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="body_1"){
	}
	if(empty($column_name)||$column_name=="middle_head_2"){
		if(!empty($_POST['middle_head_2'])){
			if(mb_strlen($_POST['middle_head_2'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#middle_head_2\">Please Enter [Middle heading 2] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="desc_image_path_2"){
		if( $_POST['desc_image_path_2'] == "delete" ){
			$upload_msg = admin_common_image_delete("companies","desc_image_path_2");
		}
		if(!empty($_FILES['desc_image_path_2']["name"])){
			$upload_msg = admin_common_image_upload("companies","desc_image_path_2");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#desc_image_path_2\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="body_2"){
	}
	if(empty($column_name)||$column_name=="middle_head_3"){
		if(!empty($_POST['middle_head_3'])){
			if(mb_strlen($_POST['middle_head_3'],"UTF-8") > 128){
				$err_msg .= "<li><a href=\"#middle_head_3\">Please Enter [Middle heading 3] within 128 characters.</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="desc_image_path_3"){
		if( $_POST['desc_image_path_3'] == "delete" ){
			$upload_msg = admin_common_image_delete("companies","desc_image_path_3");
		}
		if(!empty($_FILES['desc_image_path_3']["name"])){
			$upload_msg = admin_common_image_upload("companies","desc_image_path_3");
			if($upload_msg){
				$err_msg .= "<li><a href=\"#desc_image_path_3\">" . $upload_msg . "</a></li>";
			}
		}
	}
	if(empty($column_name)||$column_name=="body_3"){
	}
	return $err_msg;
}
?>
