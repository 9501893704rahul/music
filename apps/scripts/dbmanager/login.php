<?php

require_once __DIR__ . '/db_connect.php';

// Check whether username or password is set from android
if(isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['login_status']) && isset($_POST['lati_longitude']) && isset($_POST['cityname']))
{
    // Innitialize Variable
    $db = new DB_CONNECT();
    $conn = $db->connect();

//    $response["success"] = 0;
//    echo json_encode($response);
//    return;

    $email          = $_POST['email'];
    $password       = $_POST['pwd'];
    $login_status   = $_POST['login_status'];
    $lati_longitude = $_POST['lati_longitude'];
    $cityname       = $_POST['cityname'];


    // Query database for row exist or not
    $sql = "SELECT * FROM users WHERE  email = '$email' AND password = '$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        //$row = $result->fetch_assoc();

        //$response["success"]   = 1;
        //$response["email"]    = $row["email"];
        //$response["password"]  = $row["password"];
        $current_time = date("Y-m-d H:i;s");
        $sql1  = "UPDATE users SET login_status = '$login_status', lati_longitude = '$lati_longitude', cityname = '$cityname' , updated_time = '$current_time' WHERE  email = '$email' AND password = '$password'";
        $result1 = $conn->query($sql1);


        if ($result1) {

//            $response["success"] = 2;
//
//            echo json_encode($response);
//            return;

            $current_time = date("Y-m-d H:i:s");
            $query = "INSERT INTO trackusers(email, lati_longitude, cityname, fromwhen) VALUES"."('$email', '$lati_longitude', '$cityname', '$current_time')";

            $result2 = $conn->query($query);

            if ($result2) {

                $response["success"]  = 1;
                echo json_encode($response);
                return;

            } else {
                // failed to insert row
                $response["success"] = 0;

                echo json_encode($response);
                return;
            }



        } else {
            // failed to insert row
            $response["success"] = 0;

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