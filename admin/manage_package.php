<?php
include("../config.php");
session_start();
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM package_table WHERE package_id = '$delete_id'";
    $result = mysqli_query($connection, $delete_query);
    if ($result) {
        echo "<script>alert('Package deleted successfully!'); window.location.href='manage_package.php';</script>";
    } else {
        echo "<script>alert('Error deleting package!');</script>";
    }
}

$package_query = "SELECT p.*, c.category_name FROM package_table p 
                  JOIN category_table c ON p.category_id = c.category_id";
$package_result = mysqli_query($connection, $package_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        /* Table Styling */
        .table-container {
            width: 1200px;
            margin: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .table th {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 12px;
        }
        .table td {
            text-align: center;
            padding: 10px;
            vertical-align: middle;
            
        }
        .details-column {
            max-width: 250px;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        .action-btns {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
        }
        .status-active { color: green; font-weight: bold; }
        .status-inactive { color: red; font-weight: bold; }
        
        
    </style>
</head>
<body>
    <?php include "sidebar.php"; ?>
    <div class="content"> 
        <?php include "navbar.php"; ?>

        <div class="container mt-4">
            <h2 class="text-center mb-4">Manage Packages</h2>

            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Package Name</th>
                            <th class="details-column">Package Details</th>
                            <th>Category</th>
                            <th>Price (₹)</th>
                            <th>Departure</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($package = mysqli_fetch_assoc($package_result)) {
                            echo "<tr>
                                <td>{$i}</td>
                                <td>{$package['package_name']}</td>
                                <td class='details-column'>{$package['package_details']}</td>
                                <td>{$package['category_name']}</td>
                                <td>₹{$package['package_price']}</td>
                                <td>{$package['depart_date']}</td>
                                <td>{$package['days']} Days</td>
                                <td class='".($package['status'] == 1 ? 'status-active' : 'status-inactive')."'>"
                                    .($package['status'] == 1 ? "Active" : "Inactive")."</td>
                                <td class='action-btns'>
                                    <a href='edit_package.php?id={$package['package_id']}' class='btn btn-sm btn-warning'>
                                        <i class='bi bi-pencil-square'></i>
                                    </a>
                                    <a href='manage_package.php?delete_id={$package['package_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>
                                        <i class='bi bi-trash'></i>
                                    </a>
                                </td>
                            </tr>";
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
