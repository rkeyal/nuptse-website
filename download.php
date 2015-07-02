<?php
include('viewer/lib.php');
	//path to file
	if (isset($_COOKIE['user_id'])) {
		$id = $_GET['id'];
	    $query = "select id from $id;";
	    $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
	    $result = $mysqli->query($query) or die(mysql_error());
	    $resultData = $result->fetch_array(MYSQLI_ASSOC);
		if(checkExpiryDate("$id",$_COOKIE['user_id'], $resultData['TOTALFOUND']) == true) {
			$filedir = "answers/$id" . "ans.pdf";
		}
		else {
			$filedir = "answers/attempted.pdf";
		}
	}
	else {
		$filedir = "answers/attempted.pdf";
	}
	//name of file (can be whatever you like--i.e. doesn't have to be the same as actual file--whatever you name it is what the user will see)
	$filename = "$id Answers";
	//see http://www.w3schools.com/media/media_mimeref.asp for full list of mime types
  $mimetype = 'application/pdf';
	//see http://php.net/file_get_contents
  $data = file_get_contents($filedir);
  // see http://php.net/strlen
	$size = strlen($data);
	//trigger HTTP request - see http://php.net/header
  header("Content-Disposition: attachment; filename = $filename"); 
  header("Content-Length: $size");
  header("Content-Type: $mimetype");
	//see http://php.net/echo
  echo $data;
?>
