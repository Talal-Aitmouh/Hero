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
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> New</span>
                                                <span class="fw-light"> Row </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="small">
                                                Create a new row using this form, make sure you fill
                                                them all
                                            </p>
                                            <form action="./traitement/booking.php" method="POST">
                                                <h4>Guest Info</h4>
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
                                                            <select name="services[]" class="form-select" multiple id="exampleFormControlSelect2" aria-label="Default select example">
                                                                <?php while ($row = mysqli_fetch_assoc($resultServices)) : ?>
                                                                    <option value="<?php echo $row['ServiceID']; ?>"><?php echo $row['Name']; ?></option>
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
                                                <td><?php echo $reservation['RoomName']; ?></td>
                                                <td><?php echo $reservation['GuestName']; ?></td>
                                                <td><?php echo $reservation['CheckInDate']; ?> --> <?php echo $reservation['CheckOutDate']; ?></td>
                                                <td><?php echo $reservation['Status']; ?></td>
                                                <td><?php echo $reservation['TotalAmount']; ?></td>
                                                <td>
                                                    <form action="">
                                                        <div class="form-button-action">
                                                            <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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