<?php
$latitude = isset($_POST['latitude']) ? $_POST['latitude'] : '';
$longitude = isset($_POST['longitude']) ? $_POST['longitude'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search for Donor</title>
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
</head>
<body>
    <h1>Donor Location</h1>
    <div id="map"></div>
    <script>
        function initMap() {
            var location = { lat: parseFloat('<?php echo $latitude; ?>'), lng: parseFloat('<?php echo $longitude; ?>') };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location
            });
            new google.maps.Marker({
                position: location,
                map: map,
                title: 'Donor Location'
            });
        }
        window.onload = initMap;
    </script>
</body>
</html>
