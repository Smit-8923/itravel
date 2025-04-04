<?php
session_start();
include '../config.php'; // Ensure this file connects to your database

$admin_email = $_SESSION['admin_email'];
$query = "SELECT  * FROM admin_table WHERE admin_email = '$admin_email'";
$result = mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - iTravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
    <div class="content"> 
    
        <div class="card shadow-sm p-4">
            <h3 class="text-center">Admin Profile</h3>
            <hr>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($row['admin_name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['admin_email']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($row['admin_dob']); ?></p>
            <p><strong>Mobile:</strong> <?php echo htmlspecialchars($row['admin_mobile']); ?></p>
            <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

