<?php
include("../config.php");

if (isset($_GET['destination'])) {
    $destination = mysqli_real_escape_string($connection, $_GET['destination']);
    $query = "SELECT hotel_name FROM hotel_table WHERE destination = '$destination'";
    $result = mysqli_query($connection, $query);

    $hotels = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $hotels[] = $row['hotel_name'];
    }
    echo json_encode($hotels);
}
?>
