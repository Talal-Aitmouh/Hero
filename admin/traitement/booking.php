<?php
include '../config/db.php';


$reservations =[];
$sqlbooking = "SELECT 
    Booking.BookingID,
    Booking.CheckInDate,
    Booking.CheckOutDate,
    Booking.TotalAmount,
    Booking.Status,
    Guests.Name AS GuestName,
    Rooms.RoomName
FROM 
    Booking
INNER JOIN 
    Guests ON Booking.GuestID = Guests.GuestID
INNER JOIN 
    Rooms ON Booking.RoomID = Rooms.RoomID;
";
$resultbooking = $conn->query($sqlbooking);

if ($resultbooking ->num_rows > 0){
    while($rowbooking = $resultbooking->fetch_assoc()) {
        $reservations[] = $rowbooking;
    }
}
?>