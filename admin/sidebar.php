<div class="sidebar">
    <h4 class="text-center">iTravel Admin</h4>

    <a href="admin_dashboard.php" class="d-flex align-items-center">
        <i class="bi bi-speedometer2 me-2"></i> <span>Dashboard</span>
    </a>

    <div class="dropdown">
        <a href="javascript:void(0);" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#categoryMenu">
            <i class="bi bi-folder me-2"></i> <span>Category</span>
        </a>
        <div id="categoryMenu" class="collapse ms-3">
            <a href="add_category.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add Category</span></a>
            <a href="manage_category.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Manage Category</span></a>
        </div>
    </div>
    <div class="dropdown">
            <a href="javascript:void(0);" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#hotelMenu">
                <i class="bi bi-building me-2"></i> <span>Hotels</span>
            </a>
            <div id="hotelMenu" class="collapse ms-3">
                <a href="add_hotel.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add Hotel</span></a>
                <a href="manage_hotel.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Manage Hotels</span></a>
            </div>
        </div>

    <div class="dropdown">
        <a href="javascript:void(0);" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#packagesMenu">
            <i class="bi bi-box me-2"></i> <span>Packages</span>
        </a>
        <div id="packagesMenu" class="collapse ms-3">
            <a href="add_package.php" class="d-flex align-items-center"><i class="bi bi-plus-circle me-2"></i> <span>Add Package</span></a>
            <a href="manage_package.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Manage Packages</span></a>
        </div>
    </div>


    <a href="booking_list.php" class="d-flex align-items-center">
        <i class="bi bi-calendar-check me-2"></i> <span>Bookings</span>
    </a>

    <a href="payment_list.php" class="d-flex align-items-center">
        <i class="bi bi-credit-card me-2"></i> <span>Payments</span>
    </a>
    <div class="dropdown">
        <a href="javascript:void(0);" class="d-flex align-items-center dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#usersMenu">
            <i class="bi bi-people me-2"></i> <span>Manage Users</span>
        </a>
        <div id="usersMenu" class="collapse ms-3">
            <a href="admin_list.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>Admin List</span></a>
            <a href="user_list.php" class="d-flex align-items-center"><i class="bi bi-list-check me-2"></i> <span>User List</span></a>
        </div>
    </div>


    
    <a href="feedback_list.php" class="d-flex align-items-center">
        <i class="bi bi-chat-left-text me-2"></i> <span>User Feedback</span>
    </a>
    <a href="contact_list.php" class="d-flex align-items-center">
        <i class="bi bi-telephone me-2"></i> <span>Contact</span>
    </a>
</div>
