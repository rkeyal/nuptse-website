<!DOCTYPE html>
<html lang="en">
  <?php include ("../header.php"); ?>
  <body>
    <?php include("../navbar/navbar.php"); ?>
    <div class="container">
    <div class="container-fluid">
      <div class="row-fluid">
	<?php
		if (isset($_COOKIE["fname"]))
			include("../resources.php");
	?>
	<div class="span15">
	  <div class="hero-unit">

             <h1>Nuptse Board</h1>
<!-- Number 1=============================================================== -->
             <br />
            
             <p><img src="images/Image_1.png" width="100" height="100" alt="" border="0">TEXTNAME</p>
            
	     <br />
             <p>TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR TEXTPAR </p>
             <hr>
<!-- Number 2============================================================== -->

            
             <p><img src="images/Image_2.png" width="100" height="100" alt="" border="0"> TEXTNAME2</p>

	     <br />
             <p>TEXTPAR2 TEXTPAR2 TEXTPAR2 TEXTPAR2 TEXTPAR2 TEXTPAR TEXTPAR TEXTPAR
                TEXTPAR TEXTPAR TEXTPAR TEXTPAR  TEXTPAR TEXTPAR </p>
             <hr>
<!-- Number 3============================================================== -->

<!-- ====================================================================== -->
        <p><a class="btn btn-primary btn-large" href="../index.php">Back Home &raquo;</a></p>
	  </div>
	</div>
      </div>

      <!-- Example row of columns     -->
<!--      <div class="row">           -->
<!--        <div class="span5">       -->
<!--          <h2>Announcements</h2>  -->
<!--           <p>Coming Soon.</p>    -->
<!--          <p><a class="btn" href="#">View details &raquo;</a></p>-->
<!--       </div>                     -->
<!--        <div class="span5">       -->
<!--          <h2>Upcoming Events</h2>-->
<!--           <p>Coming Soon.</p>    -->
<!--          <p><a class="btn" href="#">View details &raquo;</a></p>-->
<!--       </div>                     -->
<!--      </div>                      -->
      <?php include("../footer.php"); ?> 

    </div> <!-- /container -->
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/bootstrap/js/jquery.js"></script>
    <script src="./assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
