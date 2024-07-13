<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.php" class="logo">
                <img src="assets/img/kaiadmin/logo_light.png" alt="navbar brand" class="navbar-brand" height="50" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item <?php echo ($current_page == 'index') ? 'active' : ''; ?>">
                    <a href="index.php">
                        <i class="fas fa-home"></i>
                        <p>Home</p>
                    </a>

                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item <?php echo ($current_page == 'room') ? 'active' : ''; ?>">
                    <a href="room.php">
                        <i class="fas fas fa-bed"></i>
                        <p>Rooms</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'booking') ? 'active' : ''; ?>">
                    <a href="booking.php">
                        <i class="fas fas fa-calendar"></i>
                        <p>Booking</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'service') ? 'active' : ''; ?>">
                    <a href="service.php">
                        <i class="fas fas fa-concierge-bell"></i>
                        <p>Service</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'staff') ? 'active' : ''; ?>">
                    <a href="staff.php">
                        <i class="fas fas fa-users"></i>
                        <p>Staff</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'Billing') ? 'active' : ''; ?>">
                    <a href="billing.php">
                        <i class="fas fa-credit-card"></i>
                        <p>Billing</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'guests') ? 'active' : ''; ?>">
                    <a href="guests.php">
                        <i class="fas fa-user"></i>
                        <p>Guests</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'FeedBack') ? 'active' : ''; ?>">
                    <a href="feedback.php">
                        <i class="fas fa-comment-alt"></i>
                        <p>FeedBack</p>
                    </a>
                </li>
                <li class="nav-item <?php echo ($current_page == 'setting') ? 'active' : ''; ?>">
                    <a href="#base">
                        <i class="fas fas fa-cog"></i>
                        <p>Setting</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#base">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>