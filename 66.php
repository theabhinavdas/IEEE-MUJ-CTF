<?php

session_start();

if (!isset($_SESSION["is_auth"])) {
	header("location: index.php");
	exit;
}

if (isset($_POST['flag-submit'])) {
   // Also check that our email address and password were passed along. If not, jump
   // down to our error message about providing both pieces of information.
   if (isset($_POST['flag'])) {
      $email = $_SESSION['email'];
      $dbuser = 'ctf_muj';
      $dbpass = 'lolno';
      // Connect to the database and select the user based on their provided email address.
      // Be sure to retrieve their password and any other information you want to save for the user session.

      $flag_text = $_POST['flag'];
      if ($flag_text == "ping") {
         try {
            $conn = new PDO('mysql:host=theabhinavdas.ipagemysql.com;dbname=ctf_db', $dbuser, $dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE ctf_users SET `level6` = 100 where email = :email");
            $stmt->execute(array('email' => $email));
            $_SESSION['is_auth_for_7'] = true;
            header("location: 777.php");

         } catch(PDOException $e) {
             echo 'ERROR: ' . $e->getMessage();
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Abhinav Das">

    <title>IEEE MUJ CTF</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">IEEE MUJ CTF</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" action="logout.php">
            <button type="submit" class="btn btn-success">Logout</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
		 <center>
			 <ul id="menu" style="font-size: 18px;">
				 <li><a href="1.php">Level 1</a></li>
				 <li><a href="22.php">Level 2</a></li>
				 <li><a href="33333.php">Level 3</a></li>
				 <li><a href="4444.php">Level 4</a></li>
				 <li><a href="555555.php">Level 5</a></li>
				 <li><a href="66.php">Level 6</a></li>
				 <li><a href="777.php">Level 7</a></li>
				 <li><a href="888.php">Level 8</a></li>
				 <li><a href="9999.php">Level 9</a></li>
				 <li><a href="1010.php">Level 10</a></li>
			 </ul>
		 </center>
      <div class="container">
        <h1>Level 6</h1>
        <p>Problem statement:</p>
        <p>What terminal command is used to find the IP address of a website?</p>

      </div>
    </div>

    <div class="container">
      <form action="" method="post">
         <center>
               <h2>Enter flag:</h2><input type="text" name="flag"><input type="submit" value="Submit" name="flag-submit">
         </center>
      </form>
      <hr>

      <footer>
        <p>&copy; 2015  -- supay</p>
      </footer>
    </div> <!-- /container -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
