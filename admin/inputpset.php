<?php include("checkauth.php"); ?>
<html>
	<?php include("../header.php"); ?>
	<body>
		<?php include("../navbar/navbar.php"); ?>
		<div class="container" style="padding: 50px 0px">
			<form id="uploadHere" action="uploadpset.php" enctype="multipart/form-data" method="post">
				<fieldset>
				<div class="control-group">
					Questions PDF: <input type="file" id="problemsetpdf" name="problemsetpdf" value="Questions PDF"><br />
					Solutions PDF: <input type="file" id="anspdf" name="anspdf"><br />
					Name: <input type="text" name="name" id="name" placeholder="Enter name here"/><br />
					Group(s): <!--input type="text" name="group" id="group" placeholder="Enter group(s) here"/><br /-->
					<?php
						$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
						$query = "SELECT id from groups;";
						$result = $mysqli->query($query) or die(mysql_error());
						$groups = '<table style="width: 450px;"><tr>';
						$i = 0;
						$base = 9;
						while ($row = $result->fetch_assoc()){
							$id = $row['id'];
							$groups = $groups . '
							<td><input type="checkbox" name="group' . $id . '" value="' . $id . '">  ' . $id . '</td>';
							if (++$i % $base == 0) $groups = $groups . '</tr>
							<tr>';
						}
						$groups = $groups . "</tr></table>";
						echo '<input type="hidden" name="groups" value=' . $i . '>';
						$result->free();
						$mysqli->close();
						echo $groups;
					?> <br />
					Expiry Date: <input type="date" name="expiry" id="expiry"/><br />	<!-- HTML5 only. Defaults to text -->
				</div>
				Problem set answers:<br />
				<?php
					for ($i = 1; $i <= $_POST['questioncount']; $i++){
						echo $i . '<input name="question' . $i . '" type="number" style="padding: 0px 5px">';
						// Should be a number. HTML5 only. Defaults to text
					echo "	relative tolerance:  ";
					echo "<select name='error$i'>
					<option value='0.00001'>0.00</option>
					<option value='0.01'>0.01</option>
					<option value='0.05'>0.05</option>
					<option value='0.1'>0.1</option>
					</select><br />";
					}
				?>
				<input type="hidden" name="questioncount" value="<?php echo $_POST["questioncount"]; ?>">
				<button type="submit" class="btn btn-primary">Add Problem Set</button>
				</fieldset>
			</form>
		</div> <!-- /container -->
		</div> <!-- /container -->
		<?php include("../footer.php"); ?>
		</div> <!-- /container -->
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../assets/bootstrap/js/jquery.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#uploadHere").validate({
					rules:{
						problemsetpdf:"required",
						anspdf:"required",
						name:"required",
						//group:"required",
						expiry:{
							required:true,
							minlength: 10
						},
					},
					messages:{
						problemsetpdf:"Please upload a pset file",
						anspdf:"Please upload a solution file",
						name:"Please enter in a name for the pset",
						//group:"Please enter the groups that the pset is assigned to",
						expiry:{
							required:"Please enter an expiry date"
							minlength:"Date must be 10 characters"
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
