<?php
   include("checkauth.php");
   ?>
    <h2>Students</h2>
    <table class="table table-striped table-bordered">
      <tr>
	<th>Group</th>
	<th>Users</th>
      </tr>
      <?php
	 $query = "select parent_email,email,`group` from users where `group`!=0 order by `group` desc;";

	 $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
	 $result = $mysqli->query($query);
    $group = 0;
     $emailsByGroup = array();
     $emails = '';
     $parentemailsByGroup = array();
     $parentemails = '';
         while ($row = $result->fetch_assoc()) {
            if ($group != 0 and $row['group'] != $group) {
                $emailsByGroup[$group] = $emails;
                $emails = $row['email'];
                $parentemailsByGroup[$group] = $parentemails;
                $parentemails = $row['parent_email'];
                $group = $row['group'];
            }
            elseif ($group == 0){
                $group = $row['group'];
                $emails = $row['email'];
                $parentemails = $row['parent_email'];
            }
            else {
                $emails = $emails . "," . $row['email'];
                $parentemails = $parentemails . "," . $row['parent_email'];
            }
         }
        $emailsByGroup[$group] = $emails;
        $parentemailsByGroup[$group] = $parentemails;
        foreach ($emailsByGroup as $key => $value){
            echo "<tr>
                <td>$key</td>
                <td>" . ltrim($value, ',') . "</td>
                </tr>";
        }
        echo '</table>
            <h2>Parents</h2>
            <table class="table table-striped table-bordered">
            <tr>
            <th>Group</th>
            <th>Parent</th>
            </tr>';
        foreach ($parentemailsByGroup as $key => $value){
            echo "<tr>
                <td>$key</td>
                <td>" . ltrim($value, ',') . "</td>
                </tr>";
        }
        echo '</table>';
         $result->free();
         $mysqli->close();
	 ?>
