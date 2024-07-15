<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$reservations = [];
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
    Rooms ON Booking.RoomID = Rooms.RoomID";
$resultbooking = $conn->query($sqlbooking);

if ($resultbooking->num_rows > 0) {
    while ($rowbooking = $resultbooking->fetch_assoc()) {
        $reservations[] = $rowbooking;
    }
}

$queryroom = "SELECT RoomID, RoomName, Price, Quantity FROM Rooms";
$result = mysqli_query($conn, $queryroom);

$queryServices = "SELECT ServiceID, Name, Amount FROM Service";
$resultServices = mysqli_query($conn, $queryServices);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $bookingID = $_POST['bookingID'];

        // Handle delete
        $query = "SELECT RoomID, CheckInDate, CheckOutDate FROM Booking WHERE BookingID = '$bookingID'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $booking = mysqli_fetch_assoc($result);
            $roomID = $booking['RoomID'];

            // Calculate number of days booked
            $checkInDate = new DateTime($booking['CheckInDate']);
            $checkOutDate = new DateTime($booking['CheckOutDate']);
            $interval = $checkInDate->diff($checkOutDate);
            $numDays = $interval->days;

            // Get the quantity of rooms booked
            $quantity = 1; // Assuming quantity is 1, if not adjust this based on your requirement

            // Increase the room quantity
            $query = "UPDATE Rooms SET Quantity = Quantity + $quantity WHERE RoomID = '$roomID'";
            mysqli_query($conn, $query);

            // Delete the booking
            $query = "DELETE FROM Booking WHERE BookingID = '$bookingID'";
            mysqli_query($conn, $query);
        }
        header('Location: ../booking.php');
        exit;

    } elseif (isset($_POST['update'])) {
        $bookingID = $_POST['bookingID'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $nationality = $_POST['nationality'];
        $phone = $_POST['phone'];
        $checkInDate = $_POST['checkInDate'];
        $checkOutDate = $_POST['checkOutDate'];
        $roomID = $_POST['roomID'];
        $quantity = 1; // Assuming quantity is 1, if not adjust this based on your requirement

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
        $query = "UPDATE Booking SET CheckInDate='$checkInDate', CheckOutDate='$checkOutDate', TotalAmount='$totalAmount', RoomID='$roomID' WHERE BookingID='$bookingID'";
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

    } else {
        // Handle new booking
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $nationality = $_POST['nationality'];
        $phone = $_POST['phone'];
        $checkInDate = $_POST['checkInDate'];
        $checkOutDate = $_POST['checkOutDate'];
        $roomID = $_POST['roomID'];
        $quantity = 1; // Assuming quantity is 1, if not adjust this based on your requirement

        // Insert guest information
        $query = "INSERT INTO Guests (Name, Email, Address, Nationality, Phone) VALUES ('$name', '$email', '$address', '$nationality', '$phone')";
        if (mysqli_query($conn, $query)) {
            $guestID = mysqli_insert_id($conn);

            // Fetch room price and quantity
            $query = "SELECT Price, Quantity FROM Rooms WHERE RoomID = '$roomID'";
            $result = mysqli_query($conn, $query);
            $room = mysqli_fetch_assoc($result);
            $roomPrice = $room['Price'];
            $roomQuantity = $room['Quantity'];

            // Check if enough rooms are available
            if ($roomQuantity < $quantity) {
                die("Not enough rooms available.");
            }

            // Calculate the number of days booked
            $date1 = new DateTime($checkInDate);
            $date2 = new DateTime($checkOutDate);
            $interval = $date1->diff($date2);
            $numDays = $interval->days;

            // Calculate total amount for rooms
            $totalAmount = $roomPrice * $quantity * $numDays;

            // Collect and insert services if any
            if (isset($_POST['services'])) {
                foreach ($_POST['services'] as $serviceID) {
                    $query = "SELECT Amount FROM Service WHERE ServiceID = '$serviceID'";
                    $result = mysqli_query($conn, $query);
                    $service = mysqli_fetch_assoc($result);
                    $totalAmount += $service['Amount'];
                }
            }

            // Insert booking information
            $status = 'Booked'; // Initial status
            $query = "INSERT INTO Booking (CheckInDate, CheckOutDate, TotalAmount, Status, GuestID, RoomID) VALUES ('$checkInDate', '$checkOutDate', '$totalAmount', '$status', '$guestID', '$roomID')";
            mysqli_query($conn, $query);

            // Decrement the quantity of rooms available
            $newRoomQuantity = $roomQuantity - $quantity;
            $query = "UPDATE Rooms SET Quantity = '$newRoomQuantity' WHERE RoomID = '$roomID'";
            mysqli_query($conn, $query);

            header('Location: ../booking.php');
            exit;
        }
    }
}
?>
