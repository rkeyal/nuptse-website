<?php
	function cleanInput($input) {

	  $search = array(
    	  '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    	  '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    	  '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    	  '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  	  );

    	  $output = preg_replace($search, '', $input);
    	  return $output;
  	}

  function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
	$link = mysqli_connect('localhost', 'root', '8PaHucre');
        $output = mysqli_real_escape_string($input);
    }
    return $output;
}

function setUnansweredQuestions($id, $user,$total) {
    $bool = false;
    $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
    for ($question = 1; $question <= $total; $question++) {
        $query = "select users_status from $id where id='$question';";
        $result = $mysqli->query($query) or die(mysql_error());
        $resultData = $result->fetch_assoc();
        $result->free();
        parse_str($resultData['users_status'], $usersStatusAssoc);
        if (!array_key_exists($user, $usersStatusAssoc)) {
            $bool = true;
            $usersStatusAssoc[$user] = "0";
        }
        $usersStatusStr = http_build_query($usersStatusAssoc);

        $query = "update " . $id . " set users_status='$usersStatusStr' where id='$question'";
        $mysqli->query($query);
    }
    $mysqli->close();
    if ($bool) {
        $redirectbase = 'Location: http://' . $_SERVER["SERVER_NAME"] . '/viewer?id=' . $id;
        //header($redirectbase);
    }
}

function checkExpiryDate($id, $user, $total) {
    $times = 0;
    $query = "select expire from details where id='$id';";
    $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
    $result = $mysqli->query($query) or die(mysql_error());
    $resultData = $result->fetch_assoc();
    $result->free();
    $expiryDateTime = new DateTime($resultData['expire']);
    $expiryDateTime->setTime(23, 59, 59);
    $currentDateTime = new DateTime("now");
    if ($currentDateTime > $expiryDateTime) {
        for ($question = 1; $question <= $total; $question++) {
            $query = "select users_status from $id where id='$question';";
            $result = $mysqli->query($query) or die(mysql_error());
            $resultData = $result->fetch_assoc();
            $result->free();
            parse_str($resultData['users_status'], $usersStatusAssoc);
            if ((int)$usersStatusAssoc[$user] === 0) {
                $times++;
                $usersStatusAssoc[$user] = "6";
                $usersStatusStr = http_build_query($usersStatusAssoc);
                $query = "update " . $id . " set users_status='$usersStatusStr' where id='$question'";
                $mysqli->query($query);
                updateQuestionDifficulty($id, $question, $usersStatusAssoc);
                updateUserStats($user,-1);
                updateGroupStats($user,-1);
            }
            elseif ((int)$usersStatusAssoc[$user] === 2) {
                $times++;
                updateQuestionDifficulty($id, $question, $usersStatusAssoc);
                updateUserStats($user,-2);
                updateGroupStats($user,-2);
            }
        }
        if ($times > 0) {
            $redirectbase = 'Location: http://' . $_SERVER["SERVER_NAME"] . '/viewer?id=' . $id;
            //header($redirectbase);
        }
        return true;
    }
    else {
        return false;
    }
    $mysqli->close();
}

function setUserQuestionStatus($id, $user, $question, $usersStatusStr, $isCorrect) {
	 parse_str($usersStatusStr, $usersStatusAssoc);
	 if ($isCorrect) {
	    if ($usersStatusAssoc[$user] === "2") {
	       $usersStatusAssoc[$user] = (string)((int) $usersStatusAssoc[$user] + 1);
           updateQuestionDifficulty($id, $question, $usersStatusAssoc);
           updateUserStats($user,2);
           updateGroupStats($user,2);
	    } else {
	       $usersStatusAssoc[$user] = "1";
           updateQuestionDifficulty($id, $question, $usersStatusAssoc);
           updateUserStats($user,1);
           updateGroupStats($user,1);
	    }
	 } else {
	    if ($usersStatusAssoc[$user] === "2") {
	       $usersStatusAssoc[$user] = (string)((int) $usersStatusAssoc[$user] + 2);
           updateQuestionDifficulty($id, $question, $usersStatusAssoc);
           updateUserStats($user,0);
           updateGroupStats($user,0);
	    } else {
	       $usersStatusAssoc[$user] = "2";
	    }
	 }
	 $usersStatusStr = http_build_query($usersStatusAssoc);

	 $query = "update " . $id . " set users_status='$usersStatusStr' where id='$question'";
	 $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
	 $mysqli->query($query);
	 $mysqli->close();
}

function updateUserStats($user, $isCorrect) {
	$query = "select stats from users where id=$user;";
	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	$result = $mysqli->query($query) or die(mysql_error());
	$resultData = $result->fetch_assoc();
	$result->free();
	$mysqli->close();
	 parse_str($resultData['stats'], $usersStatsAssoc);
    $keys = array(1 => 'first', 2 => 'second',0 => 'incorrect', -1 => 'expired', -2 => 'attempted');
    if (array_key_exists($keys[$isCorrect] , $usersStatsAssoc)) {
        $usersStatsAssoc[$keys[$isCorrect]] = (string)((int) $usersStatsAssoc[$keys[$isCorrect]] + 1);
    } else {
        $usersStatsAssoc[$keys[$isCorrect]] = "1";
    }
	 $usersStatsStr = http_build_query($usersStatsAssoc);

	 $query = "update users set stats='$usersStatsStr' where id='$user'";
	 $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	 $mysqli->query($query);
	 $mysqli->close();
}

function updateGroupStats($user, $isCorrect) {
	$query = "select stats from groups where members like '%$user%';";
	$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	$result = $mysqli->query($query) or die(mysql_error());
	$resultData = $result->fetch_assoc();
	$result->free();
	$mysqli->close();
	 parse_str($resultData['stats'], $groupStatsAssoc);
    $keys = array(1 => 'first', 2 => 'second',0 => 'incorrect', -1 => 'expired', -2 => 'attempted');
    if (array_key_exists($keys[$isCorrect] , $groupStatsAssoc)) {
        $groupStatsAssoc[$keys[$isCorrect]] = (string)((int) $groupStatsAssoc[$keys[$isCorrect]] + 1);
    } else {
        $groupStatsAssoc[$keys[$isCorrect]] = "1";
    }
	 $groupStatsStr = http_build_query($groupStatsAssoc);

	 $query = "update groups set stats='$groupStatsStr' where members like '%$user%'";
	 $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	 $mysqli->query($query);
	 $mysqli->close();
}

function updateQuestionDifficulty($id, $question, $usersStatusAssoc){
    $exps = 0;
    foreach ($usersStatusAssoc as &$status){
        $status = intval($status);
        switch ($status) {
            case 0:
                //$status = 0;
                //$exps = $exps + 1;
		$status = 8;
                break;
            case 1:
                $status = 0;
                break;
            case 2:
                $status = 7.5;
                break;
            case 3:
                $status = 5;
                break;
            case 4:
                $status = 10;
                break;
            case 6:
                $status = 0;
                $exps = $exps + 1;
                break;
            default:
                unset($status);
                break;
        }
    }
    $total = array_sum($usersStatusAssoc);
    $avg = (int) $total / (int) (count($usersStatusAssoc) - $exps);
	 $query = "update $id set difficulty='$avg' where id='$question'";
	 $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
	 $mysqli->query($query);
	 $mysqli->close();
}
?>
