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

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
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



?>