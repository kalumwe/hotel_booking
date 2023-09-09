<?php
session_start();

try {

include_once 'admin/include/class.user.php'; 
$user=new User();

$menu = 2;
$imageDir = './images/';
//$safe = $user->safe();

// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;

// set maximum number of records
define('SHOWMAX', 6);

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
    <title>Hotel Booking</title>  
    <?php require_once('./includes/plugins.php'); ?>
    
<style>
     body {
          background-image: linear-gradient(rgba(47, 23, 15, 0.2), rgba(47, 23, 15, 0.3)), url("./images/home_bg.jpg");
          background-attachment: fixed;
          background-position: center;
          background-size: cover;
   } 

#picCount {
    margin-left: 2rem;
}

</style>        
</head>

<body>   
<?php
    include('admin/include/header.php');
?>       
      <br><br><br><br>
      <div class='row d-sm-flex justify-content-center my-5'>	   
        <h5 class="mt-5 text-primary " id="picCount">Displaying <?php echo $startRow+1;  // dynamic record counter 
                if ($startRow+1 < $totalPix) {
                     echo ' to ';
                    if ($startRow+SHOWMAX < $totalPix) {
                    echo $startRow+SHOWMAX;
                    } else {
                         echo $totalPix;
					}
                }
                echo " of $totalPix";?></h5>

<?php
    if (isset($_GET['updated'])) {
       echo " <div class='row'> 
        <div class='col-md-2'></div>
          <div class='col-md-6'>
           <h5 class='text-warning'>".$user->safe($_GET['roomname'])." Updated Successfully!!</h5>
          </div>
          &nbsp;&nbsp;
        </div>
       </div>";

}                     
        $sql = "SELECT * FROM room_category LEFT JOIN images Using (image_id) LIMIT $startRow," . SHOWMAX;
        $result = $user->db->query($sql);      
        if ($result) {
            if($result->rowCount() > 0) {
                // if remainder is 0 and not first row, close row and start new one(398)
                // if ($pos++ % COLS === 0 && !$firstRow) {
                 //  echo "<div><div class='row'>";
                //  }
                // once loop begins, this is no longer true
                $firstRow = false;
            // }
              while ($row = $result->fetch()) {
                if ($pos++ % COLS === 0 && !$firstRow) {
                    echo "</div><div class='row d-sm-flex justify-content-center my-5'>";
                 }                    
                    echo "                          
                        <div class='col-md-3 d-flex justify-content-center align-items-center shadow well mx-5 '>
                         <div class='card  product-item border-0 mx-auto mb-1'>                           
                        <div class='card-body p-2 '>
                         <h4>".$user->safe($row['roomname'])."</h4><hr class='divider1'>";
                         if ( !empty($row['semi_pic'])) {
                            $image = $imageDir . basename($row['semi_pic']);
                            if (file_exists($image) && is_readable($image)) {
                                $imageSize = getimagesize($image)[3];
                            }
                         if (!empty($imageSize)) {                               
                            echo " 
                            <div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'>
                            <img class='img-fluid w-100 mx-auto rounded image' src= '" .$image . "'  alt='" .$user->safe($row['caption']) . "' 
                            " .$imageSize . "  style='width:100%; '></div>
                                    ";
                                } 
                            } else {
                                   echo "<br><br><br><br><br><br><h6 class='text-center'>no image</h6><br><br><br><br><br><br>";
                                }
                            echo "                             
                            <h6 class='descr my-3'>No of Beds: ".$user->safe($row['no_bed'])." ".$user->safe($row['bedtype'])." bed.</h6>
                                <h6 class='descr my-3'>Facilities: ".$user->safe($row['facility'])."</h6>                                
                                <h6 class='descr my-3'>Price: ".$user->safe($row['price'])." zmk/night.</h6><h6 class='text-muted ml-2'><del>$123.00</del></h6>                              
                                <div class='card-footer d-flex justify-content-between bg-light border'>
                              <a href='./booknow.php?roomname=".$user->safe($row['roomname'])."'><button class='btn btn-success btn-lg button'>Book now</button></a>           
                            <a href='./details.php?id=".(int) $row['room_cat_id']."'><button class='btn btn-info btn-lg button'>View Details</button></a>
                            </div>
                            </div>
                            </div>
                            </div> ";

                            }      
                           // while ($pos++ % COLS) {  //this second loop is not nested inside the first. It runs only after the first loop has ended.(398)
                               // echo "<div class='col-md-4'></div>"; } // check if have an incomplete row at botttom of the table n insert empty cell.                                
                } else {
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
          echo '</div>
          <div class="row d-flex align-items-center mx-auto mb-5">
          <div class="col-4 pb-1 d-flex align-items-center justify-content-center mx-auto">
            <nav aria-label="Page navigation d-flex align-items-center mx-auto ">
               &nbsp;&nbsp;&nbsp;&nbsp;<ul class="pagination d-flex align-items-center mb-3 mx-auto">
                 <li class="page-item ">';                  
               // create a back link if current page greater than 0
               if ($curPage > 0) {
                
                   echo '<a href="room.php?curPage=' . ($curPage-1) . '" class="page-link" aria-label="Previous">
                   <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span></a>';
                } else {
               // otherwise leave the cell empty
                echo '&nbsp;';
                }
      //page link number        
      for ($i = 1; $i <= $pages; $i++) {
        if ($i == $curPage) {

        echo '
        <li class="page-item"><a class="page-link" href="room.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
       } else {
        echo '
      
      <li class="page-item ';  if ($i == $curPage + 1) { echo " active "; } echo'">
      <a class="page-link" href="room.php?curPage=' . $i-1 . '">' . $i . '</a></li>';
       }
    }
                // create a forward link if more records exist
                 if ($startRow+SHOWMAX < $totalPix) {
                    echo '
                    <li class="page-item ">
                    <a href="room.php?curPage=' . ($curPage+1) . '" class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span></a>';
                 }
                echo '</li>
                </ul>
              </nav>
            </div>
        </div> ';

?>                                              
  
<!-- footer-->
<?php 
    include('./footer.php');   
     // Close the PDO connection at the end of the script or when it's no longer needed
     $user->db = null;
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php 
}  catch (Exception $e) {
    ob_end_clean();
 header('Location: http://localhost/phpsols/error.php');
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