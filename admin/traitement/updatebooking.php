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

    if (isset($_POST['delete'])) {
        // Handle delete
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
        header('Location: ../booking.php');
        exit;
    } elseif (isset($_POST['update'])) {
        // Handle update
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $nationality = $_POST['nationality'];
        $phone = $_POST['phone'];
        $checkInDate = $_POST['checkInDate'];
        $checkOutDate = $_POST['checkOutDate'];
        $roomID = $_POST['roomID'];
        $quantity = $_POST['quantity'];

        // Calculate the number of days booked
        $date1 = new DateTime($checkInDate);
        $date2 = new DateTime($checkOutDate);
        $interval = $date1->diff($date2);
        $numDays = $interval->days;

        // Get room price
        $query = "SELECT Price FROM Rooms WHERE RoomID = '$roomID'";
        $result = mysqli_query($conn, $query);
        $room = mysqli_fetch_assoc($result);
        $roomPrice = $room['Price'];

        // Calculate total amount for rooms
        $totalAmount = $roomPrice * $quantity * $numDays;

        // Update booking
        $query = "UPDATE Booking SET CheckInDate='$checkInDate', CheckOutDate='$checkOutDate', TotalAmount='$totalAmount', RoomID='$roomID', Quantity='$quantity' WHERE BookingID='$bookingID'";
        mysqli_query($conn, $query);

        // Update guest information
        $query = "UPDATE Guests SET Name='$name', Email='$email', Address='$address', Nationality='$nationality', Phone='$phone' WHERE GuestID=(SELECT GuestID FROM Booking WHERE BookingID='$bookingID')";
        mysqli_query($conn, $query);

        // Update services
        // First, delete existing service bookings
        $query = "DELETE FROM ServiceBooking WHERE BookingID = '$bookingID'";
        mysqli_query($conn, $query);

        // Then, add new service bookings
        if (isset($_POST['services'])) {
            foreach ($_POST['services'] as $serviceID) {
                $query = "INSERT INTO ServiceBooking (BookingID, ServiceID) VALUES ('$bookingID', '$serviceID')";
                mysqli_query($conn, $query);

                // Update the total amount with service cost
                $query = "SELECT Amount FROM Service WHERE ServiceID = '$serviceID'";
                $result = mysqli_query($conn, $query);
                $service = mysqli_fetch_assoc($result);
                $totalAmount += $service['Amount'];

                // Update the total amount in the booking
                $query = "UPDATE Booking SET TotalAmount='$totalAmount' WHERE BookingID='$bookingID'";
                mysqli_query($conn, $query);
            }
        }

        header('Location: ../booking.php');
        exit;
    }
}
?>
