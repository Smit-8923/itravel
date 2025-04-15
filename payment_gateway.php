<?php
include("config.php");
session_start();

// Ensure booking_id is provided
if (!isset($_GET['booking_id']) || empty($_GET['booking_id'])) {
    echo "<script>alert('Invalid booking!'); window.location.href='package.php';</script>";
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

$total_amount = $booking['total_amount'];
$gst_amount = $booking['gst_amount'];
$grand_total = $booking['grand_total'];


// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_method = mysqli_real_escape_string($connection, $_POST['payment_method']);
    
    // Update booking with payment method & status
    $update_query = "UPDATE booking_table SET payment_method='$payment_method', payment_status='Paid' WHERE booking_id=$booking_id";
    $result = mysqli_query($connection, $update_query);
    $update_payment = "UPDATE payment_table SET payment_method='$payment_method' WHERE booking_id=$booking_id";
    $q = mysqli_query($connection, $update_payment);
    if ($result) {
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
    <title>iTravel - Payment Gateway</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container">
    <h2 class="text-center mt-4">Payment Gateway</h2>
    <p class="text-center">Base Amount: <strong>Rs. <?php echo number_format($total_amount); ?></strong></p>
    <p class="text-center">GST (18%): <strong>Rs. <?php echo number_format($gst_amount); ?></strong></p>
    <p class="text-center">Total Payable: <strong>Rs. <?php echo number_format($grand_total); ?></strong></p>
    <form action="" method="post" class="text-center">
        <h4>Select Payment Method:</h4>

        <div class="mb-3">
            <input type="radio" name="payment_method" value="Credit Card" required> Credit Card<br>
            <input type="radio" name="payment_method" value="UPI"> UPI<br>
            <input type="radio" name="payment_method" value="Bank Transfer"> Bank Transfer
        </div>

        <button type="submit" class="btn btn-primary mb-3">Pay Now</button>
    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>
