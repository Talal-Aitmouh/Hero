<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$services = [];
$sqlservice = "SELECT * FROM service";
$rsltservices = $conn->query($sqlservice);

if ($rsltservices -> num_rows > 0){
    while ($row = $rsltservices -> fetch_assoc()) {
        $services[] = $row;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];
    $guest_id = $_POST['guest_id'];
    $room_id = $_POST['room_id'];

    // Insert new service into the database
    $sql = "INSERT INTO Service (Name, Type, Description, Amount, GuestID, RoomID) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $name, $type, $description, $amount, $guest_id, $room_id);

    if ($stmt->execute()) {
        // Redirect to the page with the form after successful insertion
        header("Location: ../service.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}


?>