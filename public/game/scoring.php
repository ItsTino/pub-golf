<?php
session_start();
require_once('../../src/gameApiFuncs.php');
require_once('../../src/globalVars.php');
//Get DB connection
//Check login

//Check gamecreatorid is the same as the current userID
$gameID = $_SESSION['gameID'];

//Get teams save into array

$teamArray = getTeams($gameID);

$curRound = getCurrentRoundInfo($gameID);
$clArray = clArray();
$clArray = $clArray[$curRound];

//Get scores for this round if they exist
$curScoreArr = getScoreForRound($curRound);


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>Pub Gold · Scoring</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="/rels/scoring.js"></script>

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
  <link href="/rels/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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



</head>

<body class="bg-light">

  <div class="container">
    <main>
      <div class="py-5 text-center">
        <a href="/game/"><img class="mb-4" src="/rels/default-monochrome.svg" alt="" width="148" height="114"></a>
        <h2>SCORING FORM</h2>
        <p class="lead">Press save after entering the score for a team</p>
      </div>

      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Scoring Round:</span>
            <span class="badge bg-primary rounded-pill"><?= $curRound ?></span>
          </h4>
          <ul class="list-group mb-3">
    <p>Showing saved score for current round</p>
            <?php
            foreach ($curScoreArr as $csLine) {
              echo '<li class="list-group-item d-flex justify-content-between lh-sm"><div><h6 class="my-0">' . $csLine["team"] . '</h6><small class="text-muted">Score:</small></div><span class="text-muted">' . $csLine["score"] . '</span></li>';
            };
            ?>

          </ul>
        </div>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Add Score</h4>
          <form class="needs-validation" novalidate>
            <div class="row g-3">

              <div class="col-md-5">
                <label for="team" class="form-label">Team</label>
                <select class="form-select" id="teamID" required>
                  <option>Choose...</option>

                  <?php foreach ($teamArray as $tlLine) {
                    echo '<option value"' . $tlLine["teamID"] . '">' . $tlLine["teamName"] . '</option>';
                  }

                  ?>

                </select>
              </div>


              <div class="col-md-3">
                <label for="zip" class="form-label">Score (Total Sips Per Team)</label>
                <input type="text" class="form-control" id="zip" placeholder="" required>

                <p>The par for this hole is: <?= $clArray["par"] ?></p>

              </div>
            </div>
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
          </form>
          <hr class="my-4">
          <button class="w-100 btn btn-danger btn-lg" onclick="incRound('<?= $gameID ?>')">Next Round</button>
        </div>
      </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021 - Pub Golf</p>

    </footer>
  </div>


  <script src="/rels/bootstrap.js"></script>

  <script src="form-validation.js"></script>
</body>

</html>