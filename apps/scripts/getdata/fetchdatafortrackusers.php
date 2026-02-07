<?php
/**
 * Created by PhpStorm.
 * User: JGCH
 * Date: 4/30/2018
 * Time: 1:19 AM
 */
if(isset($_POST['date'])) {
    // rest of your code goes here..
    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
    $conn = $db->connect();

    $date = $_POST['date'];

    $sql = "SELECT * FROM trackusers";
    $result = $conn->query($sql);

    $result_data = array();


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $time = strtotime($row['created_datetime']);

            $newformat = date('Y-m-d',$time);
            if($newformat == $date){
                $track['email']          = $row["email"];
                $track['duration']       = $row['duration'];
                $track['lati_longitude'] = $row['lati_longitude'];
                $track['cityname']       = $row['cityname'];
                $track['fromwhen']       = $row['fromwhen'];
                $track['towhen']         = $row['towhen'];
                array_push($result_data, $track);
            }

        }
        $rt['data'] = $result_data;
        print(json_encode($rt));
//        echo json_encode($data);
    } else {
        echo "0 results";
    }
    $conn->close();
}
?>