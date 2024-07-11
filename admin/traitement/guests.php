<?php
include '../config/db.php';

$guests = [];

$sql = "SELECT * FROM guests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guests[] = $row;
    }
}


  





?>