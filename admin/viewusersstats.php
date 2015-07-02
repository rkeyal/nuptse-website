<?php
   include("checkauth.php");
   ?>
    <table class="table table-striped table-bordered">
      <tr>
	<th>ID</th>
	<th>Last name</th>
	<th>First name</th>
	<th>Group</th>
	<th>Stats</th>
      </tr>
      <?php
	 $query = "select * from users where approved=1 order by id asc;";

	 $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	 $result = $mysqli->query($query);

         while ($row = $result->fetch_assoc()) {
            parse_str($row['stats'], $userStats);
            if ($userStats['first'] != 0 or $userStats['second'] != 0 or $userStats['incorrect'] != 0 or $userStats['expired'] != 0 or $userStats['attempted'] != 0){
                echo "<tr><td>" . $row['id'] . "</td><td>" . $row['lname'] . "</td><td>" . $row['fname'] . "</td><td>" . $row['group'] . "</td><td>" . $row['stats'] . "</td></tr>";
            }
         }

         $result->free();
         $mysqli->close();
	 ?>
    </table>
