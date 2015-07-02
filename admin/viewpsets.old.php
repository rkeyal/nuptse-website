<?php
   include("checkauth.php");
   ?>
<html>
    <?php include("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
    <?php
            $query = "select id from details;";
            $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
            $result = $mysqli->query($query);
            $column = array();
            while ($row = $result->fetch_assoc()){
                $column[] = $row['id'];
            }
        echo '
    <div class="container">
    <div class="container-fluid">
      <div class="span12">
	<ul class="nav nav-tabs">';
        foreach ($column as $pset) {
            echo "<li><a href='#$pset' data-toggle='tab'>$pset</a></li>";
        }
	echo '</ul>
	<div class="tab-content">';
        foreach ($column as $pset){
            echo "<div class='tab-pane' id='$pset'>
            <table class='table'>
            <tr>
            <th>ID</th>
            <th>Answer</th>
            <th>Tolerance</th>
            <th>Stats</th>
            <th>Difficulty</th>
            </tr>";
            $query = "select * from $pset;";

            $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
            $result = $mysqli->query($query);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['answer'] . "</td><td>" . $row['tolerance'] . "</td><td>" . $row['users_status'] . "</td><td>" . $row['difficulty'] . "</td></tr>";
                }

            $result->free();
            $mysqli->close();
            echo "</table></div>";
        }
        ?>
	</div> <!--/tab content-->
      </div> <!--/span-->
    </div> <!-- /container-fluid -->
    </div> <!--/container-->
    <div class="container">
    <?php include ("footer.php"); ?>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/bootstrap/js/jquery.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
