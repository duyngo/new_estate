<?php include "../../../controller/admin/listings/index.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Listing List</title>
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
	$(".companies_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".developer_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".billing_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".states_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".groups_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".locations_id").chosen();
});
</script>

</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Listing List</h2>
	<section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">Search Condition：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>id</th>
				<th>Developer id @ Evernote</th>
				<th>Name</th>
				<th>State</th>
				<th>Company</th>
				<th>BillCompany</th>
				<th>Status</th>
			</tr>
			<tr>
				<td> <input name="id" value="<?php echo $_SESSION['listings']['id'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td> <input name="evernote_id" value="<?php echo $_SESSION['listings']['evernote_id'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td> <input name="name" value="<?php echo $_SESSION['listings']['name'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
                                <td>
                                <select name="states_id" data-placeholder="Please Choose State..." class="states_id" />
                                <option value="">Not selected(NULL)</option>
                                <option value="notnull" <?php if( $_SESSION['urls']['states_id'] == "notnull" ){ echo "selected"; } ?>>Not NULL</option>
<?php
$result = states_index();
while( $arr = mysql_fetch_array( $result )){
?>
                                <option value="<?php echo $arr['id'];?>" <?php if( $arr['id'] == $_SESSION['listings']['states_id'] ){ echo "selected"; } ?>><?php echo $arr['name'];?></option>
<?php
}
?>
                                </select>
                                </td>
				<td> <input name="companies_id" value="<?php echo $_SESSION['listings']['companies_id'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td> <input name="billing_id" value="<?php echo $_SESSION['listings']['billing_id'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td>
				<select name="status" data-placeholder="Please Choose Status..." class="status" />
				<option value=""></option>
<?php
foreach( $listings_status_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['listings']['status'] ){ echo "selected"; } ?>><?php echo $val;?></option>
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
				<th class="edit unsortable">edit</th>
				<th class="detail unsortable">detail</th>
				<th class="ui unsortable">ui</th>
				<th class="unsortable">id</th>
				<th class="unsortable">Developer id @ Evernote</th>
				<th class="unsortable">Name</th>
				<th class="unsortable">State</th>
				<th class="unsortable">Company</th>
				<th class="unsortable">Bill Company</th>
				<th class="unsortable">Company id</th>
				<th class="unsortable">Status</th>
				<th class="unsortable">Monthly enquiry limit</th>
				<th class="unsortable">Num of Enquiry</th>
				<th class="unsortable">Achieve ment Rate</th>
				<th class="unsortable">Search Rank</th>
				<th class="delete unsortable">delete</th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
		$property_types = NULL;
		$tmp_arr = explode(",",$arr['property_types_id']);
		foreach( $tmp_arr as $key ){
			if(!empty($property_types)){
				$property_types .= ",";
			}
			$property_types .= common_get_value_2("property_types","name",$key,"");
		}
?>
			<tr>
				<td class="edit"><a href="./edit.php?id=<?php echo $arr['id'];?>">edit</a></td>
				<td class="detail"><a href="./detail.php?id=<?php echo $arr['id'];?>">detail</a></td>
				<td class="ui"><a href="<?php echo listings_get_ui_detail_url($arr['id']);?>" target="_blank">UI</a></td>
				<td><?php echo $arr['id'];?></td>
				<td><?php echo $arr['evernote_id'];?></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo common_get_value("states","name",$arr['states_id'],"");?></td>
				<td><?php echo common_get_value("companies","name",$arr['companies_id'],"");?></td>
				<td><?php echo common_get_value("companies","name",$arr['billing_id'],"");?></td>
				<td><?php echo $arr['billing_id'];?></td>
				<td><?php echo $listings_status_list[$arr['status']];?></td>
				<td><?php echo $arr['monthly_enquiry_limit'];?></td>
				<td><?php echo $arr['monthly_enquiry_num'];?></td>
				<td><?php echo $arr['achievement_rate'];?></td>
				<td><?php echo $arr['search_rank'];?></td>
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
