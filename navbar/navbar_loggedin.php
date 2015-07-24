<div class="navbar navbar-fixed-top">
     <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/index.php">Nuptse Foundation</a>
          <div class="nav-collapse">
            <ul class="nav">
	    	<?php
	   	$page = $_SERVER['REQUEST_URI'];
	   	?>
              <li <?php if ($page == '/index.php' or $page == NULL){ echo 'class="active"'; } ?>><a href="/index.php"><i class="icon-home icon-white"></i> Home</a></li>
              <li class="dropdown">
               <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-align-left icon-white"></i> About</a>
                <ul class="dropdown-menu">
                    <!--<li><a href="/about/Nuptse%20Foundation%20Overview%20Rev%20D3.pdf">Foundation Overview</a></li>
					<li><a href="/about/Nuptse%20Foundation%20Overview%20Rev%20D3.pdf">Class Structure</a></li>-->
					<li><a href="/about/foundationoverview.php">Foundation Overview</a></li>
                    <!--<li><a href="/about/2015-16%20Class%20Information%20Rev%20D.pdf">Class Schedule</a></li>-->
                    <!--<li><a href="#">Student Staff</a></li>
                    <li><a href="#">Board Members</a></li>-->
                </ul>
                </li>
				
			<li><a href="/contactus.php"><i class="icon-envelope icon-white"></i> Contact Us</a></li>
			<li><a href="/faq.php"><i class="icon-question-sign icon-white"></i> FAQ</a></li>
				
                <?php
                if(isset($_COOKIE['admin_id'])){
                    echo '<li><a href="/admin/panel.php"><i class="icon-th-large icon-white"></i> Panel</a><li>';

                }
                else {
                    echo '<li><a href="/profile.php"><i class="icon-th-large icon-white"></i> Profile</a></li>';
                    echo '<li><a href="/problemsets.php"><i class="icon-list icon-white"></i> Problem Sets</a></li>';
                }
        ?>
           </ul>
	   <ul class="nav pull-right">
              <li class="dropdown">
               <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-user icon-white"></i> <?php echo $_COOKIE["fname"] . " " . $_COOKIE["lname"]; ?> <strong class="caret"></strong></a>                        <ul class="dropdown-menu">
        <?php
        if(isset($_COOKIE['admin_id'])){
            echo '<li><a href="/admin/authentication/logout.php">Sign Out</a></li>';

        }
        else {
            echo '<li><a href="/authentication/logout.php">Sign Out</a></li>';
        }
        ?>
            </ul>
            </li>
          </ul>
	  </div><!--/.nav-collapse -->
        </div>
     </div>
</div>
