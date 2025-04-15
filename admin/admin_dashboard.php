<?php
include("../config.php");
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "<script>
        alert('Please log in for feedback.');
        window.location.href = 'admin/admin_login.php';
    </script>";
    exit();
}
$package_query = "SELECT COUNT(*) AS total_packages FROM package_table";
$package_result = mysqli_query($connection, $package_query);
$package_data = mysqli_fetch_assoc($package_result);
$total_packages = $package_data['total_packages'];

// Fetch total bookings
$booking_query = "SELECT COUNT(*) AS total_bookings FROM booking_table";
$booking_result = mysqli_query($connection, $booking_query);
$booking_data = mysqli_fetch_assoc($booking_result);
$total_bookings = $booking_data['total_bookings'];

// Fetch total users
$user_query = "SELECT COUNT(*) AS total_users FROM user_table";
$user_result = mysqli_query($connection, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$total_users = $user_data['total_users'];
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel -iTravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/x-icon" href="../img/faviconn.png">
    <style>
        body { display: flex; }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover { background: #495057; }
        .content { margin-left: 250px; padding: 20px; width: 100%; }
        @media (max-width: 768px) {
            .sidebar { width: 80px; }
            .content { margin-left: 80px; }
            .sidebar a span { display: none; }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php
    include "sidebar.php";
    ?>
    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <?php
    include "navbar.php";
    ?>
        <!-- Dashboard Cards -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Packages</h5>
                            <p class="card-text"><?php echo "$total_packages";?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Bookings</h5>
                            <p class="card-text"><?php echo "$total_bookings";?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-dark">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text"><?php echo "$total_users";?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
