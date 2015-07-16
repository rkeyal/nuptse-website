<!DOCTYPE html>
<html lang="en">
  <?php include ("header.php"); ?>
  <body>
    <?php include("navbar/navbar.php"); ?>
    <div class="container">
    <div class="container-fluid">
      <div class="row-fluid">
	<?php
		if (isset($_COOKIE["fname"]))
			include("resources.php");
	?>
	<div class="span9">
	  <div class="hero-unit">
            <h1>Welcome</h1>
            <br />
            <p>Answer questions and view your stats here.</p>
            <br />
        <p><a class="btn btn-primary btn-large" href="register/">Register now &raquo;</a></p>
	  </div>
	</div>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="span5">
          <h2>Announcements</h2>
           <p>Coming Soon.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
       </div>
        <div class="span5">
          <h2>Upcoming Events</h2>
           <p>Coming Soon.</p>
          <p><a class="btn" href="#">View details &raquo;</a></p>
       </div>
      </div>
      <?php include("footer.php"); ?>

    </div> <!-- /container -->
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/bootstrap/js/jquery.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
