<?php
function outline_err_check(){
        if(empty($_POST['name'])){
                $err_msg .= "「会社名」を入力して下さい。<br />";
        }
        if(empty($_POST['class'])){
                $err_msg .= "「事業形態」を選択して下さい。<br />";
        }
        if(empty($_POST['zip1']) || empty($_POST['zip2'])){
                $err_msg .= "「郵便番号」を入力して下さい。<br />";
        }
        if(empty($_POST['address2'])){
                $err_msg .= "「住所」を入力して下さい。<br />";
        }
        if(empty($_POST['access'])){
                $err_msg .= "「アクセス方法」を入力して下さい。<br />";
        }
        if(empty($_POST['tel1']) || empty($_POST['tel2']) || empty($_POST['tel3'])){
                $err_msg .= "「電話番号」を入力して下さい。<br />";
        }
	return $err_msg;	
}
function outline_update(){
	$sql = "update companies set";
	$sql .= " name = '" . mysql_real_escape_string( $_POST['name'] ) . "'";
	$sql .= ",division = '" . mysql_real_escape_string( $_POST['division'] ) . "'";
	$sql .= ",class = '" . $_POST['class'] . "'";
	$sql .= ",zip1 = '" . mysql_real_escape_string( $_POST['zip1'] ) . "'";
	$sql .= ",zip2 = '" . mysql_real_escape_string( $_POST['zip2'] ) . "'";
	$sql .= ",address2 = '" . mysql_real_escape_string( $_POST['address2'] ) . "'";
	$sql .= ",address3 = '" . mysql_real_escape_string( $_POST['address3'] ) . "'";
	$sql .= ",access = '" . mysql_real_escape_string( $_POST['access'] ) . "'";
	$sql .= ",tel1 = '" . mysql_real_escape_string( $_POST['tel1'] ) . "'";
	$sql .= ",tel2 = '" . mysql_real_escape_string( $_POST['tel2'] ) . "'";
	$sql .= ",tel3 = '" . mysql_real_escape_string( $_POST['tel3'] ) . "'";
	$sql .= ",fax1 = '" . mysql_real_escape_string( $_POST['fax1'] ) . "'";
	$sql .= ",fax2 = '" . mysql_real_escape_string( $_POST['fax2'] ) . "'";
	$sql .= ",fax3 = '" . mysql_real_escape_string( $_POST['fax3'] ) . "'";
	$sql .= ",establish_year = '" . mysql_real_escape_string( $_POST['establish_year'] ) . "'";
	$sql .= ",establish_month = '" . mysql_real_escape_string( $_POST['establish_month'] ) . "'";
	$sql .= ",representative_position = '" . mysql_real_escape_string( $_POST['representative_position'] ) . "'";
	$sql .= ",representative_family_name = '" . mysql_real_escape_string( $_POST['representative_family_name'] ) . "'";
	$sql .= ",representative_first_name = '" . mysql_real_escape_string( $_POST['representative_first_name'] ) . "'";
	$sql .= ",capital = '" . mysql_real_escape_string( $_POST['capital'] ) . "'";
	$sql .= ",yearly_sales = '" . mysql_real_escape_string( $_POST['yearly_sales'] ) . "'";
	$sql .= ",employee_number = '" . mysql_real_escape_string( $_POST['employee_number'] ) . "'";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $_SESSION['companies_id'];
	mysql_query( $sql );
}
?>
