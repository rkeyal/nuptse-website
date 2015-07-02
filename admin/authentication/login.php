<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/authentication/pwhash.php');

	$email = $_POST['email'];
	$password = $_POST['pwd'];
	$query = "select * from admins where email=";
	$query .= "'$email';";

	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	$result = $mysqli->query($query);

	if ($result->num_rows == 0) {
	   $login_success = False;
	} else {
	   $userdata = $result->fetch_assoc();
	   if (validate_password($password, $userdata['password'])) {
	      $login_success = True;
	   } else {
	      $login_success = False;
	   }
	}

	$result->free();
	$mysqli->close();

	if ($login_success) {
	   if (isset($_POST['rememberme']))
	      $expire = time() + 60*60*24*365*100;
	   else
	      $expire = time() + 60*60*24;

	   setcookie("admin_id", $userdata['id'], $expire, '/');
	   setcookie("user_id", "", time() - 3600, '/');
	   setcookie("grade","", time() - 3600, '/');
	   setcookie("fname", $userdata['fname'], $expire, '/');
	   setcookie("lname", $userdata['lname'], $expire, '/');
	   setcookie("email", $userdata['email'], $expire, '/');
	   header('Location: http://' . $_SERVER["SERVER_NAME"] . '/admin/panel.php');
	} else {
	  header('Location: http://' . $_SERVER["SERVER_NAME"] . '/admin/loginfailed.php');
	}
	?>
