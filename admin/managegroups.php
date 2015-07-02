<?php
   include("checkauth.php");
    $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
    $query = "SELECT id from groups;";
    $result = $mysqli->query($query) or die(mysql_error());
    $groups = "<select name='group' id='group'>";
    while ($row = $result->fetch_assoc()){
        $id = $row['id'];
        $groups = $groups .  "<option value='$id'>$id</option>";
    }
    $groups = $groups . "</select>";
    $result->free();
    $mysqli->close();
    $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
    $query = "SELECT id FROM details;";
    $result = $mysqli->query($query) or die(mysql_error());
    $psets = "<select name='psets' id='psets'>";
    while ($row = $result->fetch_assoc()){
        $id = $row['id'];
        $psets = $psets .  "<option value='$id'>$id</option>";
    }
    $psets = $psets . "</select>";
    $result->free();
    $mysqli->close();
?>
    <div class="row">
        <div class="span3">
            <form action="modifygroups.php" method="post" accept-charset="utf-8">
                <p>Add or remove groups</p>
                <input type="radio" name="operation" id="operation" value="add" />Add
                <br />
                <input type="text" name="users" id="users" placeholder="Enter users here" />
                <br />
                <input type="radio" name="operation" id="operation" value="remove" />Remove
                <br />
                <p>Select group:</p>
                <?php echo $groups; ?>
                <br />
                <button type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"> Add/Remove Group </button>
            </form>
        </div>
        <div class="span3">
            <form action="changegroups.php" method="post" accept-charset="utf-8">
                <p>Add or remove users from groups</p>
                <input type="radio" name="operation" id="operation" value="add" />Add
                <br />
                <input type="radio" name="operation" id="operation" value="remove" />Remove
                <br />
                <br />
                <input type="text" name="users" id="users" placeholder="Enter users here" />
                <br />
                <p>Select group:</p>
                <?php echo $groups; ?>
                <br />
                <button type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"> Add/Remove User(s) </button>
            </form>
        </div>
    <div class="span3">
        <form action="modifypsets.php" method="post" accept-charset="utf-8">
            <p>Add or remove psets from groups</p>
            <input type="radio" name="operation" id="operation" value="add" />Add
            <br />
            <input type="radio" name="operation" id="operation" value="remove" />Remove
            <br />
            <p>Select group:</p>
            <?php echo $groups; ?>
            <br />
            <p>Select psets:</p>
            <?php echo $psets; ?>
            <br />
            <button type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"> Add/Remove Pset </button>
        </form>
    </div>
    </div>
