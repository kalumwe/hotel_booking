<?php
session_start();
//include class(User)
include_once 'admin/include/class.user.php'; 

//create object
$user=new User(); 
   
//image location
$imageDir = './images/';

//redirect to login page if get_session() is false
if (!$user->get_session()) { 
    header("location:http://localhost:8080/hotel/admin/login.php"); 
} 

//set session variable to true
$_SESSION['formStarted'] = true;

//redirect to login page if session variable is false
if ((!$_SESSION['formStarted'])) {
    header("Location: http://localhost:8080/hotel/admin/login.php");
    exit;
}

//redirect to another page if get is empty
if (isset($_GET['id']) && is_numeric($_GET['id']))  { 
   $id = (int) $_GET['id'];

   //redirect to another page if id doesn't exist in database
   $sql ="SELECT * FROM room WHERE room_id='$id'";
   $query = $user->db->query($sql);
   if ($query->rowCount() > 0) {
       
   $id = (int) $_GET['id'];;
}  else {
    $url = "http://localhost:8080/hotel/show_all_room.php";
           header("Location: $url");
   }
} else {
    $url = "http://localhost:8080/hotel/show_all_room.php";
           header("Location: $url");
   }

//$errors = array();
$book_errors = array();

//retrieve info for display
try {
//$sql="SELECT * FROM room WHERE room_id=:id";
$sql="SELECT * FROM images as i RIGHT JOIN room_category as j ON i.image_id=j.image_id RIGHT JOIN  
room as k ON k.room_cat_id=j.room_cat_id WHERE (k.room_id=:id)"  ;
$stmt = $user->db->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
//$stmt->execute($id);
$row = $stmt->fetch();
 
//if(isset($_REQUEST[ 'submit'])) {    
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      require_once("./includes/process_edit_booking.php"); 
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
         <div class="card-body p-0">
          <!-- Page Heading -->
         <div class="d-sm-flex align-items-center  mb-4 ">
         <h1 class="h3 mb-0 text-gray-800 mt-5 px-5">Edit Booked Room</h1>
       </div>
            <?php 
            if ($row) {
              if ( !empty($row['full_pic'])) {            
               // if ( !empty($row['full_pic'])) {
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
            } else {
                echo 'No record found';
            }
        ?>
         <h2 class="px-5 py-4">Book Now: <?php echo $user->safe($row['roomname']); ?></h2>
            <hr class='divider'>
            <h6 class='descr px-5 py-1'>Facilities: <?= $user->safe($row['facility']) ?></h6>                       
            <h6 class='descr px-5 py-1'>Price: <?= $user->safe($row['price']) ?> zmk/night.</h6>
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
            <form action="" method="post" name="room_category" id="book_room" class='m-4'>                       
             <!-- checkin input-->
            <div class="form-floating mb-3">
                <input type="text" class="form-control datepicker" name="checkin" id="checkin" 
                   value="<?php  if (isset($_POST['checkin'])) { echo htmlspecialchars($_POST['checkin'], ENT_QUOTES);  
                                 } else { echo $user->safe($row['checkin']); }?>">
                    <label for="checkin">Check In :</label>
                    <div class="invalid-feedback" data-sb-feedback="checkin:required">Check-in date is required.</div>                  
                </div>               
                <div class="form-floating mb-3 mt-4">
                 <input type="text" class="form-control  datepicker" name="checkout" id="checkout" 
                 value="<?php  if (isset($_POST['checkout'])) { echo htmlspecialchars($_POST['checkout'], ENT_QUOTES);  
                                 } else { echo $user->safe($row['checkout']); }?>">
                    <label for="checkout">Check Out:</label>&nbsp;
                    <div class="invalid-feedback" data-sb-feedback="checkout:required">Check-out date is required.</div>
                  </div>                
                <div class="form-floating mb-3 mt-4">
                <input type="text" class="form-control" name="name" id="name" 
                value="<?php  if (isset($_POST['name'])) { echo htmlspecialchars($_POST['name'], ENT_QUOTES);  
                                 } else { echo $user->safe($row['name']); }?>">
                    <label for="name">Enter Your Full Name:</label>
                    <div class="invalid-feedback" data-sb-feedback="name:required">Name is required.</div>
                   </div>
                 <div class="form-floating mb-3 mt-4">
                    <input type="text" class="form-control" name="phone" id="phone" 
                    value="<?php  if (isset($_POST['phone'])) { echo htmlspecialchars($_POST['phone'], ENT_QUOTES);  
                                 } else { echo $user->safe($row['phone']); }?>">
                    <label for="phone">Enter Your Phone Number:</label>                   
                  </div>
                    <input type="hidden" name="roomname" value="<?php echo $user->safe($row['roomname']); ?>">
                   <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary button" name="submit">Update</button></div>
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
        ?>  
                  <div id="click_here">
                    <a href="admin.php">Back to Admin Panel</a>
                  </div>
                </form>
              </div>       
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