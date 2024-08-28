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
                                    <li><a href="../admin/login/index.php">Login</a></li>
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
                                    <li class="<?php echo ($current_page == 'index') ? 'active' : ''; ?>"><a href="./index.php">Home</a></li>
                                    <li class="<?php echo ($current_page == 'room') ? 'active' : ''; ?>"><a href="./rooms.php">Rooms</a></li>
                                    <li class="<?php echo ($current_page == 'about') ? 'active' : ''; ?>" ><a href="./about.php">About Us</a></li>
                                    <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li class="<?php echo ($current_page == 'about') ? 'active' : ''; ?>" ><a href="./about.php">About Us</a></li>
                                            <li><a href="./room-details.php">Room Details</a></li>
                                            <li><a href="./blog-details.php">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="<?php echo ($current_page == 'blog') ? 'active' : ''; ?>" ><a href="./blog.php">News</a></li>
                                    <li class="<?php echo ($current_page == 'contact') ? 'active' : ''; ?>" ><a href="./contact.php">Contact</a></li>
                                </ul>
                            </nav>
                            <div class="header__nav__widget">
                                <a href="rooms.php">Book Now <span class="arrow_right"></span></a>
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