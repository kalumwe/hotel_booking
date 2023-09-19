<?php
ob_start();
session_start();

include_once 'include/class.user.php'; 
$user=new User(); 
$add_errors = array();
$imageDir = '../images/';
$missing ="";

//define('ERROR_LOG','C:/Temp/logs/errors.log');

if(empty($_GET['search']) || !isset($_GET['search'])) {
    header("Location: http://localhost:8080/hotel/admin.php");
}
  
if (!$user->get_session()) { 
    header("location:http://localhost:8080/hotel/admin/login.php"); 
}

if ((!$_SESSION['formStarted'])) {
    header("Location: http://localhost:8080/hotel/admin/login.php");
    exit;
}

try {

// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;

// set maximum number of records
define('SHOWMAX', 30);

// prepare SQL to get total records
$getTotal = 'SELECT COUNT(*) FROM room_category';

// submit query and store result as $totalPix
$total = $user->db->query($getTotal);
$totalPix = $total->fetch()[0];

$search = $user->safe(trim($_GET['search'])); 

$searchTotal =  "SELECT COUNT(*) FROM room_category LEFT JOIN images Using (image_id) WHERE (roomname LIKE '%$search%') OR (bedtype LIKE '%$search%')
OR (roomname LIKE '%$search%') OR (facility LIKE '%$search%')";
// submit query and store result as $totalPix
$total = $user->db->query($searchTotal);
$totalSrch = $total->fetch()[0]; 

// set the current page (401)
$curPage = (isset ($_GET['curPage'])) ? (int) $_GET['curPage'] : 0;
$curPage = $user->safe($curPage);

// calculate the start row of the subset
$startRow = $curPage * SHOWMAX;
$pages = ceil ($totalSrch/SHOWMAX);
if ($startRow > $totalSrch) {    //(401)
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
    <title>Admin Search Results Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- external css and js files  -->
   <?php
   $links = 2;
   include './include/external-files.php'; ?>
  
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

    <!-- nav sidebar-->
    <?php 
     $nav = 2;
    include('include/nav_sidebar.php');
    ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

 <!-- Topbar -->
 <?php 
    $menu = 2;
    include('./include/topbar.php');

?>

<div class="container ">
    <div class="card-body p-0 ">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-12 mx-0 p-0">
                <div class="p-1 ">

    <?php
    $ok = false;
    $search = $user->safe(trim($_GET['search']));
    if ((!empty($search)) && (strlen($search) <= 30)) {
        // remove ability to create link in email
        $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
        $search = preg_replace($patterns," ", $search);
        $search = filter_var( $search, FILTER_SANITIZE_STRING);
        $search = (filter_var($search, FILTER_SANITIZE_STRIPPED));
        $ok = true;
    }  else {	
        echo 'Search input missing or exceeded max number of characters.';
    }
    if ($ok) {
       $sql = "SELECT * FROM room_category LEFT JOIN images Using (image_id) WHERE (roomname LIKE '%$search%') OR (bedtype LIKE '%$search%')
               OR (roomname LIKE '%$search%') OR (facility LIKE '%$search%') LIMIT $startRow," . SHOWMAX;
    
    $result = $user->db->query($sql);
    if ($result) { ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
             <div class="card-header py-3">
                 <h6 class="m-0 font-weight-bold text-primary">All Searched Rooms</h6>
             </div>
             <!--// dynamic record counter paragraph(403)-->
             <p class="mt-2 ml-4 text-dark text-muted " id="picCount">Displaying <?php echo $startRow+1;            
                        if ($startRow+1 < $totalSrch) {
                             echo ' to ';
                        if ($startRow+SHOWMAX < $totalSrch) {
                              echo $startRow+SHOWMAX;
                         } else {
                            echo $totalSrch;
                          }
                         }
                         echo " of $totalSrch search results.";?></p>

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
                 <td class=''>
                 <div class='card-header product-img position-relative overflow-hidden bg-transparent border-0 p-0'>
                 <img class='img-fluid w-100 mx-auto rounded image' src= '" .$image . "'  alt='" .$user->safe($row['caption']) . "' " .$imageSize . "                
                         style='width:100%; '></div></td>
                         ";
                     } 
                 } else {
                        echo "<td><br><h6 class='text-center'>no image</h6><br></td>";

                     }
                echo "   <td>" .$user->safe($row['roomname']). "</td>
                         <td>" .(int) $row['room_qnty']. "</td>
                         <td>" .(int) $row['available']. "</td>
                         <td>" .(int) $row['booked']. "</td>
                         <td>" .(int) $row['no_bed']. "</td>
                         <td>" .$user->safe($row['bedtype']). "</td>
                         <td>" .$user->safe($row['facility']). "</td>
                         <td> &dollar;" .$user->safe($row['price']). "</td>
                         <td>" .$user->safe($row['updated']). "</td>
                         <td>" .$user->safe($row['added']). "</td>
                         <td>
                         <div class='btn-group-vertical btn-group-sm' id='collapsibleMenu'  role='group' aria-label='Button Group'>
                         <ul class='navbar-nav flex-column'>
                         <li class='nav-item'>
                         <a href='edit_room_cat.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-primary btn-icon-split btn-sm mb-1'
                         role='button'>
                         <span class='icon text-white-50'>
                             <i class='fas fa-flag'></i>
                         </span>
                         <span class='text mr-3 pr-2'>Edit</span>
                             </a></li>
                             <li class='nav-item'>
                             <a href='../details.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-info btn-icon-split btn-sm mb-1'
                             role='button'>
                             <span class='icon text-white-50'>
                                 <i class='fas fa-info-circle'></i>
                             </span>
                             <span class='text '>Details</span>
                         </a></li>
                         <li class='nav-item'>
                         <a href='delete_room_cat.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-danger btn-icon-split btn-sm mb-1
                         ' data-toggle='modal' data-target='#deleteModal' data-id = '".$user->safe($row['roomname'])."' role='button'>
                             <span class='icon text-white-50'>
                                 <i class='fas fa-trash'></i>
                             </span>
                             <span class='text mr-1 '>Delete</span>
                         </a></li>
                         </ul>
                        </div>                            
                        </td>
                    </tr>
             </tbody>  "; ?>

             <!-- Logout Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
 <div class="modal-content">
     <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete?</h5>
         <button class="close" type="button" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">×</span>
         </button>
     </div>
     <div class="modal-body">Select "Delete" below if you are ready to delete <?= $user->safe($row['roomname']) ?>.</div>
     <div class="modal-footer">
         <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
         <form id="delform" method="post" action="admin.php">
         <input name="roomname" type="hidden" value="<?=  $user->safe($row['roomname'])  ?>">
         <input name="room_qnty" type="hidden" value="<?= (int) $row['room_qnty']  ?>">
         <input name="room_id" type="hidden" value="<?= (int) $row['room_cat_id']  ?>">
        
          <input type="submit" name="delete" value="Delete" class="btn btn-danger">
         
         </form>
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
            //$url = "http://localhost:8080/hotel_booking/show_room_cat.php";
            //header("Location: http://localhost:8080/hotel/admin.php?deleted=true&roomname=$roomname");
            //exit;
        }
    }
                    } else {
                        echo "<p>NO Records found!</p>";
                    } 
                    } else {
                        echo "<p>Cannot connect to server  $result </p> ";
                    }
                } else {
                  
                }

               ?>
                  
                            </table>
                            </div>
                        </div>
                        <?php                  
                    echo ' 
<div class="row d-flex align-items-center mx-auto mb-5">
<div class="col-4 pb-1 d-flex align-items-center justify-content-center mx-auto">
<nav aria-label="Page navigation d-flex align-items-center mx-auto ">
&nbsp;&nbsp;&nbsp;&nbsp;<ul class="pagination d-flex align-items-center mb-3 mx-auto">
                  <li class="page-item ">';
  
     // create a back link if current page greater than 0
     if ($curPage > 0) {    
         echo '<a href="search.php?search='. $search . '&curPage=' . ($curPage-1) . '" class="page-link" aria-label="Previous">
         <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span></a>';
      } else {
     // otherwise leave the cell empty
      echo '&nbsp;';
      }

      for ($i = 1; $i <= $pages; $i++) {
        if ($i == $curPage) {

        echo '
        <li class="page-item"><a class="page-link " href="search.php?search='. $search . '&curPage=' . $i-1 . '">' . $i . '</a></li>';
       } else {
        echo '
      
      <li class="page-item ';  if ($i == $curPage + 1) { echo " active "; } echo'"><a class="page-link" href="search.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
       }
    }
       // create a forward link if more records exist
       if ($startRow+SHOWMAX < $totalSrch) {
          echo '<a href="search.php?search='. $search . '&curPage=' . ($curPage+1) . '" class="page-link" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span></a>';
       }// else {
       // otherwise leave the cell empty
       //echo '&nbsp;';
      //}
      echo '</li>
      </ul>
    </nav>
    </div>
    </div>
    ';
    ?>                       
                </div>
                <!-- /.container-fluid -->
             </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
     </div>
    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
 <!-- footer -->
 <?php
      include('../admin-footer.php');
      ?>

<?php 
       //js external files and plugins
       $linksJs = 1;
       include './include/js-external-links.php' ?>   
<?php 
        // Close the PDO connection at the end of the script or when it's no longer needed
        $user->db = null;

        }  catch(Exception $e) // We finally handle any problems here
        {
            // print "An Exception occurred. Message: " . $e->getMessage();
            echo "Data can't be retrieved";
            // $date = date('m.d.y h:i:s');
             echo $e->getMessage();
            // $eMessage = $date . " | Exception Error | ," .$e->getMessage() . |\n";
            // error_log($eMessage,3,ERROR_LOG);
             // e-mail support person to alert there is a problem
             // error_log("Date/Time: $date - Exception Error, Check error log for
            //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
            // Error Log <errorlog@helpme.com>" . "\r\n");
        } catch(Error $e) {
             // print "An Error occurred. Message: " . $e->getMessage();
             echo "Data cannot be retrieved";
            // $date = date('m.d.y h:i:s');
            echo $e->getMessage();
            // $eMessage = $date . " | Error | ," . $e->getMessage() . |\n";
            // error_log($eMessage,3,ERROR_LOG);
            // e-mail support person to alert there is a problem
            // error_log("Date/Time: $date - Error, Check error log for
            //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
            // <errorlog@helpme.com>" . "\r\n");
       }
?>


</body>
</html>

    