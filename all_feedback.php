<?php
include 'config.php'; // Database connection

$sql = "SELECT username, feedback_message FROM feedback_table ORDER BY feedback_date DESC";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTravel</title>
    <link rel="stylesheet" href="css/view_feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
       

</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">All Customer Reviews</h2>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="review-card">
            <p class="review-text">"<?php echo htmlspecialchars($row['feedback_message']); ?>"</p>
            <p class="review-author">- <?php echo htmlspecialchars($row['username']); ?></p>
        </div>
    <?php } ?>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">Back to Home</a>
    </div>
</div>

</body>
</html>
