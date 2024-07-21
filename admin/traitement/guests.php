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

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$guests = [];

// Fetch all guests
$sql = "SELECT * FROM guests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guests[] = $row;
    }
}


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {

    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];
    $passportNumber = $_POST['passport_number'];
    $dateOfBirth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];

    $sql = 'INSERT INTO guests (FullName, Email, Phone, Address, Nationality, PassportNumber, DateOfBirth, Gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssss', $name, $email, $phone, $address, $nationality, $passportNumber, $dateOfBirth, $gender);
    $stmt->execute();

    // Redirect after successful insertion
    header('Location: ../guests.php');
    exit();
}



// Check if the form was submitted for updating guest information
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Include your database connection here
    // Example: $conn = new mysqli('localhost', 'username', 'password', 'database_name');
    
    // Retrieve form data
    $id = $_POST['guestid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];
    $passportNumber = $_POST['passport_number'];
    $dateOfBirth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];

    // Prepare and execute SQL statement
    $sql = 'UPDATE guests SET FullName = ?, Email = ?, Phone = ?, Address = ?, Nationality = ?, PassportNumber = ?, DateOfBirth = ?, Gender = ? WHERE GuestID = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssssssi', $name, $email, $phone, $address, $nationality, $passportNumber, $dateOfBirth, $gender, $id);

    if ($stmt->execute()) {
        // Redirect after successful update
        header('Location: ../guests.php');
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['guestid']; // Ensure the field name matches the hidden input name
    $sqlguest1 = "DELETE FROM guests WHERE GuestID = ?";
    $stmt = $conn->prepare($sqlguest1);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header('Location: ../guests.php');
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}



$conn->close();
?>
