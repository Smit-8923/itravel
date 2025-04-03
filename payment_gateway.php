<?php
include("config.php");
session_start();

// Ensure booking_id is provided
if (!isset($_GET['booking_id']) || empty($_GET['booking_id'])) {
    echo "<script>alert('Invalid booking!'); window.location.href='packages.php';</script>";
    exit;
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking details
$sql = "SELECT * FROM booking_table WHERE booking_id = $booking_id";
$result = mysqli_query($connection, $sql);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    echo "<script>alert('Booking not found!'); window.location.href='packages.php';</script>";
    exit;
}

$total_amount = $booking['total_amount'];

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = mysqli_real_escape_string($connection, $_POST['payment_method']);
    
    // Update booking with payment method & status
    $update_query = "UPDATE booking_table SET payment_method='$payment_method', payment_status ='Paid' WHERE booking_id=$booking_id";

    if (mysqli_query($connection, $update_query)) {
        echo "<script>alert('Payment Successful!'); window.location.href='payment_process.php?booking_id=$booking_id';</script>";
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
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container">
    <h2 class="text-center mt-4">Payment Gateway</h2>
    <p class="text-center">Total Amount: <strong>Rs. <?php echo number_format($total_amount); ?></strong></p>

    <form action="" method="post" class="text-center">
        <h4>Select Payment Method:</h4>

        <div class="mb-3">
            <input type="radio" name="payment_method" value="Credit Card" required> Credit Card<br>
            <input type="radio" name="payment_method" value="UPI"> UPI<br>
            <input type="radio" name="payment_method" value="Bank Transfer"> Bank Transfer
        </div>

        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>
