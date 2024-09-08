<?php
include '../config/db.php';

// Fetch total amount from billing
$sql = "SELECT SUM(Amount) as total_amount FROM transactions";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_amount = number_format($row['total_amount'], 2);

// Fetch number of bookings
$sqlBookingsCount = "SELECT COUNT(*) as num_bookings FROM booking";
$resultBookingsCount = $conn->query($sqlBookingsCount);
$rowb = $resultBookingsCount->fetch_assoc();
$num_bookings = $rowb['num_bookings'];

// Fetch number of guests
$sqlg = "SELECT COUNT(*) as num_guests FROM guests";
$resultg = $conn->query($sqlg);
$rowg = $resultg->fetch_assoc();
$num_guests = $rowg['num_guests'];

// Fetch number of check-ins in a specific date range
$sqlCheckIns = "SELECT COUNT(*) as num_check_ins FROM booking WHERE CheckInDate BETWEEN '2024-01-01' AND '2024-06-30'";
$resultCheckIns = $conn->query($sqlCheckIns);
$rowCheckIns = $resultCheckIns->fetch_assoc();
$num_check_ins = $rowCheckIns['num_check_ins'];

// Fetch transaction details
$sqlTransactions = "SELECT t.TransactionID, t.Amount, t.TransactionDate, t.PaymentMethod, t.TransactionStatus, g.FullName as GuestName
                    FROM transactions t
                    INNER JOIN billing b ON t.BillingID = b.BillingID
                    INNER JOIN guests g ON b.GuestID = g.GuestID";
$resultTransactions = $conn->query($sqlTransactions);

// Fetch total service amount
$query = "SELECT SUM(Quantity) AS TotalRooms FROM rooms";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);
$totalRooms = $row['TotalRooms'];

// Fetch feedback ratings
$sqlr = "SELECT SUM(Rating) as total_rating, COUNT(*) as total_feedbacks FROM feedback";
$resultr = $conn->query($sqlr);

if ($resultr->num_rows > 0) {
    $rowr = $resultr->fetch_assoc();
    $total_rating = $rowr['total_rating'];
    $total_feedbacks = $rowr['total_feedbacks'];
    $average_rating = ($total_feedbacks > 0) ? number_format($total_rating / $total_feedbacks, 2) : 0;
} else {
    $total_rating = $total_feedbacks = $average_rating = 0;
}

$query = "SELECT MONTH(BookingDate) AS MonthNumber, SUM(TotalAmount) AS Amount
          FROM booking
          WHERE YEAR(BookingDate) = YEAR(CURDATE())
          GROUP BY MONTH(BookingDate)";


$result = mysqli_query($conn, $query);

// Initialize an associative array for all months with null values
$months = [
    "Jan" => null, "Feb" => null, "Mar" => null, "Apr" => null,
    "May" => null, "Jun" => null, "Jul" => null, "Aug" => null,
    "Sep" => null, "Oct" => null, "Nov" => null, "Dec" => null
];

// Populate the $months array with the actual data from the query
while ($row = mysqli_fetch_assoc($result)) {
    $monthIndex = date('M', mktime(0, 0, 0, $row['MonthNumber'], 10)); // Convert month number to month name (e.g., 1 -> Jan)
    $months[$monthIndex] = $row['Amount'];
}

// Convert the $months associative array to a simple array for Chart.js
$labels = array_keys($months); // ["Jan", "Feb", "Mar", ..., "Dec"]
$data = array_values($months); // [542, null, 430, ..., 900]

// Convert data arrays to JSON format for use in JavaScript
$labels_json = json_encode($labels);
$data_json = json_encode($data);



$query = "SELECT RoomName, Quantity FROM rooms";
$result = mysqli_query($conn, $query);

$roomNames = [];
$quantities = [];

while ($row = mysqli_fetch_assoc($result)) {
    $roomNames[] = $row['RoomName'];
    $quantities[] = $row['Quantity'];
}

$roomNames_json = json_encode($roomNames);
$quantities_json = json_encode($quantities);


$query = "SELECT MONTH(CHECKINDATE) AS MonthNumber, COUNT(*) AS GuestCount
          FROM guests
          WHERE YEAR(CHECKINDATE) = YEAR(CURDATE())
          GROUP BY MONTH(CHECKINDATE)
          ORDER BY MonthNumber";
$result = mysqli_query($conn, $query);

$monthlyGuests = array_fill(1, 12, 0);  // Initialize all months with 0

while ($row = mysqli_fetch_assoc($result)) {
    $monthlyGuests[$row['MonthNumber']] = $row['GuestCount'];
}

$monthlyGuests_json = json_encode(array_values($monthlyGuests));



$query = "SELECT COUNT(*) AS TotalGuests FROM guests";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);
$totalGuests = $row['TotalGuests'];