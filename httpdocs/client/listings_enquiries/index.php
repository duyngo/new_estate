<?php include "../../../controller/client/listings_enquiries/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Enquiries List</title>
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
<script type="text/javascript">
$(function(){
	$(".listings_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".members_id").chosen();
});
</script>

</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Enquiries List</h2>
	<section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">Search Condition：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
			</tr>
			<tr>
				<td>
				<input name="name" value="<?php echo $_SESSION['listings_enquiries']['name'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="email" value="<?php echo $_SESSION['listings_enquiries']['email'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="phone" value="<?php echo $_SESSION['listings_enquiries']['phone'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
			</tr>
			</table>
			<div class="searchBtnBox">
				<p class="searchBtn"><input value="Search" id="submit" type="submit"></p>
			<input type="hidden" name="act" value="search">
			</form>
			<form id="Login2" name="Login2" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
			<p class="resetBtn"><input value="Clear" id="reset" type="submit"></p>
			<input type="hidden" name="act" value="clear">
			</form>
			</div>
		</div>
	</section>
	<section id="resultBox">
		<p class="resultNum">Search Result：<span><?php echo $row_num;?></span>Hit</p>
		<div class="pager">
		<?php include "../common/pager.php"; ?>
		</div>
		<table id="resultTbl" class="resultTbl sortable">
			<tr>
				<th class="unsortable">ID</th>
				<th class="unsortable">Date</th>
				<th class="unsortable">Listings</th>
				<th class="unsortable">Name</th>
				<th class="unsortable">Email</th>
				<th class="unsortable">Phone</th>
				<th class="unsortable">Status</th>
				<th class="unsortable">Remark</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
	if( $arr['status'] == "chargable2" || $arr['status'] == "deducted" ){
		$arr['email'] = "***";
		$arr['phone'] = "***";
	}
?>
			<tr>
				<td><?php echo $arr['id'];?></td>
				<td><?php echo $arr['send_date'];?></td>
				<td><?php echo common_get_value("listings","name",$arr['listings_id'],"");?></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo $arr['email'];?></td>
				<td><?php echo $arr['phone'];?></td>
				<td><?php echo $listings_enquiries_status_list[$arr['status']];?></td>
				<td> <?php if(!empty($arr['message'])){ ?> <a class="help" title="<?php echo str_replace("\n","<br />",$arr['message']);?>"><?php echo substr($arr['message'],0,20);?>...</a> <?php } ?> </td>
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

<script type="text/javascript" src="/admin/js/jquery.balloon.js"></script>
<script type="text/javascript">
$(function() {
    $('.help').balloon({
    tipSize: 24,
    position: "right",
    css: {
            border: 'solid 2px #000000',
            padding: '10px',
            fontSize: '100%',
            fontWeight: 'bold',
            lineHeight: '1',
            backgroundColor: '#000000',
            color: '#FFFFFF'
            }
    });

    $('#pdfToggleButton').click(pdfAreaToggle);
});
</script>

</body>
</html>
