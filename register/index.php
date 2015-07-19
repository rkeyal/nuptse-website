<!DOCTYPE html>
<html lang="en">
	<?php include("../header.php"); ?>
<body>
	<?php include("../navbar/navbar.php"); ?>
	<div class="container">
		<div class="row">
			<div class="span8">
				<form class="form-horizontal" id="registerHere" action="/register/process_registration.php" method="post">
				<fieldset>
				<h1>Registration</h1>
				<div class="control-group">
					<label class="control-label" for="input01">First name</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="user_fname" name="user_fname">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Last name</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="user_lname" name="user_lname">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Grade</label>
					<div class="controls">
                        <select id="user_grade" name="user_grade">
                        <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                        </select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Phone Number</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="user_phone" name="user_phone">
					</div>
				</div>
				 <div class="control-group">
					<label class="control-label" for="input01">Primary Email</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" id="user_email" name="user_email">
					  </div>
				</div>
				 <div class="control-group">
					<label class="control-label" for="input01">Parent Email</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" id="parent_email" name="parent_email">
					  </div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Password</label>
					  <div class="controls">
						<input type="password" class="input-xlarge" id="pwd" name="pwd">
					  </div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Confirm Password</label>
					  <div class="controls">
						<input type="password" class="input-xlarge" id="cpwd" name="cpwd">
					  </div>
				</div>

				<div class="control-group">
					<label class="control-label" for="input01"></label>
					  <div class="controls">
					   <button type="submit" class="btn btn-success" rel="tooltip" title="first tooltip">Create My Account</button>
					  </div>
				</div>
                <?php
                if (empty($_GET['email'])) {
                    echo '
                        <div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Error!</strong> This email already has an account.
                        </div>';
                }
                ?>
				  </fieldset>
				</form>
			</div>
		</div>

			<?php include("../footer.php"); ?>
			  </div><!--/row-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/bootstrap/js/jquery.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
	  <script type="text/javascript">
	  $(document).ready(function(){
			$("#registerHere").validate({
				rules:{
					user_fname:"required",
					user_lname:"required",
					user_grade:"required",
                    parent_email:{
                        email: true
                    },
					user_phone:"required",
					user_email:{
							required:true,
							email: true
						},
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
					user_fname:"Enter your first name",
					user_lname:"Enter your last name",
					user_grade:"Enter your grade",
					user_email:{
						required:"Enter your email address",
						email:"Enter valid email address"
					},
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
