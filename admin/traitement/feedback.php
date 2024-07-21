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

$feedbacks = [];
$sql = "SELECT guests.GuestID, guests.FullName, feedback.Rating, feedback.FeedbackDate, feedback.FeedbackText
        FROM feedback
        JOIN guests ON feedback.GuestID = guests.GuestID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
