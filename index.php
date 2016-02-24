<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	// First start a session. This should be right at the top of your login page.
	session_start();

	// Check to see if this run of the script was caused by our login submit button being clicked.
	if (isset($_POST['login-submit'])) {
		// Also check that our email address and password were passed along. If not, jump
		// down to our error message about providing both pieces of information.
		if (isset($_POST['email_address']) && isset($_POST['password'])) {
			$email = $_POST['email_address'];
			$pass = $_POST['password'];
         $dbuser = 'ctf_muj';
         $dbpass = 'lolno';
			// Connect to the database and select the user based on their provided email address.
			// Be sure to retrieve their password and any other information you want to save for the user session.
         try {
             $conn = new PDO('mysql:host=theabhinavdas.ipagemysql.com;dbname=ctf_db', $dbuser, $dbpass);
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

             $stmt = $conn->prepare('SELECT * FROM ctf_users WHERE email = :email AND password = :pass');
             $stmt->execute(array('email' => $email, 'pass' => $pass));
             $result = $stmt->fetchAll();
             if ( count($result) ) {
                $_SESSION['is_auth'] = true;
                $_SESSION['email'] = $email;
                header("location: 1.php");
             }
         } catch(PDOException $e) {
             echo 'ERROR: ' . $e->getMessage();
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
          <form class="navbar-form navbar-right" action="" method="post">
            <div class="form-group">
              <input type="text" placeholder="Email" class="form-control" name="email_address" id="email_address">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password" id="password">
            </div>
            <button type="submit" class="btn btn-success" name="login-submit" id="login-submit">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>Welcome to the CTF organised by IEEE MUJ.</p>
		  <p>Firstly, I am extremely happy with the response and interest showed by everybody today. Keep that up! :) Here are some rules for the CTF:</p>
        <p>
           <ul>
             <li>Relax! Have fun! Hack!</li>
				 <li>No negative marking. Attempt the questions in any order.</li>
				 <li><b>Google is your friend. Take help of Google as much as you need!</b></li>
				 <li>No DDoS or DoS attacks! :P</li>
				 <li>No brute-force attacks! :P</li>
				 <li>Keep the Natas war-game in mind while playing this CTF</li>
           </ul>
        </p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Winners</h2>
          <ol>
             <li>_______________________</li>
             <li>_______________________</li>
             <li>_______________________</li>
          </ol>
        </div>
        <div class="col-md-4">
          <h2>Leaderboard</h2>
          <p>Leaderboard will be active shortly!</p>
          <p><a class="btn btn-default" href="#" role="button" disabled="true">View Leaderboard &raquo;</a></p>
       </div>
      </div>

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
