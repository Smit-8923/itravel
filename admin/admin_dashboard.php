<?php
include "../config.php";
session_start();
?>
<?php
session_start();
require 'class/myclass.php';

if(!isset($_SESSION['adminid']))
{
    header("location:page-login.php");
}

    $connection = mysqli_connect("localhost","root","","travel");

    ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>iTravel</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/jqvmap/dist/jqvmap.min.css">


    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->
<?php
    include './themepart/sidebar.php'
?>
    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->
    

    <div id="right-panel" class="right-panel">

       
        <?php
            include './themepart/header.php'
            ?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">

            


            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-1">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count">
                                <?php 
                                $q = mysqli_query($connection,"select count(user_id) from tbl_user");
                                $count = mysqli_fetch_row($q);
                                echo $count[0];
                                
                                ?>
                            </span>
                        </h4>
                        <p class="text-light">Total Customers</p>

                       

                    </div>

                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-2">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count">
                                <?php 
                                $q = mysqli_query($connection,"select count(booking_id) from tbl_booking");
                                $count = mysqli_fetch_row($q);
                                echo $count[0];
                                
                                ?>
                                </span>
                        </h4>
                        <p class="text-light">Total Bookings</p>

                        
                    </div>
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-3">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count">
                            <?php 
                                $q = mysqli_query($connection,"select count(package_id) from tbl_package");
                                $count = mysqli_fetch_row($q);
                                echo $count[0];
                                
                                ?>
                            </span>
                        </h4>
                        <p class="text-light">Total Packages</p>

                    </div>

                   
                </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-flat-color-4">
                    <div class="card-body pb-0">
                        
                        <h4 class="mb-0">
                            <span class="count">
                            <?php 
                                $q = mysqli_query($connection,"select count(feedback_id) from tbl_feedback");
                                $count = mysqli_fetch_row($q);
                                echo $count[0];
                                
                                ?>
                            </span>
                        </h4>
                        <p class="text-light">Total Feedback</p>

                       
                    </div>
                </div>
            </div>
            <!--/.col-->

            
            <!--/.col-->


            
            <!--/.col-->

            

            


            

            <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Recent Feedback</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                        <tr class="thead-dark">
                                            <!-- <th>Id</th> -->
                                            <th>Details</th>
                                            <th>Date</th>
                                            <th>User Name</th>
                                            <th>Reply</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
    $connection = mysqli_connect("localhost","root","","travel");
    if(isset($_GET['did']))
    {
        $id = $_GET['did'];
        $query = mysqli_query($connection,"delete from tbl_feedback where feedback_id = $id");
        if($query)
        {
            echo "<script>alert('Feedback Deleted');</script>";
        }
    }

    $sql="SELECT
    `tbl_feedback`.`feedback_id`
    , `tbl_feedback`.`feedback_details`
    , `tbl_feedback`.`feedback_date`
    , `tbl_user`.`user_name`
    , `tbl_feedback`.`feedback_reply`
FROM
    `tbl_user`
    INNER JOIN `tbl_feedback` 
        ON (`tbl_user`.`user_id` = `tbl_feedback`.`user_id`) where `tbl_feedback`.`feedback_reply` IS NULL OR  `tbl_feedback`.`feedback_reply` = ' '
ORDER BY `tbl_feedback`.`feedback_id` ASC;";


    $query = mysqli_query($connection,$sql) or die(mysqli_error($connection));

    //echo "<table border='1'>";
    //echo "<tr>";
   // echo "<th>Name</th>";
    //echo "<th>Email</th>";
   // echo "<th>Password</th>";
   // echo "<th>Mobile</th>";
    //echo "</tr>";
    
    while($row = mysqli_fetch_array($query))
    {
        echo "<tr>";
        echo " <td>{$row['feedback_details']} </td> <td>{$row['feedback_date']} </td> <td>{$row['user_name']} </td> <td>{$row['feedback_reply']} </td>";
        // echo "<td><a href='?did={$row['feedback_id']}'>Delete</a></td>";
        echo "<td> <a href='edit_feedback.php?eid={$row['feedback_id']}'> Reply </a> </td>";
        echo "</tr>";
    }
    echo "</table>";
?>
                                    
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->

            

            


        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <div id="adminPanel">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <p>Welcome, <?php echo $_SESSION['admin_name']; ?>!</p>
            <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#packages">Manage Packages</a></li>
                <li><a href="#bookings">Customer Bookings</a></li>
                <li><a href="#payments">Payment Status</a></li>
                <li><a href="admin_logout.php">Logout</a></li>
            </ul>
        </div>
        
    </div>
</body>
</html>
