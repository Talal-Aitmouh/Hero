<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$staffs = [];
$sql = "SELECT * FROM staff";
$result = $conn->query($sql) ;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        $staffs[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addstaff'])){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role = $_POST['position'];

    $sqlstaff = 'INSERT INTO staff (FullName, Email, Password, Phone, Position) Values (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sqlstaff);
    $stmt->bind_param('sssss', $name, $email, $password, $phone, $role);
    $stmt->execute();
    header('Location: ../staff.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])){

    $name2 = $_POST['name'];
    $email2 = $_POST['email'];
    $phone2 = $_POST['phone'];
    $password2 = $_POST['password'];
    $role2 = $_POST['position'];
    $staffId2 = $_POST['staffId'];

    $sqlstaff2 = "UPDATE staff SET FullName = ?, Email = ?, Password = ?, Phone = ?, Position = ? WHERE StaffID = ?";
    $stmt2 = $conn->prepare($sqlstaff2);
    $stmt2->bind_param("sssssi", $name2, $email2, $password2, $phone2, $role2, $staffId2);

    if ($stmt2->execute()){
        header('Location: ../staff.php');
        exit();
    } else {
        echo "Error updating record: " . $stmt2->error;
    }
    $stmt2->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $staffId = $_POST['delete'];
    $sqlstaff = "DELETE FROM staff WHERE StaffID = ?";
    $stmt = $conn->prepare($sqlstaff);
    $stmt->bind_param("i", $staffId);

    if ($stmt->execute()) {
        header('Location: ../staff.php');
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
    $stmt->close();
}


$conn->close();
?>
