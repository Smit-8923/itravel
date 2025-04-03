<?php
include("config.php");
session_start();

// Check if 'package_id' is passed
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
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo htmlspecialchars($package['package_name']); ?> - Package Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include("header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="section_title text-center mb_70">
                <h3><?php echo htmlspecialchars($package['package_name']); ?></h3>
            </div>
        </div>
    </div>

    <div style="display: flex; flex-direction: column; align-items: center; border: 1px solid #ddd; padding: 20px; border-radius: 10px; max-width: 800px; margin:  20px auto;">
        <img src="img/destination/2.png" alt="Tour Image" style="width: 100%; max-width: 600px; height: auto; border-radius: 10px;">
        
        <h2 style="margin-top: 20px; color: #333;"><?php echo htmlspecialchars($package['package_name']); ?></h2>
        
        <p style="font-size: 16px; color: #555; text-align: justify; margin-top: 10px;">
            <?php echo nl2br(htmlspecialchars($package['package_details'])); ?>
        </p>

        <ul style="list-style: none; padding: 0; margin-top: 20px; text-align: center;">
            <li><strong>Duration:</strong> <?php echo htmlspecialchars($package['days']); ?> Days</li>
            <li><strong>Departure Date:</strong> <?php echo htmlspecialchars($package['depart_date']); ?></li>
         </ul>

        <h3 style="color: red; font-weight: bold; margin-top: 15px;">Rs. <?php echo number_format($package['package_price']); ?></h3>

        <?php if (isset($_SESSION['loggedin'])) { ?>
    <a href="booking.php?pid=<?php echo $package['package_id']; ?>" 
       style="background-color: yellow; color: black; padding: 10px 20px; font-size: 18px; font-weight: bold; border-radius: 5px; text-decoration: none; margin-top: 15px;">
       Book Now
    </a>
<?php } else { ?>
    <a href="user/login.php" 
       onclick="alert('Please log in to book this package!');" 
       style="background-color: yellow; color: black; padding: 10px 20px; font-size: 18px; font-weight: bold; border-radius: 5px; text-decoration: none; margin-top: 15px;">
       Book Now
    </a>
<?php } ?>
    </div>
</div>

<?php include("footer.php"); ?>

<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
