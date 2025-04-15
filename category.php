<?php
include("config.php");
session_start();
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>iTravel - Categories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">
   
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include("header.php"); ?>

<!-- Banner Section -->
<div class="bradcam_area bradcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Categories</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Fetch and Display Categories -->
<div class="popular_destination_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center mb_70">
                    <h3>All Categories</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            $sql = "SELECT * FROM category_table";
            $result = mysqli_query($connection, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-lg-4 col-md-6"> 
                            <a href="package.php?cid=' . $row["category_id"] . '">
                                <div class="single_destination">
                                    <div class="thumb">
                                        <img src="img/package_dp/' . htmlspecialchars($row['category_name']) . '.jpg" 
                                             alt="' . htmlspecialchars($row['category_name']) . '">
                                    </div>
                                    <div class="content">
                                        <p class="d-flex align-items-center">' . htmlspecialchars($row['category_name']) . '</p>
                                    </div>
                                </div>
                            </a>
                          </div>';
                }
            } else {
                echo "<p>No categories found.</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>

<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
