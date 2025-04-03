<?php
include("config.php");
session_start();

// Ensure package_id is provided
if (!isset($_GET['pid']) || empty($_GET['pid'])) {
    echo "<script>alert('Invalid package!'); window.location.href='packages.php';</script>";
    exit;
}

$pid = intval($_GET['pid']); // Prevent SQL injection

// Fetch package details
$sql = "SELECT * FROM package_table WHERE package_id = $pid";
$result = mysqli_query($connection, $sql);
$package = mysqli_fetch_assoc($result);

if (!$package) {
    echo "<script>alert('Package not found!'); window.location.href='packages.php';</script>";
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_SESSION["username"];
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $num_persons = intval($_POST['num_persons']);
    $booking_date = date("Y-m-d");

    // Fetch package price
    $query = "SELECT package_price FROM package_table WHERE package_id = $pid";
    $result = mysqli_query($connection, $query);
    $package = mysqli_fetch_assoc($result);
    
    if (!$package) {
        echo "<script>alert('Package details not found!'); window.location.href='packages.php';</script>";
        exit;
    }

    $total_amount = $package['package_price'] * $num_persons;

    // Insert booking into the database
    $insert_query = "INSERT INTO booking_table (package_id, name, email, phone, num_persons, booking_date, total_amount, payment_status) 
                     VALUES ('$pid', '$name', '$email', '$phone', '$num_persons', '$booking_date', '$total_amount', 'Pending')";

    if (mysqli_query($connection, $insert_query)) {
        $booking_id = mysqli_insert_id($connection);

        // Redirect to the payment gateway with booking ID
        echo "<script>window.location.href='payment_gateway.php?booking_id=$booking_id';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Package</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container">
    <h2 class="text-center mt-4">Confirm Booking</h2>

    <form action="" method="post">
        
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Number of Persons:</label>
            <input type="number" name="num_persons" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-success">Confirm Booking</button>
    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>
 