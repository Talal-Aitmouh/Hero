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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];

    $sqlguest = 'INSERT INTO guests (Name, Email, Nationality, Phone, Address) VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sqlguest);
    $stmt->bind_param('sssss', $name, $email, $nationality, $phone, $address);
    $stmt->execute();
    header('Location: ../guests.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name1 = $_POST['name'];
    $email1 = $_POST['email'];
    $phone1 = $_POST['phone'];
    $nationality1 = $_POST['nationality'];
    $address1 = $_POST['address'];
    $id = $_POST['guestid']; // Ensure the field name matches the hidden input name in the form

    $sqlguest1 = "UPDATE guests SET Name = ?, Email = ?, Nationality = ?, Phone = ?, Address = ? WHERE GuestID = ?";
    $stmt = $conn->prepare($sqlguest1);
    $stmt->bind_param('sssssi', $name1, $email1, $nationality1, $phone1, $address1, $id);

    if ($stmt->execute()) {
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
