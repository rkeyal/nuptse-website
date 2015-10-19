<?php
   include("checkauth.php");
   ?>
    <table class="table table-striped table-bordered">
      <tr>
	<th>ID</th>
	<th>Last name</th>
	<th>First name</th>
	<th>Group</th>
	<th>First Correct</th>
	<th>Second Correct</th>
	<th>Incorrect</th>
	<th>Attempted</th>
	<th>Expired</th>


	
      </tr>
      <?php
	 $query = "select * from users where approved=1 order by id asc;";

	 $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	 $result = $mysqli->query($query);

         while ($row = $result->fetch_assoc()) {
            parse_str($row['stats'], $userStats);
            //if ((!empty($userStats['first']) and $userStats['first'] != 0) or (!empty($userStats['second']) and $userStats['second'] != 0) or (!empty($userStats['incorrect']) and $userStats['incorrect'] != 0) or (!empty($userStats['expired']) and $userStats['expired'] != 0) or (!empty($userStats['attempted']) and $userStats['attempted'] != 0)){
            if(!empty($row['stats'])) {
			echo "<tr><td>" . $row['id'] . "</td><td>" . $row['lname'] . "</td><td>" . $row['fname'] . "</td><td>" . $row['group'] . "</td>";
			echo "<td>" . (empty($userStats['first'])?"0":$userStats['first']) . "</td><td>" . (empty($userStats['second'])?"0":$userStats['second']) . "</td><td>" . (empty($userStats['incorrect'])?"0":$userStats['incorrect']) . "</td><td>" . (empty($userStats['attempted'])?"0":$userStats['attempted']) . "</td><td>" . (empty($userStats['expired'])?"0":$userStats['expired']) . "</td></tr>";
            }
         }

         $result->free();
         $mysqli->close();
	 ?>
    </table>
