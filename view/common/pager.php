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
if( $page_num > 1 ){
?>

<?php
if( $now_page != 1 ){
        $previous_page = $now_page - 1;
?>
<!--a href="<?php echo $href;?>/page:<?php echo $previous_page;?>">Prev</a-->
                <li class="MdSAC03Cell01">
                  <div class="prev">
                    <a href="<?php echo $href;?>/page:<?php echo $previous_page;?>"><span></span></a>
                  </div>
                </li>
 


<?php
}
$i=0;
for($page=$start_page;$page<=$page_num;$page++){
	$i++;
	if( $page != $now_page ){
?>
		<li class="MdSAC03Cell01"><a href="<?php echo $href;?>/page:<?php echo $page;?>"><?php echo $page;?></a></li>
<?php }else{ ?>
		<li class="MdSAC03Cell01"><a class="ExActive" href="#"><?php echo $page;?></a></li>
<?php
	}
	if( $i == 15 ){
		break;
	}
}
if( $now_page != $page_num ){
        $next_page = $now_page + 1;
?>
<li class="MdSAC03Cell01">
<div class="next">
<a href="<?php echo $href;?>/page:<?php echo $next_page;?>"><span></span></a>
</div>
</li>
<?php
}
?>

<?php
}
?>
