<?php
   include("checkauth.php");
    $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
    $query = "SELECT email from users;";
    $result = $mysqli->query($query) or die(mysql_error());
    $users = "<select name='user' id='user'>";
    while ($row = $result->fetch_assoc()){
        $email = $row['email'];
        $users = $users .  "<option value='$email'>$email</option>";
    }
    $users = $users . "</select>";
    $result->free();
    $mysqli->close();
?>
    <div class="row">
        <div class="span3">
            <form action="../profile/change_password.php" method="post" accept-charset="utf-8">
                <p>Set password for user:</p>
                <input type="text" name="pwd" id="pwd" placeholder="Enter password here" />
                <br />
                <p>Select user:</p>
                <?php echo $users; ?>
                <br />
		<input type="hidden" name="admin" value="true">
                <button type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"> Set Password </button>
            </form>
        </div>
    </div>
