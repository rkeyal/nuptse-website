<?php
   include("checkauth.php");
   ?>
<html>
    <?php include("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
    <div class="container">
    <div class="container-fluid">
      <div class="span12">
	<ul class="nav nav-tabs">
	  <li><a href="#users" data-toggle="tab">View Users</a></li>
	  <li><a href="#approval" data-toggle="tab">View Pending</a></li>
	  <li><a href="#groups" data-toggle="tab">View/Manage Groups</a></li>
	  <li><a href="#stats" data-toggle="tab">View Users Stats</a></li>
	  <li><a href="#emails" data-toggle="tab">View User Emails</a></li>
	  <li><a href="#password" data-toggle="tab">Set Password</a></li>
	</ul>
	<div class="tab-content">
	  <div class="tab-pane active" id="users">
	    <?php include("viewusers.php"); ?>
	  </div>
	  <div class="tab-pane" id="approval">
	    <?php include("pendingusers.php"); ?>
	  </div>
 	  <div class="tab-pane" id="groups">
	  <?php include("viewgroups.php"); ?>
	  <?php include("managegroups.php"); ?>
	  </div>
 	  <div class="tab-pane" id="stats">
	  <?php include("viewusersstats.php"); ?>
	  </div>
 	  <div class="tab-pane" id="emails">
	  <?php include("viewemails.php"); ?>
	  </div>
 	  <div class="tab-pane" id="password">
	  <?php include("setpassword.php"); ?>
	  </div>
	</div> <!--/tab content-->
    <?php if (!empty($_GET['groups']) and $_GET['groups'] === "true") {
        echo '
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Groups modified successfully.
            </div>';
    }
   if (!empty($_GET['groups']) and $_GET['groups'] === "false") {
        echo '
            <div class="alert alert-failure">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Failure! </strong> User is not approved yet.
            </div>';
    }

    ?>
      </div> <!--/span-->
    </div> <!-- /container-fluid -->
    </div> <!--/container-->
    <div class="container">
    <?php include ("../footer.php"); ?>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/bootstrap/js/jquery.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
