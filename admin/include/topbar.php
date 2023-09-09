<script language="javascript" type="text/javascript">
        function submitreg() {
            var form = document.srch;
            if (form.search.value == "") {
                document.getElementById('info').innerHTML = "Search something.";
                //alert("Search something.");
                form.search.focus();
                return false;
            } 
        }

        function disppear() { 
           document.getElementById('info').innerHTML = '';
        }
    </script>
   
   <?php
   $loc ="./admin/img/dp/";
   if (isset($_SESSION['uname'])) { 
      $dp = $loc. $_SESSION['uname'].".jpg";
   }
   ?>


<!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link  d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>


<?php
	 switch ($menu) {
	case 1: //files in root folder
	    ?>

<!-- Topbar Search -->
<form  method="post" action="./admin/search.php" name="srch"
    class="d-none d-sm-inline-block form-inline mr-3 ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="search"  name="search" id="search" class="form-control bg-light border-0 small" placeholder="Search for... <?php
         if (isset($missing)) { echo $missing;}?>" value="<?php if (isset($_POST['search'])) echo htmlspecialchars($_POST['search'], ENT_QUOTES); ?>"
            aria-label="Search" aria-describedby="basic-addon2" onBlur="disppear()" pattern="[^'\x22]+" title="Invalid input">
            
        <div class="input-group-append">
            <button class="btn btn-dark" type="submit" name="submit" onclick="return(submitreg());">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
        <span id='info' class='text-danger mx-3'></span>  </div>
   
</form>


<?php
        break;	 	 
    case 2: // files in admin folder
	    ?>

        <!-- Topbar Search -->
<form  method="post" action="search.php" name="srch"
    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
        <input type="text"  name="search" id="search" class="form-control bg-light border-0 small" placeholder="Search for... <?php
         if (isset($missing)) { echo $missing;}?>" value="<?php if (isset($_POST['search'])) echo htmlspecialchars($_POST['search'], ENT_QUOTES); ?>"
            aria-label="Search" aria-describedby="basic-addon2" onBlur="disppear()" pattern="[^'\x22]+" title="Invalid input">
            
        <div class="input-group-append">
        <button class="btn btn-dark" type="submit" name="submit" onclick="return(submitreg());">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
        <span id='info' class='text-danger mx-3'></span>   </div>
    
</form>


<?php
        break;
    } ?>

 <!-- Topbar Navbar -->
 <ul class="navbar-nav ml-auto">

<!-- Nav Item - Search Dropdown (Visible Only XS) -->
<li class="nav-item dropdown no-arrow d-sm-none">
    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
        aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
                <input type="text"  class="form-control bg-light border-0 small"
                    placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-dark" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</li>


  <!-- Nav Item - Alerts -->
  <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu  dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header bg-dark border-dark">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2023</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2023</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>


                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header bg-dark border-dark">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                   
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                    
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <?php
	 switch ($menu) {
	case 1: //files in root folder

        $loc ="./admin/img/dp/";
        if (isset($_SESSION['uname'])) { 
           $dp = $loc. $_SESSION['uname'].".jpg";
        }
	    ?>

        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php
if (isset($_SESSION['uname'])){
echo "{$_SESSION['uname']}";
} 
echo '</p>';?></span>

<?php if (isset($_SESSION['uname']) && file_exists($dp)) { ?>
        <img class="rounded-circle" src="<?= $dp ?>"
        alt=<?= $_SESSION['uname'] ?> width="40" height="40">
<?php } else { ?>
                                            
         <img class="img-profile rounded-circle"
            src="./admin/img/undraw_profile.svg">
<?php } ?>
    </a>

    <?php
        break;	 	 
    case 2: // files in admin folder

        $loc ="./img/dp/";
        if (isset($_SESSION['uname'])) { 
           $dp = $loc. $_SESSION['uname'].".jpg";
        }
	    ?>

        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php
if (isset($_SESSION['uname'])){
echo "{$_SESSION['uname']}";
} 
echo '</p>';?></span>

<?php if (isset($_SESSION['uname']) && file_exists($dp)) { ?>
        <img class="rounded-circle" src="<?= $dp ?>"
        alt=<?= $_SESSION['uname'] ?> width="40" height="40">
<?php } else { ?>
                                            
         <img class="img-profile rounded-circle"
            src="img/undraw_profile.svg">
<?php } ?>
    </a>

    <?php
        break;
    } ?>
	    

        
        <?php
	 switch ($menu) {
	case 1: //files in root folder
?>

    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="./admin/edit-user.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
        </a>
        <a class="dropdown-item" href="./admin/change-password.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>
    </div>

    <?php
        break;	 	 
    case 2: // files in admin folder
        ?>

         <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <a class="dropdown-item" href="./edit-user.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
        </a>
        <a class="dropdown-item" href="./change-password.php">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
        </a>
        <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal2">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
        </a>
    </div>

    
    <?php
        break;
    } ?>

</li>

</ul>

</nav>
<!-- End of Topbar -->


 <!-- Logout Modal root folder -->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="admin.php?q=logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal admin folder -->
 <div class="modal fade" id="logoutModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../admin.php?q=logout">Logout</a>
                </div>
            </div>
        </div>
    </div>
