<?php
include("../config.php");
session_start();



if (!isset($_GET['id'])) {
    echo "<script>alert('No hotel selected.'); window.location.href='manage_hotel.php';</script>";
    exit;
}

$hotel_id = $_GET['id'];

// Fetch hotel data
$query = "SELECT * FROM hotel_table WHERE hotel_id = '$hotel_id'";
$result = mysqli_query($connection, $query);
$hotel = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hotel_name = $_POST['hotel_name'];
    $hotel_address = $_POST['hotel_address'];
    $hotel_description = $_POST['hotel_description'];

    $hotel_image = $hotel['image_url'];
    if (!empty($_FILES['hotel_image']['name'])) {
        $hotel_image = $_FILES['hotel_image']['name'];
        $hotel_image_tmp = $_FILES['hotel_image']['tmp_name'];
        move_uploaded_file($hotel_image_tmp, "uploads/hotels/" . $hotel_image);
    }

    $update = "UPDATE hotel_table SET 
                hotel_name = '$hotel_name',
                address = '$hotel_address',
                description = '$hotel_description',
                image_url = '$hotel_image'
               WHERE hotel_id = '$hotel_id'";
    mysqli_query($connection, $update);

    echo "<script>alert('Hotel updated successfully!'); window.location.href='manage_hotel.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Hotel - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
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
        @media (max-width: 768px) {
            .sidebar { width: 80px; }
            .content { margin-left: 80px; }
            .sidebar a span { display: none; }
        }
    </style>
</head>

<body>
<?php include("sidebar.php"); ?>

<div class="content">
    <?php include("navbar.php"); ?>

    <h2 class="text-center mt-4 mb-4">Edit Hotel</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Hotel Name</label>
            <input type="text" name="hotel_name" value="<?= htmlspecialchars($hotel['hotel_name']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Hotel Address</label>
            <textarea name="hotel_address" class="form-control" rows="2" required><?= htmlspecialchars($hotel['address']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Hotel Description</label>
            <textarea name="hotel_description" class="form-control" rows="3" required><?= htmlspecialchars($hotel['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="upload/hotels/<?= $hotel['image_url'] ?>" width="150" class="mb-2"><br>
            <label>Change Image</label>
            <input type="file" name="hotel_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Hotel</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
