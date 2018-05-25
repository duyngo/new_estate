<?php
include "../../../controller/admin/companies/detail.php";
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
<li class="<?php if( empty($_REQUEST['tab']) || $_REQUEST['tab'] == "external_users" ){ echo "select"; } ?>">External users</li>
<li class="<?php if( $_REQUEST['tab'] == "listings" ){ echo "select"; } ?>">Listing</li>
<li class="<?php if( $_REQUEST['tab'] == "sales_garellies" ){ echo "select"; } ?>">Sales Gallery</li>
</ul>
</div>


<!-- (( External users -->
<div class="content_wrap<?php if( !empty($_REQUEST['tab']) && $_REQUEST['tab'] != "external_users" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">External users List</p>
<p class="link"><a href="/admin/external_users/edit.php?companies_id=<?php echo $_REQUEST['id'];?>&tab=external_users">External users Add</a></p>
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
$result = companies_external_users_index( $_REQUEST['id'] );
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
				<th class="unsortable">Email</th>
				<th class="unsortable">Title</th>
				<th class="unsortable">First name</th>
				<th class="unsortable">Last name</th>
				<th class="unsortable">TEL</th>
				<th class="unsortable">Mobile</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/external_users/edit.php?id=<?php echo $arr['id'];?>&tab=external_users">edit</a></td>
				<td><?php echo $arr['email'];?></td>
				<td><?php echo $external_users_title_list[$arr['title']];?></td>
				<td><?php echo $arr['first_name'];?></td>
				<td><?php echo $arr['last_name'];?></td>
				<td><?php echo $arr['tel'];?></td>
				<td><?php echo $arr['mobile'];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=external_users_delete&external_users_id=<?php echo $arr['id'];?>&tab=external_users" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) External users -->



<!-- (( Listing -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "listings" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Listing List</p>
<p class="link"><a href="/admin/listings/edit.php?companies_id=<?php echo $_REQUEST['id'];?>&tab=listings">Listing Add</a></p>
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
$result = companies_listings_index( $_REQUEST['id'] );
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



<!-- (( Sales Gallery -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "sales_garellies" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Sales Gallery List</p>
<p class="link"><a href="/admin/sales_garellies/edit.php?companies_id=<?php echo $_REQUEST['id'];?>&tab=sales_garellies">Sales Gallery Add</a></p>
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
$result = companies_sales_garellies_index( $_REQUEST['id'] );
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
				<th class="unsortable">Sales Gallery Name</th>
				<th class="unsortable">Description</th>
				<th class="unsortable">Sort</th>
<th class=" unsortable">Delete</th>
</tr>
</thead>
<tbody>



<?php
if(mysql_num_rows( $result )){
while( $arr = mysql_fetch_array( $result )){
?>
<tr>
<td class="aC"><a href="/admin/sales_garellies/edit.php?id=<?php echo $arr['id'];?>&tab=sales_garellies">edit</a></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo str_replace("\n","<br />",$arr['description']);?></td>
				<td><?php echo $arr['sort'];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=sales_garellies_delete&sales_garellies_id=<?php echo $arr['id'];?>&tab=sales_garellies" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Sales Gallery -->



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
