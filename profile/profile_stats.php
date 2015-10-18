<?php
$user = $_COOKIE['user_id'];
$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");

$query = "select stats from users where id=$user;";
$result = $mysqli->query($query) or die(mysql_error());
$userOverallData = $result->fetch_assoc();

$query = "select users.group from users where id=$user;";
$result = $mysqli->query($query) or die(mysql_error());
$group = $result->fetch_assoc()["group"];

$query = "select stats from groups where id=$group;";
$result = $mysqli->query($query) or die(mysql_error());
$groupData = $result->fetch_assoc();

$query = "select problem_sets from groups where id=$group;";
$result = $mysqli->query($query) or die(mysql_error());
$psets = explode(",",$result->fetch_assoc()["problem_sets"]);

$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");

foreach ($psets as &$pset) {
	$query = "select users_stats from $pset";
	$result =  mysqli->query($query);
	$num_questions = $result->num_rows();
	//echo "<h4>".$pset."</h4>";
	for($question = 1; $question <= $num_questions; $question++) {
		$row = $result->fetch_assoc();
		parse_str($row['users_status'], $users_status);
		if (array_key_exists($user, $users_status)) {
			//echo "<p>".$question." ".$users_status[$user]."</p>";
		}
	}
	
}

$mysqli->close();
$result->free();
parse_str($userOverallData['stats'],$statsAssoc);
parse_str($groupData['stats'],$statsAssoc2);

$indices = array('first','second','incorrect','expired','attempted');
foreach ($indices as &$index) {
    if (!isset($statsAssoc[$index])){ $statsAssoc[$index] = 0; }
    if (!isset($statsAssoc2[$index])){ $statsAssoc2[$index] = 0; }
}



function percentage($var, $array){
    $raw = ( $var / max(array_sum($array),1) ) * 100;
    $rounded = round($raw,2);
    return $rounded;
}

echo ' <div class="span6">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Statistic</th>
				<th>My Value</th>
				<th>My Percentage</th>
				<th>Group Value</th>
				<th>Group Percentage</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Correct on First Try</td>
				<td>' . $statsAssoc['first'] . '</td>
				<td>' . percentage($statsAssoc['first'],$statsAssoc) . '%</td>
				<td>' . $statsAssoc2['first'] . '</td>
				<td>' . percentage($statsAssoc2['first'],$statsAssoc2) . '%</td>
			</tr>
			<tr>
				<td>Correct on Second Try</td>
				<td>' . $statsAssoc['second'] . '</td>
				<td>' . percentage($statsAssoc['second'],$statsAssoc) . '%</td>
				<td>' . $statsAssoc2['second'] . '</td>
				<td>' . percentage($statsAssoc2['second'],$statsAssoc2) . '%</td>
			</tr>
			<tr>
				<td>Incorrect on First Try</td>
                <td>' . $statsAssoc['attempted'] . '</td>
				<td>' . percentage($statsAssoc['attempted'],$statsAssoc) . '%</td>
				<td>' . $statsAssoc2['attempted'] . '</td>
				<td>' . percentage($statsAssoc2['attempted'],$statsAssoc2) . '%</td>
			</tr>
			<tr>
				<td>Incorrect on Second Try</td>
                <td>' . $statsAssoc['incorrect'] . '</td>
				<td>' . percentage($statsAssoc['incorrect'],$statsAssoc) . '%</td>
				<td>' . $statsAssoc2['incorrect'] . '</td>
				<td>' . percentage($statsAssoc2['incorrect'],$statsAssoc2) . '%</td>
			</tr>
			<tr>
				<td>Expired</td>
                <td>' . $statsAssoc['expired'] . '</td>
				<td>' . percentage($statsAssoc['expired'],$statsAssoc) . '%</td>
				<td>' . $statsAssoc2['expired'] . '</td>
				<td>' . percentage($statsAssoc2['expired'],$statsAssoc2) . '%</td>
			</tr>
		</tbody>
	</table>
</div>';
?>
