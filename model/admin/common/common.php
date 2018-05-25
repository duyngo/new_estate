<?php
function admin_common_login_check(){
	if(empty($_SESSION['users_id'])) {
		$tmp_arr = explode(".",$_SERVER['SERVER_NAME']);
		$cookie = $tmp_arr[0] . "_admin";
		if(isset($_COOKIE[$cookie])){
			$tmp_arr = explode(",",$_COOKIE[$cookie]);
			$_SESSION['users_id'] = $tmp_arr[0];
			$_SESSION['users_name'] = $tmp_arr[4];
		}else{
			header("Location:/admin/login/");
			exit;
		}
	}
	return;
}
function admin_common_cookie_check(){
	if (empty($_SESSION['users_id'])) {
		if(isset($_COOKIE[$_SERVER['SERVER_NAME']])){
			$tmp_arr = explode(",",$_COOKIE[$_SERVER['SERVER_NAME']]);
			$_SESSION['users_id'] = $tmp_arr[0];
			$_SESSION['users_name'] = $tmp_arr[4];
		}
	}
	return;
}
function admin_common_image_upload( $tables_name,$column_name ){
	$err_msg = NULL;
	$date = date("YmdHis");
//		if( preg_match("/^[!-~]+$/", $_FILES[$column_name]["name"])){
	if (is_uploaded_file($_FILES[$column_name]["tmp_name"])) {
		$file_name = str_replace(" ","",$_FILES[$column_name]["name"]);
		$file_name = str_replace("(","",$file_name);
		$file_name = str_replace(")","",$file_name);
		$file_path = $_SERVER['DOCUMENT_ROOT'] . "/admin/images/" . $tables_name . "/" . $date . "_" . $file_name;

		if(empty($err_msg)){
			$file_url = $date . "_" . $file_name;
			if(move_uploaded_file($_FILES[$column_name]["tmp_name"],$file_path)) {

				if($tables_name == "listings" && $column_name == "main_picture"){
					$imginfo = getimagesize($file_path);
					if( $imginfo[0] != 600 || $imginfo[1] != 450 ){
						$err_msg .= "Main Picture required width:600 and height:450.";
					}
				}
				if(empty($err_msg)){
					$_SESSION[$tables_name][$column_name] = $file_url;
					if(strpos($file_name,".png")!==false || strpos($file_name,".PNG")!==false ){
						$cmd = "/usr/local/bin/optipng " . $file_path;
						system($cmd);
					}else if(strpos($file_name,".jpg")!==false || strpos($file_name,".JPG")!==false ){
						$cmd = "/usr/local/bin/jpegoptim --strip-all " . $file_path;
						exec($cmd);
					}
				}
			} else {
				$err_msg .= "Image Upload Error.";
			}
		}
	}
//		}else{
//			$err_msg .= "Please upload file which name is using half-width characters.";
//		}



	if(empty($err_msg)){

	if( ($tables_name == "listings" && $column_name == "main_picture") || ($tables_name == "listings_photos" && $column_name == "image_path")){
		if( $_POST['water'] == "on" ){
			if(strpos($file_name,".png")!==false || strpos($file_name,".PNG")!==false ){
				$new_image = imagecreatefrompng( $file_path );
			}else if(strpos($file_name,".jpg")!==false || strpos($file_name,".JPG")!==false ){
				$new_image = imagecreatefromjpeg( $file_path );
			}
			//合成元画像のサイズを取得
			$new_image_width = imagesx($new_image);
			$new_image_height = imagesy($new_image);

			//合成用画像
			$new_logo = imagecreatefrompng('/home/newpropertylist.my/httpdocs/img/water.png');
			$logo_W = 300;
			$logo_H = 30;

			//ウォーターマークの配置場所を計算
			$x = ($new_image_width - $logo_W)/2;
			$y = ($new_image_height - $logo_H)/2;

			//合成する
			imagecopy($new_image, $new_logo,$x,$y,0,0, $logo_W, $logo_H);
			if(strpos($file_name,".png")!==false || strpos($file_name,".PNG")!==false ){
				imagepng($new_image,$file_path);	//pngとしてサーバーに画像吐き出し
			}else if(strpos($file_name,".jpg")!==false || strpos($file_name,".JPG")!==false ){
				imagejpeg($new_image,$file_path);
			}
			imagedestroy($new_image);			//メモリ開放
		}

		//-----以下処理は正方形画像の生成-----
		if( $tables_name == "listings" && $column_name == "main_picture" ){
			$file_path2 = $_SERVER['DOCUMENT_ROOT'] . "/admin/images/" . $tables_name . "/sq_" . $date . "_" . $file_name;
			$dest = imagecreatetruecolor(450, 450);	 //空白のキャンバスを生成
			if(strpos($file_name,".png")!==false || strpos($file_name,".PNG")!==false ){
				$src = imagecreatefrompng($file_path);		//ウォーターマーク合成済の画像を元にイメージ生成
				imagecopy($dest, $src, 0, 0, 75, 0, 450, 450);	//ウォーターマーク合成済の画像の一部を空白のキャンバスに合成
				imagepng($dest,$file_path2);			//pngとしてサーバーに画像吐き出し
			}else if(strpos($file_name,".jpg")!==false || strpos($file_name,".JPG")!==false ){
				$src = imagecreatefromjpeg($file_path);		//ウォーターマーク合成済の画像を元にイメージ生成
				imagecopy($dest, $src, 0, 0, 75, 0, 450, 450);	//ウォーターマーク合成済の画像の一部を空白のキャンバスに合成
				imagejpeg($dest,$file_path2);			//jpgとしてサーバーに画像吐き出し
			}
			//メモリ開放
			imagedestroy($dest);
			imagedestroy($src);
		}
	}else if( ($tables_name == "listings" && $column_name == "image_path") || $tables_name == "companies" || $tables_name == "listings_project_details" ){
		if(strpos($file_name,".png")!==false || strpos($file_name,".PNG")!==false ){
			$new_image = imagecreatefrompng( $file_path );
		}else if(strpos($file_name,".jpg")!==false || strpos($file_name,".JPG")!==false ){
			$new_image = imagecreatefromjpeg( $file_path );
		}
		//合成元画像のサイズを取得
		$new_image_width = imagesx($new_image);
		$new_image_height = imagesy($new_image);

		if( $new_image_width > $new_image_height ){
			$length = $new_image_width;
			$x = 0;
			$y = ( $new_image_width - $new_image_height )/2;
		}else{
			$length = $new_image_height;
			$x = ( $new_image_height - $new_image_width )/2;
			$y = 0;
		}

		$dest = imagecreatetruecolor($length,$length);   //空白のキャンバスを生成（デフォルトの背景色は黒）
		imagefill($dest,0,0,0xFFFFFF);		  //キャンバスを白で塗りつぶす

		if(strpos($file_name,".png")!==false || strpos($file_name,".PNG")!==false ){
			imagecopy($dest, $new_image, $x, $y, 0, 0, $new_image_width, $new_image_height);  //元画像を空白のキャンバスに合成
			imagepng($dest,$file_path);		 //pngとしてサーバーに画像吐き出し
		}else if(strpos($file_name,".jpg")!==false || strpos($file_name,".JPG")!==false ){
			imagecopy($dest, $new_image, $x, $y, 0, 0, $new_image_width, $new_image_height);  //元画像を空白のキャンバスに合成
			imagejpeg($dest,$file_path);	       //jpgとしてサーバーに画像吐き出し
		}
		//メモリ開放
		imagedestroy($new_image);
		imagedestroy($dest);
	}
	}
	return $err_msg;
}
function admin_common_image_delete( $tables_name,$column_name,$file_path ){
	$_SESSION[$tables_name][$column_name] = NULL;
	if(!empty($file_path)){
		$cmd = "rm -f " . $_SERVER['BASE_DIR'] . "/httpdocs/admin/images/" . $tables_name . "/" . $file_path;
		exec($cmd);

		if( $tables_name == "listings" && $column_name = "main_picture" ){
			//正方形に加工した画像を自動生成しているのでそれも削除する
			$cmd = "rm -f " . $_SERVER['BASE_DIR'] . "/httpdocs/admin/images/" . $tables_name . "/sq_" . $file_path;
			exec($cmd);
		}
	}
	return;
}
function admin_common_get_name_from_csv($arr,$tables_name){
	$name_arr = array();
	foreach( $arr as $key ){
		$name_arr[] = common_get_value($tables_name,"name",$key,"");
	}
	return implode(",",$name_arr);
}
function admin_common_get_image_width($tables_name,$image_path){
	$rtn = NULL;
	$file_path = $_SERVER['DOCUMENT_ROOT'] . "/admin/images/" . $tables_name . "/" . $image_path;
	$imginfo = getimagesize($file_path);
	$width = $imginfo[0];
	if($width<100){
		$rtn = $width;
	}else{
		$rtn = 100;
	}
	return $rtn;
}
?>
