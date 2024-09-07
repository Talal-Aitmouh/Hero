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
              <div class="card card-primary card-round">
                <div class="card-header">
                  <div class="card-head-row">
                    <div class="card-title">Service Amount</div>
                    <div class="card-tools">
                      <div class="dropdown">
                        <button class="btn btn-sm btn-label-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Export
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#">Action</a>
                          <a class="dropdown-item" href="#">Another action</a>
                          <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-category">March 25 - April 02</div>
                </div>
                <div class="card-body pb-0">
                  <div class="mb-4 mt-2">
                    <h1>$<?php echo $total_service_amount; ?></h1>
                  </div>
                  <div class="pull-in">
                    <canvas id="dailySalesChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="card card-round">
                <div class="card-body pb-0">
                  <div class="h1 fw-bold float-end text-primary">+5%</div>
                  <h2 class="mb-2">17</h2>
                  <p class="text-muted">Users online</p>
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

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">
                  ThemeKita
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Help </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Licenses </a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">ThemeKita</a>
          </div>
          <div>
            Distributed by
            <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
          </div>
        </div>
      </footer>
    </div>

  </div>
  <!--   Core JS Files   -->
  <?php include './links/script.php' ?>
 

  <script>
// Embed the PHP data into JavaScript variables
var days = <?php echo $days; ?>;
var bookingData = <?php echo $bookings; ?>;
var amountsData = <?php echo $amounts; ?>; // Embed the amounts data

// Create a Chart.js line chart with booking and amount data
var dailySalesChart = document.getElementById('dailySalesChart').getContext('2d');

var myDailySalesChart = new Chart(dailySalesChart, {
    type: 'line',
    data: {
        labels: days,  // Use the days array from PHP
        datasets: [{
            label: "Daily Bookings",
            fill: true,
            backgroundColor: "rgba(255,255,255,0.2)",
            borderColor: "#fff",
            data: bookingData  // Use the booking data array
        },
        {
            label: "Total Amount ($)",  // Second dataset for the amount
            fill: false,
            backgroundColor: "rgba(0, 255, 0, 0.3)",  // Light green background
            borderColor: "rgba(0, 255, 0, 1)",        // Green border
            data: amountsData  // Use the total amount data
        }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: true  // Display both the datasets in the legend
        },
        animation: {
            easing: "easeInOutBack"
        },
        scales: {
            yAxes: [{
                display: true,
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 10,
                    padding: 0
                },
                gridLines: {
                    drawTicks: false,
                    display: true
                }
            }],
            xAxes: [{
                display: true,
                gridLines: {
                    zeroLineColor: "transparent"
                },
                ticks: {
                    padding: -20,
                    fontColor: "rgba(255,255,255,0.2)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});
</script>
</body>

</html>