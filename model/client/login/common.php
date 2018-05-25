<?php
function client_login_err_check(){
        if( empty($_POST['email']) || empty($_POST['password']) ){
                if(empty($_POST['email'])){
                        $err_msg .= "Please Enter Email<br />";
                }
                if(empty($_POST['password'])){
                        $err_msg .= "Please Enter Password<br />";
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
                        $err_msg .= "Incorrect Email and Password combination<br>";
                }else{
                        $arr = mysql_fetch_array( $result );
                        $password = hash('SHA256',$_POST['password'] . 'SecretKey');
                        if( $password != $arr['password'] ){
                                $err_msg .= "Incorrect Email and Password combination<br>";
                        }else{
                                $_SESSION['external_users_id'] = $arr['id'];
                                $_SESSION['external_users_companies_id'] = $arr['companies_id'];
                                $_SESSION['external_users_name'] = $GLOBALS['external_users_title_list'][$arr['title']] . $arr['first_name'] . "" . $arr['last_name'];

                                //セッションを保持するがチェックされていたらクッキーを作成
				//クッキー名称はドメインから「.」を除外したものとする（「.」があるとちゃんと動かない）
				$tmp_arr = explode(".",$_SERVER['SERVER_NAME']);
				$cookie = $tmp_arr[0] . "_client";
                                if( $_POST['autoLogin'] == "on" ) {
                                        setcookie($cookie,"$arr[id],$arr[companies_id],$_POST[email],$_POST[password],$_POST[autoLogin],$_SESSION[users_name]",time() + 1825 * 24 * 60 * 60,"/");
                                }else{
                                        setcookie($cookie,"","0");        //クッキーの削除
                                }
                        }
                }
        }
        return $err_msg;
}
?>
