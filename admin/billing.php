<?php
include './traitement/billing.php'
?>

<!DOCTYPE html>
<html lang="en">
<?php include './links/links.php' ?>

<body>
    <div class="wrapper">
        <?php
        $current_page = 'Billing';
        include './links/sidebare.php'; ?>
    </div>
    <div class="main-panel">
        <?php include './links/customer.php'; ?>

        <div class="container">
            <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
                <!-- Navbar -->
                <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
                    <div class="container-fluid py-1 px-3">


                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-md-7 mt-4">
                            <div class="card">
                                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">Guest</span>
                                                    <span class="fw-light"> Details & Transaction</span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Guest and Billing Information -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Full Name</label>
                                                            <p id="guestName" class="form-control-plaintext">John Doe</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Email</label>
                                                            <p id="guestEmail" class="form-control-plaintext">johndoe@example.com</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Billing Status</label>
                                                            <p id="billingStatus" class="form-control-plaintext">Paid</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group form-group-default">
                                                            <label>Amount</label>
                                                            <p id="billingAmount" class="form-control-plaintext">$500.00</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Billing Date</label>
                                                            <p id="billingDate" class="form-control-plaintext">2024-08-10</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Transaction Form -->
                                                <form action="./traitement/billing.php" method="POST">
                                                    <input type="hidden" name="BillingID" value="">
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Amount</label>
                                                                <input type="number" step="0.01" id="transactionAmount" name="Amount" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Payment Method</label>
                                                                <select id="paymentMethod" name="PaymentMethod" class="form-control" required>
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Mastercard">Mastercard</option>
                                                                    <option value="Visa">Visa</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Transaction Status</label>
                                                                <select id="transactionStatus" name="TransactionStatus" class="form-control" required>
                                                                    <option value="Pending">Pending</option>
                                                                    <option value="Paid">Paid</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                            Close
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">Billing Information</h6>
                                </div>
                                <div class="card-body pt-4 p-3">
    <ul class="list-group">
        <?php foreach ($billings as $billing) : ?>
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm"><?php echo $billing['FullName'] ?></h6>
                    <span class="mb-2 text-xs">Email: <span class="text-dark font-weight-bold ms-sm-2"><?php echo $billing['Email'] ?></span></span>
                    <span class="mb-2 text-xs">Payment Status: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $billing['PaymentStatus'] ?></span></span>
                    <span class="text-xs">Amount: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $billing['Amount'] ?></span></span>
                    <span class="text-xs">Date: <span class="text-dark ms-sm-2 font-weight-bold"><?php echo $billing['BillingDate'] ?></span></span>
                </div>
                <div class="ms-auto text-end">
                    <!-- Delete Button Form -->
                    <form action="./traitement/billing.php" method="POST" style="display:inline-block;">
                        <input type="hidden" name="delete" value="<?php echo $billing['BillingID']; ?>">
                        <button class="btn btn-link text-danger text-gradient px-3 mb-0" type="submit" onclick="return confirm('Are you sure you want to delete this billing?');">
                            <i class="far fa-trash-alt me-2"></i>Delete
                        </button>
                    </form>

                    <!-- Edit Button -->
                    <a class="btn btn-link text-dark px-3 mb-0 <?php echo ($billing['PaymentStatus'] === 'Paid') ? 'disabled' : '' ?>" 
                       href="" 
                       data-bs-toggle="modal" 
                       data-bs-target="#addRowModal" 
                       data-id="<?php echo $billing['BillingID'] ?>" 
                       data-name="<?php echo $billing['FullName'] ?>" 
                       data-email="<?php echo $billing['Email'] ?>" 
                       data-status="<?php echo $billing['PaymentStatus'] ?>" 
                       data-amount="<?php echo $billing['Amount'] ?>" 
                       data-date="<?php echo $billing['BillingDate'] ?>">
                        <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>



                            </div>
                        </div>
                        <div class="col-md-5 mt-4">
                            <div class="card h-100 mb-4">
                                <div class="card-header pb-0 px-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-0">Your Transaction's</h6>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                                            <i class="far fa-calendar-alt me-2"></i>
                                            <small>23 - 30 March 2020</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-4 p-3">
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
                                    <ul class="list-group">

                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">Apple</h6>
                                                    <span class="text-xs">27 March 2020, at 04:30 AM</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                                + $ 2,000
                                            </div>
                                        </li>
                                    </ul>
                                    <h6 class="text-uppercase text-body text-xs font-weight-bolder my-3">Yesterday</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></button>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-1 text-dark text-sm">Stripe</h6>
                                                    <span class="text-xs">26 March 2020, at 13:45 PM</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold">
                                                + $ 750
                                            </div>
                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <h6 class="mb-0">Invoices</h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <button class="btn btn-outline-primary btn-sm mb-0">View All</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3 pb-0">
                                    <ul class="list-group">
                                        <?php
                                        // Initialize an array to hold the totals for each date
                                        $dateTotals = [];

                                        // Calculate the total amount for each billing date
                                        foreach ($billings as $billing) {
                                            $date = $billing["BillingDate"];
                                            if (!isset($dateTotals[$date])) {
                                                $dateTotals[$date] = 0;
                                            }
                                            $dateTotals[$date] += $billing["Amount"];
                                        }

                                        // Display the totals for each date
                                        foreach ($dateTotals as $date => $total) :
                                        ?>
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-dark mb-1 font-weight-bold text-sm">Billing Date: <?php echo $date; ?></h6>
                                                </div>
                                                <div class="d-flex align-items-center text-sm">
                                                    Total Amount: $<?php echo number_format($total, 2); ?>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>


                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </main>
        </div>

    </div>
    </div>
    <?php include './links/script.php' ?>
</body>

</html>