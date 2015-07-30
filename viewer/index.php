<!DOCTYPE html>
<html lang="en">
    <?php include("checkauth.php"); ?>
  <?php include ($_SERVER['DOCUMENT_ROOT'] . "/header.php"); ?>
  <body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/navbar/navbar.php"); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="well">
                    <a class="btn btn-primary pull-right" href="../problemsets.php">Go back</a>
                    <h2>Problem Set <?php include("lib.php"); echo substr(sanitize($_GET['id']),2); ?></h2>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span4">
	      <form action="check.php" method="post">
		<?php
		   include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
		   echo "<input type=\"hidden\" name=\"id\" value=\"" . sanitize($_GET['id']) . "\">";
		   ?>
		<table cellspacing="0" class="table table-striped">
		   <?php
		      $problemset_id=sanitize($_GET['id']);
		      $user = $_COOKIE['user_id'];
		      $query = "select * from " . $problemset_id . ";";

		      $mysqli = new mysqli("localhost", "root", "8PaHucre", "nuptse_questions");
		      $result = $mysqli->query($query);
		      $rowcount = $result->num_rows;
              setUnansweredQuestions($problemset_id,$user,$rowcount);
              $isExpired = checkExpiryDate($problemset_id,$user,$rowcount);
		      for ($i = 1; $i <= $rowcount; $i++) {
                $row = $result->fetch_assoc();
		         parse_str($row['users_status'], $users_status);
		         if (array_key_exists($user, $users_status)) {
		             if ((int)$users_status[$user] == 4) {
		                 echo "<tr><td>" . $i . "</td><td>Incorrect after 2 attempts</td><td><button class=\"btn btn-small btn-primary disabled\" type=\"button\" id=\"question\" name=\"question\" value=\"" . $i . "\">Submitted</button></td></tr>\n";
		             } else if ((int)$users_status[$user] == 6) {
		                 echo "<tr><td>" . $i . "</td><td>Question Expired</td><td><button class=\"btn btn-small btn-primary disabled\" type=\"button\" id=\"question\" name=\"question\" value=\"" . $i . "\">Submitted</button></td></tr>\n";
		             } else if (((int)$users_status[$user] % 2) == 1) {
		                 echo "<tr><td>" . $i . "</td><td>Correct after " . ceil((float)$users_status[$user] / 2) . " attempt(s)</td><td><button class=\"btn btn-small btn-primary disabled\" type=\"button\" id=\"question\" name=\"question\" value=\"" . $i . "\">Submitted</button></td></tr>\n";
          		     } else if ((int)$users_status[$user] == 2 and $isExpired == false) {
		                 echo "<tr><td>" . $i . "</td><td><input type=\"text\" id=\"answer" . $i . "\" name=\"answer" . $i . "\" placeholder=\"Enter Answer\" autocomplete=\"off\"></td><td><button class=\"btn btn-small btn-primary btn-danger\" type=\"submit\" id=\"question\" name=\"question\" value=\"" . $i . "\">Try Again</button></td></tr>\n";
          		     } else if ((int)$users_status[$user] == 2 and $isExpired == true) {
		                 echo "<tr><td>" . $i . "</td><td>Incorrect after 1 attempt</td><td><button class=\"btn btn-small btn-primary disabled\" type=\"button\" id=\"question\" name=\"question\" value=\"" . $i . "\">Submitted</button></td></tr>\n";
          		     } else {
		                 echo "<tr><td>" . $i . "</td><td><input type=\"text\" id=\"answer" . $i . "\" name=\"answer" . $i . "\" placeholder=\"Enter Answer\" autocomplete=\"off\"></td><td><button class=\"btn btn-small btn-primary\" type=\"submit\" id=\"question\" name=\"question\" value=\"" . $i . "\">Submit</button></td></tr>\n";
          		     }
		         }
		      }

		      $result->free();
		      $mysqli->close();
		  ?>
                 </table>
	      </form>
            </div>
            <div class="span8" style="height: 100%">
                <div class="well" style="height: 100%">
                <?php 
		if($isExpired == true){ 
		echo "
                       <p>Download the answers <a href='../download.php?id=$problemset_id'>here.</a></p>
                <object data='../pdfs/$problemset_id.pdf' type='application/pdf' width='100%' height='600px'>
                       <p>Looks like you can't view <a href='../pdfs/$problemset_id.pdf'>this file.</a></p>
                    </object>
		";
		}
		else {
		echo "
                <object data='../pdfs/$problemset_id.pdf' type='application/pdf' width='100%' height='600px'>
                       <p>Looks like you can't view <a href='../pdfs/$problemset_id.pdf'>this file.</a></p>
                    </object>
		";
		} ?>
                </div>
             </div>
        </div>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/footer.php"); ?>
    </div> <!-- /container -->
    </div>
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/assets/bootstrap/js/jquery.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
