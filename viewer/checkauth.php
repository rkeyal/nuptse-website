<?php
	$user_id = $_COOKIE['user_id'];
	$pset_id = $_GET['id'];
	if (isset($_COOKIE["fname"])) {
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
        $user_id = $_COOKIE['user_id'];
        $query = "select problem_sets from groups where members like '%,$user_id,%';";
        $res = $mysqli->query($query) or die(mysql_error());
        while ($row = $res->fetch_assoc()) {
            $psets = explode(",", $row['problem_sets']);
        }
        if(!in_array($pset_id,$psets)){
            header('Location: http://' . $_SERVER["SERVER_NAME"] . '/problemsets.php');
        }
    }
    else {
        header('Location: http://' . $_SERVER["SERVER_NAME"] . '/index.php');
    }
	$mysqli->close();
?>
