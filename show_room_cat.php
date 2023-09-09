<?php
include_once 'admin/include/class.user.php'; 
$user=new User();

session_start();
if ((!$_SESSION['formStarted'])) {
    header("Location: http://localhost:8080/hotel/admin/login.php");
    exit;
}

//image directory
$imageDir = './images/';

// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;

// set maximum number of records
define('SHOWMAX', 3);

// prepare SQL to get total records
$getTotal = 'SELECT COUNT(*) FROM room_category';

// submit query and store result as $totalPix
$total = $user->db->query($getTotal);
$totalPix = $total->fetch()[0];

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
    <meta name="hotel_booking" content="" />
        <meta name="Kalu" content="" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin-Hotel Booking</title>
 <!-- external css and js files  -->
 <?php
   $links = 1;
   include 'admin/include/external-files.php'; ?>
    
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

     <!-- nav sidebar-->
    <?php 
      $nav = 1;
      include('admin/include/nav_sidebar.php');
    ?>
 
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
<!-- Main Content -->
<div id="content">

 <!-- Topbar -->
 <?php 
    $menu = 1;
    include('admin/include/topbar.php');

?>

<div class="container ">
    <div class="card-body p-0 ">
        <!-- Nested Row within Card Body -->
        <div class="row ">
            <div class="col-lg-12 mx-0 p-0">
                <div class="p-1 ">
      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
       <h1 class="h3 mb-0 text-gray-800">All Rooms</h1>
          <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
       </div>

        <div class="card shadow mb-4 ">
            <p class="my-3 text-dark text-muted mx-4 " id="picCount">Displaying <?php echo $startRow+1; 
                                 // dynamic record counter paragraph(403)
                                   if ($startRow+1 < $totalPix) {
                                        echo ' to ';
                                   if ($startRow+SHOWMAX < $totalPix) {
                                         echo $startRow+SHOWMAX;
                                    } else {
                                       echo $totalPix;
									 }
                                    }
                                    echo " of $totalPix";?></p>

        <!-- Content Row -->
        <div class="row gx-0 d-flex justify-content-center mt-3">           
        <?php
        $sql = "SELECT * FROM room_category LEFT JOIN images Using (image_id) LIMIT $startRow," . SHOWMAX;
        $result = $user->db->query($sql);
        if ($result) {
            //if(mysqli_num_rows($result) > 0) {
                if ($result->rowCount() > 0) {
                    if (isset($_GET['updated'])) {

                        echo " <div class='row'> 
                                <div class='col-md-2'></div>
                                  <div class='col-md-6'>
                                   <h4 class=''>".$user->safe($_GET['roomname'])." Updated Successfully!!</h4>
                                  </div>
                                  &nbsp;&nbsp;
                                </div>
                               </div>";
                                        
                      }
                if (isset($_GET['deleted'])) {
                        echo " <div class='row'> 
                                <div class='col-md-2'></div>
                                  <div class='col-md-6'>
                                   <h4 class=''>".$user->safe($_GET['roomname'])." DELETED Successfully!!</h4>
                                  </div>
                                  &nbsp;&nbsp;
                                </div>
                               </div>";
                                          
                      }
                while($row = $result->fetch()) {
                    if ($pos++ % COLS === 0 && !$firstRow) {
                        echo "</div><div class='row gx-0 d-flex justify-content-center mt-3 '>";
    
                     }                                       
                    echo "                        
                    <div class='col-md-3 shadow mx-4 mb-5 '>                                
                    <div class='card product-item border-0 border-top-warning mx-auto '>
                    <div class='card-header product-img position-relative overflow-hidden bg-transparent border-0 p-0'>
                      <h4 class='pt-3 text-gray-900'>".$user->safe($row['roomname'])."</h4>               
                       <hr class='divider1'>
                ";
                if ( !empty($row['semi_pic'])) {
                    $image = $imageDir . basename($row['semi_pic']);
                    if (file_exists($image) && is_readable($image)) {
                        $imageSize = getimagesize($image)[3];
                    }
                    if (!empty($imageSize)) {                        
                     echo "                                      
                       <img class='img-fluid w-100 mx-auto rounded image' src= '" .$image . "'  alt='" .$user->safe($row['caption']) . "' " .$imageSize . "                   
                            style='width:100%; '></div>
                            ";
                    } 
                } else {
                    echo "<br><br><br><h6 class='text-center'>no image</h6><br><br><br>";

                }
                echo " 
                    <hr class='divider1'>
                    <h6 class='descr mt-3'>No of Beds: ".$user->safe($row['no_bed'])." ".$user->safe($row['bedtype'])." bed.</h6>
                        <h6 class='descr'>Facilities: ".$user->safe($row['facility'])."</h6>            
                        <h6 class='descr'>Price: ".$user->safe($row['price'])." zmk/night.</h6>
                        <h6 class='text-muted ml-2'><del>$123.00</del></h6>                        
                        <div class='card-footer d-flex justify-content-between bg-light border'>
                        <a href='admin/edit_room_cat.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-primary btn-icon-split btn-sm mb-1 btn-lg mx-2'
                           role='button'>                       
                            <span class='text px-4'>Edit</span>
                            </a>                           
                            <a href='admin/delete_room_cat.php?roomname=".$user->safe($row['roomname'])."' class='btn btn-danger btn-icon-split btn-sm mb-1 btn-lg ml-2
                                    ' data-toggle='modal ' data-target='#deleteModal' data-id = '".$user->safe($row['roomname'])."' role='button'
                                    onclick='openModal("; echo $user->safe($row['room_cat_id']); echo ")'>    
                                    <span class='text '>Delete</span>
                                </a>
                            </div>
                            </div>
                            </div>                        
                           
                            "; 
                        
                        }              
                                                          
            }  else  {
                echo "NO Data Exist";
            }
        } else {
            echo "Cannot connect to server".$result;
        }
            
        if (COLS-2 > 0) {
            for ($i = 0; $i < COLS-2; $i++) {
                 echo '<div class="col-md-7 pb-1"></div>';
            }
         }   

         echo '  </div>
          <div class="row d-flex align-items-center mx-auto mb-5">
          <div class="col-4 pb-1 d-flex align-items-center justify-content-center mx-auto">
           <nav aria-label="Page navigation d-flex align-items-center mx-auto ">
             &nbsp;&nbsp;&nbsp;&nbsp;<ul class="pagination d-flex align-items-center mb-3 mx-auto">
                            <li class="page-item ">';
                                  
            // create a back link if current page greater than 0
            if ($curPage > 0) {                
                   echo '<a href="show_room_cat.php?curPage=' . ($curPage-1) . '" class="page-link" aria-label="Previous">
                   <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a>';
            } else {
               // otherwise leave the cell empty
                echo '&nbsp;';
             }
                for ($i = 1; $i <= $pages; $i++) {
                    if ($i == $curPage) {           
                        echo '
                        <li class="page-item"><a class="page-link " href="show_room_cat.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
                    } else {
                        echo '                 
                        <li class="page-item ';  if ($i == $curPage + 1) { echo " active "; } echo'"><a class="page-link" href="show_room_cat.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
                    }
                }
                // create a forward link if more records exist
                 if ($startRow+SHOWMAX < $totalPix) {
                    echo '<a href="show_room_cat.php?curPage=' . ($curPage+1) . '" class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span></a>';
                 }

                echo '</li>
                </ul>
               </nav>
              </div>
            </div>';        
              // Close the PDO connection at the end of the script or when it's no longer needed
              $user->db = null;      
        ?>
      </div>
     <!-- /.container-fluid -->
     </div>
     <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    
    <!-- Logout Modal-->
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
       
    </div>
    </div>
<!-- /.container-fluid -->

    </div>
  <!-- End of Main Content -->
  
     <?php
      include('admin-footer.php');
      ?>

    </div>
   <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <?php 
       //js external files and plugins
       $linksJs = 1;
       include 'admin/include/js-external-links.php' ?>

</body>
</html>