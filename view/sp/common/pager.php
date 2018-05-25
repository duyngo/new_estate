<?php
//$href = str_replace("index.php","",$_SERVER['SCRIPT_NAME']);
$tmp_arr = explode("page:",$_SERVER['REQUEST_URI']);
$href = $tmp_arr[0];
$href = rtrim($href,"/");
//$now_pageは各コントローラーで取得している

//総ページ数を調べる
$page_num = 0;
if($row_num_pager){
        $page_num = ceil($row_num_pager/$limit);
}

$start = (($now_page-1) * $limit) + 1;

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
if( $now_page != 1 ){
	$previous_page = $now_page - 1;
}
if( $now_page != $page_num ){
	$next_page = $now_page + 1;
}
?>
        <div class="mdSAC02NavBox center">
          <div class="mdSAC02ItemNum center"><?php echo $now_page;?> / <?php echo $page_num;?> page</div>
<?php if( $now_page > 1 ){ ?>
            <a href="<?php echo $href;?>/page:<?php echo $previous_page;?>"><button class="mdSAC02Btn left hidden"><span></span></button></a>
<?php }else{ ?>
            <button class="mdSAC02Btn left hidden"><span></span></button>
<?php } ?>
<?php if( $now_page < $page_num ){ ?>
            <a href="<?php echo $href;?>/page:<?php echo $next_page;?>"><button class="mdSAC02Btn right"><span></span></button></a>
<?php } ?>
        </div>
