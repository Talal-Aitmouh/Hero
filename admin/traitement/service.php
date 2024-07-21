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

if ($rsltservices->num_rows > 0) {
    while ($row = $rsltservices->fetch_assoc()) {
        $services[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    // Insert new service into the database
    $sql = "INSERT INTO service (ServiceName, Description, Price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $name, $description, $amount);

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
