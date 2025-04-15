<?php
include("config.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    echo "<script>
        alert('Please log in to view your bookings.');
        window.location.href = 'user/login.php';
    </script>";
    exit();
}

$user_name = $_SESSION['username'];

// Handle Booking Cancellation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_booking'])) {
    $booking_id = intval($_POST['booking_id']);
    $update_query = "UPDATE booking_table SET booking_status = 'Cancelled' WHERE booking_id = $booking_id";

    if (mysqli_query($connection, $update_query)) {
        echo "<script>alert('Booking cancelled successfully!'); window.location.href='my_booking.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error cancelling booking!');</script>";
    }
}

// Fetch only this user's bookings
$sql = "SELECT b.*, p.* FROM booking_table b 
        JOIN package_table p ON b.package_id = p.package_id 
        WHERE b.name = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>iTravel - My Bookings</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="page-wrapper d-flex flex-column min-vh-100">
    <?php include("header.php"); ?>
    <div class="bradcam_area bradcam_bg_3">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>My Booking</h3>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-bordered mt-4">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Package Name</th>
                        <th>Adults</th>
                        <th>Children</th>
                        <th>Departure Date</th>
                        <th>Booking Date</th>
                        <th>Total Amount (incl. 18% GST)</th>
                        <th>Payment Status</th>
                        <th>Booking Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                            <td><?php echo intval($row['num_adults']); ?></td>
                            <td><?php echo intval($row['num_children']); ?></td>
                            <td><?php echo htmlspecialchars($row['departure_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                            <td>₹<?php echo number_format($row['grand_total']); ?></td>
                            <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                            <td><?php echo htmlspecialchars($row['booking_status']); ?></td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <form method="POST">
                                        <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                        <button type="submit" name="cancel_booking" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                                    </form>
                                    <?php if ($row['payment_status'] == 'Paid') { ?>
                                        <a href="bill.php?booking_id=<?php echo $row['booking_id']; ?>" class="btn btn-primary btn-sm">Invoice</a>
                                    <?php } else { ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Invoice</button>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
        </div>
    
        <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
    <p class="text-center mb-5" style="color: red; font-size: 20px;">
        You have no bookings yet!
    </p>
</div>

<?php } ?>
</div>
    <?php include("footer.php"); ?>
</body>

</html>
