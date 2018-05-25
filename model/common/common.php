<?php
function common_cookie_check(){
	if (empty($_SESSION['members_id'])) {
		if(isset($_COOKIE['newpropertylist']['members_id'])){
			$_SESSION['members_id'] = $_COOKIE['newpropertylist']['members_id'];
			$_SESSION['members_name'] = $_COOKIE['newpropertylist']['members_name'];
		}
	}
	return;
}
function common_login_check(){
	if (empty($_SESSION['companies_id'])) {
		header("Location:/login/login.php");
		exit;
	}
	return;
}
function common_exec_sql( $sql ){
    if( !mysql_query( $sql ) ){
echo $sql;exit;
	common_mysql_error( $sql, $_SERVER['REQUEST_URI']);
    }else{
	return "ok";
    }
}
function common_mysql_error($sql,$uri){

    $subject = "【】SQLエラーが発生しました";
    $comment = "ファイル名：" . $uri . "\n";
    $comment .= "実行クエリー：" . $sql . "\n";
    $comment .= "実行ユーザー：" . $_SESSION['user_id'] . "\n";
    $comment .= "実行ユーザー（クライアント）：" . $_SESSION['contact_id'] . "\n";
    $comment .= "氏名：" . $_SESSION['name1'] . " " . $_SESSION['name1'] . "\n";
    $comment .= "メールアドレス：" . $_SESSION['email'] . "\n";
    $comment .= "TEL：" . common_get_value("contacts","tel",$_SESSION['contact_id']) . "\n";
    common_send_mail( "notohantou555@gmail.com",$subject,$comment );

    header('Location:/admin/error.php');
    exit;
}
function date_exist_check($year,$month,$day)
{
    if( $month == "02")
    {
	if( $day == "29" )
	{
	    if( $year != "2016" && $year != "2020" )
	    {
		$err_msg = "存在しない日付が指定されています。";
	    }

	}
	else if( $day == "30" || $day == "31" )
	{
	    $err_msg = "存在しない日付が指定されています。";
	}
    }
    else if( $month == "04" || $month == "06" || $month == "09" || $month == "11")
    {
	if( $day == "31" ){ $err_msg = "存在しない日付が指定されています。"; }
    }
    return $err_msg;
}
function random_string($length) {
    if($length == ""){$length = 8;}
    $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z"'));
    for ($i = 0; $i < $length; $i++) {
	$r_str .= $str[rand(0, count($str)-1)];
    }
    return $r_str;
}
function common_send_mail( $to,$subject,$body ) {
	$cmd = "/usr/bin/php /home/newpropertylist.my/bin/ses.php \"" . $to . "\" \"" . $subject . "\" \"" . $body . "\"";
	exec($cmd);
	return;
}
function common_get_max( $table ) {
    $sql = "select max(id) as max from $table";
    $result = mysql_query($sql);
    $arr = mysql_fetch_array($result);
    return $arr['max'];
}
function common_get_value( $table,$column,$id,$where ) {
	$rtn = NULL;
	if(empty($where)){
		$where = "id";
	}
	$sql = "select";
	$sql .= " " . $column;
	$sql .= " from";
	$sql .= " " . $table;
	$sql .= " where";
	$sql .= " $where = '" . mysql_real_escape_string( $id ) . "'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)){
		$arr = mysql_fetch_array($result);
		$rtn = $arr[$column];
	}
	return $rtn;
}
function common_get_value_2( $table,$column,$id,$where ) {
	$rtn = NULL;
	if(empty($where)){
		$where = "id";
	}
	$sql = "select";
	$sql .= " " . $column;
	$sql .= " from";
	$sql .= " " . $table;
	$sql .= " where";
	$sql .= " $where = '" . mysql_real_escape_string( $id ) . "'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)){
		$arr = mysql_fetch_array($result);
		$rtn = $arr[$column];
	}
	return $rtn;
}
function common_get_value_all( $table,$id,$where ) {
    if( $where == "" ) {
	$where = "id";
    }
    $sql = "select * from $table where $where = '$id'";
    $result = mysql_query($sql);
    return  mysql_fetch_array($result);
}
function common_get_value_all_2( $table,$column,$condition ) {
	$sql = "select";
	$sql .= " *";
	$sql .= " from";
	$sql .= " $table";
	$sql .= " where";
	$sql .= " $column = '" . mysql_real_escape_string($condition) . "'";
	$sql .= " and";
	$sql .= " is_deleted = 0";
	return mysql_query($sql);
}
function change_date_to_jdate($date,$weekday) {
	$year = substr( $date,0,4);
	$month = substr( $date,5,2);
	$day = substr( $date,8,2);
	setlocale(LC_TIME, "ja_JP.utf8");
	$wday = strftime('%a', strtotime( $date ) );
	$jdate = $year . "年" . $month . "月" . $day . "日";
	if( $weekday == "on" ){
		$jdate .= "（" . $wday . "）";
	}
	return $jdate;
}
function change_datetime_to_jdate($datetime) {
    $year = substr( $datetime,0,4);
    $month = substr( $datetime,5,2);
    $day = substr( $datetime,8,2);
    $hour = substr( $datetime,11,2);
    $minute = substr( $datetime,14,2);
    setlocale(LC_TIME, "ja_JP.utf8");
    $wday = strftime('%a', strtotime( $datetime ) );
    $jdate = $year . "年" . $month . "月" . $day . "日（" . $wday . "）" . $hour . "時" . $minute . "分";
    return $jdate;
}
function common_get_url(){
	$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	return $url;
}
function common_get_weekday($date){
	$weekday = array( '日', '月', '火', '水', '木', '金', '土' );
	return $weekday[date('w',strtotime($date))];
}
function common_get_code( $table_name,$name ){
	$code = hash('SHA256',$table_name . mysql_real_escape_string($name) . date("YmdHis"));
	return $code;
}
function common_getPointsDistance($lat1, $lng1, $lat2, $lng2){
	$pi1 = pi();
	$lat1 = $lat1*$pi1/180;
	$lng1 = $lng1*$pi1/180;
	$lat2 = $lat2*$pi1/180;
	$lng2 = $lng2*$pi1/180;
	$deg = sin($lat1)*sin($lat2) + cos($lat1)*cos($lat2)*cos($lng2-$lng1);
	return round(6378140*(atan2(-$deg,sqrt(-$deg*$deg+1))+$pi1/2), 0);
}
function common_pc_sp(){
	$ua=$_SERVER['HTTP_USER_AGENT'];
	if((strpos($ua,"iPhone")!==false)||(strpos($ua,"Android")!==false)){    //スマホからのアクセスの場合
		if(strpos($_SERVER['REQUEST_URI'],"/sp/")===false){	     //URIに「/sp/」が含まれていない場合
			header('Location:/sp'.$_SERVER['REQUEST_URI']);
			exit();
		}
	}else{								  //PCからのアクセスの場合
		if(strpos($_SERVER['REQUEST_URI'],"/sp/")!==false){	     //URIに「/sp/」が含まれている場合
			header('Location:'.str_replace("/sp","",$_SERVER['REQUEST_URI']));
			exit();
		}
	}
	return;
}
?>
