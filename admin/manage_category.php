<?php
include("../config.php");
session_start();
if (isset($_GET['delete_id'])) {
    $category_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM category_table WHERE category_id = '$category_id'";
    $result = mysqli_query($connection, $delete_query); 
    if ($result) {
        echo "<script>alert('Category deleted successfully!'); window.location.href='manage_category.php';</script>";
    } else {
        echo "<script>alert('Error deleting category!');</script>";
    }
}
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
        .category-container {
            max-width: 800px;
            margin: 50px auto;
        }
        .action-column{
            width: 100px;
        }
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
    <div class="category-container"> 
    
     
        <h2 class="text-center m-5">Manage Categories</h2>

        <!-- Category List -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover bg-white shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th class="action-column">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $fetch_query = "SELECT * FROM category_table ORDER BY category_id DESC";
                    $result = mysqli_query($connection, $fetch_query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>{$i}</td>
                            <td>{$row['category_name']}</td>
                            <td class='action-column'>
                                <a href='manage_category.php?delete_id={$row['category_id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\");'><i class='bi bi-trash'></i>Delete</a>
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