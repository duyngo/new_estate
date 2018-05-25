<?php include "/home/newpropertylist.my/controller/admin/sizes/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Size List</title>
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
<script type="text/javascript" src="/admin/js/jquery-1.9.1.min.js"></script>
<script src="/admin/js/chosen.jquery.js"></script>

</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Size List</h2>
	<section id="resultBox">
		<p class="resultNum">Search Result：<span><?php echo $row_num;?></span>Hit</p>
		<form action="./edit.php" method="post">
		<p class="registBtn">
		<input value="Add" id="submit" type="submit">
		</p>
		</form>
		<div class="pager">
		<?php include "../common/pager.php"; ?>
		</div>
		<table id="resultTbl" class="resultTbl sortable">
			<tr>
				<th class="edit unsortable">edit</th>
				<th class="unsortable">Name</th>
				<th class="unsortable">Code(Url)</th>
				<th class="unsortable">sort</th>
				<th class="delete unsortable">delete</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
				<td class="edit"><a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo $arr['code'];?></td>
				<td><?php echo $arr['sort'];?></td>
				<td class="delete"><a href="./index.php?act=delete&id=<?php echo $arr['id'];?>" onclick="return delete_check();">delete</a></td>
			</tr>
<?php
	}
}
?>
		</table>
		<div class="pager" style="margin-top:15px;">
		<?php include "../common/pager.php"; ?>
		</div>
	</section>
<div id="pagetop"><a href="#wrapper"><img src="/admin/images/pagetop.gif" alt="ページトップへ" width="50" height="50"></a></div>
</article>
</div><!--contents-->
<?php include "../common/footer.php"; ?>
</div><!--wrapper-->
<!-- SCRIPTS -->
<!--script type="text/javascript" src="/admin/js/jquery-1.3.1.min.js"></script-->
<script language="Javascript">
<!--
function delete_check(){
	res=confirm("Do you want to delete?")
	if(res == false){ return false; }
}
//-->
</script>
</body>
</html>
