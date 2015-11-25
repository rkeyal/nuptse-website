<?php include("checkauth.php"); ?>
<html>
	<?php include("../header.php"); ?>
	<body>
		<?php include("../navbar/navbar.php"); ?>
		<?php
			$query = "select * from details;";
			$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
			$result = $mysqli->query($query);
			$column = array();
			$expires = array();
			$uploadeds = array();
			$names = array();
			$users = array();
			while ($row = $result->fetch_assoc()){
				$column[] = $row['id'];
				$expires[] = $row['expire'];
				$uploadeds[] = $row['uploaded'];
				$names[] = $row['name'];
				$uploaders[] = $row['user'];
			}
			$mysqli->close();
			
			$query = "select * from groups";
			$mysqli_g = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
			$result_g = $mysqli_g->query($query);
			$groups = array();
			$users = array();
			$psetsl = array();
			while ($row = $result_g->fetch_assoc()) {
				$groups[] = $row['id'];
				$users[] = $row['members'];
				$psetsl[] = $row['problem_sets'];
			}
			$mysqli_g->close();
			
			echo '
		<div class="container" style="padding:20px 10px">
			<div class="container-fluid">
				<div class="span12">
					<ul class="nav nav-pills">
						<li><h5>Group #</h5></li>';
			foreach($groups as $gid) {
				echo "<li><a href='#$gid' data-toggle='pill'>$gid</a></li>";
			}
			echo '</ul>
					<div class="pill-content">
						<hr/>';
			for ($i = 0; $i < count($groups); $i++) {
				echo "<div class='pill-pane' id='" . $groups[$i] . "'>";
				$psets = explode(",", $psetsl[$i]);
				echo '
						<div class="container">
							<div class="container-fluid">
								<ul class="nav nav-pills">
									<li><h6>Problem Set</h6></li>';
				foreach($psets as $pset) {
					echo "<li><a href='#" . $groups[$i] . "$pset' data-toggle='pill'>$pset</a></li>";
				}
				echo '</ul>
								<div class="pill-content">';
				for ($j = 0; $j < count($psets); $j++) {
					if (!empty($j) or $j == 0 and !empty($psets[$j])) {
						$query = "select * from " . $psets[$j];
						$mysqli_p = new mysqli("localhost","root","8PaHucre", "nuptse_questions");
						$result_p = $mysqli_p->query($query);
						$statuses = array();
						$diffs = array();
						$answers = array();
						$ids = array();
						while ($row = $result_p->fetch_assoc()) {
							$statuses[] = $row['users_status'];
							$diffs[] = $row['difficulty'];
							$answers[] = $row['answer'];
							$ids[] = $row['id'];
						}
						$mysqli_p->close();
						
						$user_f = array();
						for ($k = 0; $k < count($statuses); $k++) {
							parse_str($statuses[$k], $x);
							$keys = array_keys($x);
							foreach ($keys as $key) {
								if (in_array($key, explode(',',$users[$i]))) {
									$user_f[] = $key;
								}
							}
						}
						$user_f = array_unique($user_f);
						//error_log(implode(", ", $user_f),3, "../errors.log");
						$l = array_search($psets[$j], $column);
						echo "<div class='pill-pane' id='" . $groups[$i] . $psets[$j] . /** "'>"; /*/ "'>
									<h1>" . $names[$l] . "</h1>
									<h4>" . $uploaders[$l] . "</h4>
									<h4>" . $uploadeds[$l] . " to " . $expires[$l] . "</h4>"; /**/
		?>
									<a href="/pdfs/<?php echo $psets[$j]; ?>.pdf">View problem set</a><br />
									<a href="/admin/editpset.php?edit=<?php echo $psets[$j]; ?>">Edit problem set answers</a><br />
									<a href="./exportpset.php?pset=<?php echo $psets[$j]; ?>">Export as CSV</a> (can be exported to Excel, etc.)<br /> 
									<table class='table table-striped table-bordered'>
									<tr>
									<th>User</th>
		<?php
						foreach ($ids as $id) {
							echo "<th>#$id</th>";
						}
						$code = array(
							"0" => '<font color="brown">&#x2610;</font><font color="brown">&#x2610;</font>',
							"1" => '<font color="green">&#x2611;</font><font color="brown">&#x2610;</font>',
							"2" => '<font color=  "red">&#x2612;</font><font color="brown">&#x2610;</font>',
							"3" => '<font color=  "red">&#x2612;</font><font color="green">&#x2611;</font>',
							"4" => '<font color=  "red">&#x2612;</font><font color=  "red">&#x2612;</font>',
							"6" => '<i class="icon-time" />'//'<font color="blue">&#x1f55b;</font>'
						);
						foreach ($user_f as $user) {
							echo "<tr><td>$user</td>";
							foreach ($statuses as $status) {
								parse_str($status,$x);
								if (isset($x[$user])) {
									echo "<td>";
									echo $code[$x[$user]];
									echo "</td>";
								}
								else {
									echo "<th>No</th>";
								}
							}
							echo "</tr>";
						}
						echo "<tr><th>Answer</th>";
						foreach ($answers as $answer){
							echo "<td>" . round($answer, 2) . "</td>";
						}
						echo "</tr>";
						/*
						 * does not reflect the difficulty experienced
						 * by that group, but rather the overall
						 * difficulty across all groups.
						 */
						echo "<tr><th>Difficulty</th>";
						foreach ($diffs as $diff){
							echo "<td>" . round($diff,2) . "</td>";
						}
						echo '</table>';
						echo "</div>";
					}
				}
				echo '</div></div>';
				// DIV pill-pane
				echo '</div></div>';
			}
			echo '
					</div>
				</div>
			</div>
			';
			include('../footer.php');
			echo '
		</div>';
		?>
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../assets/bootstrap/js/jquery.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>