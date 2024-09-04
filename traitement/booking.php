<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $roomID = $_POST['room_id']; // Retrieved from hidden input
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
    $bookingDate = date('Y-m-d');
    $numberOfGuests = $_POST['number_of_guests'];
    $paymentMethod = $_POST['payment_method'];

    // Calculate the number of days
    $date1 = new DateTime($checkInDate);
    $date2 = new DateTime($checkOutDate);
    $interval = $date1->diff($date2);
    $days = $interval->days;

    // Fetch room price
    $sql = "SELECT Price FROM rooms WHERE RoomID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $roomID);
    $stmt->execute();
    $stmt->bind_result($roomPrice);
    $stmt->fetch();
    $stmt->close();
    
    // Calculate total amount
    $totalAmount = $roomPrice * $days;

    // Insert Guest
    $sql = "INSERT INTO guests (FullName, Email, Phone, Address, Nationality, PassportNumber, DateOfBirth, Gender) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $fullName, $email, $phone, $address, $nationality, $passportNumber, $dateOfBirth, $gender);
    $stmt->execute();
    $guestID = $stmt->insert_id;
    $stmt->close();

    // Insert Booking
    $sql = "INSERT INTO booking (GuestID, RoomID, BookingDate, CheckInDate, CheckOutDate, TotalAmount) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssd", $guestID, $roomID, $bookingDate, $checkInDate, $checkOutDate, $totalAmount);
    $stmt->execute();
    $bookingID = $stmt->insert_id;
    $stmt->close();

    // Insert Billing
    $sql = "INSERT INTO billing (GuestID, BookingID, Amount, BillingDate, PaymentStatus) 
            VALUES (?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iids", $guestID, $bookingID, $totalAmount, $bookingDate);
    $stmt->execute();
    $billingID = $stmt->insert_id;
    $stmt->close();

    // Insert Transaction
    $sql = "INSERT INTO transactions (BillingID, TransactionDate, Amount, PaymentMethod, TransactionStatus) 
            VALUES (?, ?, ?, ?, 'Completed')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isds", $billingID, $bookingDate, $totalAmount, $paymentMethod);
    $stmt->execute();
    $stmt->close();

    echo "Booking and payment completed successfully.";
}
?>
