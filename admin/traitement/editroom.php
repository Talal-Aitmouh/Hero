<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroku";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if (isset($_POST["submit"])) {
    $roomID = mysqli_real_escape_string($conn, $_POST['RoomID']);
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $type = mysqli_real_escape_string($conn, $_POST['Type']);
    $capacity = mysqli_real_escape_string($conn, $_POST['Capacity']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);
    $numberBed = mysqli_real_escape_string($conn, $_POST['NumberBed']);
    $bedType = mysqli_real_escape_string($conn, $_POST['BedType']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    

    $upload_dir = '../../img/rooms/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $photo_path = '';
    if (!empty($_FILES['Photo']['name'])) {
        $photo = $_FILES['Photo']['name'];
        $photo_temp = $_FILES['Photo']['tmp_name'];
        $photo_path = $upload_dir . $photo;
        move_uploaded_file($photo_temp, $photo_path);
    }

    $sql = "UPDATE Rooms SET RoomName='$name', Type='$type', Capacity='$capacity', Price='$price', 
            Description='$description', NumberBed='$numberBed', BedType='$bedType', quantity='$quantity' ";
    if ($photo_path !== '') {
        $sql .= ", Photo='$photo'";
    }
    $sql .= " WHERE RoomID=$roomID";

    if ($conn->query($sql) === TRUE) {
        // Handle additional photos if any
        foreach ($_FILES['OtherPics']['tmp_name'] as $key => $tmp_name) {
            $otherPhoto = $_FILES['OtherPics']['name'][$key];
            $other_temp = $_FILES['OtherPics']['tmp_name'][$key];
            $other_target_file = $upload_dir . basename($otherPhoto);

            if (move_uploaded_file($other_temp, $other_target_file)) {
                $sql = "INSERT INTO RoomImages (RoomID, ImageURL) VALUES ($roomID, '$otherPhoto')";
                $conn->query($sql);
            }
        }

        header("Location: ../room.php?msg=Room updated successfully");
        exit();
    } else {
        echo "Error updating room: " . $conn->error;
    }
}

$conn->close();
?>
