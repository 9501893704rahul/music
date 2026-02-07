<html>
    <html>
        <title>Thumbs</title>
<!--        <link rel="stylesheet" href="../js/themes/blue/style.css">-->
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

    </html>
    <body>
        <?php
    /**
     * Created by PhpStorm.
     * User: JGCH
     * Date: 4/26/2018
     * Time: 2:20 AM
     */
    include_once ("header.asp");
    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();
    $conn = $db->connect();

    $sql = "SELECT title, artist, likes, dislikes FROM thumps";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        echo "<table id='customers' class='tablesorter'>
            <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Likes</th>
                <th>Dislikes</th>
            </tr>
            </thead><tbody>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["title"]."</td>
                    <td>".$row["artist"]."</td>
                    <td>".$row["likes"]."</td>
                    <td>".$row["dislikes"]."</td>
              </tr>";
        }
        echo "</table></tbody>";
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
    <script type="text/javascript" src="../js/jquery-latest.js"></script>
    <script type="text/javascript" src="../js/jquery.tablesorter.js"></script>
    <script>
        $(document).ready(function()
            {
                $("#customers").tablesorter( {sortList: [[0,0], [1,0]]} );
            }
        );
    </script>
    </body>
</html>
