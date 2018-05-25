<footer>
<div id="footer">
<div id="list">
<div id="f_logo"><img src="/img/footer_logo.png" alt="NewPropertyList.my" /></div>

<div id="catch">
<p id="b">Property information website specializing in new property</p>
<p id="s">New property information website for people who are looking for their new property in Malaysia</p>

<p>[NewPropertyList.my] is run by SAMURAI INTERNET SDN. BHD. for people who are looking for new property in Malaysia.</p>
<p>You can find your new property by area, property types, range of prices, and developers.</p>
<p>You can check the detail of each property information, its photo, and floor plan. When you find your interests in property, you can add as your favourite.</p>
<p>NewPropertyList.my gives an opportunity for you to search your new property various types of search options. Let's find out your new property using a suitable search option for you.</p>
</div>

<h3>Find by Area</h3>
<?php
$result = states_index("a");
while( $arr = mysql_fetch_array( $result )){
?>

<div class="area">
<p class="area_s"><?php if( $arr['listings_num'] ){ ?><a href="/<?php echo $arr['code'];?>"><?php } ?><?php echo $arr['name'];?><?php if( $arr['listings_num'] ){ ?></a><?php } ?></p>
<ul>
<?php
	$result2 = groups_index( $arr['id'] );
	while( $arr2 = mysql_fetch_array( $result2 )){
?>
<li><?php if( $arr2['listings_num'] ){ ?><a href="/<?php echo $arr['code'];?>/<?php echo $arr2['code'];?>"><?php } ?><?php echo $arr2['name'];?><?php if( $arr2['listings_num'] ){ ?></a><?php } ?>&nbsp;|&nbsp;</li>
<?php
}
?>
</ul>
</div>

<?php
}
?>


<div class="area_pre clearfix">
<ul>
<?php
$result = states_index("b");
while( $arr = mysql_fetch_array( $result )){
?>
<li><?php if( $arr['listings_num'] ){ ?><a href="/<?php echo $arr['code'];?>"><?php } ?><?php echo $arr['name'];?><?php if( $arr['listings_num'] ){ ?></a><?php } ?>&nbsp;|&nbsp;</li>
<?php
}
?>
</ul>
</div>



<div id="type">
<h3>Find by Property types</h3>
<ul class="clearfix">
<?php
$result = property_type_groups_index();
while( $arr = mysql_fetch_array( $result )){
?>
<li><?php if( $arr['listings_num'] ){ ?><a href="/all-state/new-<?php echo $arr['code'];?>-for-sale"><?php } ?><?php echo $arr['name'];?><?php if( $arr['listings_num'] ){ ?></a><?php } ?>&nbsp;|&nbsp;</li>
<?php
}
?>
</ul>
</div>

<div id="price">
<h3>Find by Prices</h3>
<ul class="clearfix">
<?php
$result = prices_index();
while( $arr = mysql_fetch_array( $result )){
?>
<li><?php if( $arr['listings_num'] ){ ?><a href="/all-state/<?php echo $arr['code'];?>"><?php } ?><?php echo $arr['name'];?><?php if( $arr['listings_num'] ){ ?></a><?php } ?>&nbsp;|&nbsp;</li>
<?php
}
?>
</ul>
</div>

<!--div id="deve">
<h3>Find by Real Estate Developers</h3>
<ul class="clearfix">
<li><a href="">IOI Sdn. Bhd.</a>&nbsp;|&nbsp;</li>
<li><a href="">Sunway Sdn. Bhd.</a>&nbsp;|&nbsp;</li>
<li><a href="">YTL Sdn. Bhd.</a></li>
</ul>
<ul class="clearfix">
<li><a href="/real-estate-developers">See the list of developers</a></li>
</ul>
</div-->

</div>

<div id="link">
<ul>
<li><a href="">NewPropertyList.my top</a>&nbsp;|&nbsp;</li>
<li><a href="">Listenings on NewPropertyList.my</a>&nbsp;|&nbsp;</li>
<li><a href="">Register</a>&nbsp;|&nbsp;</li>
<li><a href="">Site map</a>&nbsp;|&nbsp;</li>
<li><a href="">Terms of use</a>&nbsp;|&nbsp;</li>
<li><a href="">Privacy Policy</a></li>
</ul>
<img src="img/samurai_logo.png" alt="SAMURAI internet" />
<p>&#169; 2015 / Samurai Internet Sdn. Bhd. / All Rights Reserved.</p>

</div>

</div>

</footer>
</body>
</html>
