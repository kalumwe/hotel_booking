<?php
session_start();
try {

    //include class(User)
    include_once 'admin/include/class.user.php'; 

    //create object
    $user=new User(); 

    //initialize variables
    $book_errors = array();
    $result = false;

    //header menu option
    $menu = 2;
    

   // if(isset($_REQUEST[ 'submit'])) { 
       // extract($_REQUEST);

    //image location
    $imageDir = './images/';



// define number of columns in table
define('COLS', 3);

// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;

// set maximum number of records
define('SHOWMAX', 6);

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

//SANITIZE AND VALIDATE user input
    $checkin = trim($user->safe($_POST['checkin']));
    //$checkin = filter_var( $_POST['checkin'], FILTER_SANITIZE_STRING);  		
     if (!empty($checkin))  {	
         $checkin = filter_var($checkin, FILTER_SANITIZE_STRING); 					
        // $checkin = (filter_var($checkin, FILTER_SANITIZE_STRIPPED));	
     } else {	
         $book_errors[] = 'Check-in date is required.';
     }
     
     $checkout = trim($user->safe($_POST['checkout']));
     //$checkout = filter_var( $_POST['checkout'], FILTER_SANITIZE_STRING);  		
     if (!empty($checkout))  {					
         //Sanitize 	
         $checkout = filter_var($checkout, FILTER_SANITIZE_STRING);
         //$checkout = (filter_var($checkout, FILTER_SANITIZE_STRIPPED));	
     } else {	
         $book_errors[] = 'Check-in date is required.';
     }

     //get all errors
     $errors = array_merge($book_errors, $user->getErrors());
  


// prepare SQL to get total records
//$getTotal = 'SELECT COUNT(*) FROM room_category';
$getTotal = "SELECT DISTINCT COUNT(room_cat)  FROM room WHERE room_id NOT IN (SELECT DISTINCT room_id
                    FROM room WHERE (checkin <= '$checkin' AND checkout >= '$checkout') OR (checkin >= '$checkin' 
                     AND checkin <= '$checkout') OR (checkin <= '$checkin' AND checkout >= '$checkin') )";

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

       

       

     //if (empty($errors)) {
         
         //$result = $user->check_available($checkin, $checkout);

        // if (!($result)) {
         // echo $result;
         
      //}
 //}

     if (empty($errors)) {
     
         $result = $user->check_available($checkin, $checkout);
           
            /* $sql="SELECT DISTINCT room_cat FROM room WHERE room_id NOT IN (SELECT DISTINCT room_id
             FROM room WHERE (checkin <= :check_in AND checkout >= :check_out) OR (checkin >= :check_in 
              AND checkin <= :check_out) OR (checkin <= :check_in AND checkout >= :check_in) )";
             $stmt = $user->db->prepare($sql);
             $stmt->bindParam(':check_in', $checkin, PDO::PARAM_STR);
             $stmt->bindParam(':check_out', $checkout, PDO::PARAM_STR);
             $stmt->execute();
             //$result = $stmt->execute();

             if (isset($stmt)) {
                 $errors = $stmt->errorInfo()[2];
                 $errors = "Data cant be retrieved";
             }*/
           
         }
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

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/show_room.css" type="text/css">

    <link rel="apple-touch-icon" href="assets/img1/">
    <link rel="shortcut icon" type="image/x-icon" href="assets/favicon.ico">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

     <!-- Font Awesome icons (free version)-->
     <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />   
        <link href="css/bootstrap.min.css" rel="stylesheet">
         
        <!-- Core theme CSS (includes Bootstrap)-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    
      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link href="css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".datepicker" ).datepicker({
                  dateFormat : 'yy-mm-dd'
                });
  } );
  </script>
    
   <style>
   body {
  background-image: linear-gradient(rgba(47, 23, 15, 0.2), rgba(47, 23, 15, 0.3)), url("./images/home_bg.jpg");
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
} 
#wrapper {
    overflow: hidden;
}
</style>   
</head>

<body >
 
    <!--Header-->
    <?php
        include('admin/include/header.php');
        ?>

       <br><br><br><br><br><br><div class="container">
      
       <div class='row mt-5'>
        <div class='col-lg-3'></div>
        <div class='col-lg-6 id="contactForm'>
        <?php
            if (isset($errors) && !empty($errors)) {
                echo '<ul>';
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo '</ul>';
            }
            ?>
            <div class='card  border-light-subtle border-opacity-25 mb-3 bg-white bg-opacity-25 rounded-4'>
                <div class='card-body mb-3'>
         <form action="reservation.php"   method="post" name="room_category" data-sb-form-api-token="API_TOKEN" class='m-5 p-3'
         >
          <!-- checkin input-->
          <div class="form-floating mb-3">
                <input class="form-control" id="checkin" type="text" data-sb-validations="required"
                placeholder="2023-05-18" name="checkin"
                value = "<?php if (isset($_POST['checkin'])) echo $user->safe($_POST['checkin']); ?>"> 
                <label for="checkin">Check In :</label>
                <div class="invalid-feedback" data-sb-feedback="checkin:required">Check-in date is required.</div>

             </div>

              <!-- checkout input-->
          <div class="form-floating mb-3 mt-4">
                <input class="form-control" id="checkout" type="text"  data-sb-validations="required"
                placeholder="2023-05-20"  name="checkout"
                value = "<?php if (isset($_POST['checkout'])) echo $user->safe($_POST['checkout']); ?>"> 
                <label for="checkin">Check Out :</label>
                <div class="invalid-feedback" data-sb-feedback="checkin:required">Check-out date is required.</div>

             </div>
                            
             <!-- Submit success message-->
             <!---->
              <!-- This is what your users will see when the form-->
             <!-- has successfully submitted-->
             <div class="d-none" id="submitSuccessMessage">
              <div class="text-center mb-3">
              <div class="fw-bolder">Form submission successful!</div>
              <br />
               <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
               </div>
              </div>
                 <!-- Submit error message-->
               <!---->
                  <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                <!-- Submit Button-->
                <div class="d-grid"><button class="btn btn-primary btn-lg mt-4 py-3" id="submitButton" type="submit" name="submit">Check Availability</button></div>
            
            </form>
               </div>
               </div>
               </div>
           <div class="col-lg-3"></div>
               </div>
               </div>

           <div class='row d-flex justify-content-center mt-3'>	
            
<?php   
       
       if(isset($_REQUEST[ 'submit'])) {

        
     if (empty($errors)) {    
        //$result = $user->check_available($checkin, $checkout);   
        
           $sql="SELECT DISTINCT room_cat FROM room WHERE room_id NOT IN (SELECT DISTINCT room_id
            FROM room WHERE (checkin <= :check_in AND checkout >= :check_out) OR (checkin >= :check_in 
             AND checkin <= :check_out) OR (checkin <= :check_in AND checkout >= :check_in) ) LIMIT $startRow," . SHOWMAX ;
            $stmt = $user->db->prepare($sql);
            $stmt->bindParam(':check_in', $checkin, PDO::PARAM_STR);
            $stmt->bindParam(':check_out', $checkout, PDO::PARAM_STR);
            $stmt->execute();
            //$result = $stmt->execute();

            if (isset($stmt)) {
                $errors = $stmt->errorInfo()[2];
                $errors = "Data cant be retrieved";
            }         
        }
           // if(mysqli_num_rows($result) > 0) {
            if ($stmt->rowCount() > 0) {
                    //if ($result[0] > 0) {
                //while($row = mysqli_fetch_array($result)) {
                while ($row = $stmt->fetch()) {
                    //while ($row = $result[1]) {
                    $room_cat = $row['room_cat'];
                    //$sql = "SELECT * FROM room_category WHERE roomname='$room_cat'";
                   // $query = mysqli_query($user->db, $sql);
                    //$row2 = mysqli_fetch_array($query);

                    $sql1 = "SELECT * FROM room_category LEFT JOIN images Using (image_id) WHERE roomname='$room_cat' LIMIT $startRow," . SHOWMAX ;
                    $query = $user->db->query($sql1);
                    $errors = $user->db->errorInfo()[2];
            
                    while ($row1 = $query->fetch()) {
                     if ($pos++ % COLS === 0 && !$firstRow) {
                        echo "</div><div class='row d-flex justify-content-center mt-3'>";
    
                     }
                        
                        echo "
                        
                    
                                <div class='col-md-3 shadow well mx-5'>
                                <div class='card  product-item border-0 mx-auto'>
                             <h4>".$user->safe($row1['roomname'])."</h4><hr class='divider1'>";
    
    
                             if ( !empty($row1['semi_pic'])) {
                                $image = $imageDir . basename($row1['semi_pic']);
                                if (file_exists($image) && is_readable($image)) {
                                    $imageSize = getimagesize($image)[3];
                                }
                             if (!empty($imageSize)) { 
                                   
                                echo " 
                                <div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'>
                                <img class='img-fluid w-100 mx-auto rounded image' src= '" .$image . "'  alt='" .$user->safe($row1['caption']) . "' " .$imageSize . "
                                
                                        style='width:100%; '></div>
                                        ";
                                    } 
                                } else {
                                       echo "<br><br><br><br><br><br><h6 class='text-center'>no image</h6><br><br><br><br><br><br>";
    
                                    }
                                echo " 
                                 
                                <h6 class='descr'>No of Beds: ".$user->safe($row1['no_bed'])." ".$user->safe($row1['bedtype'])." bed.</h6>
                                    <h6 class='descr'>Facilities: ".$user->safe($row1['facility'])."</h6>
                                    
                                    <h6 class='descr'>Price: ".$user->safe($row1['price'])." zmk/night.</h6><h6 class='text-muted ml-2'><del>$123.00</del></h6>
                                    
                                    
                                   
                                    <div class='card-footer d-flex justify-content-between bg-light border'>
                                <a href='./booknow.php?roomname=".$user->safe($row1['roomname'])."'><button class='btn btn-success btn-lg button'>Book now</button></a>
                               
                                <a href='./details.php?id=".(int) $row1['room_cat_id']."'><button class='btn btn-info btn-lg button'>View Details</button></a>
                                </div>
                                </div>
                                </div>
                                
                                
                                ";

                            }  
                        }    
                           }  else {
                            throw new Exception("ain't no rooms available");
                        }

                        
            if (COLS-2 > 0) {
                for ($i = 0; $i < COLS-2; $i++) {
                     echo '<div class="col-md-7 pb-1"></div>';
                }
             } 
              
                

                                echo ' 

                                <div class="row d-flex align-items-center mx-auto mb-5">
                                <div class="col-4 pb-1 d-flex align-items-center justify-content-center mx-auto">
                                <nav aria-label="Page navigation d-flex align-items-center mx-auto ">
                                &nbsp;&nbsp;&nbsp;&nbsp;<ul class="pagination d-flex align-items-center mb-3 mx-auto">
                                                  <li class="page-item ">';
                                
                                
                                
                                
                                
                                   
                                     // create a back link if current page greater than 0
                                     if ($curPage > 0) {
                                      
                                         echo '<a href="reservation.php?curPage=' . ($curPage-1) . '" class="page-link" aria-label="Previous">
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
     
                                       
                                
                                      // pad the final row with empty cells if more than 2 columns(404)
                                      
                                
                                       // create a forward link if more records exist
                                       if ($startRow+SHOWMAX < $totalPix) {
                                          echo '<a href="reservation.php?curPage=' . ($curPage+1) . '" class="page-link" aria-label="Next">
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
               
               //else {
                    //$errors = "";
                //}
               
       }
           
          }  catch (PDOException $e) {
            $errors = $e->getMessage();
            $errors = "Data can't be retrieved";
     }  catch (PDOError $e) {
        $errors = $e->getMessage();
        $errors = "Data cannot be retrieved";

     }      
        
?>


    <?php                  
                   
    ?>
   

    </div> <br><br><br><br><br><br>
     <!-- footer-->
<?php 
    
    include('./footer.php');
    ?>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
    
</html>

