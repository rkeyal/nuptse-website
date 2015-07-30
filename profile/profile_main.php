<?php
$user = $_COOKIE['user_id'];
$query = "select id from groups where members like '%,$user,%';";
$mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_system");
$result = $mysqli->query($query) or die(mysql_error());
$row = $result->fetch_assoc();
$result->free();
$mysqli->close();
?>
<h1>My Profile</h1>
<hr />
<p>Name: <?php echo $_COOKIE['fname'] . " " . $_COOKIE['lname'] ?></p>
<p>Email: <?php echo $_COOKIE['email'] ?></p>
<p>ID: <?php echo $_COOKIE['user_id'] ?></p>
<p>Grade: <?php echo $_COOKIE['grade'] ?></p>
<p>Group: <?php echo $row['id'] ?></p>
<p>Change Password:</p>
<form id="changePassword" action="/profile/change_password.php" method="post">
<div class="control-group">
<input type="password" name="pwd" id="pwd" placeholder="New password" />
</div>
<div class="control-group">
<input type="password" name="cpwd" id="cpwd" placeholder="Confirm new password" />
</div>
<button type="submit" class="btn btn-danger">Change Password</button>
</form>
<?php if (!empty($_GET['changed']) and $_GET["changed"] == "true"){
    echo '<div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> Your password was changed successfully.
            Log out and try your new password.
            </div>';
} ?>
