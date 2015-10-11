<?php
header("Content-type: text/csv");
header("Content-disposition: attachment; filename=" . $_GET['pset'] . ".csv");

$query = "select * from ". $_GET['pset'];
$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
$result = $mysqli->query($query);
$statuses = array();
$diffs = array();
$answers = array();
$ids = array();
while ($row = $result->fetch_assoc()) {
	$statuses[] = $row['users_status'];
	$diffs[] = $row['difficulty'];
	$answers[] = $row['answer'];
	$ids[] = $row['id'];
}
$users = array();
foreach ($statuses as $status){
	parse_str($status,$x);
	$keys = array_keys($x);
	$users = array_merge($keys, $users);
}
$users = array_unique($users);
echo "Users";
foreach ($ids as $id) {
	echo ", #$id";
}
echo "\n";
$code = array(
	"0" => '0',
	"1" => '1',
	"2" => '0',
	"3" => '1',
	"4" => '0',
	"6" => '0'
);
foreach ($users as $user){
	echo "$user";
	foreach ($statuses as $status){
		parse_str($status,$x);
		if (isset($x[$user])){
			echo ", " . $code[$x[$user]];
		}
		else{
			echo ", ERR";
		}
	}
	echo "\n";
}
echo "Answer";
foreach ($answers as $answer){
	echo ", " . round($answer, 2);
}
echo "\n";
echo "Difficulty";
foreach ($diffs as $diff){
	echo ", " . round($diff,2);
}
echo "\n";
?>