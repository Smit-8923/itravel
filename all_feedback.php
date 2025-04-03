<?php
include 'config.php'; // Database connection
session_start();

$sql = "SELECT username, feedback_message FROM feedback_table ORDER BY feedback_date DESC";
$result = mysqli_query($connection, $sql);
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>iTravel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/faviconn.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="../../ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>
<style>
    /* Feedback Section */
.body{
    
    background-color: #F7FAFD;
}
.containar {
    max-width: 800px;
    margin: auto;
    padding-top: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Title */
.section_title {
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 30px;
    color: #343a40;
}

/* Review Card */
.review-card {
    background: #ffffff;
    width: 800px;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    text-align: left;
    transition: 0.3s;
}

.review-card:hover {
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
}

/* Review Text */
.review-text {
    font-size: 18px;
    color: #444;
    font-style: italic;
    margin-bottom: 10px;
}

/* Review Author */
.review-author {
    font-weight: bold;
    color: #050505;
    text-align: right;
}

/* Button Container */
.text-center {
    margin-top: 30px;
}

/* Buttons */
.btn {
    text-decoration: none;
    padding: 12px 25px;
    font-size: 16px;
    border-radius: 5px;
    transition: 0.3s;
    
}

.btn-secondary {
    background-color: #6c757d;
    color: white;
    border: none;
}

.btn-secondary:hover {
    background-color: #545b62;
}

</style>
<body>


<?php
   include("header.php") ;
    ?>
    
<div class="body">

    <div class="containar">
    
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="section_title text-center mb_70">
                <h3>Available Packages</h3>
            </div>
        </div>
    </div>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="review-card">
                <p class="review-text">"<?php echo htmlspecialchars($row['feedback_message']); ?>"</p>
                <p class="review-author">- <?php echo htmlspecialchars($row['username']); ?></p>
            </div>
            <?php } ?>
            
            <div class="text-center m-4">
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </div> 

</body>
</html>
