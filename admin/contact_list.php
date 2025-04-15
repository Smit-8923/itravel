<?php
include("../config.php");
session_start();

// Ensure only Super Admins can access this page

// Handle contact Deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    $delete_query = "DELETE FROM contact_table WHERE contact_id = $delete_id";
    if (mysqli_query($connection, $delete_query)) {
        echo "<script>alert('contact deleted successfully!'); window.location.href='contact_list.php';</script>";
    } else {
        echo "<script>alert('Error deleting contact!');</script>";
    }
}

// Fetch contact List
$contact_query = "SELECT * FROM contact_table ORDER BY contact_date DESC";
$contact_result = mysqli_query($connection, $contact_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>contact List</title>
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
        <h2 class="text-center mb-4">User Reachlist</h2>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date Submitted</th>
                    <th>Action</th> <!-- Delete contact -->
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($contact = mysqli_fetch_assoc($contact_result)) {
                    echo "<tr>
                        <td>{$i}</td>
                        <td>{$contact['user_name']}</td>
                        <td>{$contact['user_email']}</td>
                        <td>{$contact['subject']}</td>
                        <td>{$contact['contact_date']}</td>
                        <td>
                            <a href='contact_list.php?delete_id={$contact['contact_id']}' class='btn btn-sm btn-danger' onclick='return confirm('Are you sure you want to delete this contact?')'>
                                Delete
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
