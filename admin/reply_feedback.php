<?php
include("../config.php");
session_start();

if (!isset($_GET['id'])) {
    echo "<script>alert('No feedback selected!'); window.location.href='feedback_list.php';</script>";
    exit;
}

$feedback_id = intval($_GET['id']);

// Fetch feedback info
$query = "SELECT * FROM feedback_table WHERE feedback_id = $feedback_id";
$result = mysqli_query($connection, $query);
$feedback = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reply_message = mysqli_real_escape_string($connection, $_POST['reply_message']);
    $update = "UPDATE feedback_table SET reply_message = '$reply_message' WHERE feedback_id = $feedback_id";

    if (mysqli_query($connection, $update)) {
        echo "<script>alert('Reply sent successfully!'); window.location.href='feedback_list.php';</script>";
    } else {
        echo "<script>alert('Error sending reply.');</script>";
    }

      // Send email
    //   $to = $feedback['user_email'];
    //   $subject = "Reply to your feedback";
    //   $message = "Hello " . $feedback['username'] . ",\n\nThanks for your feedback. Here's our response:\n\n" . $reply;
    //   $headers = "From: support@yourdomain.com";
  
    //   mail($to, $subject, $message, $headers);
  
    //   echo "<script>alert('Reply sent successfully!'); window.location.href='feedback_list.php';</script>";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reply to Feedback</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body { display: flex; }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px;
            display: block;
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover { background: #495057; }
        .content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<?php include("sidebar.php"); ?>

<div class="content">
    <?php include("navbar.php"); ?>

    <div class="container">
        <h3 class="mb-4 text-center">Reply to Feedback</h3>

        <div class="mb-3">
            <strong>User:</strong> <?php echo htmlspecialchars($feedback['username']); ?><br>
            <strong>Email:</strong> <?php echo htmlspecialchars($feedback['user_email']); ?><br>
            <strong>Submitted On:</strong> <?php echo $feedback['feedback_date']; ?>
        </div>

        <div class="mb-4">
            <strong>Feedback:</strong>
            <div class="border p-3 bg-light rounded"><?php echo nl2br(htmlspecialchars($feedback['feedback_message'])); ?></div>
        </div>

        <form method="POST">
            <label for="reply_message" class="form-label">Your Reply</label>
            <textarea name="reply_message" class="form-control" rows="5" required><?php echo htmlspecialchars($feedback['reply_message'] ?? ''); ?></textarea>

            <button type="submit" class="btn btn-success mt-3 w-100">Send Reply</button>
            <a href="feedback_list.php" class="btn btn-secondary mt-2 w-100">Cancel</a>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
