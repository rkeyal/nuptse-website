<?php
    function purgeUserStats($id, $group, $group2){
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
        $query = "select stats from users where id = $id;";
        $result = $mysqli->query($query) or die(mysql_error());
        while ($row = $result->fetch_assoc()){
            $oldStats = $row['stats'];
            parse_str($oldStats, $userStats);
        }
        $query = "select stats from groups where id = $group;";
        $result = $mysqli->query($query) or die(mysql_error());
        while ($row = $result->fetch_assoc()){
            parse_str($row['stats'], $groupStats);
        }
        $newStats = array();
        foreach ($userStats as $key => $value){
            $newStats[$key] = $groupStats[$key] - $userStats[$key];
        }
        $newStats = http_build_query($newStats);
        $query = "update groups set stats = '$newStats' where id = $group;";
        $result = $mysqli->query($query) or die(mysql_error());
        $query = "update users set stats = 'incorrect=0&first=0&second=0&expired=0&attempted=0' where id = $id;";
        $result = $mysqli->query($query) or die(mysql_error());
        $query = "insert into changes (id, first, second, stats, date) values ($id, '$group', '$group2', '$oldStats', UTC_TIMESTAMP());";
        $result = $mysqli->query($query) or die(mysql_error());
        $mysqli->close();
    }
    function addUser($id, $group){
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
        error_log($id, 3, "/var/www/html/errors.log");
        error_log($group, 3, "/var/www/html/errors.log");
        $query = "select members,stats from groups where id = '$group';";
        error_log($query, 3, "/var/www/html/errors.log");
        $result2 = $mysqli->query($query) or die(mysql_error());
        while ($row = $result2->fetch_assoc()){
            $current = explode(",", $row['members']);
            array_push($current, $id);
            parse_str($row['stats'], $oldGroupStats);
            $result = array_unique($current);
            $final = implode(",", $result);
            if ($final[0] != ",") {
                $final = "," . $final;
            }
            if (substr($final,-1) != ",") {
                $final = $final . ",";
            }
        }
        $query = "update groups set members = '$final' where id = $group;";
        $result = $mysqli->query($query) or die(mysql_error());
        $query = "update users set `group` = '$group' where id = $id;";
        $result = $mysqli->query($query) or die(mysql_error());
        $query = "select stats from changes where id = '$id' and first = '$group' order by `date` desc limit 1;";
        $result3 = $mysqli->query($query) or die(mysql_error());
        while ($row = $result3->fetch_assoc()){
            parse_str($row['stats'], $oldStats);
        }
        foreach ($oldStats as $key => $value){
            $newStats[$key] = $oldStats[$key] + $oldGroupStats[$key];
        }
        $newStats = http_build_query($newStats);
        $query = "update groups set stats = '$newStats' where id = $group;";
        $result = $mysqli->query($query) or die(mysql_error());
        $query = "update users set stats = '" . http_build_query($oldStats) . "' where id = $id;";
        $result = $mysqli->query($query) or die(mysql_error());
        $mysqli->close();
    }
    function removeUser($id, $group, $group2){
        $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
        $query = "select members from groups where id = $group;";
        $result3 = $mysqli->query($query);
        while ($row = $result3->fetch_assoc()){
            $current = explode(",", $row['members']);
            unset($current[array_search($id, $current)]);
            purgeUserStats($id, $group, $group2);
            $final = implode(",", $current);
            if ($final[0] != ",") {
                $final = "," . $final;
            }
            if (substr($final,-1) != ",") {
                $final = $final . ",";
            }
        }
        $query = "update groups set members = '$final' where id = $group;";
        $result = $mysqli->query($query) or die(mysql_error());
        $query = "update users set `group` = '0' where id = $id;";
        $result = $mysqli->query($query) or die(mysql_error());
        $mysqli->close();
    }
?>
