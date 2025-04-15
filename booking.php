<?php
include("config.php");
session_start();

// Ensure package_id is provided
if (!isset($_GET['pid']) || empty($_GET['pid'])) {
    echo "<script>alert('Invalid package!'); window.location.href='package.php';</script>";
    exit;
}

$pid = intval($_GET['pid']); // Prevent SQL injection

// Fetch package details
$sql = "SELECT * FROM package_table WHERE package_id = $pid";
$result = mysqli_query($connection, $sql);
$package = mysqli_fetch_assoc($result);

if (!$package) {
    echo "<script>alert('Package not found!'); window.location.href='package.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_SESSION["username"];
    $user_id = $_SESSION["user_id"];

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $departure_date = mysqli_real_escape_string($connection, $_POST['departure_date']);

    $num_adults = intval($_POST['num_adults']);
    $num_children = intval($_POST['num_children']);
    $booking_date = date("Y-m-d");

    // Fetch prices
    $query = "SELECT adult_price, child_price FROM package_table WHERE package_id = $pid";
    $result = mysqli_query($connection, $query);
    $package = mysqli_fetch_assoc($result);

    if (!$package) {
        echo "<script>alert('Package details not found!'); window.location.href='package.php';</script>";
        exit;
    }

    $adult_price = $package['adult_price'];
    $child_price = $package['child_price'];

    $adult_total = $adult_price * $num_adults;
    $child_total = $child_price * $num_children;
    $total_amount = $adult_total + $child_total;

    $gst_rate = 0.18;
    $gst_amount = $total_amount * $gst_rate;
    $grand_total = $total_amount + $gst_amount;

    // Insert into booking_table
    $insert_query = "INSERT INTO booking_table 
        (package_id, name, email, phone, num_adults, num_children, booking_date, departure_date, total_amount, gst_amount, grand_total, payment_status,booking_status) 
        VALUES 
        ('$pid', '$name', '$email', '$phone', '$num_adults', '$num_children', '$booking_date', '$departure_date', '$total_amount', '$gst_amount', '$grand_total', 'Pending','Pending')";

    if (mysqli_query($connection, $insert_query)) {
        $booking_id = mysqli_insert_id($connection);

        // Insert into payment_table
        $query = "INSERT INTO payment_table 
            (booking_id, user_id, amount, gst_amount, grand_total) 
            VALUES 
            ('$booking_id', '$user_id', '$total_amount', '$gst_amount', '$grand_total')";
        mysqli_query($connection, $query);

        // Redirect to payment
        echo "<script>window.location.href='payment_gateway.php?booking_id=$booking_id';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
        exit;
    }
}
?>

<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from themewagon.github.io/travelo/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Feb 2025 11:55:51 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>iTravel - Booking</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container mt-20">
    <h2 class="text-center ">Confirm Booking</h2>

    <form action="" method="post">

        <div class="mb-3">
            <label for="departure_date">Select Departure Date:</label>
            <select name="departure_date" class="form-control" required>
                <option value="">-- Select a Date --</option>
                <?php
                $date_query = "SELECT departure_date FROM departure_dates WHERE package_id = $pid ORDER BY departure_date ASC";
                $date_result = mysqli_query($connection, $date_query);
                while ($date = mysqli_fetch_assoc($date_result)) {
                    $value = htmlspecialchars($date['departure_date']);
                    echo "<option value=\"$value\">$value</option>";
                }?>
            </select>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Number of Adults:</label>
            <input type="number" name="num_adults" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label>Number of Children (Age 3+):</label>
            <input type="number" name="num_children" class="form-control" required min="0">
            <small class="text-muted">Children under 3 years are free and not counted.</small>
        </div>

        <button type="submit" class="btn btn-success mb-3">Confirm Booking</button>
    </form>
</div>

<?php include("footer.php"); ?>

<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Additional JS libraries (if needed) -->
<script src="js/vendor/modernizr-3.5.0.min.js"></script>
<script src="js/vendor/jquery-1.12.4.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/ajax-form.js"></script>
<script src="js/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/scrollIt.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/nice-select.min.js"></script>
<script src="js/jquery.slicknav.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/gijgo.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/contact.js"></script>
<script src="js/jquery.ajaxchimp.min.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/mail-script.js"></script>

<script>
    $('#datepicker').datepicker({
        iconsLibrary: 'fontawesome',
        icons: {
         rightIcon: '<span class="fa fa-caret-down"></span>'
     }
    });
</script>

</body>
</html>
