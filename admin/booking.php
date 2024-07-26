<?php
include './traitement/booking.php'
?>

<!DOCTYPE html>
<html lang="en">
<?php include './links/links.php' ?>

<body>
    <div class="wrapper">
        <?php
        $current_page = 'booking';
        include './links/sidebare.php'; ?>
    </div>
    <!-- end sidebar -->
    <div class="main-panel">
        <?php include './links/customer.php' ?>
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Booking</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="#">
                                <i class="fas fas fa-calendar"></i>
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
                                <h4 class="card-title">Add a reservation</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add a reservation
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->


                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name Room</th>
                                            <th>Guest</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Total Amount</th>
                                            <th>Services</th> <!-- New column for Services -->
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservations as $reservation) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($reservation['RoomName']); ?></td>
                                                <td><?php echo htmlspecialchars($reservation['GuestName']); ?></td>
                                                <td><?php echo htmlspecialchars($reservation['CheckInDate']); ?> --> <?php echo htmlspecialchars($reservation['CheckOutDate']); ?></td>
                                                <td><?php echo htmlspecialchars($reservation['Status']); ?></td>
                                                <td><?php echo htmlspecialchars($reservation['TotalAmount']); ?></td>
                                                <td><?php echo htmlspecialchars($reservation['Services']); ?></td> <!-- Display Services -->
                                                <td>
                                                    <form action="./traitement/booking.php" method="POST">
                                                        <div class="form-button-action">
                                                            <input type="hidden" name="bookingID" value="<?php echo htmlspecialchars($reservation['BookingID']); ?>">
                                                            <button class="btn btn-link btn-primary btn-lg" type="button" data-bs-toggle="modal" name="edit" data-bs-target="#edit">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="submit" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" name="delete" data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> New</span>
                                                <span class="fw-light"> Reservation </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="./traitement/booking.php" method="POST">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Select Guest</label>
                                                            <select name="guest" id="addguest" class="form-control">
                                                                <?php while ($row = mysqli_fetch_assoc($resultGuests)) : ?>
                                                                    <option value="<?php echo $row['GuestID'] ?>"><?php echo $row['FullName'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4>New Guest</h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Name</label>
                                                            <input name="name" id="addName" type="text" class="form-control" placeholder="Enter name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Phone</label>
                                                            <input name="phone" id="addPhone" type="text" class="form-control" placeholder="Enter phone number" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Nationality</label>
                                                            <input name="nationality" id="addNationality" type="text" class="form-control" placeholder="Enter nationality" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input name="email" id="addEmail" type="email" class="form-control" placeholder="Enter email" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Passport Number</label>
                                                            <input name="passport_number" id="addPassportNumber" type="text" class="form-control" placeholder="Enter passport number" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Date of Birth</label>
                                                            <input name="date_of_birth" id="addDateOfBirth" type="date" class="form-control" placeholder="Enter date of birth" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Gender</label>
                                                            <select name="gender" id="addGender" class="form-control" required>
                                                                <option value="">Select gender</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Address</label>
                                                            <input name="address" id="addAddress2" type="text" class="form-control" placeholder="Enter address" />
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Check-In Date</label>
                                                            <input name="checkInDate" id="addCheckInDate" type="date" class="form-control" placeholder="Select check-in date" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Check-Out Date</label>
                                                            <input name="checkOutDate" id="addCheckOutDate" type="date" class="form-control" placeholder="Select check-out date" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4>Select Rooms</h4>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Rooms</label>
                                                            <select name="roomID" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                                                <option selected disabled>Open this select menu</option>
                                                                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                                    <option value="<?php echo $row['RoomID']; ?>"><?php echo $row['RoomName']; ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Quantity</label>
                                                            <input name="quantity" class="form-control" type="number" id="html5-number-input" min="1" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <h4>Add service</h4>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Service</label>
                                                            <select name="services[]" class="form-select">
                                                                <option value="">Select services</option>
                                                                <?php while ($row = mysqli_fetch_assoc($resultServices)) : ?>
                                                                    <option value="<?php echo $row['ServiceID']; ?>"><?php echo $row['ServiceName']; ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end -->
                            <!--Edit Modal  -->
                            <?php foreach ($reservations as $reservation) : ?>
                                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold"> Update</span>
                                                    <span class="fw-light"> Reservation </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <form action="./traitement/booking.php" method="POST">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Name Guest</label>
                                                                <input name="name" value="<?php echo $reservation['GuestName']; ?>" id="addName" type="text" class="form-control" placeholder="Enter name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Room</label>
                                                                <input name="phone" id="addPhone" type="text" value="<?php echo $reservation['RoomName']; ?>" class="form-control" placeholder="Enter phone number" />

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Total Amount</label>
                                                                <input name="nationality" value="<?php echo $reservation['TotalAmount']; ?>" id="addNationality" type="text" class="form-control" placeholder="Enter nationality" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Status</label>
                                                                <input name="email" value="<?php echo $reservation['Status']; ?>" id="addEmail" type="email" class="form-control" placeholder="Enter email" />
                                                            </div>
                                                        </div>




                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Check-In Date</label>
                                                                <input name="checkInDate" value="<?php echo $reservation['CheckInDate']; ?>" id="addCheckInDate" type="date" class="form-control" placeholder="Select check-in date" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group form-group-default">
                                                                <label>Check-Out Date</label>
                                                                <input name="checkOutDate" value="<?php echo $reservation['CheckOutDate']; ?>" id="addCheckOutDate" type="date" class="form-control" placeholder="Select check-out date" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h4>Select Rooms</h4>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Rooms</label>
                                                                <select name="roomID" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                                                    <option selected disabled>Open this select menu</option>
                                                                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                                                        <option value="<?php echo $row['RoomID']; ?>"><?php echo $row['RoomName']; ?></option>
                                                                    <?php endwhile; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Quantity</label>
                                                                <input name="quantity" class="form-control" type="number" id="html5-number-input" min="1" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h4>Add service</h4>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Service</label>
                                                                <select name="services[]" class="form-select" multiple id="exampleFormControlSelect2" aria-label="Default select example">
                                                                    <?php while ($row = mysqli_fetch_assoc($resultServices)) : ?>
                                                                        <option value="<?php echo $row['ServiceID']; ?>"><?php echo $row['Name']; ?></option>
                                                                    <?php endwhile; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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