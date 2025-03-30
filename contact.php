<?php
include("config.php");
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo "<script>
        alert('Please log in to submit feedback or contact us.');
        window.location.href = 'user/login.php';
    </script>";
    exit();
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
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/feedback.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>

    <?php
    include("header.php");
    ?>

    <!-- header-end -->

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_4">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>contact</h3>
                        <!-- <p>Pixel perfect design with awesome contents</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- ================ contact section start ================= -->
    <?php
    if(isset($_POST["contact_form"])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        if(empty($name) || empty($email) || empty($subject)) {
            echo "<script>alert('All fields are required!'); window.history.back();</script>";
            exit(); // Stop execution if validation fails
        }
        $sql = "INSERT INTO `contact_table` (`contact_id`, `user_name`, `user_email`, `subject`,`contact_date`) VALUES (NULL, '$name', '$email', '$subject', current_timestamp());";
               
        $result = mysqli_query($connection,$sql );
        if ($result) {
            echo "<script>alert('Thank you ! We will reach you soon...');</script>";
            
        }
    }
    elseif (isset($_POST['feedback_form'])) {
        $details = $_POST['feedback_message'];
        $user_name = $_SESSION['username'];
        $user_email = $_SESSION['user_email'];
        if(empty($details)) {
            echo "<script>alert('Write some feedback!'); window.history.back();</script>";
            exit(); // Stop execution if validation fails
        }
        $sql = "INSERT INTO `feedback_table` (`feedback_id`, `username`, `user_email`, `feedback_message`,`feedback_date`) VALUES (NULL, '$user_name', '$user_email', '$details', current_timestamp());";
               
        $result = mysqli_query($connection,$sql );
        if ($result) {
            echo "<script>alert('Thank you for your feedback');</script>";
            
        }
    }
    

    
    ?>
    
    <section class="contact-section">
        <div class="container">


            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8">
                <form class="form-contact contact_form" action="contact.php" method="post" id="contactForm" novalidate="novalidate" >
                    <div class="row">
                    <div class="col-sm-6">
                    <input type="hidden" name="contact_form" value="1">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" required>
                                </div>
                            </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="subject" id="contact_message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Feedback'" placeholder="Subject.." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="button button-contactForm boxed-btn">
                    </div>
                </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>L.J University</h3>
                            <p>Ahmedabad, Gujarat</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+91 1234567890</h3>
                            <p>Mon to Sat 9am to 10pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>support@itravel.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">Give Your Feedback</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" name="feedback_form"  action="contact.php" method="post" id="feedbackForm" novalidate="novalidate" >
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="feedback_message" id="feedback_message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Your Feedback'" placeholder="Enter Your Feedback" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm boxed-btn" name="feedback_form">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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