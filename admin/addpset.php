<?php include("./checkauth.php"); ?>
<html>
	<?php include("../header.php"); ?>
	<body>
		<?php include("../navbar/navbar.php"); ?>
		<div class="container" style="padding: 20px">
			<form method="post" action="inputpset.php">
				Number of Questions:
				<!-- HTML5 only. Defaults to text -->
				<input name="questioncount" type="number" style="padding: 0px 5px" min=0>
				<br />
				<input type="submit" value="Next">
			</form>
			<?php include("../footer.php"); ?>
		</div> <!-- /container -->
		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="../assets/bootstrap/js/jquery.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>
