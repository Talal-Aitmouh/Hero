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
    Guests.FullName AS GuestName,
    Rooms.RoomName
FROM 
    Booking
INNER JOIN 
    Guests ON Booking.GuestID = Guests.GuestID
INNER JOIN 
    Rooms ON Booking.RoomID = Rooms.RoomID";
$resultbooking = $conn->query($sqlbooking);

while ($row = $resultbooking->fetch_assoc()) {
    $reservations[] = $row;
}




$queryroom = "SELECT RoomID, RoomName, Price, Quantity FROM Rooms";
$result = mysqli_query($conn, $queryroom);

$queryServices = "SELECT ServiceID, ServiceName, Price FROM Service";
$resultServices = mysqli_query($conn, $queryServices);

$queryGuests = "SELECT * FROM guests";
$resultGuests = $conn->query($queryGuests);


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (isset($_POST['delete'])) {
//         $bookingID = $_POST['bookingID'];

//         // Handle delete
//         $query = "SELECT RoomID, CheckInDate, CheckOutDate FROM Booking WHERE BookingID = '$bookingID'";
//         $result = mysqli_query($conn, $query);
//         if ($result && mysqli_num_rows($result) > 0) {
//             $booking = mysqli_fetch_assoc($result);
//             $roomID = $booking['RoomID'];

//             // Calculate number of days booked
//             $checkInDate = new DateTime($booking['CheckInDate']);
//             $checkOutDate = new DateTime($booking['CheckOutDate']);
//             $interval = $checkInDate->diff($checkOutDate);
//             $numDays = $interval->days;

//             // Get the quantity of rooms booked
//             $quantity = 1; // Assuming quantity is 1, if not adjust this based on your requirement

//             // Increase the room quantity
//             $query = "UPDATE Rooms SET Quantity = Quantity + $quantity WHERE RoomID = '$roomID'";
//             mysqli_query($conn, $query);

//             // Delete the booking
//             $query = "DELETE FROM Booking WHERE BookingID = '$bookingID'";
//             mysqli_query($conn, $query);

//             // Delete the billing information
//             $query = "DELETE FROM Billing WHERE BookingID = '$bookingID'";
//             mysqli_query($conn, $query);

//             // Delete the services associated with the booking
//             $query = "DELETE FROM BookingServices WHERE BookingID = '$bookingID'";
//             mysqli_query($conn, $query);
//         }
//         header('Location: ../booking.php');
//         exit;

//     } elseif (isset($_POST['update'])) {
//         $bookingID = $_POST['bookingID'];
//         $name = $_POST['name'];
//         $email = $_POST['email'];
//         $address = $_POST['address'];
//         $nationality = $_POST['nationality'];
//         $phone = $_POST['phone'];
//         $checkInDate = $_POST['checkInDate'];
//         $checkOutDate = $_POST['checkOutDate'];
//         $roomID = $_POST['roomID'];
//         $quantity = 1; // Assuming quantity is 1, if not adjust this based on your requirement

//         // Calculate the number of days booked
//         $date1 = new DateTime($checkInDate);
//         $date2 = new DateTime($checkOutDate);
//         $interval = $date1->diff($date2);
//         $numDays = $interval->days;

//         // Get room price
//         $query = "SELECT Price FROM Rooms WHERE RoomID = '$roomID'";
//         $result = mysqli_query($conn, $query);
//         $room = mysqli_fetch_assoc($result);
//         $roomPrice = $room['Price'];

//         // Calculate total amount for rooms
//         $totalAmount = $roomPrice * $quantity * $numDays;

//         // Update booking
//         $query = "UPDATE Booking SET CheckInDate='$checkInDate', CheckOutDate='$checkOutDate', TotalAmount='$totalAmount', RoomID='$roomID' WHERE BookingID='$bookingID'";
//         mysqli_query($conn, $query);

//         // Update guest information
//         $query = "UPDATE Guests SET Name='$name', Email='$email', Address='$address', Nationality='$nationality', Phone='$phone' WHERE GuestID=(SELECT GuestID FROM Booking WHERE BookingID='$bookingID')";
//         mysqli_query($conn, $query);

//         // Update services
//         // Delete existing service bookings
//         $query = "DELETE FROM BookingServices WHERE BookingID = '$bookingID'";
//         mysqli_query($conn, $query);

//         // Add new service bookings
//         if (isset($_POST['services'])) {
//             foreach ($_POST['services'] as $serviceID) {
//                 // Get service amount
//                 $query = "SELECT Amount FROM Service WHERE ServiceID = '$serviceID'";
//                 $result = mysqli_query($conn, $query);
//                 $service = mysqli_fetch_assoc($result);
//                 $totalAmount += $service['Amount'];

//                 // Insert into BookingServices table
//                 $query = "INSERT INTO BookingServices (BookingID, ServiceID) VALUES ('$bookingID', '$serviceID')";
//                 mysqli_query($conn, $query);
//             }

//             // Update the total amount in the booking
//             $query = "UPDATE Booking SET TotalAmount='$totalAmount' WHERE BookingID='$bookingID'";
//             mysqli_query($conn, $query);
//         }

//         // Update billing information
//         $paymentStatus = ($status == 'Booked') ? 'Paid' : 'Pending'; // Update payment status based on booking status
//         $query = "UPDATE Billing SET TotalAmount='$totalAmount', PaymentStatus='$paymentStatus' WHERE BookingID='$bookingID'";
//         mysqli_query($conn, $query);

//         header('Location: ../booking.php');
//         exit;

//     } else {
//         // Handle new booking
//         $name = $_POST['name'];
//         $email = $_POST['email'];
//         $address = $_POST['address'];
//         $nationality = $_POST['nationality'];
//         $phone = $_POST['phone'];
//         $checkInDate = $_POST['checkInDate'];
//         $checkOutDate = $_POST['checkOutDate'];
//         $roomID = $_POST['roomID'];
//         $quantity = 1; // Assuming quantity is 1, if not adjust this based on your requirement

//         // Insert guest information
//         $query = "INSERT INTO Guests (Name, Email, Address, Nationality, Phone) VALUES ('$name', '$email', '$address', '$nationality', '$phone')";
//         if (mysqli_query($conn, $query)) {
//             $guestID = mysqli_insert_id($conn);

//             // Fetch room price and quantity
//             $query = "SELECT Price, Quantity FROM Rooms WHERE RoomID = '$roomID'";
//             $result = mysqli_query($conn, $query);
//             $room = mysqli_fetch_assoc($result);
//             $roomPrice = $room['Price'];
//             $roomQuantity = $room['Quantity'];

//             // Check if enough rooms are available
//             if ($roomQuantity < $quantity) {
//                 die("Not enough rooms available.");
//             }

//             // Calculate the number of days booked
//             $date1 = new DateTime($checkInDate);
//             $date2 = new DateTime($checkOutDate);
//             $interval = $date1->diff($date2);
//             $numDays = $interval->days;

//             // Calculate total amount for rooms
//             $totalAmount = $roomPrice * $quantity * $numDays;

//             // Collect and insert services if any
//             if (isset($_POST['services'])) {
//                 foreach ($_POST['services'] as $serviceID) {
//                     $query = "SELECT Amount FROM Service WHERE ServiceID = '$serviceID'";
//                     $result = mysqli_query($conn, $query);
//                     $service = mysqli_fetch_assoc($result);
//                     $totalAmount += $service['Amount'];
//                 }
//             }

//             // Insert booking information
//             $status = 'Booked'; // Initial status
//             $query = "INSERT INTO Booking (CheckInDate, CheckOutDate, TotalAmount, Status, GuestID, RoomID) VALUES ('$checkInDate', '$checkOutDate', '$totalAmount', '$status', '$guestID', '$roomID')";
//             if (mysqli_query($conn, $query)) {
//                 $bookingID = mysqli_insert_id($conn);

//                 // Insert billing information
//                 $paymentStatus = ($status == 'Booked') ? 'Paid' : 'Pending'; // Initial payment status based on booking status
//                 $query = "INSERT INTO Billing (TotalAmount, PaymentStatus, BookingID, GuestID) VALUES ('$totalAmount', '$paymentStatus', '$bookingID', '$guestID')";
//                 mysqli_query($conn, $query);

//                 // Insert into BookingServices table
//                 if (isset($_POST['services'])) {
//                     foreach ($_POST['services'] as $serviceID) {
//                         $query = "INSERT INTO BookingServices (BookingID, ServiceID) VALUES ('$bookingID', '$serviceID')";
//                         mysqli_query($conn, $query);
//                     }
//                 }

//                 // Decrement the quantity of rooms available
//                 $newRoomQuantity = $roomQuantity - $quantity;
//                 $query = "UPDATE Rooms SET Quantity = '$newRoomQuantity' WHERE RoomID = '$roomID'";
//                 mysqli_query($conn, $query);

//                 header('Location: ../booking.php');
//                 exit;
//             }
//         }
//     }
// }


error_reporting(E_ALL);
ini_set('display_errors', 1);



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a new guest is being added or an existing guest is selected
    $isNewGuest = isset($_POST['name']) && !empty($_POST['name']);

    // Booking information
    $checkInDate = mysqli_real_escape_string($conn, $_POST['checkInDate']);
    $checkOutDate = mysqli_real_escape_string($conn, $_POST['checkOutDate']);
    $roomID = mysqli_real_escape_string($conn, $_POST['roomID']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']); // Quantity of rooms booked
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    // Validate required fields
    if (empty($checkInDate) || empty($checkOutDate) || empty($roomID) || empty($quantity)) {
        die('Please fill in all required fields.');
    }

    if ($isNewGuest) {
        // New guest information
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $passportNumber = mysqli_real_escape_string($conn, $_POST['passport_number']);
        $dateOfBirth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);

        // Insert new guest information
        $query = "INSERT INTO guests (FullName, Email, Address, Nationality, Phone, PassportNumber, DateOfBirth, Gender) VALUES ('$name', '$email', '$address', '$nationality', '$phone', '$passportNumber', '$dateOfBirth', '$gender')";
        if (!mysqli_query($conn, $query)) {
            die("Error inserting new guest: " . mysqli_error($conn));
        }
        $guestID = mysqli_insert_id($conn);
    } else {
        // Existing guest selected
        $guestID = mysqli_real_escape_string($conn, $_POST['guest']);
    }

    // Fetch room price and quantity
    $query = "SELECT Price, Quantity FROM rooms WHERE RoomID = '$roomID'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error fetching room details: " . mysqli_error($conn));
    }
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

    // Collect and add services if any
    if (!empty($services)) {
        foreach ($services as $serviceID) {
            $query = "SELECT Price FROM service WHERE ServiceID = '$serviceID'";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $service = mysqli_fetch_assoc($result);
                $totalAmount += $service['Price'];
            } else {
                die("Error fetching service details: " . mysqli_error($conn));
            }
        }
    }

    // Insert booking information
    $status = 'Booked'; // Initial status
    $query = "INSERT INTO booking (GuestID, RoomID, BookingDate, CheckInDate, CheckOutDate, Status, TotalAmount) VALUES ('$guestID', '$roomID', NOW(), '$checkInDate', '$checkOutDate', '$status', '$totalAmount')";
    if (mysqli_query($conn, $query)) {
        $bookingID = mysqli_insert_id($conn);

        // Insert billing information
        $paymentStatus = 'Pending'; // Initial payment status
        $query = "INSERT INTO billing (GuestID, BookingID, Amount, BillingDate, PaymentStatus) VALUES ('$guestID', '$bookingID', '$totalAmount', NOW(), '$paymentStatus')";
        if (!mysqli_query($conn, $query)) {
            die("Error inserting billing information: " . mysqli_error($conn));
        }

        // Insert into booking services table
        

        // Decrease the quantity of available rooms
        $newRoomQuantity = $roomQuantity - $quantity;
        $query = "UPDATE rooms SET Quantity = '$newRoomQuantity' WHERE RoomID = '$roomID'";
        if (!mysqli_query($conn, $query)) {
            die("Error updating room quantity: " . mysqli_error($conn));
        }

        header('Location: ../booking.php');
        exit;
    } else {
        die("Error inserting booking information: " . mysqli_error($conn));
    }
}

?>
