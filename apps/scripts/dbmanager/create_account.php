<?php

    include "db_connect.php";

	$db = new DB_CONNECT();
    $conn = $db->connect();


    $email          = $_POST['email'];
    $pwd            = $_POST['pwd'];
    $login_status   = $_POST['login_status'];
    $lati_longitude = $_POST['lati_longitude'];
    $cityname       = $_POST['cityname'];

    if(!isset($_POST['email']) || !isset($_POST['pwd']) 
	   || !isset($_POST['login_status']) 
	   || !isset($_POST['lati_longitude'])
	   || !isset($_POST['cityname'])){
        $response["success"] = 0;
		echo json_encode($response);
        return;
    }


//    $response["success"] = 0;
//    echo json_encode($response);
//    return;


    $email          = $_POST['email'];
    $pwd            = $_POST['pwd'];
    $login_status   = $_POST['login_status'];
    $lati_longitude = $_POST['lati_longitude'];
    $cityname       = $_POST['cityname'];


	// check email
	$sql = "SELECT * FROM users WHERE email ='". $email. "'";
	$result = mysqli_query($conn, $sql);

	$num_rows = mysqli_num_rows($result);
	if($num_rows > 0){
		$response["success"] = 2;
		//echo "email already present\n";

        echo json_encode($response);
        return;
	}


    $query = "INSERT INTO users(email, password, login_status, cityname, lati_longitude) VALUES"."('$email', '$pwd', '$login_status', '$cityname', '$lati_longitude')";

    $result = $conn->query($query);

	if ($result) {

        $response["success"]  = 1;
        echo json_encode($response);
        return;

    } else {
        // failed to insert row
		//echo "failure to insert row";
        $response["success"] = 0;

        echo json_encode($response);
        return;
    }
?>