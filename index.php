<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

	<head>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<script type="text/javascript" src="/assets/bootstrap/js/stepcarousel.js">

		/***********************************************
		* Step Carousel Viewer script- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
		* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
		* Please keep this notice intact
		***********************************************/

		</script>

		<style type="text/css">

		.stepcarousel{
		position: relative; /*leave this value alone*/
		border: 0px solid white;
		overflow: scroll; /*leave this value alone*/
		width: 1320px; /*Width of Carousel Viewer itself*/
		height: 600px; /*Height should enough to fit largest content's height*/
		-webkit-box-sizing: border-box; /* set box model so container width and height value includes any padding/border defined */
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		}

		.stepcarousel .belt{
		position: absolute; /*leave this value alone*/
		left: 0;
		top: 0;
		}

		.stepcarousel .panel{
		float: left; /*leave this value alone*/
		overflow: hidden; /*clip content that go outside dimensions of holding panel DIV*/
		margin: 10px; /*margin around each panel*/
		width: 1320px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then. */
		}

		span.paginatecircle{ /* CSS for paginate circle spans. Required */
		background: white;
		border: 2px solid black;
		border-radius: 10px;
		width: 6px;
		height: 6px;
		cursor: pointer;
		display: inline-block;
		margin-right: 4px;
		}

		span.paginatecircle:hover{
		background: gray;
		}

		span.paginatecircle.selected{
		background: black;
		}

		</style>



		<script type="text/javascript">

		stepcarousel.setup({
			galleryid: 'mygallery', //id of carousel DIV
			beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
			panelclass: 'panel', //class of panel DIVs each holding content
			autostep: {enable:true, moveby:1, pause:3000},
			panelbehavior: {speed:500, wraparound:true, wrapbehavior:'slide', persist:true},
			defaultbuttons: {enable: true, moveby: 1, leftnav: ['/images/arrow_left.png', 20, 262], rightnav: ['/images/arrow_right.png', -85, 262]},
			statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
			contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
		})

		</script>

	</head>

  <?php include ("header.php"); ?>
  <body>
  
	<div id="mygallery" class="stepcarousel">
		<div class="belt">

			<div class="panel">
				<img src="/images/Slide1.png" />
			</div>

			<div class="panel">
				<img src="/images/Slide2.png" />
			</div>

			<div class="panel">
				<img src="/images/Slide3.png" />
			</div>

			<div class="panel">
				<img src="/images/Slide4.png" />
			</div>

			<div class="panel">
				<img src="/images/Slide5.png" />
			</div>

			<div class="panel">
				<img src="/images/Slide6.png" />
			</div>

		</div>
	</div>


	<p id="mygallery-paginate">
		<span class="paginatecircle" data-moveby="1"></span>
	</p>
	

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
