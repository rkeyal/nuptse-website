<!DOCTYPE html>
<html lang="en">
  <?php include("header.php") ?>
  <body>

    <?php include("navbar/navbar.php"); ?>
    <div class="container">
    <table cellspacing="0" class="table table-striped table-bordered sortable">
    <tr>
        <th>PS#</th>
        <th>Description</th>
        <th>Expiry Date</th>
        <th>Status</th>
        <th>Open</th>
    </tr>
    <?php
	if (isset($_COOKIE["fname"])) {
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
        $user_id = $_COOKIE['user_id'];
        $query = "select problem_sets from groups where members like '%,$user_id,%';";
        $res = $mysqli->query($query) or die(mysql_error());
        while ($row = $res->fetch_assoc()) {
            extract($row);
        }
        //$tables = array_filter(explode(",",$problem_sets));
        if (/*count($tables) > 0*/ isset($problem_sets)) {
			/**/$tables = array_filter(explode(",",$problem_sets));/**/
        foreach ($tables as &$ps) {
            $number = substr($ps,2);
            $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
            $user_id = $_COOKIE['user_id'];
            $query = "select * from details where id = 'ps$number';";
            $res = $mysqli->query($query) or die(mysql_error());
            while ($row = $res->fetch_assoc()) {
                $status = getStatus($user_id, $number);
                $message = "Open Problems";
                $date = date('Y-m-d');
                if ($date > $row['expire'] and $status[1] == 'btn-primary') {
                    $status[1] = 'btn-danger';
                    $message = "Open Solutions";
                } elseif ($date > $row['expire']) {
                    $message = "Open Solutions";
                }
                echo '<tr>
                    <td>' . $number . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['expire'] . '</td>
                    <td>' . $status[0] . '</td>
                    <td><a class="btn ' . $status[1] . '" href="viewer/index.php?id=ps' . $number . '">' . $message . '</a></td>
                </tr>';
            }
        }
        }
        else {
            echo '</table>
                <p>Please wait for your account to be added to a group.</p>';
        }
    }
	else
        echo '<p>Please log in to see your problem sets.</p>';
    function getStatus($id, $pset) {
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
        $query = "select users_status from ps$pset;";
        $res2 = $mysqli->query($query) or die(mysql_error());
        $total = 0;
        $answered = 0;
	$allowed = array(1, 3, 4);
        while ($row = $res2->fetch_assoc()) {
            parse_str($row['users_status'], $stats);
            $total = $total + 1;
            if (!empty($stats[$id]) and in_array($stats[$id], $allowed)){
                $answered = $answered + 1;
            }
        }
        $combined = $answered . "/" . $total;
        $status = 'btn-primary';
        if ($answered == $total) {
            $status = 'btn-success';
        } elseif ($answered != 0) {
            $status = 'btn-warning';
        }
        return array($combined, $status);
    }
	?>
    </table>
	</div>
    <div class="container">
      <?php include ("footer.php"); ?>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/bootstrap/js/jquery.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>
