<?php
	include("lib.php");
	$id = $_POST['id'];
	$user = $_COOKIE['user_id'];
	$question = $_POST['question'];
	$answer = sanitize($_POST['answer' . $question]);
	$query = "select * from " . $id . " where id=" . $question . ";";
	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
	$result = $mysqli->query($query);
	$questiondata = $result->fetch_assoc();
	$result->free();
	$mysqli->close();

	$isCorrect=(abs($questiondata['answer']  - $answer) <= (abs($questiondata['answer'] * $questiondata['tolerance'])));
	setUserQuestionStatus($id, $user, $question, $questiondata['users_status'], $isCorrect);

	$redirectbase = 'Location: http://' . $_SERVER["SERVER_NAME"] . '/viewer?id=' . $id . '&q=' . $question . '&correct=';
	if ($isCorrect) {
	   header($redirectbase . 'true');
	} else {
	   header($redirectbase . 'false');
	}

	?>
