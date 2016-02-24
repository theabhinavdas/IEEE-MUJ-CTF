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
      if ($flag_text == "leet_haxor") {
         try {
            $conn = new PDO('mysql:host=theabhinavdas.ipagemysql.com;dbname=ctf_db', $dbuser, $dbpass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE ctf_users SET `level10` = 100 where email = :email");
            $stmt->execute(array('email' => $email));
            $_SESSION['is_auth_for_8'] = true;
            header("location: goodjob.php");

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
      <div class="container">
        <h1>Good job!</h1>
        <p>Hope you guys learned something about hacking and security today!</p>
        <p>Also hope you had fun! :D</p>
        <p>Your score has been recorded, the winners will be announced tomorrow!</p>
		  <p>
			Thanks for playing. Cheers!</br>
		  </p>
        <p>
           <b><u>You can logout now!</u></b>
        </p>
      </div>
    </div>

    <div class="container">
      
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