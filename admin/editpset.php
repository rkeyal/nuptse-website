<?php
   include("checkauth.php");
   ?>
<html>
    <?php include("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
    <div class="container">
        <form id="uploadHere" action="editpsetupload.php" enctype="multipart/form-data" method="post">
        <fieldset>
        <div class="control-group">
		<?php
			$pset = $_GET["edit"];
			$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
			$query = "select * from details where " . $pset . ";";
			$result = $mysqli->query($query) or die(mysql_error());
			$details = $result->fetch_assoc();
			$group = $details['group'];
		?>
		
        Group(s): <input type="text" name="group" id="group" value=<?php ?>/><br />
        Expiry Date: <input type="text" name="expiry" id="expiry" placeholder="Format YYYY-MM-DD"/><br />
        </div>
		Problem set answers:
		<br />
	  	<?php
			$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
			$query = "select answer from " . $pset . ";";
			$result = $mysqli->query($query) or die(mysql_error());
			$num_questions = $result->num_rows;
			
			for ($i = 1; $i <= $num_questions; $i++){
			    echo $i . " <input type=\"text\" name=\"question" . $i . "\" value=" . $result->fetch_assoc()['answer'] . "> <br />";
			/*echo "	tolerance:  ";
			echo "<select name='error$i'>
			<option value='0.00001'>0.00</option>
			<option value='0.01'>0.01</option>
			<option value='0.05'>0.05</option>
			<option value='0.1'>0.1</option>
			</select><br />"; */
			}
		?>
	<input type="hidden" name="questioncount" value="<?php echo $num_questions; ?>">
	<input type="hidden" name="pset" value="<?php echo $pset; ?>">
		<button type="submit" class="btn btn-primary">Edit Problem Set <?php echo $_GET["edit"];?></button>
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
  </body>
</html>
