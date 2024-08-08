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
                                                <td>
                                                    <form action="./traitement/booking.php" method="POST">
                                                        <div class="form-button-action">
                                                            <input type="hidden" name="bookingID" value="<?php echo htmlspecialchars($reservation['BookingID']); ?>">
                                                            <button class="btn btn-link btn-primary btn-lg" type="button" data-bs-toggle="modal" data-bs-target="#viewBooking"
        data-name="<?php echo htmlspecialchars($reservation['GuestName'], ENT_QUOTES, 'UTF-8'); ?>"
        data-phone="<?php echo htmlspecialchars($reservation['GuestPhone'], ENT_QUOTES, 'UTF-8'); ?>"
        data-nationality="<?php echo htmlspecialchars($reservation['GuestNationality'], ENT_QUOTES, 'UTF-8'); ?>"
        data-email="<?php echo htmlspecialchars($reservation['GuestEmail'], ENT_QUOTES, 'UTF-8'); ?>"
        data-passport-number="<?php echo htmlspecialchars($reservation['GuestPassportNumber'], ENT_QUOTES, 'UTF-8'); ?>"
        data-date-of-birth="<?php echo htmlspecialchars($reservation['GuestDateOfBirth'], ENT_QUOTES, 'UTF-8'); ?>"
        data-gender="<?php echo htmlspecialchars($reservation['GuestGender'], ENT_QUOTES, 'UTF-8'); ?>"
        data-address="<?php echo htmlspecialchars($reservation['GuestAddress'], ENT_QUOTES, 'UTF-8'); ?>"
        data-checkin-date="<?php echo htmlspecialchars($reservation['CheckInDate'], ENT_QUOTES, 'UTF-8'); ?>"
        data-checkout-date="<?php echo htmlspecialchars($reservation['CheckOutDate'], ENT_QUOTES, 'UTF-8'); ?>"
        data-room-name="<?php echo htmlspecialchars($reservation['RoomName'], ENT_QUOTES, 'UTF-8'); ?>"
        data-quantity="<?php echo htmlspecialchars($reservation['RoomQuantity'], ENT_QUOTES, 'UTF-8'); ?>"
        >

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
                                                                <option value="">Select Guest</option>
                                                                <?php while ($row = mysqli_fetch_assoc($resultGuests)) : ?>
                                                                    <option value="<?php echo $row['GuestID'] ?>"><?php echo $row['FullName'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-info mb-3" data-toggle="collapse" data-target="#guestInfo">New Guest</button>
                                                <div id="guestInfo" class="collapse">
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

                                                    </div>
                                                </div>
                                                <div class="row">
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
                                                                <option value="">Select Room</option>
                                                                <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
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
                                                                <?php while ($row = mysqli_fetch_assoc($resultServices2)) : ?>
                                                                    <option value="<?php echo $row['ServiceID']; ?>"><?php echo $row['ServiceName']; ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" name="add" class="btn btn-primary">Add</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end -->
                            <!--Edit Modal  -->
                            <div class="modal fade" id="viewBooking" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> View </span>
                                                <span class="fw-light"> Booking </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <p id="viewName">John Doe</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <p id="viewPhone">+1234567890</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Nationality</label>
                                                        <p id="viewNationality">American</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <p id="viewEmail">john.doe@example.com</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Passport Number</label>
                                                        <p id="viewPassportNumber">A1234567</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <p id="viewDateOfBirth">1985-07-20</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Gender</label>
                                                        <p id="viewGender">Male</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <p id="viewAddress">123 Main St, Anytown, USA</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Check-In Date</label>
                                                        <p id="viewCheckInDate">2024-08-01</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Check-Out Date</label>
                                                        <p id="viewCheckOutDate">2024-08-05</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Selected Rooms</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Room</label>
                                                        <p id="viewRoom">Deluxe Suite</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Quantity</label>
                                                        <p id="viewQuantity">1</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Selected Services</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Services</label>
                                                        <p id="viewServices">Spa, Breakfast</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
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