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

    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $type = mysqli_real_escape_string($conn, $_POST['Type']);
    $capacity = mysqli_real_escape_string($conn, $_POST['Capacity']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);
    $numberBed = mysqli_real_escape_string($conn, $_POST['NumberBed']);
    $bedType = mysqli_real_escape_string($conn, $_POST['BedType']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    $photo = $_FILES['Photo']['name'];
    $photo_temp = $_FILES['Photo']['tmp_name'];
    $photo_path = '../../img/rooms/' . $photo;

    $upload_dir = '../../img/rooms/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($photo_temp, $photo_path)) {
        $sql = "INSERT INTO Rooms (RoomName, Type, Capacity, Price, Description, Photo, NumberBed, BedType, quantity) 
                VALUES ('$name', '$type', '$capacity', '$price', '$description', '$photo', '$numberBed', '$bedType', '$quantity')";

        if ($conn->query($sql) === TRUE) {
            $roomID = $conn->insert_id; // Get the last inserted RoomID

            // Handle additional images
            foreach ($_FILES['OtherPics']['tmp_name'] as $key => $tmp_name) {
                $otherPhoto = $_FILES['OtherPics']['name'][$key];
                $other_temp = $_FILES['OtherPics']['tmp_name'][$key];
                $other_target_file = $upload_dir . basename($otherPhoto);

                if (move_uploaded_file($other_temp, $other_target_file)) {
                    $sql = "INSERT INTO RoomImages (RoomID, ImageURL) VALUES ($roomID, '$otherPhoto')";
                    $conn->query($sql);
                } else {
                    echo "Failed to upload additional image: " . $otherPhoto;
                }
            }

            header("Location: ../room.php?msg=New room added successfully");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}

$conn->close();
?>
