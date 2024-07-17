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
                                                <span class="fw-mediumbold"> New</span>
                                                <span class="fw-light"> Guest </span>
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


                                                    <div class="modal-footer border-0">
                                                        <button type="submit" id="addRowButton" name="add" class="btn btn-primary">
                                                            Add
                                                        </button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
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
                                                <td><?php echo $guest['Name'] ?></td>
                                                <td><?php echo $guest['Email'] ?> </td>
                                                <td><?php echo $guest['Phone'] ?></td>
                                                <td><?php echo $guest['CheckInDate'] ?></td>
                                                <td><?php echo $guest['CheckOutDate'] ?></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Remove">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
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