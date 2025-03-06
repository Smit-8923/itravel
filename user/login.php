<?php
$login = false;
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "config.php";

    // Fetch and sanitize user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $sql = "select * from user_table where user_email = '$email'";
    $result = mysqli_query($connection,$sql);
    $num  = mysqli_num_rows($result);
    // Check if the user exists
    if ($num ==1) {
        // Verify the hashed password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['user_password'])) {
            $login = true;
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['user_email'] = $email;
            $_SESSION['username'] = $row['user_name'];
            
<<<<<<< HEAD:user/login.php
<<<<<<< HEAD:user/login.php
            header("Location: ../home.php");
=======
            header("Location: index.php");
>>>>>>> 21139f06e20de00239759b17b9bf7a2a636e3fcf:login.php
=======
            header("Location: index.php");
>>>>>>> 21139f06e20de00239759b17b9bf7a2a636e3fcf:login.php
            exit(); // Prevent further execution
        } else {
            $showError = "Invalid username or password.";
        }
    } else {
        $showError = "Invalid username or password.";
    }

   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body class="login-page">
    
    <?php if ($login): ?>
        <script>alert("Login Successful.");</script>
    <?php endif; ?>

    <?php if ($showError): ?>
        <script>alert("<?php echo addslashes($showError); ?>");</script>
    <?php endif; ?>

    <div class="container mt-5">
        <form action="login.php" method="post"> 
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email..." required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
        </form>
        <div class="forgot-register">
            <a href="#">Forgot Password?</a><a href="register.php">Create a New Account</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
