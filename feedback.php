<?php
include("config.php");
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "<script>
        alert('Please log in for feedback.');
        window.location.href = 'user/login.php';
    </script>";
    exit();
}
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    
    $delete_query = "DELETE FROM feedback_table WHERE feedback_id = $delete_id";
    if (mysqli_query($connection, $delete_query)) {
        echo "<script>alert('Feedback deleted successfully!'); window.location.href='feedback.php';</script>";
    } else {
        echo "<script>alert('Error deleting feedback!');</script>";
    }
}

?>

<!doctype html>
<html class="no-js" lang="zxx">


<!-- Mirrored from themewagon.github.io/travelo/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Feb 2025 11:56:02 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>iTravel - feedback</title>
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
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/feedback.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
     <style>.containar1 {
    max-width: 800px;
    margin: auto;
    padding-top: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
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

</style>
</head>

<body>

    <?php
    include("header.php");
    ?>

    <!-- header-end -->

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_5">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>feedback</h3>
                        <!-- <p>Pixel perfect design with awesome contents</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- ================ contact section start ================= -->
    <?php
    $name = $_SESSION["username"];
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $details = $_POST['message'];
        $email = $_SESSION["user_email"];

        if(empty($details)) {
            echo "<script>alert('Please Give Feedback'); window.history.back();</script>";
            exit(); // Stop execution if validation fails
        }
        $sql = "INSERT INTO `feedback_table` (`feedback_id`, `username`, `user_email`, `feedback_message`,`feedback_date`) VALUES (NULL, '$name', '$email', '$details', current_timestamp());";
               
        $result = mysqli_query($connection,$sql );
        if ($result) {
            echo "<script>alert('Thank you for Feedback');</script>";
            
        }
        
        
    }
    $sql = "SELECT * FROM `feedback_table` WHERE `username` LIKE '$name'";
    $fetch = mysqli_query($connection, $sql);

    
    ?>
    
    <section class="contact-section">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Give Feedback</h2>
                </div>
                <div class="col-lg-8">
                <form class="form-contact contact_form" action="feedback.php" method="post" id="contactForm" novalidate="novalidate" >
                    <div class="row">
                    
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="button button-contactForm boxed-btn4">
                    </div>
                </form>
            </div>
        </div>
        <div class="containar">

        <div class="container">
    <h2 class="text-center mt-4">My feedback</h2>

    <?php if (mysqli_num_rows($fetch) > 0) { ?>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Your feedback</th>
                    <th>Date</th>

                    <th>Reply</th>
                    <th>Action</th> <!-- Cancel Button Column -->
                </tr>
            </thead>
            <tbody>
            <?php
             $i = 1;
             while ($feed = mysqli_fetch_assoc($fetch)) {
                echo "<tr>
            <td>{$i}</td>
            <td>{$feed['username']}</td>
            <td>{$feed['feedback_message']}</td>
            <td>{$feed['feedback_date']}</td>
            <td>" . (!empty($feed['reply_message']) ? $feed['reply_message'] : '<span class="text-muted">No reply yet</span>') . "</td>
            <td>
                <a href='feedback.php?delete_id={$feed['feedback_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this feedback?\")'>Delete</a>
            </td>
        </tr>";
        $i++;
             }?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center m-4" style="color: red; font-size: 20px;">You have no give any feedback!</p>
    <?php } ?>
</div>
    </section>
    <!-- ================ contact section end ================= -->
    <!-- footer start -->
    <?php
    include("footer.php");
    ?>
    <!--/ footer end  -->

    <!-- Modal -->
    <div class="modal fade custom_search_pop" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="serch_form">
                    <input type="text" placeholder="Search">
                    <button type="submit">search</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS here -->
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

    <!--contact js-->
    <!-- <script src="js/contact.js"></script> -->
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }
        });
        $('#datepicker2').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<span class="fa fa-caret-down"></span>'
            }

        });
    </script>
</body>


<!-- Mirrored from themewagon.github.io/travelo/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Feb 2025 11:56:02 GMT -->

</html>