<?php
include 'config.php'; // Database connection

$limit = 3;
$sql = "SELECT username, feedback_message FROM feedback_table ORDER BY feedback_date DESC LIMIT $limit";
$result = mysqli_query($connection, $sql);
?>

<div class="container">
    <div class="section_title text-center mb-5">
        <h2>Customer Reviews</h2>
        <p>See what our happy customers are saying</p>
    </div>
</div>

<div class="testimonial_area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="testmonial_active owl-carousel">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="single_carousel">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="single_testmonial text-center">
                                        <p>"<?php echo htmlspecialchars($row['feedback_message']); ?>"</p>
                                        <div class="testmonial_author">
                                            <h3>- <?php echo htmlspecialchars($row['username']); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="text-center mt-5">
                    <a href="all_feedback.php" class="boxed-btn4">View More</a>
                </div>
            </div>
        </div>
    </div>
</div>
