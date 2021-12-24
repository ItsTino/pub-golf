<?php
session_start();
$username = $_SESSION['username'];

?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Cover Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-DY9P72D0E7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DY9P72D0E7');
</script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
<link href="/rels/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->

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
    <link href="/rels/cover.css" rel="stylesheet">

    <script src="/rels/home.js"></script>
  </head>
  <body class="d-flex h-100 text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="mb-auto">
    <div>
      <h3 class="float-md-start mb-0">XMAS Pub Golf 🎅🎄🎁</h3>
      <nav class="nav nav-masthead justify-content-center float-md-end">
        <a class="nav-link active" aria-current="page" href="#">You're logged in as <?= $username ?></a>
        <a class="nav-link" href="/logout.php">Logout</a>
      </nav>
    </div>
  </header>

  <main class="px-3">
    <h1>Pub Gwolf</h1>
    <p class="lead">Click play to join a game with a game, or create to make a new game</p>
    <p class="lead">🍻⛳🍻⛳</p>
    <button type="button" onclick="gameIDpopup('<?= $_SESSION['uuID']?>')" class="btn btn-primary btn-lg">Play!</button>
    <br>
    <br>
    <button type="button" class="btn btn-secondary btn-lg" disabled>Create</button>
  </main>

  <footer class="mt-auto text-white-50">
    <p>pub-golf-as-a-service by <a href="https://valentino.cx" class="text-white">valentino duval</a>.</p>
  </footer>
</div>


    
  </body>
</html>