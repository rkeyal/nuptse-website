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
			echo '
		<div class="container">
			<div class="container-fluid">
				<div class="span12">
					<h3>Group #</h3>
					<ul class="nav nav-tabs">';
			foreach($groups as $gid) {
				echo "<li><a href='#$gid' data-toggle='tab'>$gid</a></li>";
			}
			echo '</ul>
					<div class="tab-content">';
			for ($i = 0; $i < count($groups); $i++) {
				echo "<div class='tab-pane' id='" . $groups[$i] . "'>";
				$psets = explode(",", $psetsl[$i]);
				echo '
						<div class="container">
							<div class="container-fluid">
								<h5>Problem Set</h5>
								<ul class="nav nav-pills">';
				foreach($psets as $pset) {
					echo "<li><a href='#" . $groups[$i] . "$pset' data-toggle='pill'>$pset</a></li>";
				}
				echo '</ul>
								<div class="pill-content">';
				for ($j = 0; $j < count($psets); $j++) {
					if (!empty($j) and isset($psets[$j])) {
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
						echo '</table>';
						echo "</div>";
					}
				}
				echo '</div></div>';
				// DIV tab-pane
				echo '</div></div>';
			}
			echo '
					</div>
				</div>
			</div>
		</div>';
		?>
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../assets/bootstrap/js/jquery.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>