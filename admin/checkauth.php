<?php
	if (!isset($_COOKIE['admin_id'])) {
	   header('Location: http://' . $_SERVER['SERVER_NAME'] . '/admin');
	}
	?>