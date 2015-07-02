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
               <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-question-sign icon-white"></i> About</a>
                <ul class="dropdown-menu">
                    <li><a href="/about/Nuptse%20Foundation%20Overview%20Rev%20D3.pdf">About Nuptse</a></li>
                    <li><a href="/about/2015-16%20Class%20Information%20Rev%20D.pdf">Class Schedule</a></li>
                    <li><a href="#">Staff</a></li>
                    <li><a href="#">Nuptse Board</a></li>
                    <li><a href="../contactus.php">Contact Us</a></li>
                </ul>
                </li>
           </ul>
	    <ul class="nav pull-right">
        <?php if ($page != '/admin/') {
            echo '
	      <li class="divider-vertical"></li>
              <li><a href="/register"><i class="icon-pencil icon-white"></i> Sign Up</a></li>
	      <li class="divider-vertical"></li>
              <li class="dropdown">
               <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-user icon-white"></i> Sign In <strong class="caret"></strong></a>
               <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">';
            include("/var/www/html/login.php");
            echo '
           </div>
            </li>
            ';
        }
        else {
            echo '
	      <li class="divider-vertical"></li>
	      <li class="divider-vertical"></li>
              <li class="dropdown">
               <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="icon-user icon-white"></i> Sign In <strong class="caret"></strong></a>
              <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;"> ';
            include("/var/www/html/admin/login.php");
            echo '
           </div>
            </li>
            ';
        }
        ?>
          </ul>
	  </div><!--/.nav-collapse -->
        </div>
     </div>
</div>
           </div>
            </li>
          </ul>
	  </div><!--/.nav-collapse -->
        </div>
     </div>
</div>
