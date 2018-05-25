<?php
include $_SERVER['BASE_DIR'] ."/controller/admin/users/index.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $tables_logical_name;?> List</title>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="">
<link rel="stylesheet" href="/admin/css/import.css">
<script src="/admin/js/common.js"></script>
<script type="text/javascript" language="javascript" src="/admin/js/jquery.dropdownPlain.js"></script>
<script type="text/javascript" src="/admin/js/jquery.js"></script>
<script type="text/javascript" src="/admin/js/placeholder.js"></script>
<script type="text/javascript" src="/admin/js/sortable.js"></script>
<script type="text/javascript" src="/admin/js/function.js"></script>
<!--[if lt IE 9]>
<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!--[if IE 6]>
<script src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script>
DD_belatedPNG.fix('img, .png');
</script>
<![endif]-->
</head>
<body>
<div id="wrapper">
<div id="contents">
<?php
include "../common/header.php";
?>
<article id="contBox">
	<h2><?php echo $tables_logical_name;?> List</h2>
	<!--section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">検索条件：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>クライアント名：</th>
				<th>ブランド名：</th>
				<th>商品カテゴリ：</th>
			</tr>
			<tr>
				<td><input name="client_name" value="<?php echo $_SESSION['client_name'];?>" size="50" id="name1" class="TextInput" type="text"></td>
				<td><input name="brand_name" value="<?php echo $_SESSION['brand_name'];?>" size="50" id="name1" class="TextInput" type="text"></td>
				<td>
				<select name="item_category">
				<option value="">選択して下さい</option>
				</select>
				</td>
			</tr>
			<tr>
				<th>媒体名：</th>
			</tr>
			<tr>
				<td><input name="media_name" value="<?php echo $_SESSION['media_name'];?>" size="50" id="name1" class="TextInput" type="text"></td>
			</tr>
			</table>
			<div class="searchBtnBox">
				<p class="searchBtn"><input value="この条件で検索する" id="submit" type="submit"></p>
		<input type="hidden" name="act" value="search">
		</form>
				<form id="Login2" name="Login2" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
				<p class="resetBtn"><input value="検索条件をクリアする" id="reset" type="submit"></p>
				<input type="hidden" name="act" value="clear">
				</form>
			</div>
		</div>
	</section-->

	<section id="resultBox">
		<p class="resultNum">SearchResult：<span><?php echo mysql_num_rows($result);?></span>Hit</p>
		<form action="./edit.php" method="post">
		<p class="registBtn">
		<input value="Add" id="submit" type="submit">
		</p>
		</form>
		<div class="pager">
<?php
include "../common/pager.php";
?>
		</div>


<!--script src="/js/jquery.grid.core.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(function($){
var t=$("#resultTbl");
	t.grid({			
			navigate:{
				maintainSelection:false
			},
			scroll:{
				width:"1200",   //横幅
				//height:"600",  //高さ
				height:"auto",  //高さ
				colWidths:[100,250,250,300,100,100,50]　　//項目の幅
			},
			stripe:false,  //ストライプ
			columnResize:false  //項目のスライド
		});
});
</script-->


		<table id="resultTbl" class="resultTbl sortable">
			<!--thead-->
			<tr>
				<th class="id unsortable">No.</th>
				<th class="edit unsortable">edit</th>
				<th class="name unsortable">Email</th>
				<th class="first_name unsortable">FirstName</th>
				<th class="last_name unsortable">LastName</th>
			</tr>
			<!--/thead-->
			<!--tbody-->
<?php
if(mysql_num_rows($result)){
	$i=0;
	while( $arr = mysql_fetch_array( $result )){
		$i++;
?>
			<tr>
				<td class="id aC"><?php echo $arr['id'];?></td>
				<td class="edit"><a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a></td>
				<td class="name"><?php echo $arr['email'];?></td>
				<td class="name"><?php echo $arr['first_name'];?></td>
				<td class="name"><?php echo $arr['last_name'];?></td>
			</tr>
<?php
	}
}
?>
			<!--/tbody-->
		</table>

		<div class="pager" style="margin-top:15px;">
<?php
include "../common/pager.php";
?>
		</div>
	</section>


<div id="pagetop"><a href="#wrapper"><img src="/admin/images/pagetop.gif" alt="ページトップへ" width="50" height="50"></a></div>

</article>

</div><!--contents-->

<?php include "../common/footer.php"; ?>

</div><!--wrapper-->

<!-- SCRIPTS -->
<script type="text/javascript" src="/admin/js/jquery-1.3.1.min.js"></script>	
</body>
</html>
