<?php
include("../config.php");
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_name = $_POST['package_name'];
    $package_details = $_POST['package_details'];
    $package_price = $_POST['package_price'];
    $depart_date = $_POST['depart_date'];
    $today = date('Y-m-d', strtotime('+1 day')); // Tomorrow's date

    // Check if the selected departure date is before tomorrow
    if ($depart_date < $today) {
        echo "<script>alert('Departure date must be in the future!'); window.history.back();</script>";
        exit; // Stop further execution
    }
    $days = $_POST['days'];
    $status = $_POST['status'];
    $category_id = $_POST['category_id'];

    $check_query = "SELECT * FROM package_table WHERE package_name = '$package_name'";
    $result = mysqli_query($connection,$check_query);
    if(mysqli_num_rows($result)>0){
        echo "<script>alert('Package Already Existing');</script>";
    }else{

    

    // Image Upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["package_image"]["name"]);
    move_uploaded_file($_FILES["package_image"]["tmp_name"], $target_file);

    // Insert Query
    $sql = "INSERT INTO package_table (package_name, package_details, package_price, depart_date, days, status, package_image, category_id) 
            VALUES ('$package_name', '$package_details','$package_price', '$depart_date', '$days', '$status', '$target_file', '$category_id')";
    $result = mysqli_query($connection,$sql);
    if($result){
        echo "<script>alert('Package Add Successfully.');</script>";
    }
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
        .container{
        max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
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
        <h2 class="text-center mt-4">Add New Package</h2>
     <div class="container ">
        <div class=" p-4 bg-white">
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Package Name</label>
                    <input type="text" name="package_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Package Details</label>
                    <textarea name="package_details" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Package Price (₹)</label>
                    <input type="number" name="package_price" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Departure Date</label>
                    <input type="date" name="depart_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Days</label>
                    <input type="text" name="days" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label><br>
                    <input type="radio" name="status" value="1" checked> Active
                    <input type="radio" name="status" value="0"> Inactive
                </div>

                <div class="mb-3">
                    <label class="form-label">Package Image</label>
                    <input type="file" name="package_image" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category Type</label>
                    <select name="category_id" class="form-control" required>
                        <option value="" disabled selected>Select Category</option>
                        <?php
                        $cat_query = "SELECT * FROM category_table";
                        $cat_result = mysqli_query($connection, $cat_query);
                        while ($category = mysqli_fetch_assoc($cat_result)) {
                            echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">Add Package</button>
            </form>
        </div>
    </div>

</div>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            let today = new Date().toISOString().split("T")[0];
            document.getElementById("depart_date").setAttribute("min", today);
        });
    </script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>