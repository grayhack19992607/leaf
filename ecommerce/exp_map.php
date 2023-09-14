<!DOCTYPE html>
<html>
<head>
    <!-- Include the Leaflet and Font Awesome libraries -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.awesome-markers/dist/leaflet.awesome-markers.css">
</head>
<body>
<div id="map" style="height: 400px;"></div>

<script>
    // Initialize the map
    var map = L.map('map').setView([12.8797, 121.7740], 5.3); // Centered on the Philippines with a zoom level of 6

    // Add a tile layer (you can use any tile provider you prefer)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Creates a red marker with a Font Awesome icon using leaflet.awesome-markers
    var redMarker = L.AwesomeMarkers.icon({
        icon: 'coffee', // Font Awesome icon class
        markerColor: 'red'
    });

    // Add the marker to the map
    L.marker([12.8797, 121.7740], { icon: redMarker }).addTo(map);
</script>
</body>
</html>
