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
    $typeBed = mysqli_real_escape_string($conn, $_POST['TypeBed']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    $wifi = isset($_POST['Wifi']) ? 1 : 0;
    $tv = isset($_POST['TV']) ? 1 : 0;
    $climatiseur = isset($_POST['Climatiseur']) ? 1 : 0;
    $freeDrink = isset($_POST['FreeDrink']) ? 1 : 0;
    $disponibility = isset($_POST['Disponibility']) ? 1 : 0;

    $image = $_FILES['Photo']['name'];
    $image_temp = $_FILES['Photo']['tmp_name'];
    $image_path = '../../img/rooms/' . $image;

    $upload_dir = '../../img/rooms/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (move_uploaded_file($image_temp, $image_path)) {
        $sql = "INSERT INTO rooms (RoomName, Type, Capacity, Price, Description, Image, NumberBed, TypeBed, Quantity, Wifi, TV, Climatiseur, FreeDrink, Disponibility) 
                VALUES ('$name', '$type', '$capacity', '$price', '$description', '$image', '$numberBed', '$typeBed', '$quantity', '$wifi', '$tv', '$climatiseur', '$freeDrink', '$disponibility')";

        if ($conn->query($sql) === TRUE) {
            $roomID = $conn->insert_id; // Get the last inserted RoomID

            // Handle additional images
            foreach ($_FILES['OtherPics']['tmp_name'] as $key => $tmp_name) {
                $otherImage = $_FILES['OtherPics']['name'][$key];
                $other_temp = $_FILES['OtherPics']['tmp_name'][$key];
                $other_target_file = $upload_dir . basename($otherImage);

                if (move_uploaded_file($other_temp, $other_target_file)) {
                    $sql = "INSERT INTO roomimages (RoomID, ImagePath) VALUES ($roomID, '$otherImage')";
                    $conn->query($sql);
                } else {
                    echo "Failed to upload additional image: " . $otherImage;
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
