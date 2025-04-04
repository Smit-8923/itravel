<?php
include("../config.php");
session_start();

// Ensure only Super Admins can access this page
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['admin_role']) || $_SESSION['admin_role'] !== 'super admin') {
    echo "<script>alert('Access Denied!'); window.location.href='admin_dashboard.php';</script>";
    exit;
}

// Handle Admin Deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Fetch role of the admin to be deleted
    $role_check_query = "SELECT admin_role FROM admin_table WHERE admin_id = $delete_id";
    $role_check_result = mysqli_query($connection, $role_check_query);
    
    if ($role_check_result && mysqli_num_rows($role_check_result) > 0) {
        $admin_data = mysqli_fetch_assoc($role_check_result);
        $admin_role = $admin_data['admin_role'];

        // Prevent deleting the currently logged-in admin or another Super Admin
        if ($delete_id == $_SESSION['admin_id']) {
            echo "<script>alert('You cannot delete yourself!'); window.location.href='admin_list.php';</script>";
            exit;
        }
        if ($admin_role == 'Super Admin') {
            echo "<script>alert('You cannot delete a Super Admin!'); window.location.href='admin_list.php';</script>";
            exit;
        }

        // Proceed with deletion
        $delete_query = "DELETE FROM admin_table WHERE admin_id = $delete_id";
        if (mysqli_query($connection, $delete_query)) {
            echo "<script>alert('Admin deleted successfully!'); window.location.href='admin_list.php';</script>";
        } else {
            echo "<script>alert('Error deleting admin!');</script>";
        }
    } else {
        echo "<script>alert('Invalid admin ID!');</script>";
    }
}

// Fetch Admin List
$admin_query = "SELECT * FROM admin_table";
$admin_result = mysqli_query($connection, $admin_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin List</title>
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

<?php include("sidebar.php"); ?>

<div class="content">
    <?php include("navbar.php"); ?>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Admin List</h2>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Admin Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Action</th> <!-- Delete Admin -->
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($admin = mysqli_fetch_assoc($admin_result)) {
                    echo "<tr>
                        <td>{$i}</td>
                        <td>{$admin['admin_name']}</td>
                        <td>{$admin['admin_email']}</td>
                        <td>{$admin['admin_role']}</td>
                        <td>{$admin['admin_doj']}</td>
                        <td>";
                    
                    // Allow deletion only for non-Super Admins
                    if ($admin['admin_role'] != 'Super Admin') {
                        echo "<a href='admin_list.php?delete_id={$admin['admin_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this admin?\")'>
                                Delete
                              </a>";
                    } else {
                        echo "<span class='text-muted'>Cannot Delete</span>";
                    }

                    echo "</td></tr>";
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
