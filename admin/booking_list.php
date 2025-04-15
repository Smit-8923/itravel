<?php
include("../config.php");
session_start();

// Handle booking status update
if (isset($_GET['update_id']) && isset($_GET['status'])) {
    $update_id = $_GET['update_id'];
    $new_status = $_GET['status'];

    $update_query = "UPDATE booking_table SET booking_status = '$new_status' WHERE booking_id = '$update_id'";
    if (mysqli_query($connection, $update_query)) {
        echo "<script>alert('Booking status updated to $new_status!'); window.location.href='booking_list.php';</script>";
    } else {
        echo "<script>alert('Error updating status!');</script>";
    }
}
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM booking_table WHERE package_id = '$delete_id'";
    $result = mysqli_query($connection, $delete_query);
    $p_delete = "DELETE FROM payment_table WHERE package_id = '$delete_id'";
    $resut = mysqli_query($connection, $p_delete);

    if ($result) {
        echo "<script>alert('booking deleted successfully!'); window.location.href='booking_list.php';</script>";
    } else {
        echo "<script>alert('Error deleting package!');</script>";
    }
}

// Fetch bookings
$booking_query = "SELECT b.*, p.*
        FROM booking_table b 
        JOIN package_table p ON b.package_id = p.package_id";
$booking_result = mysqli_query($connection, $booking_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings - iTravel</title>
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
        .table-container {
            max-width: 1200px;
            margin: 50px auto;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .status-pending { color: orange; font-weight: bold; }
        .status-confirmed { color: green; font-weight: bold; }
        .status-cancelled { color: red; font-weight: bold; }
        .action-btns {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
    </style>
</head>

<body>

    <?php include "sidebar.php"; ?>
    <div class="content">
        <?php include "navbar.php"; ?>
        <div class="container table-container">
            <h2 class="text-center mb-4">Manage Bookings</h2>

            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Package Name</th>
                        <th>Booking Date</th>
                        <th>departure Date</th>
                        <th>No of Adult</th>
                        <th>No of Children</th>
                        <th>Amount (₹)</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                        <th>Actions</th>

                        <?php 
                        // Show "Actions" column only if there are pending bookings
                        $has_pending = false;
                        while ($temp = mysqli_fetch_assoc($booking_result)) {
                            if ($temp['status'] == 'Pending') {
                                $has_pending = true;
                                break;
                            }
                        }
                        mysqli_data_seek($booking_result, 0); // Reset result pointer

                        if ($has_pending) {
                            echo "<th>Actions</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($booking = mysqli_fetch_assoc($booking_result)) {
                        $status_class = "status-" . strtolower($booking['status']);
                        echo "<tr>
                            <td>{$i}</td>
                            <td>{$booking['name']}</td>
                            <td>{$booking['package_name']}</td>
                            <td>{$booking['booking_date']}</td>
                            <td>{$booking['departure_date']}</td>
                            <td>{$booking['num_adults']}</td>
                            <td>{$booking['num_children']}</td>
                            <td>₹{$booking['grand_total']}</td>
                            <td>{$booking['payment_status']}</td>
                            <td class='{$status_class}'>" . ($booking['booking_status'] ? $booking['booking_status'] : 'Pending') . "</td>";
                        
                        if ($booking['status']) {
                            echo "<td class='action-btns'>
                                    <a href='booking_list.php?update_id={$booking['booking_id']}&status=Confirmed' class='btn btn-sm btn-success'>
                                        <i class='bi bi-check-circle'></i> Confirm
                                    </a>
                                    <a href='booking_list.php?update_id={$booking['booking_id']}&status=Cancelled' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to cancel?\")'>
                                        <i class='bi bi-x-circle'></i> Cancel
                                    </a>
                                    <a href='booking_list.php?delete_id={$booking['booking_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>
                                        <i class='bi bi-trash'></i>Delete
                                    </a>
                                  </td>";
                        }
                        
                        echo "</tr>";
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
