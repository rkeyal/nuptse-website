<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/authentication/pwhash.php');

	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
    $email = $_POST['user_email'];
    $query = "select * from users where email='$email';";
    $result = $mysqli->query($query) or die(mysql_error());
    $rows = $result->num_rows;
    if ($rows != 1) {
        // Prepare insert query
        $fname = $_POST['user_fname'];
        $lname = $_POST['user_lname'];
        $email = $_POST['user_email'];
        $phone = $_POST['user_phone'];
        $grade = $_POST['user_grade'];
		$school= $_POST['user_school'];
	if (isset($_POST['parent_email'])){
		$parent_email = $_POST['parent_email'];
	}
	else {
		$parent_email = "NULL";
	}
        $password = create_hash($_POST['pwd']);
        $query = "insert into users (fname, lname, email, grade, password, approved, `group`, phone, parent_email, date, school) values (";
        $query .= "'$fname', '$lname', '$email', $grade, '$password', 0, 0, '$phone', '$parent_email', '" . date(DATE_RFC2822) . "', '$school');";
        error_log($query, 3, "/var/www/html/errors.log");

        $mysqli->query($query);
        $mysqli->close();

        header('Location: http://' . $_SERVER["SERVER_NAME"] . '/register/registration_complete.php');
    }
    else {
        header('Location: http://' . $_SERVER["SERVER_NAME"] . '/register/index.php?email=false');
    }
?>
