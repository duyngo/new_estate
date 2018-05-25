<header>
        <h1><img src="/assets/img/logo_kin.png" width="280"><!--img src="/admin/images/rcms.gif" width="188" height="12" alt="powered by romancrewCMS"--></h1>
        <p class="loginTxt"><?php echo $_SESSION['users_name'] ."　now login.<br>"; ?><a href="/admin/login/logout.php">logout</a></p>
</header>
<nav id="gNavi">
	<ul class="dropdown">
		<li> <a href="/admin/listings/">Listing</a> </li>
		<li> <a href="/admin/listings_enquiries/">Enquiry</a> </li>
		<li> <a href="#">report</a>
			<ul class="sub_menu">
				<li> <a href="/admin/enquiry_report_master/">Enquiry Report</a> </li>
				<li> <a href="/admin/listings_enquiries/report.php">Num of Enquiries by Listing</a> </li>
			</ul>
		</li>
		<li> <a href="/admin/members/">Member</a> </li>
		<li> <a href="/admin/users/">Internal user</a> </li>
		<li>
			<a href="#">Master</a>
			<ul class="sub_menu">
				<li> <a href="/admin/property_type_groups/">Property Type Group</a> </li>
				<li> <a href="/admin/property_types/">Property Type</a> </li>
				<li> <a href="/admin/states/">State</a> </li>
				<li> <a href="/admin/groups/">Group</a> </li>
				<li> <a href="/admin/locations/">Location</a> </li>
				<li> <a href="/admin/amenity_categories/">Amenity Category</a> </li>
				<li> <a href="/admin/amenities/">Amenity</a> </li>
				<li> <a href="/admin/prices/">Price</a> </li>
				<li> <a href="/admin/features/">Features</a> </li>
				<li> <a href="/admin/bedrooms/">Bedrooms</a> </li>
				<li> <a href="/admin/completion_years/">Completion Years</a> </li>
				<li> <a href="/admin/sizes/">Sizes</a> </li>
				<li> <a href="/admin/urls/">Urls</a> </li>
				<li> <a href="/admin/banners/">Banners</a> </li>
				<li> <a href="/admin/tenures/">Tenures</a> </li>
			</ul>
		</li>
		<li>
			<a href="/admin/companies/">Company</a>
			<ul class="sub_menu">
				<li> <a href="/admin/external_users/">External User</a> </li>
			</ul>
		</li>
	</ul>
</nav>
