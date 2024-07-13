<!DOCTYPE html>
<html lang="en">
<?php include './links/links.php' ?>

<body>
    <div class="wrapper">
        <?php
        $current_page = 'FeedBack';
        include './links/sidebare.php'; ?>
    </div>

    
    <div class="main-panel">
        <?php include './links/customer.php'; ?>
        <div class="container">
            <div class="row">
               
                <div class="col-10">
                    <div class="container mt-4">
                        <h3>Lively Root</h3>
                        <ul class="nav nav-tabs mb-3">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Incoming</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Outgoing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Reported</a>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center mb-4">
                            <img src="./assets/img/mlane.jpg" alt="Lively Root" class="rounded-circle me-3">
                            <div>
                                <h4 class="mb-0">Ronald Root</h4>
                                <p class="mb-0">4.1 <span class="text-muted">(125 reviews)</span></p>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h5>Ratings</h5>
                            <div>
                                <p>Communication <span class="ms-2">★★★★☆</span></p>
                                <p>Pricing <span class="ms-2">★★★★☆</span></p>
                                <p>Plant quality <span class="ms-2">★★★★☆</span></p>
                                <p>Packaging quality <span class="ms-2">★★★★☆</span></p>
                            </div>
                        </div>
                        <div class="border p-3 mb-3">
                            <div class="d-flex align-items-center">
                                <img src="./assets/img/wild.jpg" alt="Ronald Richards" class="rounded-circle me-3" width="60">
                                <div>
                                    <h6 class="mb-0">Donna Koli</h6>
                                    <p class="mb-0">5.0 ★★★★★</p>
                                </div>
                            </div>
                            <div class="mt-3">
                                <p class="mb-1"><strong>Status:</strong> Purchased from seller</p>
                                <p class="mb-1"><strong>Purchase date:</strong> Nov 6, 2023</p>
                                <p class="mb-1"><strong>Location:</strong> Czech Republic</p>
                                <p>Great products! I just love everything about this website, their customer support and other. I will surely continue buying from them!</p>
                                <div class="d-flex">
                                    <button class="btn btn-link">Reply</button>
                                    <button class="btn btn-link">Share</button>
                                    <button class="btn btn-link">Report</button>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center">
                                    <img src="./assets/img/mlane.jpg" alt="Lively Root" class="rounded-circle me-3" width="30">
                                    <div>
                                        <h6 class="mb-0">Lively Root</h6>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p>Thank you for your kind words!</p>
                                </div>
                            </div>
                            <a href="#" class="text-decoration-none">Show more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './links/script.php' ?>
</body>

</html>