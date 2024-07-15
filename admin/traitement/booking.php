<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


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

if ($resultbooking->num_rows > 0){
    while($rowbooking = $resultbooking->fetch_assoc()) {
        $reservations[] = $rowbooking;
    }
}

$queryroom = "SELECT RoomID, RoomName, Price, quantity FROM Rooms";
$result = mysqli_query($conn, $queryroom);

$queryServices = "SELECT ServiceID, Name, Amount FROM Service";
$resultServices = mysqli_query($conn, $queryServices);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect guest information
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $nationality = $_POST['nationality'];
    $phone = $_POST['phone'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];

    // Insert guest information
    $query = "INSERT INTO Guests (Name, Email, Address, Nationality, Phone, CheckInDate, CheckOutDate) VALUES ('$name', '$email', '$address', '$nationality', '$phone', '$checkInDate', '$checkOutDate')";
    if (mysqli_query($conn, $query)) {
        $guestID = mysqli_insert_id($conn);

        // Collect booking information
        $roomID = $_POST['roomID'];
        $quantity = $_POST['quantity'];

        // Fetch room price and quantity
        $query = "SELECT Price, quantity FROM Rooms WHERE RoomID = '$roomID'";
        $result = mysqli_query($conn, $query);
        $room = mysqli_fetch_assoc($result);
        $roomPrice = $room['Price'];
        $roomQuantity = $room['quantity'];

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

        // Optionally, link services to the booking if any
       

        // Decrement the quantity of rooms available
        $newRoomQuantity = $roomQuantity - $quantity;
        $query = "UPDATE Rooms SET quantity = '$newRoomQuantity' WHERE RoomID = '$roomID'";
        mysqli_query($conn, $query);
    }
    header('Location: ../booking.php');
}
?>
