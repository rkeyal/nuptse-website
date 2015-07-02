<?php
   include("checkauth.php");
   ?>
<html>
    <?php include("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
    <div class="container">
    <a href="/admin/manageusers.php">Manage Users/Groups</a><br />
    <a href="/admin/viewpsets.php">View Problem Sets</a><br />
    <a href="/admin/addpset.php">Add Problem Set</a>
    <?php if ($_GET['groups'] === "true") {
        echo '
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Success!</strong> Groups modified successfully.
            </div>';
    }
    if ($_GET['changed'] === "true") {
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
