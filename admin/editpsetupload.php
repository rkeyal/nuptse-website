<?php
include("checkauth.php");
?>
<html>
<?php include("../header.php"); ?>
<body>
<?php include("../navbar/navbar.php"); ?>
<div class="container">
     <?php
	$pset = $_POST["pset"];
	$psid = substr($pset,2);
    $date = $_POST["expiry"];
    $groups = $_POST["group"];
    $name = $_POST["name"];
    $id = $_COOKIE["admin_id"];
	
	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
	$query = "update details set name='$name', user='$id', ;";
	$result = $mysqli->query($query) or die(mysql_error());
	?>
	
	<?php
    for ($i = 1; $i <= $_POST["questioncount"]; $i += 1) {
        $index = "question" . $i;
        $answer = $_POST[$index];
        $query = "update $pset set answer=$answer where id=$i;";
        $result = $mysqli->query($query) or die(mysql_error());
    }
    $mysqli->close();
	?>
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
