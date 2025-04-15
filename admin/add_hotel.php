<?php
include("../config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hotel_name = $_POST['hotel_name'];
    $hotel_address = $_POST['hotel_address'];
    $hotel_description = $_POST['hotel_description'];
    $hotel_destination = $_POST['hotel_destination'];
    $hotel_image = $_FILES['hotel_image']['name'];
    $hotel_image_tmp = $_FILES['hotel_image']['tmp_name'];
    move_uploaded_file($hotel_image_tmp, "uploads/hotels/" .$hotel_image);

    $check = mysqli_query($connection, "SELECT * FROM hotel_table WHERE hotel_name = '$hotel_name' && destination = '$hotel_destination'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Hotel already exists.'); window.location.href='add_hotel.php';</script>";
        exit;
    }else{

    $insert_hotel = "INSERT INTO hotel_table (hotel_name, `address`, `description`,destination,`image_url`)
                     VALUES ('$hotel_name', '$hotel_address', '$hotel_description','$hotel_destination', '$hotel_image')";
    $result = mysqli_query($connection, $insert_hotel);
    
    }
    $check_destination = mysqli_query($connection, "SELECT * FROM destination_table WHERE destination_name = '$hotel_destination'");
if (mysqli_num_rows($check_destination) == 0) {
    $insert_destination = "INSERT INTO destination_table (destination_name) VALUES ('$hotel_destination')";
    mysqli_query($connection, $insert_destination);
}


    if ($result) {
        echo "<script>alert('Hotel added successfully!'); window.location.href='manage_hotel.php';</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Hotel - Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/x-icon" href="../img/faviconn.png">
    <style>
        body {
            display: flex;
        }

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

        .sidebar a:hover {
            background: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .content {
                margin-left: 80px;
            }

            .sidebar a span {
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <div class="content">
        <?php include("navbar.php"); ?>

        <h2 class="text-center mt-4">Add New Hotel</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Hotel Name</label>
                <input type="text" name="hotel_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Hotel Address</label>
                <textarea name="hotel_address" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Hotel Description</label>
                <textarea name="hotel_description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Hotel Destination</label>
                <input type="text" name="hotel_destination" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Hotel Image</label>
                <input type="file" name="hotel_image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Hotel</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>