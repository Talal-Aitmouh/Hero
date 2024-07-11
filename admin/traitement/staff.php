<?php 
include '../config/db.php';

$staffs = [];
$sql = "SELECT * FROM staff";
$result = $conn->query($sql) ;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        $staffs[] = $row;
    }
}

?>