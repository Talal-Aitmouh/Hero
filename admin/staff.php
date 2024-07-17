<?php
include './traitement/staff.php'
?>

<!DOCTYPE html>
<html lang="en">
<?php include './links/links.php' ?>

<body>
    <div class="wrapper">
        <?php
        $current_page = 'staff';
        include './links/sidebare.php'; ?>
    </div>
    <!-- end sidebar -->
    <div class="main-panel">
        <?php include './links/customer.php' ?>
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Staff</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="#">
                                <i class="fas fas fa-users"></i>
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
                                <h4 class="card-title">Add Staff</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    Add Staff
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
                                                <span class="fw-light"> Staff </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="./traitement/staff.php" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Full Name</label>
                                                            <input id="addname" name="name" type="text" class="form-control" placeholder="fill name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Position</label>
                                                            <input id="addPosition" name="position" type="text" class="form-control" placeholder="fill position" />
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input id="addemail" name="email" type="email" class="form-control" placeholder="fill email" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Phone</label>
                                                            <input id="addphone" name="phone" type="number" class="form-control" placeholder="fill phone" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Password</label>
                                                            <input id="addpassword" name="password" type="text" class="form-control" placeholder="fill password" />
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="submit" name="addstaff" id="addRowButton" class="btn btn-primary">
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
                                            <th>Position</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($staffs as $staff) : ?>
                                            <tr>
                                                <td><?php echo $staff['FullName'] ?></td>
                                                <td><?php echo $staff['Email'] ?></td>
                                                <td><?php echo $staff['Phone'] ?></td>
                                                <td><?php echo $staff['Position'] ?></td>
                                                <td>
                                                    <form action="./traitement/staff.php" method="post">
                                                        <div class="form-button-action">
                                                            <button type="button" title="Edit" name="update" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#Editstaff" data-id2="<?php echo $staff['StaffID']; ?>" data-name2="<?php echo $staff['FullName'] ?>" data-email2="<?php echo $staff['Email'] ?>" data-phone2="<?php echo $staff['Phone'] ?>" data-password2="<?php echo $staff['Password'] ?>" data-position2="<?php echo $staff['Position'] ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button type="submit" class="btn btn-link btn-danger" name="delete" value="<?php echo $staff['StaffID']; ?>">
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

                            <div class="modal fade" id="Editstaff" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">Edit</span>
                                                <span class="fw-light"> Staff</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="./traitement/staff.php" method="post">
                                                <div class="row">
                                                    <input type="hidden" id="editstaffId" name="staffId" />
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Full Name</label>
                                                            <input id="editname" name="name" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Position</label>
                                                            <input id="editposition" name="position" type="text" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <input id="editemail" name="email" type="email" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Phone</label>
                                                            <input id="editphone" name="phone" type="number" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Password</label>
                                                            <input id="editpassword" name="password" type="text" class="form-control" />
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