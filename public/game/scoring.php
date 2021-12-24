<?php
require_once('../../src/gameApiFuncs.php');
//Get DB connection
//Check login

//Check gamecreatorid is the same as the current userID


//Get teams save into array
$teamArray = getTeams($_SESSION['currentGameSession']);
$scoreArray = getScores($_SESSION['currentGameSession']);
$roundInfoArray = getCurrentRoundInfo($_SESSION['currentGameSession']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Checkout example · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">

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
    <link href="/rels/form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-5 text-center">
    <img class="mb-4" src="/rels/default-monochrome.svg" alt="" width="148" height="114">
      <h2>SCORING FORM</h2>
      <p class="lead">Press save after entering the score for a team</p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Scoring Round:</span>
          <span class="badge bg-primary rounded-pill">1</span>
    </h4>
    <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">team_one</h6>
              <small class="text-muted">Unsaved</small>
            </div>
            <span class="text-muted"></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">team_two</h6>
              <small class="text-muted">Score:</small>
            </div>
            <span class="text-muted">8</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">team_three</h6>
              <small class="text-muted">Score:</small>
            </div>
            <span class="text-muted">9</span>
          </li>

        </ul>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Add Score</h4>
        <form class="needs-validation" novalidate>
          <div class="row g-3">

            <div class="col-md-5">
              <label for="player" class="form-label">Team</label>
              <select class="form-select" id="country" required>
                <option>Choose...</option>
                <option value="">team_one</option>
                <option value="">team_two</option>

              </select>
            </div>


            <div class="col-md-3">
              <label for="zip" class="form-label">Score (Total Sips Per Team)</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>

            <p>The par for this hole is: 3</p>

            </div>
          </div>
          <hr class="my-4">
          <button class="w-100 btn btn-primary btn-lg" type="submit">Save</button>
        </form>
        <hr class="my-4">
        <button class="w-100 btn btn-danger btn-lg" type="submit">Next Round</button>
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
