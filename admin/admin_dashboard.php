<?php
include "../config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div id="adminPanel">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <p>Welcome, <?php echo $_SESSION['admin_name']; ?>!</p>
            <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#packages">Manage Packages</a></li>
                <li><a href="#bookings">Customer Bookings</a></li>
                <li><a href="#payments">Payment Status</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </div>
        
    </div>
</body>
</html>
