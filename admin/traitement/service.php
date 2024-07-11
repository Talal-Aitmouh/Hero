<?php
include '../config/db.php';

$services = [];
$sqlservice = "SELECT 
    Service.ServiceID,
    Service.Type,
    Service.Name,
    Service.Description,
    Service.Amount,
    Guests.Name AS GuestName,
    Rooms.RoomName
FROM 
    Service
INNER JOIN 
    Guests ON Service.GuestID = Guests.GuestID
INNER JOIN 
    Rooms ON Service.RoomID = Rooms.RoomID;
";
$rsltservices = $conn->query($sqlservice);

if ($rsltservices -> num_rows > 0){
    while ($row = $rsltservices -> fetch_assoc()) {
        $services[] = $row;
    }
}


?>