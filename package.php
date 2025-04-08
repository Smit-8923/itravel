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

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include("header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="section_title text-center mb_70">
                <h3>Available Packages</h3>
            </div>
        </div>
    </div>

    <?php
    include("config.php");

    // Check if 'cid' is provided in the URL
    $cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

    // SQL Query: If 'cid' is provided, filter by category_id
    $sql = ($cid > 0) ? "SELECT * FROM package_table WHERE category_id = $cid" : "SELECT * FROM package_table";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>    
    <div style="display: flex; align-items: center; border: 1px solid #ddd; padding: 5px; border-radius: 5px; max-width: 100%; margin: 10px; height: 120px;">
    <img src="admin/<?php echo htmlspecialchars($row['package_image']); ?>" 
     alt="Tour Image" style="width: 150px; height: 100px; border-radius: 8px; margin-right: 15px;">
<div style="flex-grow: 1;">
            <h3 style="margin: 0;"><?php echo htmlspecialchars($row['package_name']); ?></h3>
            <p style="margin: 5px 0; 
                      max-height: 60px; 
                      max-width: 90%;
                      overflow: hidden; 
                      text-overflow: ellipsis; 
                      display: -webkit-box; 
                      -webkit-line-clamp: 3; 
                      -webkit-box-orient: vertical;">
                <?php echo htmlspecialchars($row['package_details']); ?>
            </p>
        </div>
        <div style="text-align: center;">
            <p style="color: red; font-size: 15px; font-weight: bold; margin: 10px;">
                Rs.<?php echo number_format($row['package_price']); ?>
            </p>
            <a href="package_details.php?pid=<?php echo $row['package_id']; ?>" 
               style='background-color: yellow; border: none; padding: 8px 15px; font-size: 15px; cursor: pointer;'>Details</a>
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

</body>
</html>
