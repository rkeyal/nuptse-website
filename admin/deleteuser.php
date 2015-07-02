<?php
	include("checkauth.php");
	include("lib.php");
	$user_id = $_GET['id'];
	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	$query = "select `group` from users where id=$user_id;";
    $result = $mysqli->query($query) or die(mysql_error());
    while ($row = $result->fetch_assoc()){
        if ($row['group'] != '0'){
            error_log($row['group'], 3, '/var/www/html/errors.log');
            removeUser($user_id, $row['group'], NULL);
        }
    }
	$query = "delete from users where id=" . $user_id . ";";
    $result = $mysqli->query($query) or die(mysql_error());
	$mysqli->close();

	header('Location: ' . $_SERVER["HTTP_REFERER"]);
?>
