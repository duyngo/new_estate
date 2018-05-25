<?php include "/home/newpropertylist.my/controller/admin/enquiry_report_master/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Enquiry Report</title>
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
        $(".states_id").chosen();
});
</script>

</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Enquiry Report</h2>
        <section id="searchBox">
                <form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
                <p class="arw-folding trigger_search">Search Condition：</p>
                <div class="toggle_search">
                        <table>
                        <tr>
                                <th>State</th>
                        </tr>
                        <tr>
                                <td>
                                <select name="states_id" data-placeholder="Please Choose State..." class="states_id" />
                                <option value="">Not selected(NULL)</option>
<?php
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
?>
                                <option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_SESSION['enquiry_report_master']['states_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?></option>
<?php
}
?>
                                </select>
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
				<th class="unsortable">State</th>
				<th class="unsortable">Area Group</th>
				<th class="unsortable">Property Type Group</th>
				<th class="unsortable">Ave Num of Enquiries</th>
				<th class="unsortable">Num of Enquiries</th>
				<th class="unsortable">Num of Listings</th>
<?php
for($i=1;$i<date("d");$i++){
?>
				<th class="unsortable"><?php echo $i;?></th>
<?php
}
?>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
		if( $arr['states_id'] == 0 ){
			$arr['states_name'] = "All State";
		}
?>
			<tr>
				<td><?php echo $arr['states_name'];?></td>
				<td><?php echo $arr['groups_name'];?></td>
				<td><?php echo $arr['property_type_groups_name'];?></td>
				<td><?php echo $arr['average_enquiries_num'];?></td>
				<td><?php echo $arr['enquiries_num'];?></td>
				<td><?php echo $arr['listings_num'];?></td>
<?php
for($i=1;$i<date("d");$i++){
	$date = date("Y-m") . "-" . $i;
?>
				<td><?php echo enquiry_report_daily_index($arr['id'],$date);?></td>
<?php
}
?>
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
