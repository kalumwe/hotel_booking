<?php 

session_start();

//define('ERROR_LOG','C:/Temp/logs/errors.log');

//include file(class)
include_once './include/class.user.php'; 

//create object
$user=new User();


//redirect to login page if get_session() is false
if (!$user->get_session()) { 
    header("location:http://localhost:8080/hotel/admin/login.php"); 
}

//set session variable
$_SESSION['formStarted'] = true;

//redirect to login page if session variable is false
if ((!$_SESSION['formStarted'])) {
    header("Location: http://localhost:8080/hotel/admin/login.php");
    exit;
}

// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;

// set maximum number of records
define('SHOWMAX', 5);

// prepare SQL to get total records
$getTotal = 'SELECT COUNT(*) FROM managers';

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
    <title>View Managers</title>

   <!-- Custom fonts for this template-->
   <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="../https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/ht-admin-2.min.css" rel="stylesheet">

    <script language="javascript" type="text/javascript" src="../my_js/global.js"></script>
    <script language="javascript" type="text/javascript" src="../my_js/modal.js"></script>

    <script language="javascript" type="text/javascript">
        
    </script>
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <!-- nav sidebar-->
    <?php 
      $nav = 2;
      include('./include/nav_sidebar.php');
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

    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Managers</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
        <a class="text-decoration-none d-flex align-items-center justify-content-center" href="#">
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
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">80%</div>
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
                                <a class="text-decoration-none d-flex align-items-center justify-content-center" href="#">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Managers</div>
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

                try {

                    //retrieve managers info for display
                     //$sql = "SELECT * FROM managers LIMIT $startRow," . SHOWMAX;
                     $sql = "SELECT CONCAT(last_name, ' ', first_name) AS name, uemail, age, uname, uid, ";
                     $sql .= "DATE_FORMAT(start_date, '%d %M, %Y,  %H.%i.%S') AS ";
                     $sql .= "regdat, DATE_FORMAT(updated, '%d %M, %Y,  %H.%i.%S') AS updates ";
                     $sql .= " FROM managers ORDER BY updated DESC ";
                     $sql .= " LIMIT $startRow," . SHOWMAX;
                      //$sql = "SELECT * FROM room_category LEFT JOIN images Using (image_id)";
                    //$result = mysqli_query($user->db, $sql);
                    $result = $user->db->query($sql);
             
                   if ($result) { ?>

                   <!-- DataTales Example -->
                   <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Managers</h6>
                        </div>

                        <!--// dynamic record counter paragraph(403)-->
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

//show update and delete messages
if (isset($_GET['updated'])) {
    echo " <p class='text-success ml-4'>Manager Updated Successfully!!</p> ";
}

if (isset($_GET['changed'])) {
    echo " <p class='text-success ml-4'>Your Profile is Updated Successfully!!</p> ";
}

if (isset($_GET['deleted'])) {
    echo " <p class='text-warning ml-4'>Manager DELETED!!</p>";

}

?>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="data-Table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Pofile Picture</th>
                                            <th>Name</th>
                                            <th>Userame</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Date Started</th>
                                            <th>Last Updated</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Pofile Picture</th>
                                            <th>Name</th>
                                            <th>Userame</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Date Started</th>
                                            <th>Last Updated</th>
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
                        //image location
                        $loc ="./img/dp/";
                        //if (isset($_SESSION['uname'])) { 
                            $dp = $loc. $user->safe($row['uname']).".jpg";
                       // }

                       // if ( !empty($row['uname'])) {
                           // $image = $imageDir . basename($row['thumb']);
                            if (file_exists($dp) && is_readable($dp)) {
                                $imageSize = getimagesize($dp)[3];
                                                    
                            if (!empty($imageSize)) {                               
                            echo " 
                            <td class='d-flex align-items-center justify-content-center py-4'>
                            <div class='card-header product-img position-relative overflow-hidden bg-transparent border-0 p-0'>"; 
                            echo " <img class='img  mx-0  rounded-circle image border-0 ' 
                            src= '" .$dp . "' width='80' height='80'
                            alt='" .$dp . "' " .$imageSize . " '></div></td>
                                    ";
                                } 
                            } else {
                                   echo "<td class='d-flex justify-content-center py-4'> 
                                   <div class=' product-img position-relative overflow-hidden bg-transparent border-0 p-0'>                                  
                                   <img class='img-fit rounded-circle ' 
                                      src='./img/undraw_profile.svg' width='80' height='80'></div></td>";

                            }

                           echo "   <td class=' pt-5'>" .$user->safe($row['name']). "</td>
                                    <td class=' pt-5'>" .$user->safe($row['uname']). "</td>
                                    <td class=' pt-5'>" .$user->safe($row['uemail']). "</td>
                                    <td class=' pt-5'>" .(int) $row['age']. "</td>
                                    <td class=' pt-5'>" .$user->safe($row['regdat']). "</td>
                                    <td class=' pt-5'>" .$user->safe($row['updates']). "</td>
                                    <td>
                                    <div class='btn-group-vertical btn-group-sm' id='collapsibleMenu'  role='group' aria-label='Button Group'>
                                    <ul class='navbar-nav flex-column'>
                                    <li class='nav-item'>
                                    <a href='./edit-account.php?id=".(int) $row['uid']."' class='btn btn-primary btn-icon-split btn-sm mb-1'
                                    role='button'>
                                    <span class='icon text-white-50'>
                                        <i class='fas fa-pencil-alt'></i>
                                    </span>
                                    <span class='text mr-3 pr-2'>Edit</span>
                                        </a></li>
                                        <li class='nav-item'>
                                        <a href='details.php?id=".(int) $row['uid']."' class='btn btn-info btn-icon-split btn-sm mb-1'
                                        role='button'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-info-circle'></i>
                                        </span>
                                        <span class='text '>Details</span>
                                    </a></li>
                                    <li class='nav-item'>
                                    <a href='delete_manager.php?id=".(int) $row['uid']."' class='btn btn-danger btn-icon-split btn-sm mb-1
                                    ' data-toggle='modal' data-target='#deleteModal' data-id = '".(int) $row['uid']."' role='button'
                                    onclick='openModal3("; echo $user->safe($row['uid']); echo ")'>
                                        <span class='icon text-white-50'>
                                            <i class='fas fa-trash'></i>
                                        </span>
                                        <span class='text mr-1 '>Delete</span>
                                    </a></li>
                                    </ul>
	                               </div>
                                        
                                        </td>
                                    </tr>
                        </tbody>

                           
                        "; ?>
   <!-- Logout Modal-->
   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby=""
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Are you sure you want to delete this Item<span id="delmes"></span>?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="delmes">Select "Delete" below if you are ready to delete.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form id="delform" method="post" action="">
                    
                   
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
            //$url = "http://localhost:8080/hotel_booking/show_room_cat.php";
            //header("Location: http://localhost:8080/hotel/admin.php?deleted=true&roomname=$roomname");
            //exit;
        }
    

    }
                    } else {
                        echo "<p>NO Data Exist</p>";
                    } 
                    } else {
                        echo "<p>Cannot connect to server  $result </p> ";
                    }

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
      
         echo '<a href="view-managers.php?curPage=' . ($curPage-1) . '" class="page-link" aria-label="Previous">
         <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span></a>';
      } else {
     // otherwise leave the cell empty
      echo '&nbsp;';
      }

      //dynamic page link numbers
      for ($i = 1; $i <= $pages; $i++) {
        if ($i == $curPage) {

        echo '
        <li class="page-item"><a class="page-link" href="view-managers.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
       } else {
        echo '
      
      <li class="page-item ';  if ($i == $curPage + 1) { echo " active "; } echo'"><a class="page-link" href="view-managers.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
       }
    }
      
       // create a forward link if more records exist
       if ($startRow+SHOWMAX < $totalPix) {
          echo '<a href="view-managers.php?curPage=' . ($curPage+1) . '" class="page-link" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span></a>';
       }
       // pad the final row with empty cells if more than 2 columns
       // else {
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
                  </div>
                 <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

   <!--footer-->
     <?php
      include('../admin-footer.php');
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
   <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/ht-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level plugins -->
    <script src="../js/demo/datatables-demo.js"></script>
    
</body>

</html>