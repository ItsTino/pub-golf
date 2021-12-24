<?php
//Check login

//Check gamecreatorid is the same as the current userID

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
      <p class="lead">Press save after entering a score/award/penalty</p>
    </div>

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Scoring Round:</span>
          <span class="badge bg-primary rounded-pill">3</span>
    </h4>

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

            <div class="col-md-4">
              <label for="state" class="form-label">Type</label>
              <select class="form-select" id="state" required>
                <option>Choose...</option>
                <option value="drink">Drink</option>
                <option value="penalty">Penalty</option>
                <option value="award">Award</option>
              </select>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Points</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>

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
