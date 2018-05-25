    <header><a href="/"><img src="/assets/img/logo_kin.png" alt="" class="HeaderLogo"></a>
      <div class="drawer drawer--left">
        <button type="button" class="drawer-toggle drawer-hamburger"><span class="sr-only">toggle navigation</span><span class="drawer-hamburger-icon"></span></button>
        <nav class="drawer-nav">
          <ul class="drawer-menu"><a href="/sp" class="a">
              <li><a href="/" class="a">Top</a></li></a>
              <li><a href="/kuala-lumpur/" class="a">Kuala Lumpur</a></li>
              <li><a href="/selangor/" class="a">Selangor</a></li>
              <li><a href="/penang/" class="a">Penang</a></li>
              <li><a href="/johor/" class="a">Johor</a></li>
              <li><a href="/areas/" class="a">See all areas</a></li>
              <li><a href="/features/" class="a">Search by features</a></li>
              <li><a href="/about/" class="a">About us</a></li>
<?php if(empty($_SESSION['members_id'])){ ?>
              <li><a href="/signin/" class="a">Sign in</a></li>
              <li><a href="/sp/signup/" class="a">Sign up</a></li>
<?php }else{ ?>
              <li><a href="/signout/" class="a">Sign out</a></li>
<?php } ?>
         </ul>
        </nav>
      </div><a href="/enquiry/collection" class="a"><img src="/assets/img/md_contact_complete.png" alt="" class="HeaderCart"><span class="HeaderCart Num"><?php echo $fav_num;?></span></a>
    </header>
