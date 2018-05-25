<?php
include "../../../controller/admin/property_type_groups/detail.php";
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
<li class="<?php if( empty($_REQUEST['tab']) || $_REQUEST['tab'] == "property_types" ){ echo "select"; } ?>">Property type</li>
<li class="<?php if( $_REQUEST['tab'] == "urls" ){ echo "select"; } ?>">Urls</li>
</ul>
</div>



<!-- (( Property type -->
<div class="content_wrap<?php if( !empty($_REQUEST['tab']) && $_REQUEST['tab'] != "property_types" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Property type List</p>
<p class="link"><a href="/admin/property_types/edit.php?property_type_groups_id=<?php echo $_REQUEST['id'];?>&tab=property_types">Property type Add</a></p>
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
$result = property_type_groups_property_types_index( $_REQUEST['id'] );
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
				<th class="unsortable">Property type name</th>
				<th class="unsortable">code</th>
				<th class="unsortable">Picture</th>
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
<td class="aC"><a href="/admin/property_types/edit.php?id=<?php echo $arr['id'];?>&tab=property_types">edit</a></td>
				<td><?php echo $arr['name'];?></td>
				<td><?php echo $arr['code'];?></td>
				<td><?php if(!empty($arr['image_path'])){ ?><img src="/admin/images/property_types/<?php echo $arr['image_path'];?>" width="100" height="auto"><?php } ?></td>
				<td><?php echo str_replace("\n","<br />",$arr['description']);?></td>
				<td><?php echo $arr['sort'];?></td>
<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>&act=property_types_delete&property_types_id=<?php echo $arr['id'];?>&tab=property_types" onclick="return delete_check();">delete</a></td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</section>
</div> <!-- )) comp-table -->
</div> <!-- )) Property type -->



<!-- (( Urls -->
<div class="content_wrap<?php if( $_REQUEST['tab'] != "urls" ){ echo " disnon"; } ?>">
<div class="tabitem_mds">
<p class="mds">Urls List</p>
<p class="link"><a href="/admin/urls/edit.php?property_type_groups_id=<?php echo $_REQUEST['id'];?>&tab=urls">Urls Add</a></p>
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
$result = property_type_groups_urls_index( $_REQUEST['id'] );
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
				<th class="unsortable">State</th>
				<th class="unsortable">Ares Group</th>
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
				<td><?php echo common_get_value("states","name",$arr['states_id'],"");?>
</td>
				<td><?php echo common_get_value("groups","name",$arr['groups_id'],"");?>
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
