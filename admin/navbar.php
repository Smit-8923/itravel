<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand">Admin Dashboard</span>
                <div class="dropdown ms-auto">
                    <?php
                    echo '<button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> ' . $_SESSION['admin_name'].'</button>';?>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <!-- <li><a class="dropdown-item" href="changepass.php">Change Password</a></li> -->
                        <li><a class="dropdown-item" href="admin_logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>