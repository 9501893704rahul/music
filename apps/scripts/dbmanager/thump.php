<?php

require_once __DIR__ . '/db_connect.php';

// Check whether username or password is set from android
if(isset($_POST['title']) && isset($_POST['thump']) && isset($_POST['artist']))
{
    // Innitialize Variable
    $db = new DB_CONNECT();
    $conn = $db->connect();



    $title  = $_POST['title'];
    $title  = trim($title);
    $artist = $_POST['artist'];
    $artist = trim($artist);
    $thump  = $_POST['thump'];


    // Query database for row exist or not
    $sql = "SELECT * FROM thumps WHERE  title = '$title' AND artist = '$artist'";
    //$sql = "SELECT * FROM users";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        $likes    = $row["likes"];
        $dislikes = $row["dislikes"];

        if($thump == "1"){
            $likes ++;
            $sql  = "UPDATE thumps SET likes= '$likes' WHERE title = '$title'";
        }
        //thump down
        if($thump == "0"){
            $dislikes ++;
            $sql  = "UPDATE thumps SET dislikes= '$dislikes' WHERE title = '$title'";
        }

        // Query database for row exist or not

        $result = $conn->query($sql);

    } else {

        if($thump == "1"){ $likes = 1; $dislikes = 0;}
        //thump down
        if($thump == "0"){ $likes = 0; $dislikes = 1;}

        $query = "INSERT INTO thumps(title, artist, likes, dislikes) VALUES"."('$title', '$artist','$likes', '$dislikes')";

        $result = $conn->query($query);

    }

    if ($result) {
        if($thump == "1"){
            $response["success"]  = 1;
            echo json_encode($response);
            return;
        }
        if($thump == "0"){
            $response["success"]  = 2;
            echo json_encode($response);
            return;
        }

    } else {
        // failed to insert row
        $response["success"] = 0;

        echo json_encode($response);
        return;
    }

}

?>