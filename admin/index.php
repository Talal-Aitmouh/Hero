<?php
include './traitement/dashboard.php';
// session_start();

// if (!isset($_SESSION['StaffID'])) {
//     header("Location: login/index.php");
//     exit();
// }


// $fullName = $_SESSION['FullName'];
// $email = $_SESSION['Email'];
// $position = $_SESSION['Position'];


?>

<!DOCTYPE html>
<html lang="en">
<?php include './links/links.php'; ?>

<body>
  <div class="wrapper">
    <!-- Sidebar -->

    <?php
    $current_page = 'index';
    include './links/sidebare.php'; ?>
  </div>
  <!-- End Sidebar -->

  <div class="main-panel">
    <?php include './links/customer.php' ?>

    <div class="container">
      <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
          <div>
            <h3 class="fw-bold mb-3">Dashboard</h3>
          </div>
          <div class="ms-md-auto py-2 py-md-0">
            <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
            <a href="#" class="btn btn-primary btn-round">Add Customer</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-icon">
                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                      <i class="fas fa-users"></i>
                    </div>
                  </div>
                  <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                      <p class="card-category">Guests</p>
                      <h4 class="card-title"><?php echo $num_guests ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-icon">
                    <div class="icon-big text-center icon-info bubble-shadow-small">
                      <i class="fas fa-star"></i>

                    </div>
                  </div>
                  <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                      <p class="card-category">Ratting</p>
                      <h4 class="card-title"><?php echo $average_rating; ?>%</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-icon">
                    <div class="icon-big text-center icon-success bubble-shadow-small">
                      <i class="fas fa-money-check-alt"></i>
                    </div>
                  </div>
                  <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                      <p class="card-category">Total amount</p>
                      <h4 class="card-title">$ <?php echo $total_amount; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-icon">
                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                      <i class="far fas fa-calendar"></i>
                    </div>
                  </div>
                  <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                      <p class="card-category">Booking</p>
                      <h4 class="card-title"><?php echo $num_bookings; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row">
                  <div class="card-title">Booking Statistics</div>
                  <div class="card-tools">
                    <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
                      <span class="btn-label">
                        <i class="fa fa-pencil"></i>
                      </span>
                      Export
                    </a>
                    <a href="#" class="btn btn-label-info btn-round btn-sm">
                      <span class="btn-label">
                        <i class="fa fa-print"></i>
                      </span>
                      Print
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-container" style="min-height: 375px">
                  <canvas id="statisticsChart"></canvas>
                </div>
                <div id="myChartLegend"></div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-gray card-round">
              <div class="card-header">
                <div class="card-head-row">
                  <div class="card-title">Total Rooms Disponibles</div>
                  <div class="card-tools ">
                    <div class="dropdown bg-primary">
                      <button class="btn btn-primary btn-sm btn-label-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Export
                      </button>
                      <div class="dropdown-menu bg-primary" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item text-light" href="#">Action</a>
                        <a class="dropdown-item text-light" href="#">Another action</a>
                        <a class="dropdown-item text-light" href="#">Something else here</a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-body pb-0 ">
                <div class="mb-4 mt-2">
                  <h1><?php echo $totalRooms; ?> rooms</h1>
                </div>
                <div class="pull-in ">
                  <canvas id="dailySalesChart"></canvas>
                </div>
              </div>
            </div>
            <div class="card card-round">
              <div class="card-body pb-0">
                <h2 class="mb-2"><?php echo $totalGuests; ?> Guest</h2>
                <p class="text-muted">New Guests</p>
                <div class="pull-in sparkline-fix">
                  <div id="lineChart"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-md-12">
            <div class="card card-round">
              <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Transaction History</div>
                  <div class="card-tools">
                    <div class="dropdown">
                      <button class="btn btn-icon btn-clean me-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <!-- Projects table -->
                  <table class="table align-items-center mb-0">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Payment Num</th>
                        <th scope="col" class="text-start">Date</th>
                        <th scope="col" class="text-end">Amount</th>
                        <th scope="col" class="text-end">Guest Name</th>
                        <th scope="col" class="text-end">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php while ($row = $resultTransactions->fetch_assoc()) : ?>
                        <tr>
                          <th scope="row">
                            # <?php echo $row['TransactionID']; ?>
                          </th>
                          <td class="text-start"><?php echo $row['TransactionDate']; ?></td>
                          <td class="text-end">$<?php echo $row['Amount']; ?></td>
                          <td class="text-end"><?php echo $row['GuestName']; ?></td>
                          <td class="text-end"><?php echo $row['TransactionStatus']; ?></td>
                        </tr>
                      <?php endwhile; ?>

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

  </div>
 
  <?php include './links/script.php' ?>





</body>

</html>