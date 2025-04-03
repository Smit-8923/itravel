<header>
    <div class="header-area">
        <div id="sticky-header" class="main-header-area">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light" style="min-height: 70px;">
                    <a class="navbar-brand" href="index.php">
                        <img src="img/logoo.png" alt="" class="img-fluid" style="max-height: 60px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link active px-3 py-2" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link px-3 py-2" href="about.php">About</a></li>
                            <li class="nav-item"><a class="nav-link px-3 py-2" href="package.php">Packages</a></li>
                            <li class="nav-item"><a class="nav-link px-3 py-2" href="my_booking.php">Booking</a></li>
                            <li class="nav-item"><a class="nav-link px-3 py-2" href="contact.php">Contact</a></li>
                            <li class="nav-item"><a class="nav-link px-3 py-2" href="feedback.php">Feedback</a></li>
                        </ul>
                        <?php 
                            
                            if(isset($_SESSION['username'])) {
                                echo '<div class="dropdown">
                                        <button class="btn btn-danger dropdown-toggle px-4 py-2" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['username'] . '</button>
                                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                            <li><a class="dropdown-item" href="user/profile.php">Profile</a></li>
                                            <li><a class="dropdown-item" href="user/logout.php">Logout</a></li>
                                        </ul>
                                      </div>';
                            } else {
                                echo '<a href="user/login.php" class="btn btn-danger px-4 py-2">Login</a>';
                            }
                        ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
