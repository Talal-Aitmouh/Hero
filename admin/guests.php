<?php
include './traitement/guests.php'
?>

<!DOCTYPE html>
<html lang="en">
<?php include './links/links.php' ?>

<body>
    <div class="wrapper">
        <?php
        $current_page = 'guests';
        include './links/sidebare.php'; ?>
    </div>
    <!-- end sidebar -->
    <div class="main-panel">
        <?php include './links/customer.php' ?>
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Guests</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="#">
                                <i class="fas fa-user"></i>
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
                                <h4 class="card-title">Add a Customer</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add a Customer
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">New</span>
                                                <span class="fw-light">Guest</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./traitement/guests.php" method="post">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Name</label>
                                                            <input name="name" id="addName" type="text" class="form-control" placeholder="Enter name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Phone</label>
                                                            <input name="phone" id="addPhone" type="text" class="form-control" placeholder="Enter phone number" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Nationality</label>
                                                            <input name="nationality" id="addNationality" type="text" class="form-control" placeholder="Enter nationality" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input name="email" id="addEmail" type="email" class="form-control" placeholder="Enter email" required />
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
                                                            <input name="address" id="addAddress" type="text" class="form-control" placeholder="Enter address" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="addRowButton" name="add" class="btn btn-primary">
                                                        Add
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                        Close
                                                    </button>
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
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>CheckInDate</th>
                                            <th>CheckOutDate</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($guests as $guest) : ?>
                                            <tr>
                                                <td><?php echo $guest['FullName'] ?></td>
                                                <td><?php echo $guest['Email'] ?> </td>
                                                <td><?php echo $guest['Phone'] ?></td>
                                                <td><?php echo $guest['CHECKINDATE'] ?></td>
                                                <td><?php echo $guest['CHECKOUTDATE'] ?></td>
                                                <td>
                                                    <form action="./traitement/guests.php" method="post">
                                                        <input type="hidden" name="guestid" value="<?php echo $guest['GuestID']; ?>" />
                                                        <div class="form-button-action">
                                                            <button type="button" title="Edit" name="update" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#Editguests" data-id="<?php echo $guest['GuestID']; ?>" data-name="<?php echo $guest['FullName']; ?>" data-email="<?php echo $guest['Email']; ?>" data-phone="<?php echo $guest['Phone']; ?>" data-address="<?php echo $guest['Address']; ?>" data-nationality="<?php echo $guest['Nationality']; ?>" data-passport="<?php echo $guest['PassportNumber']; ?>" data-dateofbirth="<?php echo $guest['DateOfBirth']; ?>" data-gender="<?php echo $guest['Gender']; ?>">

                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="submit" name="delete" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
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
                            <div class="modal fade" id="Editguests" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">Edit</span>
                                                <span class="fw-light">Guest</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./traitement/guests.php" method="post">
                                                <div class="row">
                                                    <input type="hidden" id="editguestId" name="guestid" />

                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Name</label>
                                                            <input name="name" id="editName" type="text" class="form-control" placeholder="Enter name" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Phone</label>
                                                            <input name="phone" id="editPhone" type="text" class="form-control" placeholder="Enter phone number" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Nationality</label>
                                                            <input name="nationality" id="editNationality" type="text" class="form-control" placeholder="Enter nationality" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input name="email" id="editEmail" type="email" class="form-control" placeholder="Enter email" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Passport Number</label>
                                                            <input name="passport_number" id="editPassportNumber" type="text" class="form-control" placeholder="Enter passport number" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Date of Birth</label>
                                                            <input name="date_of_birth" id="editDateOfBirth" type="date" class="form-control" placeholder="Enter date of birth" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group form-group-default">
                                                            <label>Gender</label>
                                                            <select name="gender" id="editGender" class="form-control" required>
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
                                                            <input name="address" id="editAddress" type="text" class="form-control" placeholder="Enter address" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
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