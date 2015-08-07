<?php
   include("checkauth.php");
   ?>
<html>
    <?php include("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
	<div class="container" style="padding: 20px">
    <div class="container">
		<div class="span3" style="padding: 10px">
			<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li class="nav-header">Users</li>
					<li>
						<a href="/admin/manageusers.php">Manage Users/Groups</a>
					</li>
					<li class="nav-header">Problem Sets</li>
					<li>
						<a href="/admin/viewpsets.php">View Problem Sets</a>
					</li>
					<li>
						<a href="/admin/addpset.php">Add Problem Set</a>
					</li>
				</ul>
			</div>
		</div>
		<!--
		<button class="btn btn-small btn-primary" onclick="location.href='/admin/manageusers.php';">Manage Users/Groups</button>
		<button class="btn btn-small btn-primary" onclick="location.href='/admin/viewpsets.php';">View Problem Sets</button>
		<button class="btn btn-small btn-primary" onclick="location.href='/admin/addpset.php';">Add Problem Set</button>-->
		<br>
		<br>
	    You can manage users and group here, as well as approve new users.
		<br>
		<br>
		You can add and view problem sets here.
		<!---->
		<?php if (!empty($_GET['groups']) and $_GET['groups'] === "true") {
			echo '
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> Groups modified successfully.
				</div>';
		}
		if (!empty($_GET['groups']) and $_GET['changed'] === "true") {
			echo '
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Success!</strong> Password modified successfully.
				</div>';
		}
		?>
    </div> <!-- /container -->
	<?php include("../footer.php"); ?>
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/bootstrap/js/jquery.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
