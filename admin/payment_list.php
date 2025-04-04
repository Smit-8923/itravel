<?php
include("../config.php");
session_start();
$sql = "SELECT p.*, b.package_id, pkg.package_name 
        FROM payment_table p
        JOIN booking_table b ON p.booking_id = b.booking_id
        JOIN package_table pkg ON b.package_id = pkg.package_id
        ORDER BY p.payment_id DESC";

$result = mysqli_query($connection, $sql);
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
    <?php
    include "navbar.php";
    ?>
    <div class="container">
    <h2 class="text-center mt-4">Payment List</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Payment ID</th>
                    <th>Booking ID</th>
                    <th>Package Name</th>
                    <th>User ID</th>
                    <th>Amount</th>
                    <th>Payment method</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['payment_id']; ?></td>
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td>Rs. <?php echo number_format($row['amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center mt-4" style="color: red;">No payments found!</p>
    <?php } ?>
</div>


    </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>