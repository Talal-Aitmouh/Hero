<?php
include './traitement/room.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['RoomID'])) {
    $roomID = $_POST['RoomID'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Heroku";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete room images first
    $sql_select_images = "SELECT ImageURL FROM RoomImages WHERE RoomID=?";
    $stmt_select_images = $conn->prepare($sql_select_images);
    if ($stmt_select_images) {
        $stmt_select_images->bind_param("i", $roomID);
        $stmt_select_images->execute();
        $result_images = $stmt_select_images->get_result();

        while ($row = $result_images->fetch_assoc()) {
            $imageURL = $row['ImageURL'];
            $image_path = '../../img/rooms/' . $imageURL;
            if (file_exists($image_path)) {
                unlink($image_path); // Delete image file from server
            }
        }

        $stmt_select_images->close();

        // Delete room images records from RoomImages table
        $sql_delete_images = "DELETE FROM RoomImages WHERE RoomID=?";
        $stmt_delete_images = $conn->prepare($sql_delete_images);
        if ($stmt_delete_images) {
            $stmt_delete_images->bind_param("i", $roomID);
            $stmt_delete_images->execute();
            $stmt_delete_images->close();

            // Delete room record from Rooms table
            $sql_delete_room = "DELETE FROM Rooms WHERE RoomID=?";
            $stmt_delete_room = $conn->prepare($sql_delete_room);
            if ($stmt_delete_room) {
                $stmt_delete_room->bind_param("i", $roomID);
                $stmt_delete_room->execute();
                $stmt_delete_room->close();

                // Success message (optional, no output as per your request)
            } else {
                // Error preparing statement to delete room
            }
        } else {
            // Error preparing statement to delete room images
        }
    } else {
        // Error preparing statement to select room images
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include './links/links.php' ?>

<body>
    <div class="wrapper">
    <?php
      $current_page = 'room';
      include './links/sidebare.php'; ?>
    </div>
        <!-- end sidebar -->
        <div class="main-panel">
            <?php include './links/customer.php' ?>
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Rooms</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="fas fas fa-bed"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">All Room</h4>
                                    <!-- <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Add Room
                                    </button> -->
                                    <button type="button" class="btn btn-primary btn-round ms-auto" onclick="openModal()">Add Room</button>

                                </div>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>

                                                <th colspan="2" class="text-center">Name</th>
                                                <th>Capacity</th>
                                                <th>Type</th>
                                                <th>Price</th>
                                                <th style="width: 10%" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rooms as $room) : ?>
                                                <tr>
                                                    <td><img src="../img/rooms/<?php echo $room['Photo']; ?>" alt="Photo" width="100" height="50"></td>
                                                    <td><?php echo $room['RoomName']; ?></td>
                                                    <td><?php echo $room['Capacity']; ?></td>
                                                    <td><?php echo $room['Type']; ?></td>
                                                    <td>$ <?php echo number_format($room['Price'], 2); ?></td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <button type="button" data-bs-toggle="tooltip" title="Edit Task" class="btn btn-link btn-primary btn-lg" onclick="openEditRoomModal('<?php echo $room['RoomID']; ?>', '<?php echo $room['RoomName']; ?>', '<?php echo $room['Photo']; ?>', '<?php echo $room['Type']; ?>', '<?php echo $room['Capacity']; ?>', '<?php echo $room['Price']; ?>', '<?php echo $room['Description']; ?>', '<?php echo $room['NumberBed']; ?>', '<?php echo $room['BedType']; ?>')">
                                                                <i class="fa fa-edit"></i>
                                                            </button>

                                                            <button type="button" class="btn btn-link btn-primary" onclick="openModal2('<?php echo $room['Photo']; ?>', 
                               '<?php echo $room['RoomName']; ?>', 
                               '<?php echo $room['Type']; ?>', 
                               '<?php echo $room['Capacity']; ?>', 
                               '<?php echo $room['Price']; ?>', 
                               '<?php echo $room['Description']; ?>', 
                               '<?php echo $room['NumberBed']; ?>', 
                               '<?php echo $room['BedType']; ?>',
                               '<?php echo $room['quantity']; ?>')">
                                                                <i class="fas fa-eye"></i>
                                                            </button>


                                                            <form method="POST" action="" style="display:inline;">
                                                                <input type="hidden" name="RoomID" value="<?php echo $room['RoomID']; ?>">
                                                                <button type="submit" data-bs-toggle="tooltip" name="RoomID" value="<?php echo $room['RoomID']; ?>" title="" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Are you sure you want to delete this room?');">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Modal for adding a room -->
                                <div id="addRoomModal" class="modal" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content  ">
                                            <div class="modal-header border-0 ">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold"> New</span>
                                                    <span class="fw-light"> Room </span>
                                                </h5>
                                                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="addRoomForm" action="./traitement/addroom.php" method="POST" enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="addName" name="Name" type="text" class="form-control" placeholder="Name" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Image</label>
                                                                <input id="addPhoto" name="Photo" type="file" class="form-control" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Type</label>
                                                                <input id="addType" name="Type" type="text" class="form-control" placeholder="Type" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Capacity</label>
                                                                <input id="addCapacity" name="Capacity" type="number" class="form-control" placeholder="Capacity" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Price</label>
                                                                <input id="addPrice" name="Price" type="text" class="form-control" placeholder="Price" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Description</label>
                                                                <input id="addDescription" name="Description" type="text" class="form-control" placeholder="Description" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Number Bed</label>
                                                                <input id="addNumberBed" name="NumberBed" type="number" class="form-control" placeholder="Number Bed" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Type Bed</label>
                                                                <input id="addBedType" name="BedType" type="text" class="form-control" placeholder="Type Bed" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Quantity</label>
                                                                <input id="addBedType" name="quantity" type="number" class="form-control" placeholder="Quantity" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="otherPics" name="OtherPics[]" type="file" class="form-control" multiple />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="otherPics" name="OtherPics[]" type="file" class="form-control" multiple />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="otherPics" name="OtherPics[]" type="file" class="form-control" multiple />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="otherPics" name="OtherPics[]" type="file" class="form-control" multiple />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-danger" onclick="closeModal()">Close</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                                <div id="show" class="modal" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">Room</h5>
                                                <button type="button" class="close" onclick="closeModal2()" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body room-info">
                                                <img id="roomImage" src="" alt="Room Image" class="image-fluid w-25">
                                                <ul class="list-group">
                                                    <li class="list-group-item"><strong>Name:  </strong> <span id="roomName"></span></li>
                                                    <li class="list-group-item"><strong>Type:  </strong> <span id="roomType"></span></li>
                                                    <li class="list-group-item"><strong>Capacity:  </strong> <span id="roomCapacity"></span></li>
                                                    <li class="list-group-item"><strong>Price:  </strong> <span id="roomPrice"></span></li>
                                                    <li class="list-group-item"><strong>Description:  </strong> <span id="roomDescription"></span></li>
                                                    <li class="list-group-item"><strong>Number Bed:  </strong> <span id="roomNumberBed"></span></li>
                                                    <li class="list-group-item"><strong>Type Bed:  </strong> <span id="roomBedType"></span></li>
                                                    <li class="list-group-item"><strong>Quantity:  </strong> <span id="roomquantity"></span></li>
                                                </ul>
                                                <button type="button" class="btn btn-danger mt-3" onclick="closeModal2()">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end -->
                                <div id="edit" class="modal" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">Edit</span>
                                                    <span class="fw-light">Room</span>
                                                </h5>
                                                <button type="button" class="close" onclick="closeEditModal()" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Edit the room details using this form, make sure you fill them all</p>
                                                <form id="editRoomForm" action="./traitement/editroom.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" id="editRoomID" name="RoomID">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="editName" name="Name" type="text" class="form-control" placeholder="Name" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Image</label>
                                                                <input id="editPhoto" name="Photo" type="file" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Type</label>
                                                                <input id="editType" name="Type" type="text" class="form-control" placeholder="Type" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Capacity</label>
                                                                <input id="editCapacity" name="Capacity" type="number" class="form-control" placeholder="Capacity" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Price</label>
                                                                <input id="editPrice" name="Price" type="text" class="form-control" placeholder="Price" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Description</label>
                                                                <input id="editDescription" name="Description" type="text" class="form-control" placeholder="Description" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Number Bed</label>
                                                                <input id="editNumberBed" name="NumberBed" type="number" class="form-control" placeholder="Number Bed" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Type Bed</label>
                                                                <input id="editBedType" name="BedType" type="text" class="form-control" placeholder="Type Bed" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Quantity</label>
                                                                <input id="editquantity" name="quantity" type="number" class="form-control" placeholder="Quantity" required />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="editPhoto" name="OtherPics[]" type="file" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="editPhoto" name="OtherPics[]" type="file" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="editPhoto" name="OtherPics[]" type="file" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group form-group-default">
                                                                <label>Other Pic</label>
                                                                <input id="editPhoto" name="OtherPics[]" type="file" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                                                    <button type="button" class="btn btn-danger" onclick="closeEditModal()">Close</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end -->
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <?php include './links/script.php' ?>
</body>

</html>