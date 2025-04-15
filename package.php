<?php
include("config.php");
session_start();
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>iTravel - Packages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
    .package-card:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>

</head>

<body>

    <?php include("header.php"); ?>
    

    <div class="container">
    <div class="section_title text-center mb_70">
                    <h3>All Packages</h3>
                </div>

        <?php
        include("config.php");
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $search = mysqli_real_escape_string($connection, $_GET['search']);
        
            $sql = "SELECT DISTINCT p.* 
                    FROM package_table p
                    LEFT JOIN schedule_table s ON p.package_id = s.package_id
                    WHERE p.package_name LIKE '%$search%' 
                       OR s.destination_name LIKE '%$search%'";
        }elseif (isset($_GET['location']) && !empty(trim($_GET['location']))) {
                $location = mysqli_real_escape_string($connection, $_GET['location']);
            
                $sql = "SELECT DISTINCT p.* 
                        FROM package_table p
                        LEFT JOIN schedule_table s ON p.package_id = s.package_id
                        WHERE p.package_name LIKE '%$location%' 
                           OR s.destination_name LIKE '%$location%'";
            }
        else{
        // Check if 'cid' is provided in the URL
        $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

        // SQL Query: If 'cid' is provided, filter by category_id
        $sql = ($cid > 0) ? "SELECT * FROM package_table WHERE category_id = $cid" : "SELECT * FROM package_table";
        }
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="card mb-4 shadow-sm package-card" style="flex-direction: row; align-items: center; padding: 10px; border-radius: 10px; transition: transform 0.3s;">
                <?php
                    $image_sql = "SELECT image_path FROM package_images WHERE package_id = " . $row['package_id'] . " LIMIT 1";
                    $image_result = mysqli_query($connection, $image_sql);
                    $image_row = mysqli_fetch_assoc($image_result);
                    $image_path = $image_row ? $image_row['image_path'] : 'default.jpg'; // fallback
                    ?>
                <a href="package_details.php?pid=<?php echo $row['package_id']; ?>"><img src="admin/<?php echo htmlspecialchars($image_path); ?>"
         alt="Tour Image"
         style="width: 150px; height: 100px; border-radius: 8px; margin-right: 15px; object-fit: cover;"></a>

    <div style="flex-grow: 1;">
        <h5 class="mb-1"><?php echo htmlspecialchars($row['package_name']); ?></h5>
        <p class="mb-2" style="max-height: 60px; max-width: 90%; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
            <?php echo htmlspecialchars($row['package_details']); ?>
        </p>
    </div>
    <div style="text-align: center;">
        <a href="package_details.php?pid=<?php echo $row['package_id']; ?>" class="btn btn-success btn-sm">Details</a>
    </div>
</div>

        <?php
            }
        } else {
            echo "<p style='text-align: center; font-size: 25px; color: red; margin: 20px'>No packages found!</p>";
        }
    
        ?>
    </div>

    <?php include("footer.php"); ?>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
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



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>
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