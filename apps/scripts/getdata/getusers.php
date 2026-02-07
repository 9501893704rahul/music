<html>
    <head>
        <title>Users</title>
        <style>
            #customers {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #002366;
                color: white;
            }
        </style>
    </head>
    <body>
        <?php
    /**
     * Created by PhpStorm.
     * User: JGCH
     * Date: 4/26/2018
     * Time: 2:21 AM
     */
    include_once ("header.asp");
    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
    $conn = $db->connect();

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "<table id='customers'>
            <tr>
                <th>Email</th>
                <th>Password</th>
                <th>Login_status</th>
                <th>Cityname</th>
                <th>GPS Location</th>
                <th>Created_datetime</th>
                <th>Updated_time</th>
            </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["email"]."</td>
                    <td>".$row["password"]."</td>
                    <td>".$row["login_status"]."</td>
                    <td>".$row["cityname"]."</td>
                    <td>".$row["lati_longitude"]."</td>
                    <td>".$row["created_datetime"]."</td>
                    <td>".$row["updated_time"]."</td>
              </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }


    //if ($result->num_rows > 0) {
    //    // output data of each row
    //    while($row = $result->fetch_assoc()) {
    //        echo "id: " . $row["id"]. " - title: " . $row["title"]. "- artist: " . $row["artist"]. "- likes: " . $row["likes"]. "- dislikes: " . $row["dislikes"].  "- updated_time: " . $row["updated_time"]."<br>";
    //    }
    //} else {
    //    echo "no thumbs";
    //}

    $conn->close();
    ?>
    </body>
</html>
