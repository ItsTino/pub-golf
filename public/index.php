<?php

include '../src/mariadbconn.php';
// Load Composer's autoloader
require '../vendor/autoload.php';

// Initialize the session
session_start();
//print_r($_POST);

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /game/index.php");
    exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$loginerror = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {

        //Start Login Process
        $dbconnect = get_dbc();
        $passhash = "";
        if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblUser WHERE uname=?")) {

            /* bind parameters for markers */
            $stmt->bind_param("s", $username);

            $stmt->execute();

            $result = $stmt->get_result();

            while ($row = $result->fetch_all(MYSQLI_BOTH)) {
                foreach ($row as $r) {
                    $passhash = $r['uPassHash'];
                }
            }
        }

        if (password_verify($password, $passhash)) {


            // Store data in session variables


            // Redirect user to welcome page
            $_SESSION["loggedin"] = true;
            $_SESSION['CREATED'] = time();
            $_SESSION["username"] = $username;
            $_SESSION['uuID'] = $r['uuID'];
            $_SESSION['gameID'] = $r['uCurrentGameID'];
            $_SESSION['teamID'] = $r['uCurrentTeamID'];

            header("location: /game/");
            //If current game is 000 goto pre-game lobby
            $emptyUUID = '00000000-0000-0000-0000-000000000000';
            if ($emptyUUID === $r['uCurrentGameID']){

              header("location: home.php");
            }

            
            //If current game is set go straight to game (check admin status in that page not here)
            
        } else {
            //error

        }
    }
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Xmas Pub Gwolf">
    <meta name="author" content="Valentino Duval">
    <title>Pub Golf</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DY9P72D0E7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DY9P72D0E7');
</script>
    

    <!-- Bootstrap core CSS -->
<link href="/rels/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
<link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="/rels/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form method="post" action="index.php">
    <img class="mb-4" src="/rels/default-monochrome.svg" alt="" width="148" height="114">
    <h1 class="h3 mb-3 fw-normal">Sign In</h1>

    <div class="form-floating">
      <input type="username" class="form-control" name="username" id="floatingInput" placeholder="john">
      <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; Valentino Duval - 2021</p>
  </form>
</main>


    
  </body>
</html>
