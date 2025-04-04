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

// Fetch categories for dropdown
$category_query = "SELECT * FROM category_table";
$category_result = mysqli_query($connection, $category_query);

// Handle form submission
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

    // Update query
    $update_query = "UPDATE package_table 
                     SET package_name='$package_name', package_details='$package_details', package_price='$package_price', 
                         depart_date='$depart_date', days='$days', status='$status', category_id='$category_id' 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Package - Admin Panel</title>
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
            .sidebar a span { display: none; }}
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            margin-bottom: 15px;
        }
        .radio-group {
            display: flex;
            gap: 20px;
        }
    </style>
</head>
<body>
<?php
    include "sidebar.php";
    ?>
    <div class="content">
    <?php
    include "navbar.php";
    ?>
   
   <h2 class="text-center mt-4">Edit Package</h2>
    <div class="container">
        <form method="post">
            <label class="form-label">Package Name</label>
            <input type="text" name="package_name" class="form-control" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>

            <label class="form-label">Package Details</label>
            <textarea name="package_details" class="form-control" required><?php echo htmlspecialchars($package['package_details']); ?></textarea>

            <label class="form-label">Package Price (₹)</label>
            <input type="number" name="package_price" class="form-control" value="<?php echo $package['package_price']; ?>" required>

            <label class="form-label">Departure Date</label>
            <input type="date" name="depart_date" class="form-control" value="<?php echo $package['depart_date']; ?>" required>

            <label class="form-label">Days</label>
            <input type="text" name="days" class="form-control" value="<?php echo $package['days']; ?>" required>

            <label class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <?php while ($category = mysqli_fetch_assoc($category_result)) { ?>
                    <option value="<?php echo $category['category_id']; ?>" 
                        <?php echo ($category['category_id'] == $package['category_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['category_name']); ?>
                    </option>
                <?php } ?>
            </select>

            <label class="form-label">Status</label>
            <div class="radio-group">
                <label><input type="radio" name="status" value="Active" <?php echo ($package['status'] == 1) ? 'checked' : ''; ?>> Active</label>
                <label><input type="radio" name="status" value="Inactive" <?php echo ($package['status'] == 0) ? 'checked' : ''; ?>> Inactive</label>
            </div>

            <button type="submit" class="btn btn-success mt-3 w-100">Update Package</button>
            <a href="manage_package.php" class="btn btn-secondary mt-2 w-100">Cancel</a>
        </form>
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
