<?php
//page url base name
$currentPage = basename($_SERVER['SCRIPT_FILENAME']); 

?> 


<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="//localhost:8080/hotel/index.php"><h5>KaluHotel</a></h5>               
            <button class="navbar-toggler ml-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu<i class="fas fa-bars ms-1"></i>
             </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">

   <?php
	 switch ($menu) {
	case 1: //index.php
	    ?>
               <li class="nav-item "><a class="nav-link active" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="room.php">Rooms &amp; Facilities</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="reservation.php">Online Reservation</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>-->
                <!--<li class="nav-item"><a  class="nav-link" href="admin.php">Admin</a></li>-->
                <?php if (isset($_SESSION['uname'])) { ?>
                <li class="nav-item my-auto"><span class="nav-link ">                  
                     <?php
                        echo "Welcome ". $_SESSION['uname'];                           
                        ?>
                    </span></li>
                        <li class="nav-item my-auto">
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn btn-danger">Logout</button>
                        </a>
                    </li>  
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="./admin/login.php">Login</a></li>
                    <?php } ?>
       
    <?php
        break;	 	 
        case 2: // room.php & reservation.php & review.php
	    ?>        
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item >"><a class="nav-link <?php if ($currentPage == 'room.php') { echo 'active';} ?> "  href="room.php">Rooms &amp; Facilities</a></li>
                <!--<li class="nav-item "><a class="nav-link <?php if ($currentPage == 'reservation.php') { echo 'active';} ?>"  href="reservation.php">Online Reservation</a></li>
                <li class="nav-item "><a class="nav-link <?php if ($currentPage == 'review.php') { echo 'active';} ?>"  href="review.php">Review</a></li>
               <li class="nav-item"><a class="nav-link <?php if ($currentPage == 'about.php') { echo 'active';} ?>" href="#">About</a></li>-->
                  <?php if (isset($_SESSION['uname'])) { ?>
                <li class="nav-item my-auto"><span class="nav-link ">                  
                     <?php
                        echo "Welcome ". $_SESSION['uname'];                            
                        ?>
                    </span></li>                  
                    <li class="nav-item my-auto">
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn btn-danger">Logout</button>
                        </a>
                    </li>  
                     <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="./admin/login.php">Login</a></li>
                    <?php } ?>

     <?php
        break;	 	 
       case 3: // admin.php
	    ?>        
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="room.php">Rooms &amp; Facilities</a></li>
               <!-- <li class="nav-item"><a class="nav-link" href="reservation.php">Online Reservation</a></li>-->
          <?php if (isset($_SESSION['uname'])) { ?>
                <li class="nav-item my-auto"><span class="nav-link ">                 
                    <?php
                        echo "Welcome ". $_SESSION['uname'];                           
                    ?>
                    </span></li>                   
                    <li class="nav-item my-auto">
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn btn-danger">Logout</button>
                        </a>
                      </li>  
            <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="./admin/login.php">Login</a></li>
            <?php } ?>

    <?php
        break;	 	 
        case 4: // show_all_room.php
	    ?>
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="room.php">Rooms &amp; Facilities</a></li>
                <!--<li class="nav-item"><a class="nav-link" href="reservation.php">Online Reservation</a></li>
                <li class="nav-item"><a class="nav-link" href="review.php">Review</a></li>
                <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['uname'])) { ?>
                <li class="nav-item my-auto"><span class="nav-link ">
                    <?php
                        echo "Welcome ". $_SESSION['uname'];                           
                        ?>
                    </span></li>
                        <li class="nav-item my-auto">
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn btn-danger">Logout</button>
                        </a>
                    </li>  
                     <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="./admin/login.php">Login</a></li>
                    <?php } ?>
                  </ul>
    <?php
        break;	 	 
        case 5: // show_room_cat.php
	    ?>
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="room.php">Rooms &amp; Facilities</a></li>
               <!-- <li class="nav-item"><a class="nav-link" href="reservation.php">Online Reservation</a></li>               
                <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>-->
                </ul>
                <ul class="nav navbar-nav navbar-right">
                   <?php if (isset($_SESSION['uname'])) { ?>
                <li class="nav-item my-auto"><span class="nav-link ">
                  
                     <?php
                         echo "Welcome ". $_SESSION['uname'];                           
                        ?>
                    </span></li>                  
                    <li class="nav-item my-auto">
                        <a href="admin.php?q=logout">
                            <button type="button" class="btn btn-danger">Logout</button>
                        </a>
                    </li>  
                     <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="./admin/login.php">Login</a></li>
                    <?php } ?>

                </ul>
        <?php
        break;
    } ?>

                  </ul>
                </div>
            </div>
        </nav>

        <script src="js/scripts.js"></script>
        <script src="js/bootstrap.min.js"></script>