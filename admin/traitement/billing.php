<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT g.FullName, g.Email, b.Amount, b.PaymentStatus, b.BillingID, b.BookingID, b.BillingDate
        FROM billing b
        JOIN guests g ON b.GuestID = g.GuestID";

$result = $conn->query($sql);

$billings = [];
while($row = $result->fetch_assoc()) {
    $billings[] = $row;
}

?>