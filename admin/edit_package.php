<?php
include("../config.php");
session_start();

if (!isset($_GET['id'])) {
    echo "<script>alert('No package selected!'); window.location.href='manage_package.php';</script>";
    exit;
}

$package_id = $_GET['id'];

// Fetch package data
$query = "SELECT * FROM package_table WHERE package_id = '$package_id'";
$result = mysqli_query($connection, $query);
$package = mysqli_fetch_assoc($result);

if (!$package) {
    echo "<script>alert('Package not found!'); window.location.href='manage_package.php';</script>";
    exit;
}

// Fetch categories
$category_query = "SELECT * FROM category_table";
$category_result = mysqli_query($connection, $category_query);

// Fetch departure dates
$departure_query = "SELECT * FROM departure_dates ORDER BY departure_date ASC";
$departure_result = mysqli_query($connection, $departure_query);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $package_name = $_POST['package_name'];
    $package_details = $_POST['package_details'];
    $adult_price = $_POST['adult_price'];
    $child_price = $_POST['child_price'];
    // $departure_id = $_POST['depart_id'];
    $days = $_POST['days'];
    $status = $_POST['status'];
    $category_id = $_POST['category_id'];

    $update_query = "UPDATE package_table 
                     SET package_name='$package_name', package_details='$package_details', 
                         adult_price='$adult_price', child_price='$child_price', 
                        days='$days', 
                         status='$status', category_id='$category_id' 
                     WHERE package_id='$package_id'";

    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        echo "<script>alert('Package updated successfully!'); window.location.href='manage_package.php';</script>";
    } else {
        echo "<script>alert('Error updating package!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Package - Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control { margin-bottom: 15px; }
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<?php include "sidebar.php"; ?>
<div class="content">
    <?php include "navbar.php"; ?>

    <h2 class="text-center mt-4">Edit Package</h2>
    <div class="container">
        <form method="post">
            <label class="form-label">Package Name</label>
            <input type="text" name="package_name" class="form-control" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>

            <label class="form-label">Package Details</label>
            <textarea name="package_details" class="form-control" required><?php echo htmlspecialchars($package['package_details']); ?></textarea>

            <label class="form-label">Adult Price (₹)</label>
            <input type="number" name="adult_price" class="form-control" value="<?php echo $package['adult_price']; ?>" required>

            <label class="form-label">Child Price (₹)</label>
            <input type="number" name="child_price" class="form-control" value="<?php echo $package['child_price']; ?>" required>
            <p>
                <small class="text-muted">Children under 3 years are free and not counted.</small>
            </p>

           
            <label class="form-label mt-3">Days</label>
            <input type="text" name="days" class="form-control" value="<?php echo $package['days']; ?>" required>

            <label class="form-label mt-3">Category</label>
            <select name="category_id" class="form-control" required>
                <?php while ($category = mysqli_fetch_assoc($category_result)) { ?>
                    <option value="<?php echo $category['category_id']; ?>" 
                        <?php echo ($category['category_id'] == $package['category_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['category_name']); ?>
                    </option>
                <?php } ?>
            </select>

            <label class="form-label mt-3">Status</label>
            <div class="radio-group">
                <label><input type="radio" name="status" value="Active" <?php echo ($package['status'] == "Active") ? 'checked' : ''; ?>> Active</label>
                <label><input type="radio" name="status" value="Inactive" <?php echo ($package['status'] == "Inactive") ? 'checked' : ''; ?>> Inactive</label>
            </div>

            <button type="submit" class="btn btn-success mt-4 w-100">Update Package</button>
            <a href="manage_package.php" class="btn btn-secondary mt-2 w-100">Cancel</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
