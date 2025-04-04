<?php
include("../config.php");
session_start();

// Ensure only Super Admins can access this page

// Handle User Deletion
if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);

    // Prevent deletion if user_id does not exist
    $check_query = "SELECT * FROM user_table WHERE user_id = $delete_id";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $delete_query = "DELETE FROM user_table WHERE user_id = $delete_id";
        if (mysqli_query($connection, $delete_query)) {
            echo "<script>alert('User deleted successfully!'); window.location.href='user_list.php';</script>";
        } else {
            echo "<script>alert('Error deleting User!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}

// Fetch User List
$user_query = "SELECT * FROM user_table";
$user_result = mysqli_query($connection, $user_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
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
        <h2 class="text-center mb-4">User List</h2>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Birthdate</th>
                    <th>Date of Join</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($user = mysqli_fetch_assoc($user_result)) {
                    echo "<tr>
                        <td>{$i}</td>
                        <td>{$user['user_name']}</td>
                        <td>{$user['user_email']}</td>
                        <td>{$user['user_mobile']}</td>
                        <td>{$user['user_dob']}</td>
                        <td>{$user['user_doj']}</td>
                        <td>";
                    
                    // Allow deletion only for non-Super Admins
                    if ($_SESSION['admin_role'] != 'Super Admin') {
                        echo "<a href='user_list.php?delete_id={$user['user_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this user?\")'>
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
