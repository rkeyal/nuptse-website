<?php
   include("./checkauth.php");
   ?>
<html>
    <?php include("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
    <div class="container">
    	  <form method="post" action="inputpset.php">
        Number of Questions:
	  	<select name="questioncount">
			<?php
				for ($i = 1; $i <= 100; $i++)
				    echo "<option value=\"" . $i . "\">" . $i . "</option>";
			?>
		</select><br />
		<input type="submit" value="Go">
	  </form>
    <?php include("../footer.php"); ?>
    </div> <!-- /container -->
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/bootstrap/js/jquery.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
