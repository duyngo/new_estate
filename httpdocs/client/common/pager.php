<?php
$tmp_arr = explode("/",$_SERVER['SCRIPT_NAME']);
$tables_name = $tmp_arr[2];
$function = $tables_name . "_index";

//現在自分がいるページ数を設定
if(empty($_REQUEST['page'])){
        $now_page = 1;
}else{
        $now_page = $_REQUEST['page'];
}
//まず対象の総件数を調べる
$result_page = $function();
$row_num_page = mysql_num_rows( $result_page );

//総ページ数を調べる
$page_num = 0;
if($row_num_page){
	$page_num = ceil($row_num_page/$lines);
}

$start = (($now_page-1) * $lines) + 1;

//最終ページのみ、「件を表示しています」の表示件数が異なる
if( $now_page == $page_num ){
        $end = $row_num_page;
}else{
        $end = ($now_page) * $lines;
}
//ページネーションの先頭ページを求める
if( $page_num >= ($now_page + 9) ){
        $start_page = $now_page;
}else{
        if( ($page_num - 8) > 0 ){
                $start_page = $page_num - 8;
        }else{
                $start_page = 1;
        }
}
if( $page_num > ($start_page + 9) ){
        $end_page = $start_page + 9;
}else{
        $end_page = $page_num;
}
?>

                        <ul>
<?php
if( $start_page != 1 ){
        $previous_page = $start_page - 1;
?>
	<li class="prev"><a href="<?php echo $_SERVER['SCRIPT_NAME'];?>?page=<?php echo $previous_page;?>">前へ</a></li>
<?php
}
?>

<?php
        $i=0;
        for($page=$start_page;$page<=$page_num;$page++) {
                $class = NULL;
                if(empty($_REQUEST['page'])){
                        if( $page == 1 ){
                                $class = "stay";
                        }
                }else{
                        if( $page == $_REQUEST['page'] ){
                                $class = "stay";
                        }
                }
		if( $class == "stay" ){
?>
                                <li class="<?php echo $class;?>"><?php echo $page;?></li>
<?php
		}else{
?>
                                <li><a href="<?php echo $_SERVER['SCRIPT_NAME'];?>?page=<?php echo $page;?>"><?php echo $page;?></a></li>
<?php
		}
                $i++;
                if( $i == 9 ){
                        break;
                }
        }
?>


<?php
if( $end_page != $page_num ){
        $next_page = $now_page + 1;
?>
	<li class="next"><a href="<?php echo $_SERVER['SCRIPT_NAME'];?>?page=<?php echo $next_page;?>">次へ</a></li>
<?php
}
?>
                        </ul>
