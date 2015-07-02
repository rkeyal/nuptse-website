<!DOCTYPE html>
<html lang="en">
  <?php include("header.php"); ?>
  <body>

    <?php include("navbar/navbar.php"); ?>
    <div class="container">
    <div class="container-fluid">
    <?php include("resources.php"); ?>
      <div class="span8">
<?php if (isset($_COOKIE['user_id'])){
    echo '
	<ul class="nav nav-tabs">
	  <li><a href="#main" data-toggle="tab">Main Information</a></li>
	  <li><a href="#stats" data-toggle="tab">Statistics</a></li>
	  <li><a href="#announcements" data-toggle="tab">Announcements</a></li>
	</ul>
	<div class="tab-content">
	  <div class="tab-pane active" id="main">';
	    include("profile/profile_main.php");
	  echo '</div>
	  <div class="tab-pane" id="stats">';
    include("profile/profile_stats.php");
    echo '
	  </div>
 	  <div class="tab-pane" id="announcements">';
	  include("profile/profile_announcements.php");
	  echo '</div>
	</div> <!--/tab content-->';
}
else {
    echo "<h4>Please log in to view your profile.</h4>";
}
?>
      </div> <!--/span-->
    </div> <!-- /container-fluid -->
    </div> <!--/container-->
    <div class="container">
    <?php include ("footer.php"); ?>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/bootstrap/js/jquery.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
	  <script type="text/javascript">
	  $(document).ready(function(){
			$("#changePassword").validate({
				rules:{
					pwd:{
						required:true,
						minlength: 6
					},
					cpwd:{
						required:true,
						equalTo: "#pwd"
					},
				},
				messages:{
					pwd:{
						required:"Enter your password",
						minlength:"Password must be minimum 6 characters"
					},
					cpwd:{
						required:"Enter confirm password",
						equalTo:"Password and Confirm Password must match"
					},
				},
				errorClass: "help-inline",
				errorElement: "span",
				highlight:function(element, errorClass, validClass) {
					$(element).parents('.control-group').addClass('error');
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).parents('.control-group').removeClass('error');
					$(element).parents('.control-group').addClass('success');
				}
			});
		});
	  </script>
  </body>
</html>
