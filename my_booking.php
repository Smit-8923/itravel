<?php
include("config.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    echo "<script>alert('Please log in to view your bookings!'); window.location.href='user/login.php';</script>";
    exit;
}

$user_name = $_SESSION['username'];

// Handle Booking Cancellation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_booking'])) {
    $booking_id = intval($_POST['booking_id']);
    $delete_query = "DELETE FROM booking_table WHERE booking_id = $booking_id";
    
    if (mysqli_query($connection, $delete_query)) {
        echo "<script>alert('Booking canceled successfully!'); window.location.href='my_booking.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error canceling booking!');</script>";
    }
}

// Fetch user's bookings with package name
$sql = "SELECT b.*, p.package_name 
        FROM booking_table b 
        JOIN package_table p ON b.package_id = p.package_id 
        WHERE b.name = '$user_name' 
        ORDER BY b.booking_date DESC";

$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Bookings</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container">
    <h2 class="text-center mt-4">My Bookings</h2>

    <?php if (mysqli_num_rows($result) > 0) { ?>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Package Name</th>
                    <th>Number of Persons</th>
                    <th>Total Amount</th>
                    <th>Booking Date</th>
                    <th>Payment Status</th>
                    <th>Action</th> <!-- Cancel Button Column -->
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['package_name']); ?></td>
                        <td><?php echo $row['num_persons']; ?></td>
                        <td>Rs. <?php echo number_format($row['total_amount']); ?></td>
                        <td><?php echo $row['booking_date']; ?></td>
                        <td><?php echo htmlspecialchars($row['payment_status']); ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                <button type="submit" name="cancel_booking" class="btn btn-danger btn-sm">Cancel</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center mt-4" style="color: red;">You have no bookings yet!</p>
    <?php } ?>
</div>

<?php include("footer.php"); ?>

</body>
</html>
