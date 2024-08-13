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

// Fetch all rooms
$rooms = [];
$sqlRooms = "SELECT * FROM Rooms";
$resultRooms = $conn->query($sqlRooms);
if ($resultRooms->num_rows > 0) {
    while ($row = $resultRooms->fetch_assoc()) {
        $rooms[] = $row;
    }
}

// Handle delete room
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $roomID = $_POST['RoomID'];

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
}

// Handle update room
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
            Description='$description', NumberBed='$numberBed', TypeBed='$bedType', quantity='$quantity' ";
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

// Handle add new room
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Name']);
    $type = mysqli_real_escape_string($conn, $_POST['Type']);
    $capacity = mysqli_real_escape_string($conn, $_POST['Capacity']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $description = mysqli_real_escape_string($conn, $_POST['Description']);
    $numberBed = mysqli_real_escape_string($conn, $_POST['NumberBed']);
    $typeBed = mysqli_real_escape_string($conn, $_POST['TypeBed']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    $wifi = isset($_POST['WiFi']) ? 1 : 0;
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

// Close connection
$conn->close();
?>
