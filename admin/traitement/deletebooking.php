<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingID = $_POST['bookingID'];

    // Get roomID and quantity for the booking
    $query = "SELECT RoomID, Quantity FROM Booking WHERE BookingID = '$bookingID'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $booking = mysqli_fetch_assoc($result);
        $roomID = $booking['RoomID'];
        $quantity = $booking['Quantity'];

        // Increase the room quantity
        $query = "UPDATE Rooms SET Quantity = Quantity + $quantity WHERE RoomID = '$roomID'";
        mysqli_query($conn, $query);

        // Delete service bookings related to this booking
        $query = "DELETE FROM ServiceBooking WHERE BookingID = '$bookingID'";
        mysqli_query($conn, $query);

        // Delete the booking
        $query = "DELETE FROM Booking WHERE BookingID = '$bookingID'";
        mysqli_query($conn, $query);
    }
}

header('Location: ../booking.php');
?>
