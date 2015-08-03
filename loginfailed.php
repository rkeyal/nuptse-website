<!DOCTYPE html>
<html lang="en">
	<?php include("./header.php"); ?>
<body>
	<?php include("./navbar/navbar.php"); ?>
	<div class="container">
<?php if (!empty($_GET['pending']) and $_GET["pending"] == "True"){
    echo '<h1>Account Pending</h1>
        <p>Your account is currently pending approval, if you have any questions please contact <a href="mailto:aseem.keyal@gmail.com">aseem.keyal@gmail.com</a>.</p>';
} else {
    echo '<h1>Login Failed</h1>
        <p>Incorrect email or password, please contact <a href="mailto:nuptsefoundation@gmail.com">nuptsefoundation@gmail.com</a> if trying to log in again does not work.</p>';
}
?>
        <?php include("./login.php"); ?>
    <?php include("./footer.php"); ?>
    </div><!--/row-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/bootstrap/js/jquery.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
  </body>
</html>



