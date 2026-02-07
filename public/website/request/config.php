<?php 
// Request Form Connection Settings
$studiohost = "76.239.45.61";
$studioport = 443;
$logfile = 'connection_log.txt';
$connection = fsockopen($studiohost, $studioport, $errno, $errstr, 10);
$log = date('Y-m-d H:i:s') . " - Attempting to connect to $studiohost on port $studioport\n";

if ($connection) {
    $log .= "Connection successful.\n";
    fclose($connection);
} else {
    $log .= "Connection failed: $errstr ($errno)\n";
}
file_put_contents($logfile, $log, FILE_APPEND);


// Request Form Basic Settings
$namefield = 0;                     // Request listener name: 0=no, 1=yes, 2=required
$locationfield = 0;                 // Request listener location: 0=no, 1=yes, 2=required
$expire = 1;                        // Number of days to remember name and location. 0=just for the session
$requestsperhour = 10;              // Limit the number of requests the individual user can make per hour
$requestsperday = 30;               // Total number of requests the individual user can make per day

$sitename = "Jammin' 92";
$home = "/";
$css = "style.css";
$header = "header.php";
$footer = "footer.php";
$script = "request.php";
$banfile = "banned.php";

// Confirmation messages for successful request submission
$confirmationMessage = "Your song request has been received. Usually it will play within the next song or two, unless it has been played recently.";
$successTitle = "Thank You!";


// Paths/URLs for images used in the form.
$logo_path    = "https://jammin92.com/images/jamminlogotrans.png"; // Main site logo
$good_image   = "https://jammin92.com/images/good.png";           // Icon for successful requests
$redx_image   = "https://jammin92.com/images/redx.png";           // Icon for error messages
$song_image   = "https://jammin92.com/images/Song.png";           // Icon for song in upcoming requests
$artist_image = "https://jammin92.com/images/Artist.png";         // Icon for artist in upcoming requests

$header_shading = "#eee";
$libdir = "library";
$buildlib = 0;
?>
