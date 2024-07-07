<?php 
include '../config/db.php';




$sql = "SELECT SUM(TotalAmount) as total_amount FROM Billing";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_amount = number_format($row['total_amount'], 2);

$sqlBookingsCount = "SELECT COUNT(*) as num_bookings FROM Booking";
$resultBookingsCount = $conn->query($sqlBookingsCount);
$rowb = $resultBookingsCount->fetch_assoc();
$num_bookings = $rowb['num_bookings'];

$sqlg = "SELECT COUNT(*) as num_g from Guests";
$resultg = $conn->query($sqlg);
$rowg = $resultg ->fetch_assoc();
$numg = $rowb['num_bookings'];

$sqlCheckIns = "SELECT COUNT(*) as num_check_ins FROM Booking WHERE CheckInDate BETWEEN '2024-01-01' AND '2024-06-30'";
$resultCheckIns = $conn->query($sqlCheckIns);
$rowCheckIns = $resultCheckIns->fetch_assoc();
$numcheck = $rowCheckIns['num_check_ins'];


$sqlTransactions = "SELECT t.TransactionID, t.Amount, t.Date,t.Description, g.Name as GuestName
                    FROM Transactions t
                    INNER JOIN Guests g ON t.GuestID = g.GuestID";
$resultTransactions = $conn->query($sqlTransactions);



$sqlTotalServiceAmount = "SELECT SUM(Amount) as total_amount FROM Service";
$resultTotalServiceAmount = $conn->query($sqlTotalServiceAmount);
$rowTotalServiceAmount = $resultTotalServiceAmount->fetch_assoc();
$total_service_amount = number_format($rowTotalServiceAmount['total_amount'], 2);



$sqlr = "SELECT SUM(Rating) as total_rating, COUNT(*) as total_feedbacks FROM Feedback";
$resultr = $conn->query($sqlr);

if ($resultr->num_rows > 0) {
    // Output data of each row
    while($rowr = $resultr->fetch_assoc()) {
        $total_rating = $rowr['total_rating'];
        $total_feedbacks = $rowr['total_feedbacks'];
        $percentage = ($total_rating / $total_feedbacks);

       
    }
} else {
    echo "0 results";
}
$conn->close();



?>