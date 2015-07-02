<?php
    include('lib.php');
    $users = $_POST["users"];
    $group = $_POST["group"];
    $operation = $_POST["operation"];
    $current = explode(",", $users);
    $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
    foreach ($current as $id) {
        $query = "select `group`,approved from users where id = $id;";
        $result = $mysqli->query($query) or die(mysql_error());
        $modified = 'false';
        while ($row = $result->fetch_assoc()){
            if ($row['group'] == 0 && $operation == "add" && $row['approved'] == 1){
                addUser($id, $group);
                $modified = 'true';
            }
            elseif ($row['group'] != 0 && $operation == "add" && $group != $row['group'] && $row['approved'] == 1){
                removeUser($id, $row['group'], $group);
                addUser($id, $group);
                $modified = 'true';
            }
            elseif ($row['group'] != 0 && $operation == "remove" && $group == $row['group']){
                removeUser($id, $group, NULL);
                $modified = 'true';
            }
        }
    }
    $mysqli->close();
    header('Location: http://' . $_SERVER["SERVER_NAME"] . '/admin/manageusers.php?groups=' . $modified);
?>
