<?php
include("../config.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $delete_id = intval($_GET['id']);

    // Get image filename before deleting
    $query = mysqli_query($connection, "SELECT image_url FROM hotel_table WHERE hotel_id = $delete_id");
    $hotel = mysqli_fetch_assoc($query);

    if ($hotel) {
        // Delete the image file
        $image_path = "uploads/hotels/" . $hotel['image_url'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete hotel from table
        mysqli_query($connection, "DELETE FROM hotel_table WHERE hotel_id = $delete_id");

        echo "<script>alert('Hotel deleted successfully.'); window.location.href='manage_hotel.php';</script>";
        exit;
    } else {
        echo "<script>alert('Hotel not found.'); window.location.href='manage_hotel.php';</script>";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Hotel - Admin Panel</title>
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

        .hotel-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .hotel-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include("sidebar.php"); ?>

    <div class="content">
        <?php include("navbar.php"); ?>

        <h2 class="text-center mt-4 mb-4">Manage Hotels</h2>

        <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Hotel Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Address</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM hotel_table ORDER BY hotel_id DESC";
            $result = mysqli_query($connection, $sql);
            $i = 1;
            if (mysqli_num_rows($result) > 0) {
                while ($hotel = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                        <td>' . $i++ . '</td>
                       <td>' . htmlspecialchars($hotel['hotel_name']) . '</td>
                        <td><img src="uploads/hotels/'.htmlspecialchars($hotel['image_url']) . '" width="100" height="80" style="object-fit:cover;"></td>
                        <td>' . htmlspecialchars($hotel['description']) . '</td>
                        <td>' . htmlspecialchars($hotel['address']) . '</td>
                        <td>' . htmlspecialchars($hotel['destination']) . '</td>
                        <td>
                            <a href="edit_hotel.php?id=' . $hotel['hotel_id'] . '" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>
                            <a href="manage_hotel.php?id=' . $hotel['hotel_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure you want to delete this hotel?\')"><i class="bi bi-trash"></i>Delete</a>
                        </td>
                    </tr>';
                }
            } else {
                echo '<tr><td colspan="6" class="text-center">No hotels found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
