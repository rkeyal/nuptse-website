<?php
   include("checkauth.php");
   ?>
<html>
    <?php include("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
    <div class="container">
<<<<<<< HEAD
    <a href="/admin/manageusers.php">Manage Users/Groups</a><br />
    <a href="/admin/viewpsets.php">View Problem Sets</a><br />
    <a href="/admin/addpset.php">Add Problem Set</a>
    <?php if (!empty($_GET['groups']) and $_GET['groups'] === "true") {
=======
    <a href="./manageusers.php">Manage Users/Groups</a><br />
    <a href="./viewpsets.php">View Problem Sets</a><br />
    <a href="./addpset.php">Add Problem Set</a>
    <?php if (isset($_GET['groups']) and $_GET['groups'] === "true") {
>>>>>>> origin/master
        echo '
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Groups modified successfully.
            </div>';
    }
<<<<<<< HEAD
    if (!empty($_GET['groups']) and $_GET['changed'] === "true") {
=======
    if (isset($_GET['changed']) and $_GET['changed'] === "true") {
>>>>>>> origin/master
        echo '
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Password modified successfully.
            </div>';
    }
    ?>
    <?php include("../footer.php"); ?>
    </div> <!-- /container -->
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/bootstrap/js/jquery.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
