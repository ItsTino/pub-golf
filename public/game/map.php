<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pub Golf Map</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
<div id='map' style="width:100%; height:100%; position:fixed; left:0;top:0;overflow:hidden;"></div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoidmR1dmFsIiwiYSI6ImNrdmlyZ3dpbjBycm0yd3F4b3d2Yml1YnAifQ.0BP6szsxpV8OpO3TOgem0g';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11'
});
</script>   
</body>
</html>