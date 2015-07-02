<?php
$user = $_COOKIE['user_id'];
$query = "select stats from users where id=$user;";
$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
$result = $mysqli->query($query) or die(mysql_error());
$userData = $result->fetch_assoc();
$query = "select stats from groups where members like '%$user%';";
$result = $mysqli->query($query) or die(mysql_error());
$groupData = $result->fetch_assoc();
$result->free();
$mysqli->close();
parse_str($userData['stats'],$statsAssoc);
parse_str($groupData['stats'],$statsAssoc2);

$indices = array('first','second','incorrect','expired','attempted');
foreach ($indices as &$index) {
    if (!isset($statsAssoc[$index])){ $statsAssoc[$index] = 0; }
    if (!isset($statsAssoc2[$index])){ $statsAssoc2[$index] = 0; }
}

function percentage($var, $array){
    $raw = ( $var / array_sum($array) ) * 100;
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
