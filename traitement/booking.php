<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone_number'];
$address = $_POST['address'];
$nationality = $_POST['nationality'];
$passportNumber = $_POST['passport_number'];
$dateOfBirth = $_POST['date_of_birth'];
$gender = $_POST['gender'];
$checkInDate = $_POST['checkin_date'];
$checkOutDate = $_POST['checkout_date'];
$numberOfGuests = $_POST['number_of_guests'];
$roomID = $_POST['room_id'];

// Insert guest information into the guests table
$guestInsertSQL = "INSERT INTO guests (FullName, Email, Phone, Address, Nationality, PassportNumber, DateOfBirth, Gender, CHECKINDATE, CHECKOUTDATE)
                   VALUES ('$fullName', '$email', '$phone', '$address', '$nationality', '$passportNumber', '$dateOfBirth', '$gender', '$checkInDate', '$checkOutDate')";

if ($conn->query($guestInsertSQL) === TRUE) {
    $guestID = $conn->insert_id; // Get the last inserted GuestID

    // Insert booking information into the booking table
    $bookingDate = date('Y-m-d'); // Current date
    $status = "Pending"; // Default status
    $totalAmount = calculateTotalAmount($roomID, $checkInDate, $checkOutDate, $conn); // Function to calculate total amount

    $bookingInsertSQL = "INSERT INTO booking (GuestID, RoomID, BookingDate, CheckInDate, CheckOutDate, Status, TotalAmount)
                         VALUES ('$guestID', '$roomID', '$bookingDate', '$checkInDate', '$checkOutDate', '$status', '$totalAmount')";

    if ($conn->query($bookingInsertSQL) === TRUE) {
        echo "Booking created successfully!";
    } else {
        echo "Error: " . $bookingInsertSQL . "<br>" . $conn->error;
    }

} else {
    echo "Error: " . $guestInsertSQL . "<br>" . $conn->error;
}

$conn->close();

// Function to calculate the total amount
function calculateTotalAmount($roomID, $checkInDate, $checkOutDate, $conn) {
    // Calculate the number of days
    $checkIn = new DateTime($checkInDate);
    $checkOut = new DateTime($checkOutDate);
    $interval = $checkIn->diff($checkOut);
    $days = $interval->days;

    // Fetch the room price
    $roomPriceSQL = "SELECT Price FROM rooms WHERE RoomID = '$roomID'";
    $roomResult = $conn->query($roomPriceSQL);
    $roomPrice = $roomResult->fetch_assoc()['Price'];

    // Calculate total amount
    $totalAmount = ($roomPrice * $days);
    return $totalAmount;
}
?>
