<?php
include "../../../controller/admin/states/detail.php";
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
<li class="<?php if( empty($_REQUEST['tab']) || $_REQUEST['tab'] == "locations" ){ echo "select"; } ?>">Location</li>
<li class="<?php if( $_REQUEST['tab'] == "groups" ){ echo "select"; } ?>">Area Group</li>
<li class="<?php if( $_REQUEST['tab'] == "amenities" ){ echo "select"; } ?>">Amenity</li>
<li class="<?php if( $_REQUEST['tab'] == "listings" ){ echo "select"; } ?>">Listing</li>
<li class="<?php if( $_REQUEST['tab'] == "urls" ){ echo "select"; } ?>">Urls</li>
</ul>
</div>



<!-- (( Location -->
<div class="content_wrap<?php if( !empty($_REQUEST['tab']) && $_REQUEST['tab'] != "locations" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Location List</p>
<p class="link"><a href="/admin/locations/edit.php?states_id=<?php echo $_REQUEST['id'];?>&tab=locations">Location Add</a></p>
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
$result = states_locations_index( $_REQUEST['id'] );
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
				<th class="unsortable">Area Group</th>
				<th class="unsortable">name</th>
				<th class="unsortable">code</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/locations/edit.php?id=<?php echo $arr['id'];?>&tab=locations">edit</a></td>
				<td><?php echo common_get_value("groups","name",$arr['groups_id'],"");?>
</td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo $arr['code'];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=locations_delete&locations_id=<?php echo $arr['id'];?>&tab=locations" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Location -->



<!-- (( Area Group -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "groups" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Area Group List</p>
<p class="link"><a href="/admin/groups/edit.php?states_id=<?php echo $_REQUEST['id'];?>&tab=groups">Area Group Add</a></p>
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
$result = states_groups_index( $_REQUEST['id'] );
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
				<th class="unsortable">name</th>
				<th class="unsortable">code</th>
				<th class="unsortable">sort</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/groups/edit.php?id=<?php echo $arr['id'];?>&tab=groups">edit</a></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo $arr['code'];?></td>
				<td><?php echo $arr['sort'];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=groups_delete&groups_id=<?php echo $arr['id'];?>&tab=groups" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Area Group -->



<!-- (( Amenity -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "amenities" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Amenity List</p>
<p class="link"><a href="/admin/amenities/edit.php?states_id=<?php echo $_REQUEST['id'];?>&tab=amenities">Amenity Add</a></p>
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
$result = states_amenities_index( $_REQUEST['id'] );
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
				<th class="unsortable">Area Group</th>
				<th class="unsortable">Category</th>
				<th class="unsortable">Amenity name</th>
				<th class="unsortable">Picture</th>
				<th class="unsortable">Latitude</th>
				<th class="unsortable">Longitude</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/amenities/edit.php?id=<?php echo $arr['id'];?>&tab=amenities">edit</a></td>
				<td><?php echo common_get_value("groups","name",$arr['groups_id'],"");?>
</td>
				<td><?php echo common_get_value("amenity_categories","name",$arr['amenity_categories_id'],"");?>
</td>
				<td><?php echo $arr['name'];?></td>
				<td><?php if(!empty($arr['image_path'])){ ?><img src="/admin/images/amenities/<?php echo $arr['image_path'];?>" width="100" height="auto"><?php } ?></td>
				<td><?php echo $arr['latitude'];?></td>
				<td><?php echo $arr['longitude'];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=amenities_delete&amenities_id=<?php echo $arr['id'];?>&tab=amenities" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Amenity -->



<!-- (( Listing -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "listings" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Listing List</p>
<p class="link"><a href="/admin/listings/edit.php?states_id=<?php echo $_REQUEST['id'];?>&tab=listings">Listing Add</a></p>
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
$result = states_listings_index( $_REQUEST['id'] );
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
<th class="detail unsortable">detail</th>
				<th class="unsortable">id</th>
				<th class="unsortable">Name</th>
				<th class="unsortable">Company</th>
				<th class="unsortable">PropertyName</th>
				<th class="unsortable">Status</th>
				<th class="unsortable">Posted date</th>
				<th class="unsortable">Expiry date</th>
				<th class="unsortable">LatestUpdate</th>
				<th class="unsortable">UpdatedUser</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/listings/edit.php?id=<?php echo $arr['id'];?>&tab=listings">edit</a></td>
				<td class="detail"><a href="/admin/listings/detail.php?id=<?php echo $arr['id'];?>">detail</a></td>
				<td><?php echo $arr['id'];?></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo common_get_value("companies","name",$arr['companies_id'],"");?>
</td>
				<td><?php echo $arr['property_name'];?></td>
				<td><?php echo $listings_status_list[$arr['status']];?></td>
				<td><?php echo $arr['posted_date'];?></td>
				<td><?php echo $arr['expiry_date'];?></td>
				<td></td>
				<td></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=listings_delete&listings_id=<?php echo $arr['id'];?>&tab=listings" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Listing -->



<!-- (( Urls -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "urls" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Urls List</p>
<p class="link"><a href="/admin/urls/edit.php?states_id=<?php echo $_REQUEST['id'];?>&tab=urls">Urls Add</a></p>
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
$result = states_urls_index( $_REQUEST['id'] );
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
				<th class="unsortable">Url</th>
				<th class="unsortable">Type</th>
				<th class="unsortable">Ares Group</th>
				<th class="unsortable">Property Type Groups</th>
				<th class="unsortable">Conditions Num</th>
				<th class="unsortable">Listings Num</th>
				<th class="unsortable">Ad Flag</th>
				<th class="unsortable">Created</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/urls/edit.php?id=<?php echo $arr['id'];?>&tab=urls">edit</a></td>
				<td><?php echo $arr['url'];?></td>
				<td><?php echo $urls_type_list[$arr['type']];?></td>
				<td><?php echo common_get_value("groups","name",$arr['groups_id'],"");?>
</td>
				<td><?php echo common_get_value("property_type_groups","name",$arr['property_type_groups_id'],"");?>
</td>
				<td></td>
				<td></td>
				<td><?php echo $urls_ad_flag_list[$arr['ad_flag']];?></td>
				<td></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=urls_delete&urls_id=<?php echo $arr['id'];?>&tab=urls" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Urls -->



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