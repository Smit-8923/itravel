<?php
session_start();
session_destroy();
header("Location: admin_login.php"); // Redirect to homepage after logout
exit();
?>
