<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

<?php
switch ($nav) {
	case 1: //files in root folder
?>

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="admin.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-"></i>
    </div>
    <div class="sidebar-brand-text mx-3  text-warning">Hotel Booking Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link active" href="admin.php">
        <i class="fas fa-fw fa-tachometer-alt fa-beat"></i>
        <span>Dashboard</span></a>
</li>
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Room Category
</div>

<!-- Nav Item - Pages Collapse Menu -->
 <!-- Nav Item - Add Room Category -->
 <li class="nav-item">
    <a class="nav-link" href="admin/addroom.php" >
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Add Room Category</span></a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-empty fa-bed"></i>
        <span>Rooms</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="show_room_cat.php">Show All Room Categories</a>
            <a class="collapse-item " href="show_room_cat.php">Edit Room</a>
        </div>
    </div>
</li>
<!-- Bookings -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
<span>Bookings</span></a>

</div>

<li class="nav-item">
    <a class="nav-link " href="room.php">
        <i class="fas fa-calendar"></i>
        <span>Book now</span></a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooked" aria-expanded="true"
        aria-controls="collapseBooked">
        <i class="fas fa-bed"></i>
        <span>Booked Rooms</span>
    </a>
    <div id="collapseBooked" class="collapse" aria-labelledby="headingBooked"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="show_all_room.php">Show All Booked Rooms</a>
            <a class="collapse-item " href="show_all_room.php">Edit Booked Room</a>
        </div>
    </div>
</li>
<!-- Manager -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
<span>Manager</span></a>
</div>


<li class="nav-item">
    <a class="nav-link " href="admin/registration.php">
        <i class="fas fa-solid fa-user-plus"></i>
        <span>Add Manager</span></a>
</li>
<li class="nav-item">
    <a class="nav-link " href="admin/view-managers.php">
        <i class="fas fa-solid fa-users"></i>
        <span>View Managers</span></a>
</li>
<!-- Account -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
<span>Account</span></a>

</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="true"
        aria-controls="collapseAccount">
        <i class="fas fa-fw fa-cog"></i>
        <span>Accout Settings</span>
    </a>
    <div id="collapseAccount" class="collapse" aria-labelledby="headingAccount"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="admin/edit-user.php">Edit Account</a>
            <a class="collapse-item" href="admin/change-password.php">Change Password</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link" href="admin.php?q=logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span></a>
</li>

<?php
    break;	 	 
    case 2: // files in admin folder
 ?>

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center my-3" href="../admin.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-"></i>
    </div>
    <div class="sidebar-brand-text mx-3  text-warning">Hotel Booking Admin</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link active" href="../admin.php">
        <i class="fas fa-fw fa-tachometer-alt fa-beat"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
Room Category
</div>

<!-- Nav Item - Pages Collapse Menu -->
 <!-- Nav Item - Add Room Category -->
 <li class="nav-item">
    <a class="nav-link" href="./addroom.php" >
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Add Room Category</span></a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-empty fa-bed"></i>
        <span>Rooms</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="../show_room_cat.php">Show All Room Categories</a>
            <a class="collapse-item " href="../show_room_cat.php">Edit Room</a>
        </div>
    </div>
</li>
<!-- Bookings -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
<span>Bookings</span></a>

</div>

<li class="nav-item">
    <a class="nav-link " href="../room.php">
        <i class="fas fa-calendar"></i>
        <span>Book now</span></a>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBooked" aria-expanded="true"
        aria-controls="collapseBooked">
        <i class="fas fa-bed"></i>
        <span>Booked Rooms</span>
    </a>
    <div id="collapseBooked" class="collapse" aria-labelledby="headingBooked"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="../show_all_room.php">Show All Booked Rooms</a>
            <a class="collapse-item " href="../show_all_room.php">Edit Booked Room</a>
        </div>
    </div>
</li>
<!-- Manager -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
<span>Manager</span></a>

</div>


<li class="nav-item">
    <a class="nav-link " href="./registration.php">
        <i class="fas fa-solid fa-user-plus"></i>
        <span>Add Manager</span></a>
</li>
<li class="nav-item">
    <a class="nav-link " href="./view-managers.php">
        <i class="fas fa-solid fa-users"></i>
        <span>View Managers</span></a>
</li>
<!-- Account -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
<span>Account</span></a>

</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="true"
        aria-controls="collapseAccount">
        <i class="fas fa-fw fa-cog"></i>
        <span>Accout Settings</span>
    </a>
    <div id="collapseAccount" class="collapse" aria-labelledby="headingAccount"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item " href="./edit-user.php">Edit Account</a>
            <a class="collapse-item" href="./change-password.php">Change Password</a>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link" href="../admin.php?q=logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span></a>
</li>


    <?php
        break;
    } ?>



<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
<button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>


    <!-- Sidebar Message -->
    <!--<div class="sidebar-card  d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>Hotel Admin Pro</strong> is packed with premium features and more!</p>
                <a class="btn btn-success btn-sm" href="#">Subscribe for more!</a>
            </div>-->

</ul>
<!-- End of Sidebar -->