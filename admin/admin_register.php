<?php
    $showAlert = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    include "../config.php";
    $adminname = $_POST['adminname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Password validation: Minimum 8 characters, at least one letter and one number
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]{8,}$/", $password)) {
        $showError = "Password must be at least 8 characters long and contain both letters and numbers.";
    } else {
        $sql = "select * from admin_table Where admin_email = '$email'";
        $result = mysqli_query($connection,$sql);
        $num = mysqli_num_rows($result);
        if($num > 0){
            $showError = "Admin Exists already";
        }
        else{
            if($cpassword == $password){
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_mobile`, `admin_dob`, `admin_password`, `admin_doj`) VALUES (NULL, '$adminname', '$email', '$mobile', '$dob', '$hash', current_timestamp());";
                $request = mysqli_query($connection, $sql);
                if($request){
                    $showAlert = true;
                    header("location: admin_login.php");
                }
            }
            else{
                $showError = "Passwords do not match.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="admin.css">
</head>
<body class="register-page">


    <?php if ($showError): ?>
        <script>alert("<?php echo addslashes($showError); ?>");</script>
    <?php endif; ?>

    <div class="container">
        <form action="admin_register.php" method="post"> 
            <div class="form-group">
                <label for="name">adminname</label>
                <input type="text" class="form-control" id="name" name="adminname" placeholder="Enter name..." required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter mail...">
            </div>
            <div class="form-group">
                <label for="mobile">Mobile No</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required placeholder="Enter mobile number...">
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Enter password">
            </div>
            <div class="form-group">
                <label for="cpassword">Confirm password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" required placeholder="Repeat password...">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="al-register">
            <span>Already Member?</span><a href="admin_login.php">Click to Login</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>