<?php
//Check that the user is in an active game
require_once('../../src/mariadbconn.php');
session_start();

if (!isset($_SESSION['loggedin'])) {
  //not logged in. return to login by redirecting to logout so we can clear the session at the same time.
  header("location: /logout.php");
} else {
  $gameID = filter_var($_SESSION['currentGameSession'], FILTER_SANITIZE_STRING);
  $username = $_SESSION['username'];
  $isMod = $_SESSION['isMod'];
  gameLoop($gameID);
}

function gameLoop($gameID) {
      //Get our dbconnection from mariadbconn
      $dbconnect = get_dbc();

      //Get 
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Starter Template · Bootstrap v5.1</title>



    

    <!-- Bootstrap core CSS -->
<link href="/rels/bootstrap.min.css" rel="stylesheet" >

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
    <link href="starter-template.css" rel="stylesheet">
  </head>
  <body>
    
<div class="col-lg-8 mx-auto p-1 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
      <img class="mb-4" src="/rels/default-monochrome.svg" alt="" width="148" height="114">
    </a>
  </header>

  <main>
    <h1><?= $username ?></h1>
    <p class="fs-5 col-md-8">You're on round number: 1</p>
    <p class="fs-5 col-md-8">Your Team Name: team_one</p>
    <p class="fs-5 col-md-8">Your Team Score: 0</p>
    <p class="fs-5 col-md-8">Your Personal Score: 0</p>
    
<?php 
//Show the scoring button if the user is the game mod
if ($isMod == true) {
  echo'<div class="mb-5"><a href="scoring.php" class="btn btn-warning btn-lg px-4">Score this round</a></div>';
}
?>


    <hr class="col-3 col-md-2 mb-5">

    <div class="row g-5">
      <div class="col-md-6">
        <h2>Leaderboard!</h2>
        <p>Ready to beyond the starter template? Check out these open source projects that you can quickly duplicate to a new GitHub repository.</p>
        <ul class="icon-list">
          <li><a href="https://github.com/twbs/bootstrap-npm-starter" rel="noopener" target="_blank">Bootstrap npm starter</a></li>
          <li class="text-muted">Bootstrap Parcel starter (coming soon!)</li>
        </ul>
      </div>
    </div>
  </main>
  <footer class="pt-5 my-5 text-muted border-top">
    Created by Valentino Duval &middot; &copy; 2021
  </footer>
</div>


    <script src="/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      
  </body>
</html>
