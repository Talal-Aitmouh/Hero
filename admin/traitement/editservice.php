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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_service'])) {
    // Retrieve form data
    $service_id = $_POST['service_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    // Prepare the update statement
    $sql = "UPDATE Service SET Name = ?, Type = ?, Description = ?, Amount = ? WHERE ServiceID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $name, $type, $description, $amount, $service_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the service page after successful update
        header("Location: ../service.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
