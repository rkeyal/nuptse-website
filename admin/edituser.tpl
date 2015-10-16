<html lang="en">
	<?php include("../header.php"); ?>
<body>
	<?php include("../navbar/navbar.php"); ?>
	<div class="container">
		<div class="row">
			<div class="span8">
				<form class="form-horizontal" id="registerHere" action="/admin/edituserupload.php" method="post">
				<fieldset>
				<h1>Edit User</h1>
				<div class="control-group">
					<label class="control-label" for="input01">First name</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="user_fname" name="user_fname" value="<?php echo(isset($row['fname'])?$row['fname']:""); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Last name</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="user_lname" name="user_lname" value="<?php echo(isset($row['lname'])?$row['lname']:""); ?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Grade</label>
					<div class="controls">
                        <select id="user_grade" name="user_grade" value="echo(<?php echo(isset($row['grade'])?$row['grade']:""); ?>">
                        <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                        </select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">School</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="user_school" name="user_school" value="<?php echo(isset($row['school'])?$row['school']:""); ?>">
					</div>	
				</div>
				<div class="control-group">
					<label class="control-label" for="input01">Phone Number</label>
					<div class="controls">
						<input type="text" class="input-xlarge" id="user_phone" name="user_phone" value="<?php echo(isset($row['phone'])?$row['phone']:""); ?>">
					</div>
				</div>
				 <div class="control-group">
					<label class="control-label" for="input01">Primary Email</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" id="user_email" name="user_email" value="<?php echo(isset($row['email'])?$row['email']:""); ?>">
					  </div>
				</div>
				 <div class="control-group">
					<label class="control-label" for="input01">Parent Email</label>
					  <div class="controls">
						<input type="text" class="input-xlarge" id="parent_email" name="parent_email" value="<?php echo(isset($row['parent_email'])?$row['parent_email']:""); ?>">
					  </div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input01"></label>
					  <div class="controls">
					   <button type="submit" class="btn btn-success" rel="tooltip" title="first tooltip">Finish Edits</button>
					  </div>
				</div>
				  </fieldset>
				  <input type="hidden" name="user_id" value=<?php echo($user_id);?>>
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
  </body>
</html>