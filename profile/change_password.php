<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . '/authentication/pwhash.php');

	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	if (isset($_COOKIE['user_id'])) {
    $email = $_COOKIE['email'];
}
else {
	$email = $_POST['user'];
}
    $password = create_hash($_POST['pwd']);
    $query = "update users set password = '" . $password . "' where email='$email';";
    error_log($query, 3, '/var/www/html/my-errors.log');
    $result = $mysqli->query($query) or die(mysql_error());
    $mysqli -> close();
	if (isset($_POST['admin']) == false) {
    header('Location: http://' . $_SERVER["SERVER_NAME"] . '/profile.php?changed=true');
}
else {
    header('Location: http://' . $_SERVER["SERVER_NAME"] . '/admin/panel.php?changed=true');
}
?>
