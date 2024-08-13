<?php
// Database connection (replace with your actual connection details)
include './config/db.php';

// Get the room ID from the URL
$room_id = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;

if ($room_id > 0) {
    // Fetch room details
    $query = "SELECT * FROM rooms WHERE RoomID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $room_id);
    $stmt->execute();
    $room_result = $stmt->get_result();
    $room = $room_result->fetch_assoc();

    // Fetch room images
    $query_images = "SELECT ImagePath FROM roomimages WHERE RoomID = ?";
    $stmt_images = $conn->prepare($query_images);
    $stmt_images->bind_param("i", $room_id);
    $stmt_images->execute();
    $images_result = $stmt_images->get_result();
    $images = $images_result->fetch_all(MYSQLI_ASSOC);
} else {
    echo "Invalid Room ID.";
    exit;
}
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

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__btn__widget">
            <a href="#">Book Now <span class="arrow_right"></span></a>
        </div>
        <div class="offcanvas__widget">
            <ul>
                <li><span class="icon_pin_alt"></span> 96 Ernser Vista Suite 437, NY, US</li>
                <li><span class="icon_phone"></span> (123) 456-78-910</li>
            </ul>
        </div>
        <div class="offcanvas__language">
            <img src="img/lan.png" alt="">
            <span>English</span>
            <i class="fa fa-angle-down"></i>
            <ul>
                <li>English</li>
                <li>Bangla</li>
            </ul>
        </div>
        <div class="offcanvas__auth">
            <ul>
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="header__top__widget">
                            <li><span class="icon_pin_alt"></span> 96 Ernser Vista Suite 437, NY, US</li>
                            <li><span class="icon_phone"></span> (123) 456-78-910</li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <div class="header__top__right">
                            <div class="header__top__auth">
                                <ul>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="#">Register</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__nav__option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="header__logo">
                            <a href="./index.php"><img src="img/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="header__nav">
                            <nav class="header__menu">
                                <ul class="menu__class">
                                    <li><a href="./index.php">Home</a></li>
                                    <li><a href="./rooms.php">Rooms</a></li>
                                    <li><a href="./about.php">About Us</a></li>
                                    <li class="active"><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="./about.php">About Us</a></li>
                                            <li><a href="./room-details.php">Room Details</a></li>
                                            <li><a href="./blog-details.php">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="./blog.php">News</a></li>
                                    <li><a href="./contact.php">Contact</a></li>
                                </ul>
                            </nav>
                            <div class="header__nav__widget">
                                <a href="#">Book Now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open">
                    <span class="fa fa-bars"></span>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Room Details Slider Begin -->
    <!-- Room Details Slider Begin -->
    <div class="room-details-slider">
        <div class="container">
            <div class="room__details__pic__slider owl-carousel">
                <div class="room__details__pic__slider__item set-bg" data-setbg="img/rooms/<?php echo $room['Image']; ?>"></div>

                <?php foreach ($images as $image): ?>
                    <div class="room__details__pic__slider__item set-bg" data-setbg="img/rooms/<?php echo $image['ImagePath']; ?>"></div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Room Details Slider End -->

    <!-- Rooms Details Section Begin -->
    <section class="room-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="room__details__content">
                        <div class="room__details__rating">
                            <div class="room__details__hotel">
                                <span>Hotel</span>
                                <div class="room__details__hotel__rating">
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star-half_alt"></span>
                                </div>
                            </div>
                            <div class="room__details__advisor">
                                <img src="img/rooms/details/tripadvisor.png" alt="">
                                <div class="room__details__advisor__rating">
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star"></span>
                                    <span class="icon_star-half_alt"></span>
                                </div>
                                <span class="review">(1000 Reviews)</span>
                            </div>
                        </div>
                        <div class="room__details__title">
                            <h2><?php echo $room['RoomName']; ?></h2>
                            <h3 class="ml-5 mt-3" >$ <span><?php echo $room['Price']; ?></span>  /day</h3>
                            <a href="#" class="primary-btn">Booking Now</a>
                        </div>
                        
                        <div class="room__details__desc">
                            <h2>Description:</h2>
                            <p><?php echo $room['Description']; ?></p>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="room__details__facilities">
                                    <h2>Others facilities:</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <ul>
                                                <li><span class="icon_check"></span> Takami Bridal Attire</li>
                                                <li><span class="icon_check"></span> Esthetic Salon</li>
                                                <li><span class="icon_check"></span> Multilingual staff</li>
                                                <li><span class="icon_check"></span> Dry cleaning and laundry</li>
                                                <li><span class="icon_check"></span> Credit cards accepted</li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6">
                                            <ul>
                                                <li><span class="icon_check"></span> Rent-a-car</li>
                                                <li><span class="icon_check"></span> Reservation & confirmation</li>
                                                <li><span class="icon_check"></span> Babysitter upon request</li>
                                                <li><span class="icon_check"></span> 24-hour currency exchange</li>
                                                <li><span class="icon_check"></span> 24-hour Manager on Duty</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="room__details__more__facilities">
                                    <h2>Most popular facilities:</h2>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?php if ($room['Climatiseur']) { ?>
                                                <div class="room__details__more__facilities__item">
                                                    <div class="icon"><img src="img/rooms/details/facilities/fac-1.png" alt="Air Conditioning"></div>
                                                    <h6>Air Conditioning</h6>
                                                </div>
                                            <?php } ?>
                                            <?php if ($room['TV']) { ?>
                                                <div class="room__details__more__facilities__item">
                                                    <div class="icon"><img src="img/rooms/details/facilities/fac-2.png" alt="Cable TV"></div>
                                                    <h6>Cable TV</h6>
                                                </div>
                                            <?php } ?>
                                            <?php if ($room['FreeDrink']) { ?>
                                                <div class="room__details__more__facilities__item">
                                                    <div class="icon"><img src="img/rooms/details/facilities/fac-3.png" alt="Free Drinks"></div>
                                                    <h6>Free Drinks</h6>
                                                </div>
                                            <?php } ?>
                                            <?php if ($room['Wifi']) { ?>
                                                <div class="room__details__more__facilities__item">
                                                    <div class="icon"><img src="img/rooms/details/facilities/fac-4.png" alt="Unlimited Wifi"></div>
                                                    <h6>Unlimited Wifi</h6>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-5.png" alt="Restaurant quality"></div>
                                                <h6>Restaurant quality</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-6.png" alt="Service 24/24"></div>
                                                <h6>Service 24/24</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-7.png" alt="Gym Centre"></div>
                                                <h6>Gym Centre</h6>
                                            </div>
                                            <div class="room__details__more__facilities__item">
                                                <div class="icon"><img src="img/rooms/details/facilities/fac-8.png" alt="Spa & Wellness"></div>
                                                <h6>Spa & Wellness</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Rooms Details Section End -->

    <!-- Rooms Details Section End -->

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