<?php
	$expire = time() - 3600;
	setcookie("admin_id", "", $expire, '/');
	setcookie("user_id", "", $expire, '/');
	setcookie("grade", "", $expire, '/');
	setcookie("fname", "", $expire, '/');
	setcookie("lname", "", $expire, '/');
	setcookie("email", "", $expire, '/');
	header('Location: http://' . $_SERVER["SERVER_NAME"] . '/admin');
	?>
