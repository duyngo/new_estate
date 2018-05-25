<?php
include "../../../controller/admin/listings/detail.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $tables_logical_name;?> detail｜romancrew CMS</title>
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
</head>
<body>
<div id="wrapper">
<div id="contents">
<?php
include "../common/header.php";
?>
<article id="contBox">
<h2><?php echo $tables_logical_name;?> detail</h2>
<section id="detailInfoBox">
<dl>
<dt><?php echo $arr['name'];?><a href="./edit.php?id=<?php echo $_REQUEST['id'];?>"><input value="edit" id="button" type="submit" class="editbtn"></a></dt>
<dd><?php echo $arr['logical_name'];?></dd>
</dl>
</section>
<div class="itemchange-box clearfix">
<ul id="tab">
<li class="<?php if( empty($_REQUEST['tab']) || $_REQUEST['tab'] == "listings_photos" ){ echo "select"; } ?>">Images</li>
<li class="<?php if( $_REQUEST['tab'] == "listings_project_details" ){ echo "select"; } ?>">project details</li>
<li class="<?php if( $_REQUEST['tab'] == "listings_plans" ){ echo "select"; } ?>">Plans</li>
<li class="<?php if( $_REQUEST['tab'] == "listings_amenities" ){ echo "select"; } ?>">Amenities</li>
<li class="<?php if( $_REQUEST['tab'] == "listings_enquiries" ){ echo "select"; } ?>">Enquiries</li>
</ul>
</div>



<!-- (( Images -->
<div class="content_wrap<?php if( !empty($_REQUEST['tab']) && $_REQUEST['tab'] != "listings_photos" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Images List</p>
<p class="link"><a href="/admin/listings_photos/edit.php?listings_id=<?php echo $_REQUEST['id'];?>&tab=listings_photos">Images Add</a></p>
</div>
<!-- (( comp-table -->
<div id="comp-table">
<section id="resultBox">
<!--section id="searchBox">
<form id="Login" name="Login" action="#" method="post">
<p class="arw-folding trigger_search">SearchCondition：</p>
<div class="toggle_search">
<table>
<tr>
<th>氏名：</th>
<th>メールアドレス：</th>
<th></th>
</tr>
<tr>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td></td>
</tr>
</table>
<div class="searchBtnBox">
<p class="searchBtn"><input value="Search" id="submit" type="submit"></p>
<p class="resetBtn"><input value="Clear" id="reset" type="reset"></p>
</div>
</div>
</form>
</section-->
<?php
$result = listings_listings_photos_index( $_REQUEST['id'] );
?>
<p class="resultNum">SearchResult：<span><?php echo mysql_num_rows( $result );?></span>件</p>
<!--p class="registBtn"><input value="Add" id="submit" type="submit"></p-->
<div class="pager">
<!--ul>
<li class="prev"><a href="#">Prev</a></li>
<li class="stay">1</li>
<li><a href="#">2</a></li>
<li class="next"><a href="#">Next</a></li>
</ul-->
</div>
<table id="resultTbl" class="resultTbl sortable">
<thead>
<tr>
	<th class="edit unsortable">edit</th>
	<th class="unsortable">Photo</th>
	<th class="unsortable">caption</th>
	<th class="unsortable">Sort</th>
	<th class="unsortable">Display Flag</th>
	<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/listings_photos/edit.php?id=<?php echo $arr['id'];?>&tab=listings_photos">edit</a></td>
				<td><?php if(!empty($arr['image_path'])){ ?><img src="/admin/images/listings_photos/<?php echo $arr['image_path'];?>" width="100" height="auto"><?php } ?></td>
				<td><?php echo str_replace("\n","<br />",$arr['caption']);?></td>
				<td><?php echo $arr['sort'];?></td>
				<td><?php echo $listings_photos_display_flag_list[$arr['display_flag']];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=listings_photos_delete&listings_photos_id=<?php echo $arr['id'];?>&image_path=<?php echo $arr['image_path'];?>&tab=listings_photos" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Images -->



<!-- (( project details -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "listings_project_details" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">project details List</p>
<p class="link"><a href="/admin/listings_project_details/edit.php?listings_id=<?php echo $_REQUEST['id'];?>&tab=listings_project_details">project details Add</a></p>
</div>
<!-- (( comp-table -->
<div id="comp-table">
<section id="resultBox">
<!--section id="searchBox">
<form id="Login" name="Login" action="#" method="post">
<p class="arw-folding trigger_search">SearchCondition：</p>
<div class="toggle_search">
<table>
<tr>
<th>氏名：</th>
<th>メールアドレス：</th>
<th></th>
</tr>
<tr>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td></td>
</tr>
</table>
<div class="searchBtnBox">
<p class="searchBtn"><input value="Search" id="submit" type="submit"></p>
<p class="resetBtn"><input value="Clear" id="reset" type="reset"></p>
</div>
</div>
</form>
</section-->
<?php
$result = listings_listings_project_details_index( $_REQUEST['id'] );
?>
<p class="resultNum">SearchResult：<span><?php echo mysql_num_rows( $result );?></span>件</p>
<!--p class="registBtn"><input value="Add" id="submit" type="submit"></p-->
<div class="pager">
<!--ul>
<li class="prev"><a href="#">Prev</a></li>
<li class="stay">1</li>
<li><a href="#">2</a></li>
<li class="next"><a href="#">Next</a></li>
</ul-->
</div>
<table id="resultTbl" class="resultTbl sortable">
<thead>
<tr>
<th class="edit unsortable">edit</th>
				<th class="unsortable">Head</th>
				<th class="unsortable">Body</th>
				<th class="unsortable">Sort</th>
				<th class="unsortable">Display Flag</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/listings_project_details/edit.php?id=<?php echo $arr['id'];?>&tab=listings_project_details">edit</a></td>
				<td><?php echo $arr['head'];?></td>
				<td><?php echo str_replace("\n","<br />",$arr['body']);?></td>
				<td><?php echo $arr['sort'];?></td>
				<td><?php echo $listings_project_details_display_flag_list[$arr['display_flag']];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=listings_project_details_delete&listings_project_details_id=<?php echo $arr['id'];?>&image_path=<?php echo $arr['image_path'];?>&tab=listings_project_details" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) project details -->



<!-- (( Plans -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "listings_plans" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Plans List</p>
<p class="link"><a href="/admin/listings_plans/edit.php?listings_id=<?php echo $_REQUEST['id'];?>&tab=listings_plans">Plans Add</a></p>
</div>
<!-- (( comp-table -->
<div id="comp-table">
<section id="resultBox">
<!--section id="searchBox">
<form id="Login" name="Login" action="#" method="post">
<p class="arw-folding trigger_search">SearchCondition：</p>
<div class="toggle_search">
<table>
<tr>
<th>氏名：</th>
<th>メールアドレス：</th>
<th></th>
</tr>
<tr>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td></td>
</tr>
</table>
<div class="searchBtnBox">
<p class="searchBtn"><input value="Search" id="submit" type="submit"></p>
<p class="resetBtn"><input value="Clear" id="reset" type="reset"></p>
</div>
</div>
</form>
</section-->
<?php
$result = listings_listings_plans_index( $_REQUEST['id'] );
?>
<p class="resultNum">SearchResult：<span><?php echo mysql_num_rows( $result );?></span>件</p>
<!--p class="registBtn"><input value="Add" id="submit" type="submit"></p-->
<div class="pager">
<!--ul>
<li class="prev"><a href="#">Prev</a></li>
<li class="stay">1</li>
<li><a href="#">2</a></li>
<li class="next"><a href="#">Next</a></li>
</ul-->
</div>
<table id="resultTbl" class="resultTbl sortable">
<thead>
<tr>
<th class="edit unsortable">edit</th>
				<th class="unsortable">Name</th>
				<th class="unsortable">Image</th>
				<th class="unsortable">Sort</th>
				<th class="unsortable">Display Flag</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/listings_plans/edit.php?id=<?php echo $arr['id'];?>&tab=listings_plans">edit</a></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php if(!empty($arr['image_path'])){ ?><img src="/admin/images/listings_plans/<?php echo $arr['image_path'];?>" width="100" height="auto"><?php } ?></td>
				<td><?php echo $arr['sort'];?></td>
				<td><?php echo $listings_plans_display_flag_list[$arr['display_flag']];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=listings_plans_delete&listings_plans_id=<?php echo $arr['id'];?>&image_path=<?php echo $arr['image_path'];?>&tab=listings_plans" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Plans -->



<!-- (( Amenities -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "listings_amenities" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Amenities List</p>
<p class="link"><a href="/admin/listings_amenities/edit.php?listings_id=<?php echo $_REQUEST['id'];?>&tab=listings_amenities">Amenities Add</a></p>
</div>
<!-- (( comp-table -->
<div id="comp-table">
<section id="resultBox">
<!--section id="searchBox">
<form id="Login" name="Login" action="#" method="post">
<p class="arw-folding trigger_search">SearchCondition：</p>
<div class="toggle_search">
<table>
<tr>
<th>氏名：</th>
<th>メールアドレス：</th>
<th></th>
</tr>
<tr>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td></td>
</tr>
</table>
<div class="searchBtnBox">
<p class="searchBtn"><input value="Search" id="submit" type="submit"></p>
<p class="resetBtn"><input value="Clear" id="reset" type="reset"></p>
</div>
</div>
</form>
</section-->
<?php
$result = listings_listings_amenities_index( $_REQUEST['id'] );
?>
<p class="resultNum">SearchResult：<span><?php echo mysql_num_rows( $result );?></span>件</p>
<!--p class="registBtn"><input value="Add" id="submit" type="submit"></p-->
<div class="pager">
<!--ul>
<li class="prev"><a href="#">Prev</a></li>
<li class="stay">1</li>
<li><a href="#">2</a></li>
<li class="next"><a href="#">Next</a></li>
</ul-->
</div>
<table id="resultTbl" class="resultTbl sortable">
<thead>
<tr>
<th class="edit unsortable">edit</th>
				<th class="unsortable">Amenities</th>
				<th class="unsortable">Sort</th>
				<th class="unsortable">Display Flag</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/listings_amenities/edit.php?id=<?php echo $arr['id'];?>&tab=listings_amenities">edit</a></td>
				<td><?php echo common_get_value("amenities","name",$arr['amenities_id'],"");?>
</td>
				<td><?php echo $arr['sort'];?></td>
				<td><?php echo $listings_amenities_display_flag_list[$arr['display_flag']];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=listings_amenities_delete&listings_amenities_id=<?php echo $arr['id'];?>&tab=listings_amenities" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Amenities -->



<!-- (( Enquiries -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "listings_enquiries" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Enquiries List</p>
</div>
<!-- (( comp-table -->
<div id="comp-table">
<section id="resultBox">
<!--section id="searchBox">
<form id="Login" name="Login" action="#" method="post">
<p class="arw-folding trigger_search">SearchCondition：</p>
<div class="toggle_search">
<table>
<tr>
<th>氏名：</th>
<th>メールアドレス：</th>
<th></th>
</tr>
<tr>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td><input name="name1" size="50" id="name1" class="TextInput" type="text"></td>
<td></td>
</tr>
</table>
<div class="searchBtnBox">
<p class="searchBtn"><input value="Search" id="submit" type="submit"></p>
<p class="resetBtn"><input value="Clear" id="reset" type="reset"></p>
</div>
</div>
</form>
</section-->
<?php
$result = listings_listings_enquiries_index( $_REQUEST['id'] );
?>
<p class="resultNum">SearchResult：<span><?php echo mysql_num_rows( $result );?></span>件</p>
<!--p class="registBtn"><input value="Add" id="submit" type="submit"></p-->
<div class="pager">
<!--ul>
<li class="prev"><a href="#">Prev</a></li>
<li class="stay">1</li>
<li><a href="#">2</a></li>
<li class="next"><a href="#">Next</a></li>
</ul-->
</div>
<table id="resultTbl" class="resultTbl sortable">
<thead>
<tr>
				<th class="unsortable">Name</th>
				<th class="unsortable">Email</th>
				<th class="unsortable">Phone</th>
				<th class="unsortable">Good Points</th>
				<th class="unsortable">Contact me via</th>
				<th class="unsortable">Nationality</th>
				<th class="unsortable">Message</th>
				<th class="unsortable">EnquiryDate</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo $arr['email'];?></td>
				<td><?php echo $arr['phone'];?></td>
				<td><?php echo $arr['good_point'];?></td>
				<td><?php echo $listings_enquiries_contact_type_list[$arr['contact_type']];?></td>
				<td><?php echo $listings_enquiries_nationality_list[$arr['nationality']];?></td>
				<td><?php echo str_replace("\n","<br />",$arr['message']);?></td>
				<td><?php echo $arr['created'];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=listings_enquiries_delete&listings_enquiries_id=<?php echo $arr['id'];?>&tab=listings_enquiries" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Enquiries -->



<div id="pagetop"><a href="#wrapper"><img src="/admin/images/pagetop.gif" alt="ページトップへ" width="50" height="50"></a></div>
</article>
</div><!--contents-->
<?php include "../common/footer.php"; ?>
</div><!--wrapper-->
<!-- SCRIPTS -->
<script type="text/javascript" src="/admin/js/jquery-1.3.1.min.js"></script>
<script language="Javascript">
<!--
function delete_check(){
res=confirm("Do you want to delete？")
if(res == false){ return false; }
}
//-->
</script>
</body>
</html>
