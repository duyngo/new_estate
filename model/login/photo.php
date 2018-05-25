<?php
function photo_index( $companies_id ){
	$sql = "select";
	$sql .= " t1.*";
	$sql .= ",concat(t2.family_name,t2.first_name) as name";
	$sql .= " from";
	$sql .= " photos t1";
	$sql .= " left join";
	$sql .= " companies t2";
	$sql .= " on";
	$sql .= " ( t1.companies_id = t2.id )";
	$sql .= " where";
	$sql .= " t1.companies_id = " . $companies_id;
	$sql .= " order by t1.sort";
	return mysql_query( $sql );
}
function photo_err_check(){
	if(!empty($_POST['caption'])){
		if(mb_strlen($_POST['caption'],"UTF-8")>10){
			$err_msg .= "「キャプション」は10文字以内で入力して下さい。<br />";
		}
	}
	return $err_msg;	
}
function photo_image_upload(){
	//まず画像アップロード対象ディレクトリがあるかどうか確認する
	$dir = $_SERVER['DOCUMENT_ROOT'] . "/pc/login/images/" . $_SESSION['companies_id'];
	if(!file_exists($dir)){
		$cmd = "mkdir " . $dir;
		system($cmd);
	}
        $date = date("YmdHis");
        if( $_POST['image_del'] == "1" ){
                $_SESSION['image_path'] = "";
        }
        if(!empty($_FILES['image_path']["name"])){
                if( preg_match("/^[!-~]+$/", $_FILES['image_path']["name"])){
                        if (is_uploaded_file($_FILES['image_path']["tmp_name"])) {
                                $file_path = $_SERVER['DOCUMENT_ROOT'] . "/pc/login/images/" . $_SESSION['companies_id'] . "/" . $date . "_" . $_FILES['image_path']["name"];
                                $file_url = "/login/images/" . $_SESSION['companies_id'] . "/" . $date . "_" . $_FILES['image_path']["name"];
                                if(move_uploaded_file($_FILES['image_path']["tmp_name"],$file_path)) {
                                        $_SESSION['image_path'] = $file_url;
                                } else {
                                        $err_msg .= "サムネイル画像のアップロードでエラーが発生しました。";
                                        $err_msg .= $file_path;
                                }
                        }
                }else{
                        $err_msg .= "画像のファイル名は半角英数字と記号のみにして下さい。";
                }
	}
        return $err_msg;
}
function photo_insert(){
	$sql = "select";
	$sql .= " max(sort) as sort";
	$sql .= " from";
	$sql .= " photos";
	$sql .= " where";
	$sql .= " companies_id = " . $_SESSION['companies_id'];
	$result = mysql_query( $sql );
	$arr = mysql_fetch_array( $result );
	$sort = $arr['sort'] + 1;

	$sql = "insert into photos (";
	$sql .= " companies_id";
	$sql .= ",image_path";
	$sql .= ",caption";
	$sql .= ",sort";
	$sql .= ",created";
	$sql .= ")values(";
	$sql .= " '" . $_SESSION['companies_id'] . "'";
	$sql .= ",'" . $_SESSION['image_path'] . "'";
	$sql .= ",'" . mysql_real_escape_string( $_POST['caption'] ) . "'";
	$sql .= ",$sort";
	$sql .= ",now()";
	$sql .= ")";
	mysql_query( $sql );
	return;
}
function photo_update_sort($type,$id){
	$now_sort = common_get_value("photos","sort",$id);	//現在のソート順
	if( $type == "up" ){
		$new_sort = $now_sort - 1;			//1つ上のソート順
	}else if( $type == "down" ){
		$new_sort = $now_sort + 1;			//1つ下のソート順
	}
	$other_id = common_get_value("photos","id",$new_sort,"sort");

	//自分のソート順を変更
	$sql = "update photos set";
	$sql .= " sort = $new_sort";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $id;
	mysql_query( $sql );

	//他者のソート順を変更
	$sql = "update photos set";
	$sql .= " sort = $now_sort";
	$sql .= ",modified = now()";
	$sql .= " where";
	$sql .= " id = " . $other_id;
	mysql_query( $sql );
	return;
}
function photo_down(){
	return;
}
function photo_delete(){
	$image_path = $_SERVER['DOCUMENT_ROOT'] . "/pc" . $_POST['image_path'];
	$cmd = "rm -f " . $image_path;
	system( $cmd );

	$sql = "delete from photos where id = " . $_POST['id'];
	mysql_query( $sql );
	return;
}
?>
