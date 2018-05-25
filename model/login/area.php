<?php
function area_err_check(){
        if(empty($_POST['area'])){
                $err_msg .= "対応エリアを１つ以上選択して下さい。<br />";
        }
        return $err_msg;
}
function area_update(){
	$sql = "update companies set";
	$sql .= " area = '" . implode(",",$_POST['area']) . "'";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $_SESSION['companies_id'];
	common_exec_sql( $sql );
}
?>
