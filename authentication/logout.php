<?php
	$expire = time() - 3600;
	setcookie("user_id", "", $expire, '/');
	setcookie("admin_id", "", $expire, '/');
	setcookie("fname", "", $expire, '/');
	setcookie("lname", "", $expire, '/');
	setcookie("email", "", $expire, '/');
	setcookie("grade", "", $expire, '/');
	header('Location: http://' . $_SERVER["SERVER_NAME"]);
	?>
