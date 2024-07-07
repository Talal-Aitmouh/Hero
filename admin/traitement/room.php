<?php
include '../config/db.php';

$rooms = [];

$sqlRooms = "SELECT * FROM Rooms";
$resultRooms = $conn->query($sqlRooms);

if ($resultRooms->num_rows > 0) {
    while ($row = $resultRooms->fetch_assoc()) {
        $rooms[] = $row;
    }
}


  





?>