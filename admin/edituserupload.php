<?php
	include("checkauth.php");
	include("lib.php");
	include("../navbar/navbar.php");
	include("../header.php");
	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
    $email = $_POST['user_email'];
    $query = "select * from users where email='$email';";
    $result = $mysqli->query($query) or die(mysql_error());
    $rows = $result->num_rows;
    if ($rows == 1) {
        $fname = $_POST['user_fname'];
        $lname = $_POST['user_lname'];
        $email = $_POST['user_email'];
        $phone = $_POST['user_phone'];
        $grade = $_POST['user_grade'];
		$school= $_POST['user_school'];
		$id    = $_POST['user_id'];
		if (isset($_POST['parent_email'])){
			$parent_email = $_POST['parent_email'];
		} else {
			$parent_email = "NULL";
		}
		$query = "update users set fname='$fname', lname='$lname', email='$email', grade='$grade', phone='$phone', parent_email='$parent_email', school='$school' where id=$id";
		//error_log($query, 3, "/var/www/html/errors.log");
		echo("<p>[DEBUG] Query: $query</p>");
		if ($mysqli->query($query)) {
			$mysqli->close();
			echo("<p> User information edited succesfully. </p>");
		} else {
			echo("<p> SQL Error: User information was not edited. </p>");
		}
			echo("<p><a href=\"/admin/manageusers.php\">View Users</a></p>");
    } else {
		echo("<p> Something went wrong </p>");
	}
?>
