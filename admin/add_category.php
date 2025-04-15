<?php
include("../config.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - Admin Panel</title>
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
    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <?php
    include "navbar.php";
    ?>
        <!-- Category Page -->
         <?php
         if($_SERVER["REQUEST_METHOD"] == "POST") 
         {
             $name = $_POST['category'];
             $check = "select * from category_table where category_name = '$name'";
             $check_result = mysqli_query($connection,$check);
             $num = mysqli_num_rows($check_result);
            if($num > 0){
            echo "<script>alert('Category already existing.');</script>";
        }
        else{
             $sql = "INSERT INTO `category_table`(`category_name`) VALUES ('$name')";
             $result = mysqli_query($connection,$sql);
             if($result)
             {
                 echo "<script>alert('Category inserted');</script>";
             }
            }
         }
     ?>
        <div class="container mt-4">
            <h2>Add Categories</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" name="category" class="form-control" id="categoryName" placeholder="Enter category name" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
