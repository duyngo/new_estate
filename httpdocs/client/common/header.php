<header>
        <h1><img src="/assets/img/logo_kin.png" width="280"><!--img src="/admin/images/rcms.gif" width="188" height="12" alt="powered by romancrewCMS"--></h1>
        <p class="loginTxt"><?php echo $_SESSION['external_users_name'] ."　now login.<br>"; ?><a href="/client/login/logout.php">logout</a></p>
</header>
<nav id="gNavi">
	<ul class="dropdown">
		<li> <a href="/client/listings/">Listings</a> </li>
		<li> <a href="/client/listings_enquiries/">Enquiry</a> </li>
		<li> <a href="/client/external_users/">User</a> </li>
	</ul>
</nav>
