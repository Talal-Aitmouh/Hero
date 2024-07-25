<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$rooms = [];

$sqlRooms = "SELECT * FROM Rooms";
$resultRooms = $conn->query($sqlRooms);

if ($resultRooms->num_rows > 0) {
    while ($row = $resultRooms->fetch_assoc()) {
        $rooms[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $roomID = $_POST['RoomID'];

    $conn = new mysqli("localhost", "root", "", "Heroku");

    // Select and delete room images
    $sql_select_images = "SELECT ImagePath FROM RoomImages WHERE RoomID=?";
    $stmt_select_images = $conn->prepare($sql_select_images);
    $stmt_select_images->bind_param("i", $roomID);
    $stmt_select_images->execute();
    $result_images = $stmt_select_images->get_result();

    while ($row = $result_images->fetch_assoc()) {
        $image_path = '../../img/rooms/' . $row['ImagePath'];
        if (file_exists($image_path)) {
            unlink($image_path); // Delete image file from server
        }
    }

    $stmt_select_images->close();

    // Delete room images records from RoomImages table
    $sql_delete_images = "DELETE FROM RoomImages WHERE RoomID=?";
    $stmt_delete_images = $conn->prepare($sql_delete_images);
    $stmt_delete_images->bind_param("i", $roomID);
    $stmt_delete_images->execute();
    $stmt_delete_images->close();

    // Delete room record from Rooms table
    $sql_delete_room = "DELETE FROM Rooms WHERE RoomID=?";
    $stmt_delete_room = $conn->prepare($sql_delete_room);
    $stmt_delete_room->bind_param("i", $roomID);
    $stmt_delete_room->execute();
    $stmt_delete_room->close();

    $conn->close();
}

  





?>