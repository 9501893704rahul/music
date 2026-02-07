<?php
/**
 * Created by PhpStorm.
 * User: JGCH
 * Date: 4/26/2018
 * Time: 10:27 AM
 * Description: when user loggint out, store login status in users table. whether user online or offline
 * and then store end time app closed and listening duration in trackusers table
 */

require_once __DIR__ . '/db_connect.php';

// Check whether username or password is set from android
if(isset($_POST['email']) && isset($_POST['login_status']) && isset($_POST['duration']))
{
    // Innitialize Variable
    $db = new DB_CONNECT();
    $conn = $db->connect();

    $email          = $_POST['email'];
    $duration       = $_POST['duration'];
    $login_status   = $_POST['login_status'];


    // Query database for row exist or not
    $sql = "SELECT * FROM users WHERE  email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        //$row = $result->fetch_assoc();

        //$response["success"]   = 1;
        //$response["email"]    = $row["email"];
        //$response["password"]  = $row["password"];
        $current_time = date("Y-m-d H:i;s");
        $sql1  = "UPDATE users SET login_status = '$login_status', updated_time = '$current_time' WHERE  email = '$email'";
        $result1 = $conn->query($sql1);


        if ($result1) {

            $current_time =  date("Y-m-d H:i:s");
            $sql2  = "UPDATE trackusers SET towhen = '$current_time', duration = '$duration' WHERE  email = '$email' ORDER BY fromwhen DESC LIMIT 1";
            //$sql2  = "SET ROWCOUNT 1"." UPDATE trackusers SET towhen = '$current_time', duration = '$duration' WHERE  email = '$email' ORDER BY fromwhen DESC "."SET ROWCOUNT 0";
            //$sql2  = "WITH CTE AS ("."SELECT TOP 1 FROM trackusers ORDER BY fromwhen DESC WHERE email = '$email')"." UPDATE  CTE SET towhen = '$current_time', duration = '$duration' ";
            $result2 = $conn->query($sql2);

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