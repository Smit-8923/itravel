<?php
include("config.php");
session_start();

// Ensure booking_id is provided
if (!isset($_GET['booking_id']) || empty($_GET['booking_id'])) {
    echo "<script>alert('Invalid access!'); window.location.href='package.php';</script>";
    exit;
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking details
$sql = "SELECT * FROM booking_table WHERE booking_id = $booking_id";
$result = mysqli_query($connection, $sql);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    echo "<script>alert('Booking not found!'); window.location.href='package.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container text-center">
    <h2 class="mt-4">Payment Successful!</h2>
    <p>Your payment for <strong><?php echo $booking['total_amount']; ?></strong> has been completed.</p>
    <p>Payment Method: <strong><?php echo htmlspecialchars($booking['payment_method']); ?></strong></p>
    <p>Thank you for booking with us!</p>

    <a href="index.php" class="btn btn-success">Go to Homepage</a>
</div>

<?php include("footer.php"); ?>

</body>
</html>
