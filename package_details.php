<?php
include("config.php");
session_start();

// Check if 'package_id' is passed
if (!isset($_GET['pid']) || empty($_GET['pid'])) {
    echo "<script>alert('Invalid package!'); window.location.href='package.php';</script>";
    exit;
}

$pid = intval($_GET['pid']); // Prevent SQL injection

$dest_query = mysqli_query($connection, "SELECT DISTINCT destination_name FROM schedule_table WHERE package_id = $pid");

$destination_names = [];
while ($row = mysqli_fetch_assoc($dest_query)) {
    $destination_names[] = "'" . mysqli_real_escape_string($connection, $row['destination_name']) . "'";
}

$hotel_query = false;

if (!empty($destination_names)) {
    $dest_list = implode(',', $destination_names);
    $hotel_query = mysqli_query($connection, "SELECT * FROM hotel_table WHERE destination IN ($dest_list)");
}

// Fetch package details
$sql = "SELECT * FROM package_table WHERE package_id = $pid";
$result = mysqli_query($connection, $sql);
$package = mysqli_fetch_assoc($result);

if (!$package) {
    echo "<script>alert('Package not found!'); window.location.href='package.php';</script>";
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
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .preview-thumb {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .preview-thumb:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
        }

        .preview-thumb.active-thumb {
            border: 3px solidrgb(28, 30, 32);
            box-shadow: 0 0 10px rgba(61, 65, 70, 0.6);
        }
    </style>

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

        <div style="display: flex; flex-direction: column; align-items: center; border: 1px solid #ddd; padding: 20px; border-radius: 5px; max-width: 1200px; margin: 20px auto;">
            <!-- 📷 Gallery with Click-to-Preview -->
            <?php
            $img_query = "SELECT image_path FROM package_images WHERE package_id = $pid";
            $img_result = mysqli_query($connection, $img_query);

            $firstImage = '';
            $thumbnails = [];

            if (mysqli_num_rows($img_result) > 0) {
                while ($img = mysqli_fetch_assoc($img_result)) {
                    $imagePath = 'admin/' . htmlspecialchars($img['image_path']);
                    if (empty($firstImage)) {
                        $firstImage = $imagePath;
                    }
                    $thumbnails[] = $imagePath;
                }
            }
            ?>

            <!-- Main Preview Image -->
            <div class="mb-4 text-center">
                <img id="mainPreview" src="<?php echo $firstImage; ?>" class="img-fluid rounded shadow" style="height: 450px; object-fit: contain;" alt="Main Image">
            </div>

            <!-- Thumbnails Grid -->
            <div class="row mb-4">
                <?php foreach ($thumbnails as $thumb): ?>
                    <div>
                        <img src="<?php echo $thumb; ?>" class="img-fluid rounded preview-thumb" style="height: 80px; object-fit: cover; width: 100px; cursor: pointer; margin:5px;" onclick="setMainImage(this.src)">
                    </div>
                <?php endforeach; ?>
            </div>




            <h2 style="margin-top: 20px; color: #333;"><?php echo htmlspecialchars($package['package_name']); ?></h2>

            <p style="font-size: 16px; color: #555; text-align: justify; margin-top: 10px;">
                <?php echo nl2br(htmlspecialchars($package['package_details'])); ?>
            </p>

            <ul style="list-style: none; padding: 0; margin-top: 20px; text-align: center;">
                <li><strong>Duration:</strong> <?php echo htmlspecialchars($package['days']); ?> Days</li>
                <li><strong>Available Departure Dates:</strong>
                    <ul style="list-style: none; padding-left: 0;">
                        <?php
                        $date_query = "SELECT departure_date FROM departure_dates WHERE package_id = $pid ORDER BY departure_date ASC";
                        $date_result = mysqli_query($connection, $date_query);
                        while ($date = mysqli_fetch_assoc($date_result)) {
                            echo '<li>' . htmlspecialchars($date['departure_date']) . '</li>';
                        }
                        ?>
                    </ul>
                </li>

            </ul>

            <!-- 🧭 Day-wise Itinerary Section -->
            <?php
            $schedule_query = "SELECT * FROM schedule_table WHERE package_id = '$pid' ORDER BY day_number ASC";
            $schedule_result = mysqli_query($connection, $schedule_query);

            if (mysqli_num_rows($schedule_result) > 0) {
                echo '<div class="mt-4 w-100">';
                echo '<h4 class="text mb-4">Day-wise schedule</h4>';
                echo '<div>';

                while ($row = mysqli_fetch_assoc($schedule_result)) {
                    echo '<div class="mb-2 p-3" ">';
                    echo '<h5 class="text-primary mb-2">Day ' . htmlspecialchars($row['day_number']) . ': ' . htmlspecialchars($row['title']) . '</h5>';
                    echo '<p style="margin-bottom: 5px;"><strong>Destination:</strong> ' . htmlspecialchars($row['destination_name']) . '</p>';
                    echo '<p style="text-align: justify;"><strong>Description:</strong><br>' . nl2br(htmlspecialchars($row['description'])) . '</p>';
                    echo '</div>';
                }

                echo '</div></div>';
            }
            ?>

<?php if (mysqli_num_rows($hotel_query) > 0): ?>
    <h3 class='text mb-4'><i class="bi bi-house-door"></i>Hotel Availability</h3>
    <div class="container">
        <?php while ($hotel = mysqli_fetch_assoc($hotel_query)): ?>
            <div class="row mb-4 align-items-center shadow-sm p-3 bg-white rounded" style="border: 1px solid #eee;">
                <div class="col-md-4">
                    <img src="<?php echo 'admin/uploads/hotels/' . htmlspecialchars($hotel['image_url']); ?>"
                         class="img-fluid rounded"
                         alt="Hotel Image"
                         style="width: 100%; height: 250px; object-fit:fill;">
                </div>
                <div class="col-md-8">
                    <h5 class="text-dark mb-2"><?php echo htmlspecialchars($hotel['hotel_name']); ?></h5>
                    <p class="mb-1"><strong>Address:</strong> <?php echo htmlspecialchars($hotel['address']); ?></p>
                    <p class="mb-1"><strong>Details :</strong>
                    <?php echo nl2br(htmlspecialchars($hotel['description'])); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

            

            <div class="text-center mt-4">
                <h4 style="font-weight: bold; color: green;">Adult Price: Rs. <?php echo number_format($package['adult_price']); ?></h4>
                <h5 style="font-weight: bold; color: #555;">Child Price (Above 3 Yrs): Rs. <?php echo number_format($package['child_price']); ?></h5>
                <p style="color: gray;"><em>*Children under 3 years are free and not counted</em></p>
            </div>

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

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function setMainImage(src) {
            document.getElementById('mainPreview').src = src;

            // Remove active class from all thumbnails
            document.querySelectorAll('.preview-thumb').forEach(function(img) {
                img.classList.remove('active-thumb');
            });

            // Add active class to clicked thumbnail
            const clickedImg = Array.from(document.querySelectorAll('.preview-thumb')).find(img => img.src === src);
            if (clickedImg) {
                clickedImg.classList.add('active-thumb');
            }
        }

        // Auto-set active class to first thumbnail on page load
        document.addEventListener('DOMContentLoaded', function() {
            const firstThumb = document.querySelector('.preview-thumb');
            if (firstThumb) {
                firstThumb.classList.add('active-thumb');
            }
        });
    </script>

</body>

</html>