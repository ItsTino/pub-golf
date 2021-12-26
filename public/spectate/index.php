<?php
session_start();
require_once('../../src/gameApiFuncs.php');
require_once('../../src/mariadbconn.php');
require_once('../../src/globalVars.php');
$dbconnect = get_dbc();
$clArray = clArray();
$currentRoundArray = [];
$gameID = '195922dc-7f40-4d44-af4a-08b915cdb592';
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
$playerLocArr = getPlayerLocations();



?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.84.0">
  <title>Pub Golf - Spectate</title>


  <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

  <!-- Bootstrap core CSS -->
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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



    .marker {
      background-image: url('mapbox-icon.png');
      background-size: cover;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      cursor: pointer;
    }

    .playermarker {
      background-image: url('marker-icon.png');
      background-size: cover;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      cursor: pointer;
    }

    .mapboxgl-popup {
      max-width: 200px;
    }

    .mapboxgl-popup-content {
      text-align: center;
      font-family: 'Open Sans', sans-serif;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="dashboard.css" rel="stylesheet">
</head>

<body>

  <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Pub Golf</a>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">


      <main class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

          <h1>
            <?php 
            echo $r['gameName'] . ' Round ' . $r['gameRound'];
            ?> 
          </h1>

        </div>



        <h2>Game Map</h2>

        <div id='map' style='width: 100%; height: 100%;'></div>
        <h2>Game Scoreboard</h2>
        <div>
          <div class="table-responsive">
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
    </div>

    </main>




    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
    <script src="dashboard.js"></script>

    <script>
      mapboxgl.accessToken = 'pk.eyJ1IjoidmR1dmFsIiwiYSI6ImNrdmlyZ3dpbjBycm0yd3F4b3d2Yml1YnAifQ.0BP6szsxpV8OpO3TOgem0g';

      var geojson = {
        "type": "FeatureCollection",
        "features": [{
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Lark Rise",
              "description": "Par: 3 Drink: Lager"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8782034516334531,
                50.74446768396834
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Parkstone and Heatherlands",
              "description": "Par: 3 Drink: Lager"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8783308565616608,
                50.74332457315983
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Buffalo",
              "description": "Par: 3 Drink: Cider"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8792092800140379,
                50.739710054771415
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Richmond Arms",
              "description": "Par: 3 Drink: Lager"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8656909465789795,
                50.7364755074732
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "Tesco Express",
              "description": "Par: 3 Drink: Tinny"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8691456317901611,
                50.73468457045487
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Christopher Creek",
              "description": "Par: 2 Drink: Spirit x2"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8656855821609495,
                50.72238721732111
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Brasshaus",
              "description": "Par: 3 Drink: Darkfruit"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8761166930198667,
                50.71953780487921
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Moon in the Square",
              "description": "Par: 3 Drink: Pitcher"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.88041090965271,
                50.719598938311684
              ]
            }
          },
          {
            "type": "Feature",
            "properties": {
              "marker-color": "#7e7e7e",
              "marker-size": "medium",
              "marker-symbol": "alcohol-shop",
              "title": "The Mary Shelley",
              "description": "Par: 3 Drink: Lager"
            },
            "geometry": {
              "type": "Point",
              "coordinates": [
                -1.8761354684829712,
                50.720661968026086
              ]
            }
          }

        ]
      };

      <?php
      echo 'var geojson2 = {
          "type": "FeatureCollection",
          "features": [';

      foreach ($playerLocArr as $plLine) {
        echo '
            {
              "type": "Feature",
              "properties": {
                "title": "' . $plLine['name'] . '"},
                "geometry": {
                  "type": "Point",
                  "coordinates": [' . $plLine['long'] . ',' . $plLine['lat'] . ']
                }
              },';
      }
      echo ']};';

      ?>
      //php generate the json on the fly



      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        tileset: 'vduval.aexdg0ak',
        center: [-1.8795506307410543, 50.717332143306926], // starting position
        zoom: 12
      });

      //Set bounds
      var bounds = [
        [-1.9593619372915292, 50.67862491057444],
        [-1.7344901925828047, 50.80115585972338]
      ];
      map.setMaxBounds(bounds);


      // add markers to map
      geojson.features.forEach(function(marker) {
        // create a HTML element for each feature
        var el = document.createElement('div');
        el.className = 'marker';

        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
          .setLngLat(marker.geometry.coordinates)
          .setPopup(
            new mapboxgl.Popup({
              offset: 25
            }) // add popups
            .setHTML(
              '<h3>' +
              marker.properties.title +
              '</h3><p>' +
                marker.properties.description +
                '</p>'
            )
          )
          .addTo(map);

      })


      geojson2.features.forEach(function(marker) {
        // create a HTML element for each feature
        var el = document.createElement('div');
        el.className = 'playermarker';

        // make a marker for each feature and add it to the map
        new mapboxgl.Marker(el)
          .setLngLat(marker.geometry.coordinates)
          .setPopup(
            new mapboxgl.Popup({
              offset: 25
            }) // add popups
            .setHTML(
              '<h3>' +
              marker.properties.title +
              '</h3>'
            )
          )
          .addTo(map);

      });
    </script>
</body>

</html>