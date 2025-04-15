<?php
include("../config.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $package_name = $_POST['package_name'];
    $package_details = $_POST['package_details'];
    $status = $_POST['status'];
    $days = $_POST['days'];
    $category_id = $_POST['category_id'];
    $adult_price = $_POST['adult_price'];
    $child_price = $_POST['child_price'];

    $insert_package = "INSERT INTO package_table (category_id, package_name,  package_details, days,status,adult_price,child_price)
                        VALUES ('$category_id', '$package_name', '$package_details',  '$days','$status','$adult_price','$child_price')";
    mysqli_query($connection, $insert_package);
    $package_id = mysqli_insert_id($connection);
    // Insert departure dates
    date_default_timezone_set('Asia/Kolkata'); // Add at the top

    foreach ($_POST['departure_dates'] as $date) {
        $today = date('d-m-Y');
        if (!empty($date) && $date < $today) {
            echo "<script>alert('Departure date must be today or in the future!'); window.history.back();</script>";
            exit;
        } elseif (!empty($date)) {
            mysqli_query($connection, "INSERT INTO departure_dates (package_id, departure_date) VALUES ($package_id, '$date')");
        }
    }

    // Insert additional images
    if (isset($_FILES['more_images'])) {
        foreach ($_FILES['more_images']['tmp_name'] as $key => $tmp_name) {
            $filename = $_FILES['more_images']['name'][$key];
            if ($filename != "") {
                $target = "uploads/package/" . basename($filename);
                move_uploaded_file($tmp_name, $target);
                mysqli_query($connection, "INSERT INTO package_images (package_id, image_path) VALUES ($package_id, '$target')");
            }
        }
    }

    if (isset($_POST['day_title']) && is_array($_POST['day_title'])) {
        for ($i = 0; $i < count($_POST['day_title']); $i++) {
            $day_number = $i + 1;
            $day_title = $_POST['day_title'][$i];
            $day_description = $_POST['day_description'][$i];
            $destination_name = $_POST['destination_name'][$i];
           ;
            $insert_schedule = "INSERT INTO schedule_table 
        (package_id, day_number, title, `description`, destination_name)
        VALUES ('$package_id', '$day_number', '$day_title', '$day_description', '$destination_name')";
            mysqli_query($connection, $insert_schedule);
        }
        echo "<script>alert('Package added successfully!'); window.location.href='manage_package.php';</script>";
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
    <?php include "sidebar.php"; ?>
    <div class="content">
        <?php include "navbar.php"; ?>
        <h2 class="text-center mt-4">Add new Package</h2>
        <form method="POST" action="add_package.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php
                    $categories = mysqli_query($connection, "SELECT * FROM category_table");
                    while ($row = mysqli_fetch_assoc($categories)) {
                        echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Package Name</label>
                <input type="text" name="package_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Upload More Images (Max 5)</label>
                <input type="file" name="more_images[]" class="form-control" multiple accept="image/*">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="package_details" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label>Duration (Days)</label>
                <input type="number" name="days" id="days" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Departure Dates (up to 4)</label><br>
                <input type="date" name="departure_dates[]" class="form-control mb-2" required>
                <input type="date" name="departure_dates[]" class="form-control mb-2">
                <input type="date" name="departure_dates[]" class="form-control mb-2">
                <input type="date" name="departure_dates[]" class="form-control mb-2">
            </div>
            <div class="mb-3">
                <label for="adult_price">Adult Price (₹)</label>
                <input type="number" name="adult_price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="child_price">Child Price (₹)</label>
                <input type="number" name="child_price" class="form-control" required>
            </div>
            <small style="color: gray;">
                * Children under 3 years are free and not counted in booking total.
            </small>
            

            <div class="mb-3">
                <label class="form-label">Status</label><br>
                <input type="radio" name="status" value="Active" checked> Active
                <input type="radio" name="status" value="inctive"> Inactive
            </div>
            <div id="dayScheduleContainer"></div>
            <button type="submit" name="submit" class="btn btn-primary">Add Package</button>
        </form>
    </div>

    <script>
        document.getElementById('days').addEventListener('input', function() {
            const days = parseInt(this.value);
            const container = document.getElementById('dayScheduleContainer');
            container.innerHTML = '';

            if (!isNaN(days)) {
                for (let i = 0; i < days; i++) {
                    const block = document.createElement('div');
                    block.className = 'day-block border p-3 rounded mb-3';
                    block.innerHTML = `
                    <h5>Day ${i + 1}</h5>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="day_title[]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="day_description[]" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Destination</label>
                        <select name="destination_name[]" class="form-control destination-select" data-index="${i}">
                            <option value="">Select Destination</option>
                            <?php
                            $location = mysqli_query($connection, "SELECT * FROM destination_table");
                            while ($row = mysqli_fetch_assoc($location)) {
                                echo "<option value='{$row['destination_name']}'>{$row['destination_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>`;
                    container.appendChild(block);
                }
            }
        });
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>