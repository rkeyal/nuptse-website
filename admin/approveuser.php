<?php
	include("checkauth.php");
	$user_id = $_GET['id'];
	$query = "update users set approved=1 where id=" . $user_id . ";";

	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	$mysqli->query($query);
	$mysqli->close();

	header('Location: http://' . $_SERVER["SERVER_NAME"] . '/admin/manageusers.php');
?>
