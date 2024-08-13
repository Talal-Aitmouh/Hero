<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include './links/head.php'; ?>
</head>

<body>
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

                        </div>
                    </div>
                </div>
                <div class="canvas__open">
                    <span class="fa fa-bars"></span>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Booking</h2>
                    </div>
                    <div class="card-body">
                        <form action="#">
                            <div class="row pb-3 mb-5 border-bottom">
                                <div class="col-md-6 mb-3">
                                    <label for="">Checkin Date</label>
                                    <input type="date" id="checkin" name="checkin" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Checkout Date</label>
                                    <input type="date" id="checkin" name="checkin" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Number of guest</label>
                                    <input type="number" id="checkin" name="checkin" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Nationality</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter your username" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Enter your number" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Passport Number / CIN</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirmPassword" class="form-label">Date of Birth</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="confirmPassword" class="form-label">Adress</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm your password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Service?</label>
                                    <select class="form-select" id="service" name="service">
                                        <option value="">Picine</option>
                                        <option value="">Dinner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="gender" id="male" required>
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="gender" id="female" required>
                                    <label for="female" class="form-check-label">Female</label>
                                </div>

                            </div>

                            <div class="text-center  ">
                                <button type="submit">Book Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <?php

    include './links/footer.php';
    ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>