<!DOCTYPE html>


<?php	
	include("checkauth.php");
	include("lib.php");
	$user_id = $_GET['id'];
	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	$query = "select * from users where id=$user_id;";
    $result = $mysqli->query($query) or die(mysql_error());
	$mysqli->close();
	$row = $result->fetch_assoc();
	include("edituser.tpl");
?>
