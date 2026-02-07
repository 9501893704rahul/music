<?php
    require 'track_config.php';
    
    $result = $conn->query("SELECT lati_longitude FROM users");

    $latilongtiArr = [];

    $rowCount = $result->num_rows;
    if ($rowCount > 0) {
        for ($index = 0; $index < $rowCount; $index ++) { 
            $row = $result->fetch_assoc();

            $loc = $row['lati_longitude'];
            array_push($latilongtiArr, $loc);
        }
    }
    $latilongtiArr = json_encode($latilongtiArr);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Get Location</title>
    <style>
        .wrapper {
            padding: 15px;
        }
        #googleMap {
            width: 90vw;
            height: 90vh;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div id="googleMap"></div>
    </div>
    <script>
        function gmap() {
            var mapProp= {
                center: new google.maps.LatLng(0, 0),
                zoom:1,
            };

            map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            
            var locArr = <?php echo $latilongtiArr; ?>;

            for (var index = 0; index < locArr.length; index ++) {
                var lati = Number(locArr[index].split('/')[0]);
                var long = Number(locArr[index].split('/')[1]);
                var myLatlng = {lat: lati, lng: long};

                new google.maps.Marker({
                    position:  myLatlng,
                    map: map,
                    draggable: false,
                });
            }

        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeXKc29sBRsdP2KwRkkhvm6KajuPdRYYk&callback=gmap"></script>

</body>
</html>