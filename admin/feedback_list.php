<?php
include("../config.php");
session_start();

// Ensure only Super Admins can access this page

// Handle Feedback Deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    $delete_query = "DELETE FROM feedback_table WHERE feedback_id = $delete_id";
    if (mysqli_query($connection, $delete_query)) {
        echo "<script>alert('Feedback deleted successfully!'); window.location.href='feedback_list.php';</script>";
    } else {
        echo "<script>alert('Error deleting feedback!');</script>";
    }
}



// Fetch Feedback List
$feedback_query = "SELECT * FROM feedback_table ORDER BY feedback_date DESC";
$feedback_result = mysqli_query($connection, $feedback_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback List</title>
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
        <h2 class="text-center mb-4">User Feedback</h2>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Feedback</th>
                    <th>Date Submitted</th>
                    <th>Reply</th>

                    <th>Action</th> <!-- Delete Feedback -->
                </tr>
            </thead>
            <tbody>
    <?php
    $i = 1;
    while ($feedback = mysqli_fetch_assoc($feedback_result)) {
        echo "<tr>
            <td>{$i}</td>
            <td>{$feedback['username']}</td>
            <td>{$feedback['user_email']}</td>
            <td>{$feedback['feedback_message']}</td>
            <td>{$feedback['feedback_date']}</td>
            <td>" . (!empty($feedback['reply_message']) ? $feedback['reply_message'] : '<span class="text-muted">No reply yet</span>') . "</td>
            <td>
                <a href='reply_feedback.php?id={$feedback['feedback_id']}' class='btn btn-sm btn-primary'>Reply</a>
                <a href='feedback_list.php?delete_id={$feedback['feedback_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this feedback?\")'>Delete</a>
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
