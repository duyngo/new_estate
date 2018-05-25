<?php include "../../../controller/admin/listings_enquiries/index.php"; ?>
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
	$(".send_date").chosen();
});
</script>

</head>
<body onload="ajax_add_listings_arr('');">
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
				<th>id</th>
				<th>Listings</th>
				<th>Status</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>SendDate</th>
			</tr>
			<tr>
				<td>
				<input name="id" value="<?php echo $_SESSION['listings_enquiries']['id'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="listings_id" value="<?php echo $_SESSION['listings_enquiries']['listings_id'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<select name="status" data-placeholder="Please Choose Status..." class="status" />
				<option value=""></option>
<?php
foreach( $listings_enquiries_status_list as $key => $val ){
?>
				<option value="<?php echo $key;?>" <?php if( $key == $_SESSION['listings_enquiries']['status'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
				</select>
				</td>
				<td>
				<input name="name" value="<?php echo $_SESSION['listings_enquiries']['name'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="email" value="<?php echo $_SESSION['listings_enquiries']['email'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<input name="phone" value="<?php echo $_SESSION['listings_enquiries']['phone'];?>" size="20" id="name1" class="TextInput" type="text" title="">
				</td>
				<td>
				<select name="send_date" />
				<option value=""></option>
<?php
$result_sd = listings_enquiries_send_date_index();
while( $arr_sd = mysql_fetch_array( $result_sd )){
?>
				<option value="<?php echo $arr_sd['send_date']?>" <?php if( $arr_sd['send_date'] == $_SESSION['listings_enquiries']['send_date'] ){ echo "selected"; } ?>><?php echo $arr_sd['send_date'];?></option>
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
		<div class="pager">
		<?php include "../common/pager.php"; ?>
		</div>
<div class="test"></div>
		<table id="resultTbl" class="resultTbl sortable">
			<tr>
                                <th class="unsortable">Enquiry Date</th>
                                <th class="unsortable">Name</th>
                                <th class="unsortable">Email</th>
                                <th class="unsortable">Phone</th>
                                <th class="unsortable">Remarks</th>
                                <th class="unsortable">Status</th>
                                <th class="unsortable">Send Date</th>
                                <th class="unsortable">id</th>
                                <th class="unsortable">Listings</th>
                                <th class="unsortable">State</th>
                                <th class="unsortable">Area Group</th>
                                <th class="unsortable">Property Name</th>
                                <th class="unsortable">Price Name</th>
                                <th class="unsortable">Billing company</th>
                                <th class="unsortable">Company id</th>
                                <th class="unsortable">Service Fee</th>
                                <th class="unsortable">Num of  Enquiries sent (Monthly Limit)</th>
                                <th class="unsortable">Charge Type</th>
                                <th class="unsortable">Grand total of Enquiries</th>
                                <th class="unsortable">Num of times</th>
                                <th class="delete unsortable">delete</th>
                                <th class="delete unsortable"></th>
			</tr>
<?php
$result = $index( $lines );
if(mysql_num_rows($result)){
	while( $arr = mysql_fetch_array( $result )){
?>
			<tr>
                                <td style="font-size:9px;"><?php echo substr($arr['created'],5,11);?></td>
                                <td style="font-size:9px;"><?php echo $arr['name'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['email'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['phone'];?></td>
				<td style="font-size:9px;"> <?php if(!empty($arr['message'])){ ?> <a class="help" title="<?php echo str_replace("\n","<br />",$arr['message']);?>"><?php echo substr($arr['message'],0,20);?>...</a> <?php } ?> </td>
                                <td style="font-size:9px;">
                                <select name="status" onChange="location.href=value;"/>
<?php
foreach( $listings_enquiries_status_list as $key => $val ){
?>
                                <option value="<?php echo $_SERVER['REQUEST_URI'];?>/index.php?act=update_status&id=<?php echo $arr['id'];?>&status=<?php echo $key;?>" <?php if( $key == $arr['status'] ){ echo "selected"; } ?>><?php echo $val;?></option>
<?php
}
?>
                                </select>
				</td>
                                <td style="font-size:9px;">
<?php
if( $arr['send_date'] == "0000-00-00 00:00:00" ){
?>
	<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>" method="post" />
	<input type="submit" value="Send Mail" style="color:white;background-color:gray;" >
	<input type="hidden" name="act" value="send_mail">
	<input type="hidden" name="id" value="<?php echo $arr['id'];?>">
	<input type="hidden" name="listings_id" value="<?php echo $arr['listings_id'];?>">
	</form>
<?php
}else{
	echo substr($arr['send_date'],5,11);
}
?>
</td>
                                <td style="font-size:9px;"><?php echo $arr['id'];?></td>
                                <td style="font-size:9px;"><a href="/admin/listings/detail.php?id=<?php echo $arr['listings_id'];?>"><?php echo common_get_value("listings","name",$arr['listings_id'],"");?></a></td>
                                <td style="font-size:9px;"><?php echo $arr['states_name'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['groups_name'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['property_name'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['price_name'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['billing_name'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['billing_id'];?></td>
                                <td style="font-size:9px;"><?php echo $arr['service_fee'];?></td>
                                <td><?php echo listings_enquiries_get_send_num($arr['listings_id'],date("Y-m"));?>(<?php echo $arr['monthly_enquiry_limit'];?>)</td>
                                <td style="font-size:9px;"><?php echo $arr['charge_type'];?></td>
                                <td><?php echo listings_enquiries_get_send_num($arr['listings_id'],"");?></td>
                                <td><?php echo listings_enquiries_get_num_of_times($arr['listings_id'],$arr['email'],$arr['phone'],$arr['created']);?></td>
                                <td class="delete"><a href="./index.php?act=delete&id=<?php echo $arr['id'];?>" onclick="return delete_check();">delete</a></td>
                                <td><input type="checkbox" onclick="ajax_add_listings_arr(<?php echo $arr['id'];?>);"></td>
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
function send_mail_check(){
	res=confirm("Do you want to send mail to client?")
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
<script language="Javascript">
<!--
function ajax_add_listings_arr(listings_id){
        $.ajax({
                type: "POST",
                url: "/admin/ajax/add_listings_arr.php",
                data:{
                        listings_id:listings_id,
                },
                cache: false,
                success: function(html){
                        $(".test").html(html);
                }
        });
}
//-->
</script>
</body>
</html>
