<?php
//file upload class namespace
use PhpSolutions\File\Upload;

session_start();

//include class (User)
include_once 'include/class.user.php'; 

//create object
$user = new User(); 

//initialize variable
$result = false;

//$uid = $_SESSION[ 'uid'];

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

//store token if session variable is exists
if($_SESSION['formStarted']) {
   //store session value in variable
   $sessionToken = $_SESSION['hotel_sess_token'];
}
    
//if (isset($_POST[ 'submit'])) { 
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {       
      //include file upload class 
      include_once './PhpSolutions/File/Upload.php';
      if (!hash_equals($sessionToken, $_POST['hotel_sess_token'])) {
         die("Token validation failed.");
      }

// Set Content Security Policy header
//header("Content-Security-Policy: default-src 'self'; script-src 'self' example.com");

// Prevent loading external scripts
//echo '<script src="https://malicious-site.com/evil.js"></script>';  // Blocked by CSP
    //initializing variables
    $add_errors = array();
    $img_errors = array();
    $full_pic = null;
    $semi_pic = null;
    $thumb = null;
    //$names1 = array();  
   
//create upload object if no errors exist
    if ($_FILES['full_pic']['error'] == 0)  {
        $loader1 = new Upload('full_pic', '../images/', 2001200); 
        //return name of file
        $names1 = $loader1->getFilenames();
        //get messages
        $img_errors1 = $loader1->getMessages();
    }
       
//create upload object if no errors exist
    if ($_FILES['semi_pic']['error'] == 0)  {
        $loader2 = new Upload('semi_pic', '../images/', 2001200); 
        //return name of file
        $names2 = $loader2->getFilenames(); 
         //get messages
        $img_errors2 = $loader2->getMessages();
     }  
         
//create upload object if no errors exist
     if ($_FILES['thumb']['error'] == 0)  {
        $loader3 = new Upload('thumb', '../images/', 2001200);
        //return name of file
        $names3 = $loader3->getFilenames();
         //get messages
        $img_errors3 = $loader3->getMessages();

     } 
                  
//SANITIZE, FILTER and VALIDATE user input
    $roomname = trim($user->safe($_POST['roomname'])); 	
if ((!empty($roomname)) && (preg_match('/[a-z0-9\s]/i',$roomname)) && (strlen($roomname) <= 30)) {				
	//Sanitize the trimmed first name
    $roomname = filter_var( $roomname, FILTER_SANITIZE_STRING);
    $roomname = (filter_var($roomname, FILTER_SANITIZE_STRIPPED));
    		
} else {	
	$add_errors[] = 'Roomname missing. Alphabetic, numeric, space only max 30 characters';
}

$room_qnty = (int) trim($_POST['room_qnty']);
   		
if ((!empty($room_qnty)) && (strlen($room_qnty) <= 3)) {					
	//Sanitize the trimmed phone number	
	$room_qnty = (filter_var($room_qnty, FILTER_SANITIZE_NUMBER_INT));
    $room_qnty = (filter_var($room_qnty, FILTER_SANITIZE_STRIPPED));	
} else {	
	$add_errors[] = 'Missing room quantity Selection.';
}

$no_bed = (int) trim($_POST['no_bed']);	    		
if ((!empty($no_bed)) && (strlen($no_bed) <= 2)) {					
	//Sanitize the trimmed phone number	
	$no_bed = (filter_var($no_bed, FILTER_SANITIZE_NUMBER_INT));
    $no_bed = (filter_var($no_bed, FILTER_SANITIZE_STRIPPED));	
} else {	
	$add_errors[] = 'Missing number of beds Selection.';
}


$bedtype =  trim($user->safe($_POST['bedtype']));
if (!empty($bedtype)) {				
	//Sanitize the trimmed first name
    $bedtype = (filter_var($bedtype, FILTER_SANITIZE_STRING));	
    $bedtype = (filter_var($bedtype, FILTER_SANITIZE_STRIPPED));		
} else {	
	$add_errors[] = 'Bed type missing. ';
}

$caption = trim($user->safe($_POST['caption'])); 
    if ((!empty($caption)) && (strlen($caption) <= 40)) {
       // remove ability to create link in email
       $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
       $caption = preg_replace($patterns," ", $caption);
       $caption = filter_var( $caption, FILTER_SANITIZE_STRING);
       $caption = (filter_var($caption, FILTER_SANITIZE_STRIPPED));
    } 

$facility = trim($user->safe($_POST['facility'])); 
    if ((!empty($facility)) && (strlen($facility) <= 200)) {
       // remove ability to create link in email
       $patterns = array("/http/", "/https/", "/\:/","/\/\//","/www./");
       $facility = preg_replace($patterns," ", $facility);
       $facility = filter_var( $facility, FILTER_SANITIZE_STRING);
       $facility = (filter_var($facility, FILTER_SANITIZE_STRIPPED));
       } else { // if comment not valid display error page
        $add_errors[] = 'you forgot to enter Facilities ';
        $add_errors[] = 'Or exceeded max number of characters';
    }

    $price = trim($user->safe($_POST['price']));		
if ((!empty($price)) && (strlen($price) <= 10)) {					
	//Sanitize the trimmed price					
	$price = (filter_var($price, FILTER_SANITIZE_NUMBER_INT));
    $price = preg_replace('/\D+/', '', ($price));	
	} else {	
	$add_errors[] = 'Price missing. Must be Numberic. Max ######.##.';
	}


    //call function to insert data and store uploaded file names if all errors are empty
    if (empty($errors) && (empty($add_errors)) ) {
      ////isset($names1) && (!empty($names1)) == $full_pic ? $names1[0] : [];
      //isset($names2) &&(!empty($names2)) == $semi_pic ? $names2[0] : [];
      //isset($names3) && (!empty($names3)) == $thumb ? $names3[0] :[];
      if (isset($names1) && !empty($names1))
          $full_pic = $names1[0];
      if (isset($names2) && !empty($names2))
          $semi_pic = $names2[0];
      if (isset($names3) && !empty($names3))    
          $thumb = $names3[0];

       $result = $user->add_room($roomname, $room_qnty, $no_bed, $bedtype, $full_pic, $semi_pic, $thumb, $caption, $facility, $price);

    }

    $errors = array_merge($add_errors, $user->getErrors());

    //display message and redirect to another page if result is true and no errors
    if (($result) && (empty($errors))) { 
        echo "<script type='text/javascript'>
              alert('Room Added Succesfully');
         </script>";
        echo " <script type='text/javascript'>
        window.location.href = '../admin.php';
        </script>"; 
    } else {
         $errors = array_merge($add_errors, $user->getErrors());
       }
    
    }
               
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="hotel_booking" content="" />
    <meta name="Kalu" content="" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin-Add Room</title>

    <!-- external css and js files & plugins  -->
 <?php
   $links = 2;
   include 'include/external-files.php'; ?>
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
 //set top nav bar
    $menu = 2;
    include('./include/topbar.php');
    ?>
        <div class="">
            <h2 class="ml-4">Add Room Category</h2>
            <hr>
    <?php
          //display errors if they exist
             if (isset($errors) && !empty($errors))  {
               
                echo '<ul class="">';
                foreach ($errors as $error) {
                    echo "<li class=' text-danger'>$error</li>";
                }
                echo '</ul>';
            }
                    
     ?>          
            <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-10 d-flex justify-content-center align-item-center mx-auto">
                        <div class="p-5">

            <form action="addroom.php" method="post" name="roomcategory" enctype="multipart/form-data" 
                  onSubmit="return(validate_input());">
                 <div class="form-group">
                    <label for="roomname">Room Type Name:</label>
                    <input type="text" class="form-control form-control-user" name="roomname" placeholder="super delux"
                      value = "<?php if (isset($_POST['roomname'])) echo htmlspecialchars($_POST['roomname'], ENT_QUOTES); ?>"
                      onBlur = "disappear()">
                      <span class="text-danger" id="error_message1"></span>
                  </div>
                <div class="row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="form-group">
                    <label for="qty">No of Rooms:</label>&nbsp;
                    <select name="room_qnty" class="form-control form-control-user" onBlur = "disappear()">
                      <option value="1" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 1)) { echo "selected"; } ?>>1
                      </option>
                      <option value="2" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 2)) { echo "selected"; } ?>>2
                      </option>
                      <option value="3" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 3)) { echo "selected"; } ?>>3
                      </option>
                      <option value="4" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 4)) { echo "selected"; } ?>>4
                      </option>
                      <option value="5" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 5)) { echo "selected"; } ?>>5
                      </option>
                      <option value="6" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 6)) { echo "selected"; } ?>>6
                      </option>
                      <option value="7" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 7)) { echo "selected"; } ?>>7
                      </option>
                      <option value="8" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 8)) { echo "selected"; } ?>>8
                      </option>
                      <option value="9" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 9)) { echo "selected"; } ?>>9
                      </option>
                      <option value="10" <?php if ((isset($_POST['room_qnty'])) && ($_POST['room_qnty'] == 10)) { echo "selected"; } ?>>10</option>
                    </select>
                    <span class="text-danger" id="error_message2" ></span>
                   </div>
                 </div>       
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="bed">No of Bed:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="no_bed" class="form-control form-control-user" onBlur = "disappear()">
                      <option value="1" <?php if ((isset($_POST['no_bed'])) && ($_POST['no_bed'] == 1)) { echo "selected"; } ?>>1</option>
                      <option value="2" <?php if ((isset($_POST['no_bed'])) && ($_POST['no_bed'] == 2)) { echo "selected"; } ?>>2</option>
                    </select>
                    <span class="text-danger" id="error_message3"></span>
                  </div>
                 </div>
                <div class="col-sm-4">
                <div class="form-group">
                    <label for="bedtype">Bed Type:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <select name="bedtype" class="form-control form-control-user" onBlur = "disappear()">
                      <option value="single" <?php if ((isset($_POST['bedtype'])) && ($_POST['bedtype'] == 'single')) { echo "selected"; } ?>>single</option>
                      <option value="double" <?php if ((isset($_POST['bedtype'])) && ($_POST['bedtype'] == 'double')) { echo "selected"; } ?>>double</option>
                    </select>
                    <span class="text-danger" id="error_message4"></span>
                   </div>
                 </div>
                </div>
                <div class="row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                <div class="form-group">
                    <label for="full_pic">Full picture:</label>
                    <input type="file" name="full_pic" placeholder="super_delux.jpg" class="form-control">
                    <span>
                        <?php
                        if (isset($img_errors1) && !empty($img_errors1))  {
                            echo "<ul class='list-group'>";
                            foreach ($img_errors1 as $error) {
                              echo "<li class='list-group-item-danger'>$error</li>";
                            }
                              echo '</ul>';            
                        }
                       ?>
                      </span>
                   </div></div>
                 <div class="col-sm-4">
                  <div class="form-group">
                    <label for="semi_pic">Semi picture:</label>
                    <input type="file"  name="semi_pic" id="semi_pic" placeholder="_semi_super_delux.jpg" class="form-control ">
                      <span> 
                        <?php
                        if (isset($img_errors2) && !empty($img_errors2))  {
                            echo "<ul class='list-group'>";
                            foreach ($img_errors2 as $error) {
                                echo "<li class='list-group-item-danger'>$error</li>";
                            }
                            echo '</ul>';
                        }
                        ?>
                        </span>
                  </div></div>
                <div class="col-sm-4">
                <div class="form-group">
                    <label for="thumb">Thumb picture:</label>
                    <input type="file" name="thumb" placeholder="_thb_super_delux.jpg" class="form-control">                    
                    <span>
                    <?php
                     if (isset($img_errors3) && !empty($img_errors3))  {
                        echo "<ul class='list-group'>";
                        foreach ($img_errors3 as $error) {
                            echo "<li class='list-group-item-danger'>$error</li>";
                        }
                        echo '</ul>';
                    }
                    ?>
                    </span>
                  </div></div>
                 </div>
                 <div class="form-group">
                    <label for="caption">Caption:</label>
                    <input type="text" class="form-control form-control-user" name="caption" placeholder="super delux"
                      value = "<?php if (isset($_POST['caption'])) echo htmlspecialchars($_POST['caption'], ENT_QUOTES); ?>">
                   </div>
                 <div class="form-group">
                    <label for="Facility">Facility:</label>
                    <textarea class="form-control form-control-user" rows="5" name="facility" id="facility" value = "" onBlur = "disappear()">
                        <?php if (isset($_POST['facility'])) echo htmlspecialchars($_POST['facility'], ENT_QUOTES); ?></textarea>
                        <span class="text-danger" id="error_message5"></span>
                   </div>
                  <div class="form-group">
                    <label for="price">Price Per Night:</label>
                    <input type="text" class="form-control form-control-user" name="price" 
                     value = "<?php if (isset($_POST['price'])) echo $user->safe($_POST['price']); ?>" 
                     onBlur = "disappear()">
                     <span class="text-danger" id="error_message6"></span>
                    </div>
                     <input type="hidden" name="hotel_sess_token" value="<?= $sessionToken ?>">

                      <button type="submit" class="btn btn-lg btn-primary button btn-user btn-block" name="submit" 
                        value="Add Room">Add</button>
                     <br>
                   <div id="click_here">
                    <a href="../admin.php">Back to Admin Panel</a>
                 </div>
                </form>
               <hr>
            </div>
           </div>
          </div>
        </div>
       </div>
      </div>
    </div>
  </div>
    <!-- footer -->
    <?php
      include('../admin-footer.php');
      ?>
    </div>
   
 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    
    <?php 
       //js external files and plugins
       $linksJs = 2;
       include 'include/js-external-links.php' ?>

</body>
</html>

