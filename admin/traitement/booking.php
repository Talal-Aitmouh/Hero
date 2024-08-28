<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlbooking = "SELECT 
    Booking.BookingID,
    Booking.CheckInDate,
    Booking.CheckOutDate,
    Booking.TotalAmount,
    Booking.Status,
    Guests.FullName AS GuestName,
    Guests.Email AS GuestEmail,
    Guests.Phone AS GuestPhone,
    Guests.Address AS GuestAddress,
    Guests.Nationality AS GuestNationality,
    Guests.PassportNumber AS GuestPassportNumber,
    Guests.DateOfBirth AS GuestDateOfBirth,
    Guests.Gender AS GuestGender,
    Rooms.RoomName,
    Rooms.Price AS RoomPrice,
    Rooms.Description AS RoomDescription,
    Rooms.Quantity AS RoomQuantity
    
FROM 
    booking AS Booking
INNER JOIN 
    guests AS Guests ON Booking.GuestID = Guests.GuestID
INNER JOIN 
    rooms AS Rooms ON Booking.RoomID = Rooms.RoomID";

$resultbooking = $conn->query($sqlbooking);

$reservations = [];
while ($row = $resultbooking->fetch_assoc()) {
    $reservations[] = $row;
}




$queryroom = "SELECT RoomID, RoomName, Price, Quantity FROM Rooms";
$result = mysqli_query($conn, $queryroom);

$queryroom2 =  "SELECT RoomID, RoomName, Price, Quantity FROM Rooms";
$result2 = mysqli_query($conn, $queryroom2);


$queryServices = "SELECT ServiceID, ServiceName, Price FROM Service";
$resultServices = mysqli_query($conn, $queryServices);

$queryServices2 = "SELECT ServiceID, ServiceName, Price FROM Service";
$resultServices2 = mysqli_query($conn, $queryServices);

$queryGuests = "SELECT * FROM Guests";
$resultGuests = $conn->query($queryGuests);



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
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

        // Insert new guest information including check-in and check-out dates
        $query = "INSERT INTO guests (FullName, Email, Address, Nationality, Phone, PassportNumber, DateOfBirth, Gender, CheckInDate, CheckOutDate) 
                  VALUES ('$name', '$email', '$address', '$nationality', '$phone', '$passportNumber', '$dateOfBirth', '$gender', '$checkInDate', '$checkOutDate')";
        if (!mysqli_query($conn, $query)) {
            die("Error inserting new guest: " . mysqli_error($conn));
        }
        $guestID = mysqli_insert_id($conn);
    } else {
        // Existing guest selected
        $guestID = mysqli_real_escape_string($conn, $_POST['guest']);

        // Update the guest's check-in and check-out dates
        $query = "UPDATE guests SET CheckInDate = '$checkInDate', CheckOutDate = '$checkOutDate' WHERE GuestID = '$guestID'";
        if (!mysqli_query($conn, $query)) {
            die("Error updating guest dates: " . mysqli_error($conn));
        }
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
                $date1 = new DateTime($checkInDate);
                $date2 = new DateTime($checkOutDate);
                $interval = $date1->diff($date2);
                $numDays = $interval->days;
                $service = mysqli_fetch_assoc($result);
                $totalAmount += $service['Price'] * $numDays ;
            } else {
                die("Error fetching service details: " . mysqli_error($conn));
            }
        }
    }

    // Insert booking information
    $status = 'Booked'; // Initial status
    $query = "INSERT INTO booking (GuestID, RoomID, BookingDate, CheckInDate, CheckOutDate, Status, TotalAmount) 
              VALUES ('$guestID', '$roomID', NOW(), '$checkInDate', '$checkOutDate', '$status', '$totalAmount')";
    if (mysqli_query($conn, $query)) {
        $bookingID = mysqli_insert_id($conn);

        // Insert billing information
        $paymentStatus = 'Pending'; // Initial payment status
        $query = "INSERT INTO billing (GuestID, BookingID, Amount, BillingDate, PaymentStatus) 
                  VALUES ('$guestID', '$bookingID', '$totalAmount', NOW(), '$paymentStatus')";
        if (!mysqli_query($conn, $query)) {
            die("Error inserting billing information: " . mysqli_error($conn));
        }

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Delete booking information
    $bookingID = $_POST['bookingID'];

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Retrieve the GuestID associated with the booking
        $sqlGuestID = "SELECT GuestID FROM booking WHERE BookingID = ?";
        $stmtGuestID = $conn->prepare($sqlGuestID);
        $stmtGuestID->bind_param("i", $bookingID);
        $stmtGuestID->execute();
        $stmtGuestID->bind_result($guestID);
        $stmtGuestID->fetch();
        $stmtGuestID->close();

        // Delete related records from the `transactions` table
        $sqlTransactions = "DELETE FROM transactions WHERE BillingID IN (SELECT BillingID FROM billing WHERE BookingID = ?)";
        $stmtTransactions = $conn->prepare($sqlTransactions);
        $stmtTransactions->bind_param("i", $bookingID);
        $stmtTransactions->execute();
        $stmtTransactions->close();

        // Delete related records from the `billing` table
        $sqlBilling = "DELETE FROM billing WHERE BookingID = ?";
        $stmtBilling = $conn->prepare($sqlBilling);
        $stmtBilling->bind_param("i", $bookingID);
        $stmtBilling->execute();
        $stmtBilling->close();

        // Delete related records from the `feedback` table
        $sqlFeedback = "DELETE FROM feedback WHERE BookingID = ?";
        $stmtFeedback = $conn->prepare($sqlFeedback);
        $stmtFeedback->bind_param("i", $bookingID);
        $stmtFeedback->execute();
        $stmtFeedback->close();

        // Finally, delete the booking record from the `booking` table
        $sqlBooking = "DELETE FROM booking WHERE BookingID = ?";
        $stmtBooking = $conn->prepare($sqlBooking);
        $stmtBooking->bind_param("i", $bookingID);
        $stmtBooking->execute();
        $stmtBooking->close();

        // Delete the guest record from the `guests` table
        $sqlGuest = "DELETE FROM guests WHERE GuestID = ?";
        $stmtGuest = $conn->prepare($sqlGuest);
        $stmtGuest->bind_param("i", $guestID);
        $stmtGuest->execute();
        $stmtGuest->close();

        // Commit the transaction
        $conn->commit();

        header('Location: ../booking.php');
        exit();
    } catch (Exception $e) {
        // An error occurred, rollback the transaction
        $conn->rollback();
        echo "Error deleting records: " . $e->getMessage();
    }
}



$conn->close();
