<?php include "../../../controller/admin/listings_enquiries/report.php"; ?>
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
	$(".status").chosen();
});
</script>
<script type="text/javascript">
$(function(){
        $(".states_id").chosen();
});
</script>
<script type="text/javascript">
$(function(){
	$(".send_date").chosen();
});
</script>
<script type="text/javascript">
$(function(){
        $('select[name="states_id"]').change(function() {
        var states_id = document.Login.states_id.value;
        $.ajax({
                type: "POST",
                url: "/admin/listings_enquiries/groups.php",
                data:{
                        states_id: states_id,
                },
                cache: false,
                success: function(html){
                        $(".groups_id").html(html);
                }
        });
        })
})
</script>
<script type="text/javascript">
$(document).ready(function(){
        var states_id = document.Login.states_id.value;
        $.ajax({
                type: "POST",
                url: "/admin/listings_enquiries/groups.php",
                data:{
                        states_id: states_id,
                },
                cache: false,
                success: function(html){
                        $(".groups_id").html(html);
                }
        });
});
</script>
</head>
<body>
<div id="wrapper">
<div id="contents">
<?php include "../common/header.php"; ?>
<article id="contBox">
	<h2>Num of Enquiries by Listing</h2>
	<section id="searchBox">
		<form id="Login" name="Login" action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post">
		<p class="arw-folding trigger_search">Search Condition：</p>
		<div class="toggle_search">
			<table>
			<tr>
				<th>Rank</th>
				<th>Parent Company</th>
				<th>Developer id @ Evernote</th>
				<th>Property Name</th>
				<th>Status</th>
				<th>State</th>
				<th>Area Group</th>
				<th>This month</th>
				<th>Charge Type</th>
			</tr>
			<tr>
				<td>
				<select name="rank" />
				<option value=""></option>
<?php
foreach( $companies_rank_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['listings_enquiries_report']['rank'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
				</td>
				<td> <input name="parent_company" value="<?php echo $_SESSION['listings_enquiries_report']['parent_company'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td> <input name="evernote_id" value="<?php echo $_SESSION['listings_enquiries_report']['evernote_id'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td> <input name="name" value="<?php echo $_SESSION['listings_enquiries_report']['name'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td>
				<select name="status" data-placeholder="Please Choose Status..." class="status" />
				<option value=""></option>
<?php
foreach( $listings_status_list as $key => $val ){
	if( $key != "current" && $key != "archived" ){
		continue;
	}
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['listings_enquiries_report']['status'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
				</td>
                                <td>
                                <select name="states_id" data-placeholder="Please Choose State..." class="states_id" />
                                <option value="">Not selected(NULL)</option>
<?php
$result_states = states_index();
while( $arr_states = mysql_fetch_array( $result_states )){
?>
                                <option value="<?php echo $arr_states['id'];?>" class="<?php echo $arr_states['id'];?>" <?php if( $arr_states['id'] == $_SESSION['listings_enquiries_report']['states_id'] ){ echo "selected"; } ?>><?php echo $arr_states['name'];?></option>
<?php
}
?>
                                </select>
                                </td>
                                <td>
                                <select id="groups_id" name="groups_id" class="groups_id" />
                                </select>
                                </td>
				<td> <input name="monthly_enquiry_num" value="<?php echo $_SESSION['listings_enquiries_report']['monthly_enquiry_num'];?>" size="20" id="name1" class="TextInput" type="text" title=""> </td>
				<td>
				<select name="charge_type" />
				<option value=""></option>
<?php
foreach( $listings_charge_type_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['listings_enquiries_report']['charge_type'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
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
                                <th class="unsortable">Rank</th>
                                <th class="unsortable">Parent Company</th>
                                <th class="unsortable">Developer id @ Evernote</th>
                                <th class="unsortable">Property Name</th>
                                <th class="unsortable">Status</th>
                                <th class="unsortable">State</th>
                                <th class="unsortable">Area Group</th>
                                <th class="unsortable">Property type</th>
                                <th class="unsortable">Price Name</th>
                                <th class="unsortable">Search Rank</th>
                                <th class="unsortable">Charge Type</th>
                                <th class="unsortable">fixed fee</th>
                                <th class="unsortable">Call option fee</th>
                                <th class="unsortable">Monthly enquiry limit</th>
                                <th class="unsortable">Service fee</th>
                                <th class="unsortable">4 months ago</th>
                                <th class="unsortable">3 months ago</th>
                                <th class="unsortable">2 months ago</th>
                                <th class="unsortable">Last month</th>
                                <th class="unsortable">This month</th>
			</tr>
<?php
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
                                <td style="font-size:9px;"><?php echo listings_enquiries_report_get_parent_rank($arr);?></td>
                                <td style="font-size:9px;"><a href="/admin/companies/detail.php?id=<?php echo listings_enquiries_report_get_parent_id($arr);?>"><?php echo listings_enquiries_report_get_parent_name($arr);?></a></td>
                                <td style="font-size:9px;"><?php echo $arr['evernote_id'];?></td>
                                <td style="font-size:9px;"><a href="<?php echo listings_get_ui_detail_url($arr['id']);?>" target="_blank"><?php echo $arr['name'];?></a></td>
                                <td style="font-size:9px;"><?php echo $arr['status'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['states_name'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['groups_name'];?></td>
                                <td style="font-size:9px;"><?php echo listings_get_property_type_name($arr['property_types_id']);?></td>
                                <td style="font-size:9px;"><?php echo $arr['price_name'];?></td>
                                <td><?php echo $arr['search_rank'];?></td>
                                <td><?php echo $listings_charge_type_list[$arr['charge_type']];?></td>
                                <td><?php echo $arr['fixed_fee'];?></td>
                                <td><?php echo $arr['call_option_fee'];?></td>
                                <td><?php echo $arr['monthly_enquiry_limit'];?></td>
                                <td><?php echo $arr['service_fee'];?></td>
                                <td><?php echo listings_enquiries_get_send_num($arr['id'],date('Y-m', strtotime('-4 month')));?></td>
                                <td><?php echo listings_enquiries_get_send_num($arr['id'],date('Y-m', strtotime('-3 month')));?></td>
                                <td><?php echo listings_enquiries_get_send_num($arr['id'],date('Y-m', strtotime('-2 month')));?></td>
                                <td><?php echo listings_enquiries_get_send_num($arr['id'],date('Y-m', strtotime('-1 month')));?></td>
                                <td><?php echo listings_enquiries_get_send_num($arr['id'],date('Y-m'));?></td>
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
</body>
</html>
