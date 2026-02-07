<?php

include "db_connect.php";

$db = new DB_CONNECT();
$conn = $db->connect();

if(!isset($_POST['email']) || !isset($_POST['title']) || !isset($_POST['artist']) || !isset($_POST['cityname']) || !isset($_POST['listentime'])){
    $response["success"] = 0;
    echo json_encode($response);
    return;
}
$email      = $_POST['email'];
$title      = $_POST['title'];
$artist     = $_POST['artist'];
$cityname   = $_POST['cityname'];
$listentime = $_POST['listentime'];


$query = "INSERT INTO locations(email, title, artist, cityname, listentime) VALUES"."('$email','$title', '$artist', '$cityname', '$listentime')";

$result = $conn->query($query);

if ($result) {

    $response["success"]  = 1;
    echo json_encode($response);
    return;

} else {
    // failed to insert row
    $response["success"] = 0;

    echo json_encode($response);
    return;
}
?>