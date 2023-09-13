<?php
//close the current session
//session_write_close();

//ini_set('session.httponly', true);
//ini_set('session.secure', true);
 session_start();
 
/*session_set_cookie_params([
    'httponly' => true,
    'secure' => true,  // If using HTTPS
 ]);*/
 
 try {
 //include file(class) 
include_once 'admin/include/class.user.php';

//create object
$user = new User();

if ($_SESSION['user_level'] !== 1) {
    header("location:http://localhost:8080/hotel/index.php");  
}

//save session 'id' in variable
if (isset($_SESSION[ 'id']) && is_numeric($_SESSION[ 'id'])) {
$uid = $_SESSION[ 'id'];
} else {
    header("location:http://localhost:8080/hotel/admin/login.php");  
}

/*if (isset($_SESSION['cookie_params'])) { 
    header("location:http://localhost:8080/hotel/admin/login.php"); 
} */

// Set Content Security Policy header
//header("Content-Security-Policy: default-src 'self'; script-src 'self' example.com");

// Prevent loading external scripts
//echo '<script src="https://malicious-site.com/evil.js"></script>';  // Blocked by CSP


//if get_session function is false redirect to login page                  
if (!$user->get_session()) { 
    header("location:http://localhost:8080/hotel/admin/login.php"); 
} 

//set values to session variables 
$_SESSION['formStarted'] = true;
$_SESSION['started'] = "admin";


if($_SESSION['formStarted']) {
// Generate and store token 
if (!isset($_SESSION['hotel-sess-token'])) {
    $_SESSION[ 'hotel-sess-token'] = bin2hex(random_bytes(32));
 }
}

//logout if GET 'q' is set
if (isset($_GET['q']))  { 
   $user->user_logout();
   header("location: admin/login.php"); 
} 

//Directory for images
$imageDir = './images/';

// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;

// set maximum number of records
define('SHOWMAX', 5);

// prepare SQL to get total records
$getTotal = 'SELECT COUNT(*) FROM room_category';
// submit query and store result as $totalPix
$total = $user->db->query($getTotal);
$totalPix = $total->fetch()[0];

// prepare SQL to get total booked rooms
$getTotalBooked = 'SELECT COUNT(*) FROM room WHERE book="true"';
$totalBooked = $user->db->query($getTotalBooked);
$totalBookedRooms = $totalBooked->fetch()[0];

// set the current page (401)
$curPage = (isset ($_GET['curPage'])) ? (int) $_GET['curPage'] : 0;
$curPage = $user->safe($curPage);

// calculate the start row of the subset
$startRow = $curPage * SHOWMAX;
$pages = ceil ($totalPix/SHOWMAX);
if ($startRow > $totalPix) {    //(401)
   $startRow = 0;
   $curPage = 0;
}

if ($curPage >= $pages) {
	$startRow = 0;
    $curPage = 0;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="hotel_admin" content="" />
    <meta name="Kalu" content="" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin-Hotel Booking</title>
   <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/ht-admin-2.min.css" rel="stylesheet">
    <script language="javascript" type="text/javascript">
    <script language="javascript" type="text/javascript" src="my_js/global.js"></script>
    <script language="javascript" type="text/javascript" src="my_js/modal.js"></script>       
    </script>
    
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
 <!-- nav sidebar-->
    <?php 
    //include navigation sidebar 
    $nav = 1;
    include('admin/include/nav_sidebar.php');
    ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
<!-- Main Content -->
<div id="content">
 <!-- Topbar -->
<?php 
   //include top nav bar
    $menu = 1;
    include('admin/include/topbar.php');

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
        <a class="text-decoration-none d-flex align-items-center justify-content-center mx-auto" href="#">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Earnings (Monthly)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </a>
        </div>
    </div>
</div>

    <!-- Earnings (Annualy) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                <a class="text-decoration-none d-flex align-items-center justify-content-center" href="#">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <a class="text-decoration-none d-flex align-items-center justify-content-center" href="#">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Bookings 
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $totalBookedRooms ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 80%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        
                        <div class="col-xl-3 col-md-6 mb-4">                      
                            <div class="card border-left-warning shadow h-100 py-2">                            
                                <div class="card-body">
                                <a class="text-decoration-none d-flex align-items-center justify-content-center" href="show_room_cat.php">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Rooms</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalPix ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bed fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                    </a>
                                </div>                              
                            </div>                      
                        </div>
                    </div> 

                <?php 
                  //retrieve room data and display all records

                     $sql = "SELECT * , DATE_FORMAT(added, '%d %M, %Y  %H.%i.%S') AS ";
                     $sql .= "regdat, DATE_FORMAT(updated, '%d %M, %Y  %H.%i.%S') AS updates 
                     FROM room_category LEFT JOIN images USING (image_id) ORDER BY price LIMIT $startRow," . SHOWMAX;
                    //$sql = "SELECT * FROM room_category LEFT JOIN images Using (image_id)";
                    //$result = mysqli_query($user->db, $sql);
                    $result = $user->db->query($sql);
             
                   if ($result) { ?>
                   <!-- DataTable -->
                   <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Rooms</h6>
                        </div>

                        <!--// dynamic record counter paragraph-->
                        <p class="mt-2 ml-4 text-dark text-muted " id="picCount">Displaying <?php echo $startRow+1;            
                                   if ($startRow+1 < $totalPix) {
                                        echo ' to ';
                                   if ($startRow+SHOWMAX < $totalPix) {
                                         echo $startRow+SHOWMAX;
                                    } else {
                                       echo $totalPix;
									 }
                                    }
                                    echo " of $totalPix";?></p>


<?php
//Dispay update message 
if (isset($_GET['updated'])) {
    echo " <p class='text-success ml-4'>".$user->safe($_GET['roomname'])." Updated Successfully!!</p> ";
}

//Dispay delete message
if (isset($_GET['deleted'])) {
    echo " <p class='text-warning ml-4'>".$user->safe($_GET['roomname'])." DELETED Successfully!!</p>";

}
?>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="data-Table" width="100%" cellspacing="0">
                                    <thead>
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;Image&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Roomname</th>
                                            <th>Room Quantity</th>
                                            <th>Available</th>
                                            <th>Booked</th>
                                            <th>Number of Beds</th>
                                            <th>Bed type</th>
                                            <th>Facilities</th>
                                            <th>Price</th>
                                            <th>Last Updated</th>
                                            <th>Added</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>&nbsp;&nbsp;&nbsp;&nbsp;Image&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            <th>Roomname</th>
                                            <th>Room Quantity</th>
                                            <th>Available</th>
                                            <th>Booked</th>
                                            <th>Number of Beds</th>
                                            <th>Bed type</th>
                                            <th>Facilities</th>
                                            <th>Price</th>
                                            <th>Last Updated</th>
                                            <th>Added</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                   <?php                   
                   //if(mysqli_num_rows($result) > 0)
                    if($result->rowCount() > 0) {
                      while ($row = $result->fetch()) {
                        echo "
                        <tbody>
                        <tr>";
                        if ( !empty($row['thumb'])) {
                            $image = $imageDir . basename($row['thumb']);
                            if (file_exists($image) && is_readable($image)) {
                                $imageSize = getimagesize($image)[3];
                            }
                         if (!empty($imageSize)) { 
                               
                            echo " 
                            <td class=' py-5'>
                            <div class='card-header product-img position-relative overflow-hidden bg-transparent border-0 p-0'>
                            <img class='img-fluid w-100 mx-0  rounded image' src= '" .$image . "'  alt='" .$user->safe($row['caption']) . "' " .$imageSize . "
                            
                                     '></div></td>
                                    ";
                                } 
                          } else {
                                   echo "<td><br><h6 class='text-center'>no image</h6><br></td>";
                          }
                           echo "   <td class=' pt-5'>" .$user->safe($row['roomname']). "</td>
                                    <td class=' pt-5'>" .(int) $row['room_qnty']. "</td>
                                    <td class=' pt-5'>" .(int) $row['available']. "</td>
                                    <td class=' pt-5'>" .(int) $row['booked']. "</td>
                                    <td class=' pt-5'>" .(int) $row['no_bed']. "</td>
                                    <td class=' pt-5'>" .$user->safe($row['bedtype']). "</td>
                                    <td class=' pt-5'>" .$user->safe($row['facility']). "</td>
                                    <td class=' pt-5'> &dollar;" .$user->safe($row['price']). "</td>
                                    <td class=' pt-5'>" .$user->safe($row['updates']). "</td>
                                    <td class=' pt-5'>" .$user->safe($row['regdat']). "</td>
                                    <td>
                                    <div class='btn-group-vertical btn-group-sm' id='collapsibleMenu'  role='group' aria-label='Button Group'>
                                    <ul class='navbar-nav flex-column'>
                                    <li class='nav-item'>
                                    <a href='admin/edit_room_cat.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-primary btn-icon-split btn-sm mb-1'
                                    role='button'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-pencil-alt'></i>
                                    </span>
                                    <span class='text mr-3 pr-2'>Edit</span>
                                        </a></li>
                                        <li class='nav-item'>
                                        <a href='details.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-info btn-icon-split btn-sm mb-1'
                                        role='button'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-info-circle'></i>
                                        </span>
                                        <span class='text '>Details</span>
                                    </a></li>
                                    <li class='nav-item'>
                                    <a href='./admin/delete_room_cat.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-danger btn-icon-split btn-sm mb-1
                                    ' data-toggle='modal' data-target='#deleteModal' data-id = '".$user->safe($row['roomname'])."' role='button' 
                                      onclick='openModal("; echo $user->safe($row['room_cat_id']); echo ")' >
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-trash'></i>
                                        </span>
                                        <span class='text mr-1 '>Delete</span>
                                    </a></li>
                                    </ul>
	                               </div>
                                        
                                        </td>
                                    </tr>
                        </tbody>";
                         ?>
 
                        <!-- Delete Modal-->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="<?= $user->safe($row['roomname']) ?>"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="<?= $user->safe($row['roomname']) ?>">Are you sure you want to delete this Item<span id="delmes"></span>?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="delmes">Select "Delete" below if you are ready to delete.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="delform" method="post" action="">
                    <input name="roomname" type="hidden" value="<?=  $user->safe($row['roomname'])  ?>">
                    <input name="room_qnty" type="hidden" value="<?= (int) $row['room_qnty']  ?>">
                    <input name="room_id" type="hidden" value="<?= (int) $row['room_cat_id']  ?>">
                   
                    <a href="" class='btn btn-danger' 
                    type="submit" name="delete" id='delete' onclick="">Delete</a> 
                    
                    </form>
                </div>
            </div>
        </div>
     </div>

    <?php                       
       } 

                if (isset($_POST['delete'])) {
                    $room_id = (int) ($_POST['room_id']);
                    $roomname = $user->safe($_POST['roomname']);
                    $room_qnty = (int) ($_POST['room_qnty']);
                    $deleted = $user->delete_room_cat($roomname, $room_qnty, $room_id);
                    if ($deleted)  {
                          echo 'deleted1';
                    }

                }
           } else {
               echo "<p>NO Data Exist</p>";
           } 
        } else {
             echo "<p>Cannot connect to server  $result </p> ";
        }

?>
                  
                    </table>
                 </div>
            </div>
            <?php
                        
                    //pagination
                    echo ' 
                      <div class="row d-flex align-items-center mx-auto mb-5">
                      <div class="col-4 pb-1 d-flex align-items-center justify-content-center mx-auto">
                      <nav aria-label="Page navigation d-flex align-items-center mx-auto ">
                     &nbsp;&nbsp;&nbsp;&nbsp;<ul class="pagination d-flex align-items-center mb-3 mx-auto">
                     <li class="page-item ">';

     // create a back link if current page greater than 0
     if ($curPage > 0) {
      
         echo '<a href="admin.php?curPage=' . ($curPage-1) . '" class="page-link" aria-label="Previous">
         <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span></a>';
      } else {
     // otherwise leave the cell empty
      echo '&nbsp;';
      }

      //page number links
      for ($i = 1; $i <= $pages; $i++) {
        if ($i == $curPage) {

        echo '
        <li class="page-item"><a class="page-link" href="admin.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
       } else {
        echo '
      
      <li class="page-item ';  if ($i == $curPage + 1) { echo " active "; } echo'"><a class="page-link" href="admin.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
       }
    }
       
      // pad the final row with empty cells if more than 2 columns
       // create a forward link if more records exist
       if ($startRow+SHOWMAX < $totalPix) {
          echo '<a href="admin.php?curPage=' . ($curPage+1) . '" class="page-link" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span></a>';
       } else {
       // otherwise leave the cell empty
       echo '<span>&nbsp;</span>';
      }

      echo '
      </ul>
    </nav>
    </div>
    </div>
    ';
    ?>

              </div>
            </div>
           <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->  
     <?php
      //include footer
      include('admin-footer.php');
      ?>
    <?php                  
        // Close the PDO connection at the end of the script or when it's no longer needed
         $user->db = null;

            }  catch(Exception $e) // We finally handle any problems here
                     {
                     // print "An Exception occurred. Message: " . $e->getMessage();
                     print "The system is busy please try later";
                     // $date = date('m.d.y h:i:s');
                      echo $e->getMessage();
                     // $eMessage = $date . " | Exception Error | " , $errormessage . |\n";
                     // error_log($eMessage,3,ERROR_LOG);
                      // e-mail support person to alert there is a problem
                      // error_log("Date/Time: $date - Exception Error, Check error log for
                     //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                     // Error Log <errorlog@helpme.com>" . "\r\n");
            } catch(Error $e) {
                      // print "An Error occurred. Message: " . $e->getMessage();
                      print "The system is busy please try later";
                     // $date = date('m.d.y h:i:s');
                     echo $e->getMessage();
                     // $eMessage = $date . " | Error | " , $errormessage . |\n";
                     // error_log($eMessage,3,ERROR_LOG);
                     // e-mail support person to alert there is a problem
                     // error_log("Date/Time: $date - Error, Check error log for
                     //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                     // <errorlog@helpme.com>" . "\r\n");
            }


  ?>

    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


   <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/ht-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level plugins -->
    <script src="js/demo/datatables-demo.js"></script>
   
</body>
</html>