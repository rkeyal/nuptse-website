<?php
    $pset = $_POST["psets"];
    $group = $_POST["group"];
    $operation = $_POST["operation"];
    $modified = 'false';
    if ($operation == "add"){
        addPset($pset, $group);
        $modified = 'true';
    }
    elseif ($operation == "remove"){
        removePset($pset, $group);
        $modified = 'true';
    }
    header('Location: http://' . $_SERVER["SERVER_NAME"] . '/admin/manageusers.php?psets=' . $modified);

    function addPset($id, $group){
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
        $query = "select problem_sets from groups where id = '$group';";
        $result2 = $mysqli->query($query) or die(mysql_error());
        while ($row = $result2->fetch_assoc()){
            $current = explode(",", $row['problem_sets']);
            array_push($current, $id);
            $result = array_unique($current);
            $final = implode(",", $result);
        }
        $query = "update groups set problem_sets = '$final' where id = $group;";
        $result = $mysqli->query($query) or die(mysql_error());
        $mysqli->close();
    }
    function removePset($id, $group){
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
        $query = "select problem_sets from groups where id = '$group';";
        $result2 = $mysqli->query($query) or die(mysql_error());
        while ($row = $result2->fetch_assoc()){
            $current = explode(",", $row['problem_sets']);
            $result = array_diff($current, [$id]);
            $final = implode(",", $result);
        }
        $query = "update groups set problem_sets = '$final' where id = $group;";
        $result = $mysqli->query($query) or die(mysql_error());
        $mysqli->close();
    }
?>
