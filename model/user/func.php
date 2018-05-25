<?php
function user_index() {
        $sql = "select * from users";
        $sql .= " where";
        $sql .= " is_deleted = 0";
        $sql .= " and";
        $sql .= " is_retired = 0";
        $sql .= " order by id";
        return mysql_query( $sql );
}
function user_insert(){
        $sql = "insert into users(";
        $sql .= " email";
        $sql .= ",name1";
        $sql .= ",name2";
        $sql .= ",image_path";
        $sql .= ",zipcode";
        $sql .= ",address1";
        $sql .= ",address2";
        $sql .= ",address3";
        $sql .= ",tel";
        $sql .= ",fax";
        $sql .= ",mobile";
        $sql .= ",password";
        $sql .= ",created";
        $sql .= ",created_by";
        $sql .= ")values(";
        $sql .= " '" . $_POST['email'] . "'";
        $sql .= ",'" . mysql_real_escape_string($_POST['name1']) . "'";
        $sql .= ",'" . mysql_real_escape_string($_POST['name2']) . "'";
        $sql .= ",'" . $_POST['image_path'] . "'";
        $sql .= ",'" . $_POST['zipcode'] . "'";
        $sql .= ",'" . $_POST['address1'] . "'";
        $sql .= ",'" . mysql_real_escape_string($_POST['address2']) . "'";
        $sql .= ",'" . mysql_real_escape_string($_POST['address3']) . "'";
        $sql .= ",'" . $_POST['tel'] . "'";
        $sql .= ",'" . $_POST['fax'] . "'";
        $sql .= ",'" . $_POST['mobile'] . "'";
        $sql .= ",'" . sha1($_POST['password'] . 'SecretKey') . "'";
        $sql .= ",'" . common_get_now_datetime() . "'";
        $sql .= ",'$_SESSION[user_id]'";
        $sql .= ")";
        if( $_SESSION['edit_status'] == "yet" ) {
                common_exec_sql( $sql );
        }
        return;
}
function user_update() {
        $sql = "update users set";
        $sql .= " name1 = '" . addslashes($_POST['name1']) . "'";
        $sql .= ",name2 = '" . addslashes($_POST['name2']) . "'";
        $sql .= ",email = '" . $_POST['email'] . "'";
        $sql .= ",image_path = '" . $_POST['image_path'] . "'";
        $sql .= ",zipcode = '" . addslashes($_POST['zipcode']) . "'";
        $sql .= ",address1 = '" . $_POST['address1'] . "'";
        $sql .= ",address2 = '" . addslashes($_POST['address2']) . "'";
        $sql .= ",address3 = '" . addslashes($_POST['address3']) . "'";
        $sql .= ",tel = '" . $_POST['tel'] . "'";
        $sql .= ",mobile = '" . $_POST['mobile'] . "'";
        if( $_POST['password'] != "" ){
                $sql .= ",password = '" . sha1($_POST['password'] . 'SecretKey') . "'";
        }
        $sql .= ",is_retired = '" . $_POST['is_retired'] . "'";
        $sql .= ",modified = '" . common_get_now_datetime() . "'";
        $sql .= ",modified_by = $_SESSION[user_id]";
        $sql .= " where";
        $sql .= " id = " . $_POST['id'];
        common_exec_sql( $sql );
        return;
}
function user_err_check() {
        if( $_POST['name1'] == "" ) {
                $err_msg .= "苗字を入力して下さい。<br>";
        }
        if( $_POST['zipcode'] != "" ) {
                //がっちり郵便番号
                //if (!preg_match("/^[0-9]{3}-[0-9]{4}$/", $_POST['zipcode']))

                if (!preg_match("/^[!-~]+$/", $_POST['zipcode'])) {
                        $err_msg .= "郵便番号は半角英数記号のみで入力して下さい。<br>";
                }
        }
        if( $_POST['tel'] != "" ) {
                if (!preg_match("/^[!-~]+$/", $_POST['tel'])) {
                        $err_msg .= "電話番号は半角英数記号のみで入力して下さい。<br>";
                }
        }
        if( $_POST['fax'] != "" ) {
                if (!preg_match("/^[!-~]+$/", $_POST['fax'])) {
                        $err_msg .= "FAX番号は半角英数記号のみで入力して下さい。<br>";
                }
        }
        if( $_POST['mobile'] != "" ) {
                if (!preg_match("/^[!-~]+$/", $_POST['mobile'])) {
                        $err_msg .= "携帯番号は半角英数記号のみで入力して下さい。<br>";
                }
        }
        if( $_POST['email'] == "" ) {
                $err_msg .= "メールアドレスを入力して下さい。<br>";
        } else {
                if (!preg_match("|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|", $_POST['email'])) {
                        $err_msg .= "メールアドレスの形式が正しくありません。<br>";
                } else {
                }
        }
        if( $_POST['password'] == "" ) {
                if( $_POST['id'] == "" ) {
                        $err_msg .= "パスワードを入力して下さい。<br>";
                }
        } else {
                if (!preg_match("/^[!-~]+$/", $_POST['password'])) {
                        $err_msg .= "パスワードは半角英数記号のみで入力して下さい。<br>";
                }
        }
        return $err_msg;
}
function user_image_upload( $model,$id ){
        if( $_POST['image_del'] == "1" ){
                $_SESSION['image_path'] = "";
        }
        if( $_FILES['image_path']["name"] != "" ){
                if( preg_match("/^[!-~]+$/", $_FILES['image_path']["name"])){
                        if (is_uploaded_file($_FILES['image_path']["tmp_name"])) {
                                $file_path = $_SERVER['DOCUMENT_ROOT'] . "/admin/" . $model . "/images/" . $id . "_" . $_FILES['image_path']["name"];
                                $file_url = "/admin/" . $model . "/images/" . $id . "_" . $_FILES['image_path']["name"];
                                if(move_uploaded_file($_FILES['image_path']["tmp_name"],$file_path)) {
                                        $_SESSION['image_path'] = $file_url;
                                } else {
                                        $err_msg .= "サムネイル画像のアップロードでエラーが発生しました。";
                                }
                        }
                }else{
                        $err_msg .= "画像のファイル名は半角英数字と記号のみにして下さい。";
                }
        }
        return $err_msg;
}
?>
