<?php
include("config.php");
session_start();

if (!isset($_GET['booking_id']) || empty($_GET['booking_id'])) {
    echo "<script>alert('Invalid booking!'); window.location.href='my_booking.php';</script>";
    exit;
}

$booking_id = intval($_GET['booking_id']);
$query = "SELECT b.*, p.package_name, p.adult_price, p.child_price 
          FROM booking_table b 
          JOIN package_table p ON b.package_id = p.package_id 
          WHERE b.booking_id = $booking_id";
$result = mysqli_query($connection, $query);
$booking = mysqli_fetch_assoc($result);

if (!$booking) {
    echo "<script>alert('Booking not found!'); window.location.href='my_booking.php';</script>";
    exit;
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
    <title>iTravel - invoice</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            border: 1px solid #eee;
            padding: 30px;
            background: #fff;
            font-size: 16px;
            line-height: 24px;
            color: #555;
            font-family: 'Helvetica Neue', 'Helvetica', sans-serif;
        }
        .invoice-box table {
            width: 100%;
        }
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        .heading {
            background: #f5f5f5;
            font-weight: bold;
        }
        .total-row {
            border-top: 2px solid #333;
            font-weight: bold;
        }
        .btn-container {
            text-align: center;
            margin: 20px;
        }
        .company-info {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-logo {
            max-width: 120px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div id="invoiceArea" class="invoice-box">

    <div class="company-info">
        <img src="img/logoo.png" alt="Company Logo" class="company-logo">
        <h3>iTravel Tours & Travels</h3>
        <p>LJ University, Ahmedabad, Gujarat, India<br>GSTIN: 27AAAPL1234C1ZV | Phone: +91 74909 41144 | Email: support@itravel.com</p>
    </div>

    <table>
        <tr>
            <td style="width: 50%;">
                <strong>Package Name  :</strong> <?php echo htmlspecialchars($booking['package_name']); ?><br>
                <strong>Departure Date:</strong> <?php echo date('d M Y', strtotime($booking['departure_date'])); ?><br>
                <strong>Booking Date  :</strong> <?php echo date('d M Y', strtotime($booking['booking_date'])); ?><br>
                <strong>Booking ID    :</strong> <?php echo $booking['booking_id']; ?>
            </td>
            <td style="text-align:left;">
                <strong>Customer      :</strong> <?php echo htmlspecialchars($booking['name']); ?><br>
                <strong>Email         :</strong> <?php echo htmlspecialchars($booking['email']); ?><br>
                <strong>Phone         :</strong> <?php echo htmlspecialchars($booking['phone']); ?><br>
                <strong>Payment Method:</strong> <?php echo htmlspecialchars($booking['payment_method']); ?>
            </td>
        </tr>
    </table>

    <hr>

    <table class="table table-bordered mt-3">
        <thead>
            <tr class="heading">
                <td>Description</td>
                <td class="text-end">Amount</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Adults (<?= $booking['num_adults']; ?> × ₹<?= number_format($booking['adult_price'], 2); ?>)</td>
                <td class="text-end"><?= number_format($booking['num_adults'] * $booking['adult_price'], 2); ?></td>
            </tr>
            <tr>
                <td>Children (<?= $booking['num_children']; ?> × ₹<?= number_format($booking['child_price'], 2); ?>)</td>
                <td class="text-end"><?= number_format($booking['num_children'] * $booking['child_price'], 2); ?></td>
            </tr>
            <tr>
                <td>-</td>
                <td>-</td>
            </tr>
            <tr>
                <td><strong>Base Amount</strong></td>
                <td class="text-end"><strong>₹<?= number_format($booking['total_amount'], 2); ?></strong></td>
            </tr>
            <tr>
                <td><strong>GST (18%)</strong></td>
                <td class="text-end"><strong>₹<?= number_format($booking['gst_amount'], 2); ?></strong></td>
            </tr>
            <tr class="total-row">
                <td><strong>Total Amount Payable</strong></td>
                <td class="text-end"><strong>₹ <?= number_format($booking['grand_total'], 2); ?></strong></td>
            </tr>
        </tbody>
    </table>

    <p class="text-center mt-4">Thank you for booking with <strong>iTravel</strong>!<br>We wish you a pleasant journey.</p>
</div>

<div class="btn-container">
    <button onclick="downloadPDF()" class="btn btn-primary">⬇️ Download PDF</button>
</div>

<!-- PDF Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function downloadPDF() {
        var element = document.getElementById('invoiceArea');
        html2pdf().from(element).set({
            margin: 1,
            filename: 'invoice_<?php echo $booking['booking_id']; ?>.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        }).save();
    }
</script>

</body>
</html>
