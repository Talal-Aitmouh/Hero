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
$sqlTotalServiceAmount = "SELECT SUM(Price) as total_service_amount FROM service";
$resultTotalServiceAmount = $conn->query($sqlTotalServiceAmount);
$rowTotalServiceAmount = $resultTotalServiceAmount->fetch_assoc();
$total_service_amount = number_format($rowTotalServiceAmount['total_service_amount'], 2);

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



// Fetch data by day and total amount from the database
$sql = "SELECT DAY(BookingDate) AS day, COUNT(*) AS bookings, SUM(TotalAmount) AS total_amount
        FROM booking
        WHERE YEAR(BookingDate) = YEAR(CURDATE()) 
        AND MONTH(BookingDate) = MONTH(CURDATE())
        GROUP BY DAY(BookingDate)
        ORDER BY DAY(BookingDate)";

$result = $conn->query($sql);

$days = [];
$bookings = [];
$amounts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $days[] = $row['day'];           // Get day number
        $bookings[] = $row['bookings'];  // Get booking count
        $amounts[] = $row['total_amount']; // Get total amount for the day
    }
} else {
    // If no results, provide default empty arrays
    $days = json_encode([]);
    $bookings = json_encode([]);
    $amounts = json_encode([]);
}

// Close the connection
$conn->close();

// Convert PHP arrays to JSON
$days = json_encode($days);
$bookings = json_encode($bookings);
$amounts = json_encode($amounts);
