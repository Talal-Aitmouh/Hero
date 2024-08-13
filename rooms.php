<?php
include './config/db.php'


?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include './links/head.php'; ?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>



    <!-- Header Section Begin -->
    <?php
    $current_page = 'room';
    include './links/header.php';
    ?>
    <!-- Header Section End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h1>Our Room</h1>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Rooms</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Rooms Section Begin -->
    <section class="rooms spad">
        <div class="container">
            <?php
            // Fetch all rooms with their principal image
            $sql = "SELECT * FROM rooms";
            $res = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($res)) {
                $roomId = $row['RoomID'];

                // Fetch additional images for the current room
                $imgSql = "SELECT ImagePath FROM roomimages WHERE RoomID = $roomId";
                $imgRes = mysqli_query($conn, $imgSql);
            ?>
                <div class="row">
                    <div class="col-lg-6 p-0 order-lg-2 order-md-2 col-md-6">
                        <div class="room__pic__slider owl-carousel">
                            <?php
                            // Display the principal image first
                            echo '<div class="room__pic__item set-bg" data-setbg="img/rooms/' . $row['Image'] . '"></div>';

                            // Display additional images
                            while ($imgRow = mysqli_fetch_assoc($imgRes)) {
                                echo '<div class="room__pic__item set-bg" data-setbg="img/rooms/' . $imgRow['ImagePath'] . '"></div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-lg-6 p-0 order-lg-1 order-md-1 col-md-6">
                        <div class="room__text">
                            <h3><?php echo $row['RoomName']; ?></h3>
                            <h2><sup>$</sup><?php echo $row['Price']; ?><span>/day</span></h2>
                            <ul>
                                <li><span>Type:</span><?php echo $row['Type']; ?></li>
                                <li><span>Capacity:</span><?php echo $row['Capacity']; ?></li>
                                <li><span>Bed:</span><?php echo $row['TypeBed']; ?></li>
                                <li><span>Services:</span>
                                    <?php
                                    $services = [];
                                    if ($row['Wifi']) $services[] = 'Wifi';
                                    if ($row['TV']) $services[] = 'Television';
                                    if ($row['Climatiseur']) $services[] = 'Climatiseur';
                                    if ($row['FreeDrink']) $services[] = 'Free Drink';
                                    echo implode(', ', $services);
                                    ?>
                                </li>
                                <li><span>Description:</span><?php echo $row['Description']; ?></li>
                            </ul>
                            <a href="room-details.php?room_id=<?php echo $row['RoomID']; ?>">View Details</a>
                        </div>
                    </div>

                </div>
            <?php } ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination__number">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">Next <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- Rooms Section End -->

    <!-- Footer Section Begin -->
    <?php

    include './links/footer.php';
    ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>