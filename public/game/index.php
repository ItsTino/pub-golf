<?php
//Check that the user is in an active game
session_start();
require_once('../../src/gameApiFuncs.php');
require_once('../../src/mariadbconn.php');
require_once('../../src/globalVars.php');


if (!isset($_SESSION['loggedin'])) {
  //not logged in. return to login by redirecting to logout so we can clear the session at the same time.
  header("location: /logout.php");
} else {
  $gameID = $_SESSION['gameID'];
  $username = $_SESSION['username'];
  $teamID = $_SESSION['teamID'];

  //manually set isMod to Ryan
  if ($_SESSION['uuID'] == 'f1a03930-1031-41dc-869a-a5b08bb532cd') {
    $_SESSION['isMod'] = true;
  }
  //gameLoop($gameID, $teamID, $uuID);

  $teamName = (getTeamName($teamID));

  $teamScore = getTeamScore($gameID, $teamID);



  $dbconnect = get_dbc();
  $clArray = clArray();
  $currentRoundArray = [];

  if ($stmt = mysqli_prepare($dbconnect, "SELECT * FROM tblGameInfo WHERE uGameID=?")) {

    /* bind parameters for markers */
    $stmt->bind_param("s", $gameID);

    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_all(MYSQLI_BOTH)) {
      foreach ($row as $r) {
        $currentRoundArray = $clArray[$r['gameRound']];
        $gameRound = $r['gameRound'];
      }
    }
  }
  $scoreBoardArray = getScoreBoard($gameID, $gameRound);
}



?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title>Pub Golf</title>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-DY9P72D0E7"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-DY9P72D0E7');
  </script>

  <!-- Bootstrap core CSS -->
  <link href="/rels/bootstrap.min.css" rel="stylesheet">

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
    <header class="d-flex align-items-center pb-3 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <img class="mb-4" src="/rels/default-monochrome.svg" alt="" width="148" height="114">
      </a>


    </header>

    <main>

      <h1><?= $username ?> </h1>
      <p>you're playing for team <?= $teamName ?></p>
      <p class="fs-5 col-md-8">You're on round number: <?= $currentRoundArray['step'] ?></p>
      <p class="fs-5 col-md-8">You're headed to: <?= $currentRoundArray['name'] ?></p>
      <p class="fs-5 col-md-8">You're Drinking: <?= $currentRoundArray['drink'] ?></p>
      <p class="fs-5 col-md-8">This hole's par is: <?= $currentRoundArray['par'] ?></p>
      <p class="fs-5 col-md-8">Your Team Score: <?= $teamScore ?></p>

      <?php
      //Show the scoring button if the user is the game mod
      if ($_SESSION['isMod'] == true) {
        echo '<div class="mb-3"><a href="scoring.php" class="btn btn-warning btn-lg px-4">Score this round</a></div>';
      }

      ?>
      <div class="mb-3">
        <a href="map.php" class="btn btn-warning btn-lg px-4">View Map</a>
      </div>


      <hr class="col-3 col-md-2 mb-5">

      <div class="row g-5">
        <div class="col-md-6">
          <h2>Leaderboard!</h2>
          <p></p>
          <style>
            table {
              width: 100%;
            }
          </style>

          <table id="table" name="table" class="table table-striped table-lg">
            <tr>
              <th>Team</th>
              <th>Score</th>
              <th>Δ</th>
            </tr>
            <?php foreach ($scoreBoardArray as $sbLine) {
              echo '<tr><td>' . $sbLine["team"] . '</td><td>' . $sbLine["score"] . '</td><td>' . $sbLine["parDif"] . '</td></tr>';
            }
            ?>
          </table>
        </div>
      </div>
      <!-- Send location to api for spectate map -->
      <script>

        <?php echo 'name="' . $username . '";' ?>
        console.log("running");
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(sendPos);

          function sendPos(position) {
            lat = position.coords.latitude;
            long = position.coords.longitude;

            var settings = {
              "url": "https://alpine.cx/game/api.php",
              "method": "POST",
              "timeout": 0,
              "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
              },
              "data": {
                "action": "sendLoc",
                "name": name,
                "lat": lat,
                "long": long
              }
            };

            $.ajax(settings).done(function(response) {
              console.log(name + " " + lat + " " + long);
            });
          }
        } else {

        }
      </script>
    </main>
    <footer class="pt-5 my-5 text-muted border-top">
      Created by Valentino Duval &middot; &copy; 2021
    </footer>
  </div>


  <script src="/rels/bootstrap.js"></script>


</body>

</html>