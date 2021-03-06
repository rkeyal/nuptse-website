<?php
   include("checkauth.php");
   ?>
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
        echo '
    <div class="container">
    <div class="container-fluid">
      <div class="span12">
	<ul class="nav nav-pills">';
        foreach ($column as $pset) {
            echo "<li><a href='#$pset' data-toggle='pill'>$pset</a></li>";
        }
	echo '</ul>
	<div class="pill-content">';
        for ($i = 0;$i<count($column);$i++){
            $query = "select * from " . $column[$i] . ";";

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
            error_log(implode(", ", $users),3, "../errors.log");
            echo "<div class='pill-pane' id='" . $column[$i] . "'>
            <h1>" . $names[$i] . "</h1>
            <h4>" . $uploaders[$i] . "</h4>
            <h4>" . $uploadeds[$i] . " to " . $expires[$i] . "</h4>";
	?>
	    <a href="/pdfs/<?php echo $column[$i]; ?>.pdf">View problem set</a><br />
		<a href="/admin/editpset.php?edit=<?php echo $column[$i]; ?>">Edit problem set answers</a><br />
		<a href="./exportpset.php?pset=<?php echo $column[$i]; ?>">Export as CSV</a> (can be exported to Excel, etc.)<br /> 
            <table class='table table-striped table-bordered'>
            <tr>
            <th>User</th>
	<?php
            foreach ($ids as $id){
                echo "<th>#$id</th>";
            }
            echo "</tr>";
            $code = array(
				"0" => '<font color="brown">&#x2610;</font><font color="brown">&#x2610;</font>',
				"1" => '<font color="green">&#x2611;</font><font color="brown">&#x2610;</font>',
				"2" => '<font color=  "red">&#x2612;</font><font color="brown">&#x2610;</font>',
				"3" => '<font color=  "red">&#x2612;</font><font color="green">&#x2611;</font>',
				"4" => '<font color=  "red">&#x2612;</font><font color=  "red">&#x2612;</font>',
				"6" => '<i class="icon-time" />'//'<font color="blue">&#x1f55b;</font>'
			);
            foreach ($users as $user){
                echo "<tr><td>$user</td>";
                foreach ($statuses as $status){
                    parse_str($status,$x);
                    if (isset($x[$user])){
                        echo "<td>";
                        echo $code[$x[$user]];
                        echo "</td>";
                    }
                    else{
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
            echo "<tr><th>Difficulty</th>";
            foreach ($diffs as $diff){
                echo "<td>" . round($diff,2) . "</td>";
            }
            echo "</tr>";

            $result->free();
            $mysqli->close();
            echo "</table></div>";
        }
        ?>
	</div> <!--/pill content-->
      </div> <!--/span-->
    </div> <!-- /container-fluid -->
    </div> <!--/container-->
    <div class="container">
    <?php include ("../footer.php"); ?>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/bootstrap/js/jquery.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
