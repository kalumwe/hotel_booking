<?php
session_start();

try {
//include class(User)
include_once 'admin/include/class.user.php'; 

//create object
$user = new User(); 

//redirect to another page if get is empty    
if (isset($_GET['roomname']) && (!$_POST))  { 
    // //redirect to another page if get value doesn't exist in database
    $sql ="SELECT * FROM room_category WHERE roomname='".$user->safe($_GET['roomname'])."'";
    $query = $user->db->query($sql);
    if ($query->rowCount() > 0) {
        $roomname = $user->safe($_GET['roomname']); 
    } else {
      header("Location: http://localhost:8080/hotel/room.php");   
   }
//image location
$imageDir = './images/';
  
//retrieve info for display
$sql="SELECT * FROM room_category LEFT JOIN images Using (image_id) WHERE roomname='$roomname'";
$query = $user->db->query($sql);
$row = $query->fetch();

}
    
//if(isset($_REQUEST[ 'submit']))  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
    require('includes/process_booking.php');
}
    
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="hotel_booking" content="" />
        <meta name="Kalu" content="" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hotel Booking</title>  
    <?php require_once('./includes/plugins.php'); ?>
    <script src="js/validate.js"></script>
<style>
   body {
        background-image: linear-gradient(rgba(47, 23, 15, 0.2), rgba(47, 23, 15, 0.3)), url("./images/home_bg.jpg");
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
} 
</style>  
</head>

<body>
    <!--Header-->
    <?php
        $menu = 2;
        include('admin/include/header.php');
    ?>        
    <div class="container mt-5 mb-5">
    <!-- Nested Row within Card Body -->
    <div class="row ">
      <div class="col-lg-12 mx-auto my-5 "></div>   
        <div class="col-lg-10 mx-auto d-sm-flex align-items-center justify-content-center ">
        <div class="card mx">
         <div class="card-body p-0 ">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center  mb-4 ">
              <h1 class="h3 mb-0 text-gray-800 mt-5 px-5">Book Room</h1>
            </div>
         <?php
            if (!empty($row['full_pic'])) {
                $image = $imageDir . basename($row['full_pic']);
                if (file_exists($image) && is_readable($image)) {
                    $imageSize = getimagesize($image)[3];
                }
                 if (!empty($imageSize)) {                        
                    echo " 
                    <div class='card-header product-img position-relative overflow-hidden bg-transparent border-0 p-0 shadow'>
                    <img class='img-fluid w-100 mx-auto  p-5 rounded border-0 image' src= '" .$image . "'  alt='" .$user->safe($row['caption']) . "'
                        " .$imageSize . " style='width:100%; '></div>
                            ";
                 } 
            } else {
                echo "<img class='img-fluid w-100 mx-auto rounded image' src= './img/image_not_available.png'  alt=''
                      style='width:100%; '>";

            }
    ?>             
            <h2 class="px-5 py-4">Book Now: <?php echo $roomname; ?></h2>
              <hr class='divider'>          
            <h6 class='descr px-5 py-1'>Facilities: <?php echo isset($row['facility']) ? $user->safe($row['facility']) : ''; ?></h6>                        
            <h6 class='descr px-5 py-1'>Price: <?php echo isset($row['price']) ? $user->safe($row['price']) : ''; ?> zmk/night.</h6>
            <h6 class='text-muted ml-2 px-5 mb-3'><del>$123.00</del></h6>
          </div>       
         </div>
        </div>
       </div>
        <div class='row mt-5'>
        <div class='col-md-3'></div>        
        <div class='col-lg-6 id="contactForm'>           
        <div class='card border border-gray-100 border-opacity-25 mb-3 bg-white bg-opacity-10 rounded-4'>
            <div class='card-body mb-3'>
              <form action="" method="post" name="book_room" id="book_room" class='m-4'>           
              <!-- checkin input-->
              <div class="form-floating mb-3">
                <input class="form-control datepicker" id="checkin" type="text" data-sb-validations="required"
                   placeholder="2023-05-18" name="checkin"
                   value = "<?php if (isset($_POST['checkin'])) echo $user->safe($_POST['checkin']); ?>"> 
                 <label for="checkin">Check In :</label>
                <div class="invalid-feedback" data-sb-feedback="checkin:required">Check-in date is required.</div>
               </div>
              <!-- checkout input-->
               <div class="form-floating mb-3 mt-4">
                <input class="form-control datepicker"  id="checkout" type="text"  data-sb-validations="required"
                placeholder="2023-05-20" name="checkout"
                value = "<?php if (isset($_POST['checkout'])) echo $user->safe($_POST['checkout']); ?>"> 
                <label for="checkout">Check Out :</label>
                <div class="invalid-feedback" data-sb-feedback="checkout:required">Check-out date is required.</div>
                </div>              
                <div class="form-floating mb-3 mt-4">                   
                   <input type="text" class="form-control" name="name" id="name" placeholder="Jhon Wicky" data-sb-validations="required"
                     value = "<?php if (isset($_POST['name'])) echo $user->safe($_POST['name']); ?>">
                     <label for="name">Enter Your Full Name:</label>
                    <div class="invalid-feedback" data-sb-feedback="name:required">Name is required.</div>
                   </div>
                <div class="form-floating mb-3 mt-4">                   
                   <input type="text" class="form-control" name="phone" id="phone" placeholder="018XXXXXXX" data-sb-validations="required"
                    value = "<?php if (isset($_POST['phone'])) echo $user->safe($_POST['phone']); ?>">
                    <label for="phone">Enter Your Phone Number:</label>
                 </div>              
                <div class="d-grid"><button type="submit" class="btn btn-primary btn-lg mt-4 py-3" name="submit">Book Now</button></div>
                  <br>
                  <div class="text-danger" id="error_msg">
        <?php
            if (isset($errors) && !empty($errors)) {
                echo '<ul>';
                foreach ($errors as $error) {
                    echo "<li class='text-danger'>$error</li>";
                }
                echo '</ul>';
            }
        ?>        </div>
                  <div id="click_here" class=" d-flex justify-content-center">
                    <a href="index.php">Back to Home</a>
                </div>
              </form>
            </div>
           <div class="col-md-3"></div>
          </div>
         </div>
        </div>
       </div>
     </div>
    </div>
        <br><br><br><br><br><br><br><br>
        <!-- footer-->
<?php    
    include('./footer.php');

 // Close the PDO connection at the end of the script or when it's no longer needed
 $user->db = null;

?>

 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
     <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
     <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
</body>
</html>

<?php 
} catch (Exception $e) {
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