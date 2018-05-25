<?php
function client_lost_err_check(){
        if(empty($_POST['email'])){
                if(empty($_POST['email'])){
                        $err_msg .= "Please Enter Email<br />";
                }
        }else{
                $sql = "select";
                $sql .= " *";
                $sql .= " from";
                $sql .= " external_users";
                $sql .= " where";
                $sql .= " email = '" . mysql_real_escape_string( $_POST['email'] ) . "'";
                $sql .= " and";
                $sql .= " is_deleted = 0";
                $result =  mysql_query( $sql );
                if( mysql_num_rows( $result ) == 0) {
                        $err_msg .= "This Email is not registerd";
                }
        }
        return $err_msg;
}
function client_lost_send_mail($to){
	$reset_code = hash('SHA256',$_POST['email'] . date("YmdHis"));
        $sql = "update external_users set";
        $sql .= " reset_code = '$reset_code'";
        $sql .= ",modified = now()";
        $sql .= " where";
        $sql .= " email = '" . $_POST['email'] . "'";
        common_exec_sql($sql);

        $subject = "Email for password resets";
        $body .= "Please access next webpage,and reset your password.\n";
        $body .= "\n";
        $body .= "http://newpropertylist.my/client/reset/index.php?reset_code=" . $reset_code . "\n";
        $body .= "\n";
        $body .= "Warm regards,\n";
        $body .= "--------------------------------------------------------------------------------------------------\n";
        $body .= "NewPropertyList.my\n";
        $body .= "EMAIL : info@samurai-internet.com\n";
        $body .= "TEL : 011-3921 4968\n";
        $body .= "\n";
        $body .= "SAMURAI INTERNET SDN. BHD.      [1136750-D] [MSC Status Company]\n";
        $body .= "Block 3730, Persiaran APEC, 63000 Cyberjaya, Malaysia \n";
        $body .= "URL : www.samurai-internet.com\n";
        $body .= "--------------------------------------------------------------------------------------------------\n";
        common_send_mail($to,$subject,$body);
        return;
}
?>
