<?php
session_start();
//include file (class User)
include_once 'include/class.user.php'; 

//thumbnail upload class namespace and check password class namespace
//use PhpSolutions\Image\ThumbnailUpload;
use PhpSolutions\Image\ThumbnailUpload;
use PhpSolutions\Authenticate\CheckPassword;
require_once __DIR__ . '/./PhpSolutions/Authenticate/CheckPassword.php';

//create object
$user = new User(); 

//initialize variables
$reg_errors = array();
$register = false;
$result2 = [];
$result1 = [];


//if(isset($_REQUEST[ 'submit'])) 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //require_once './PhpSolutions/Image/ThumbnailUpload.php';
    //extract($_REQUEST);


//sanitize, validate and filter user input   
$first_name = trim($user->safe($_POST['firstname']));	    	
if ((!empty($first_name)) && (preg_match('/[a-z\s]/i',$first_name)) && (strlen($first_name) <= 40)) {				
	//Sanitize the trimmed first name
    $first_name = filter_var( $_POST['firstname'], FILTER_SANITIZE_STRING);
    $first_name = (filter_var($first_name, FILTER_SANITIZE_STRIPPED));
    $firstname = $first_name;		
} else {	
	$reg_errors[] = 'First Name missing or not alphabetic and space characters. Max 30';
}

//Is the last name present? If it is, sanitize it
$last_name = trim($user->safe($_POST['lastname']));			
if ((!empty($last_name)) && (preg_match('/[a-z\-\s\']/i',$last_name)) &&
		(strlen($last_name) <= 40)) {					
	//Sanitize the trimmed last name
    $last_name = filter_var( $_POST['lastname'], FILTER_SANITIZE_STRING);
    $last_name = (filter_var($last_name, FILTER_SANITIZE_STRIPPED));
    $lastname = $last_name;				
} else {	
	$reg_errors[] = 'Last name missing or not alphabetic, dash, quote or space. Max 30.';
}	

$u_name = trim($user->safe($_POST['uname']));	
if ((!empty($u_name)) && (preg_match('/^[-_\p{L}\d]+$/ui',$u_name)) &&
		(strlen($u_name) <= 15)) {				
	//Sanitize the trimmed first name
    $u_name = filter_var( $_POST['uname'], FILTER_SANITIZE_STRING);
    $u_name = (filter_var($u_name, FILTER_SANITIZE_STRIPPED));
    $username = $u_name;		
} else {	
	$reg_errors[] = 'Only alphanumeric characters, hyphens, and underscores are permitted in username';
}

// Check for a password and match against the confirmed password:
    $u_pass1 = trim($user->safe($_POST['upass']));
    $u_pass1 = filter_var($_POST['upass'], FILTER_SANITIZE_STRING);
    $string_length = strlen($u_pass1);		
    if (empty($u_pass1)) {   //                                             #7
        $reg_errors[] ='Please enter a valid password';
    } else {
    if (!preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,12}$/', $u_pass1)) {  //                        #8
       $reg_errors[] = 'Invalid password, 8 to 12 chars, one upper, one lower, one number, one special.';
    } else {
        $u_pass2 = trim($user->safe($_POST['upass2']));
        $u_pass2 = filter_var( $_POST['upass2'], FILTER_SANITIZE_STRING);	
    if($u_pass1 === $u_pass2) { //                                 #9
      $password = $u_pass1;
    } else {
      $reg_errors[] = 'Your two password do not match.';
      $reg_errors[] = 'Please try again';
    }
    }
    }
    
    //checkpassword object
    $checkPwd = new CheckPassword($u_pass1, 8);
    $checkPwd->requireMixedCase(true);
    $checkPwd->requireNumbers(1);
    $checkPwd->requireSymbols(1);
    if ($checkPwd->check()) {
        $result1 = ['Password OK'];
    } else {
        $result2 = $checkPwd->getErrors();
    }

$firstname = $first_name;
$lastname = $last_name;
$username = $u_name;
//$upass = $password;
//$age = $u_age;


 $email = trim($_POST['uemail']);
 if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
     $reg_errors[] = 'You forgot to enter your email address';
     $reg_errors[] = ' or the e-mail format is incorrect.';
 } else {
    $email = filter_var( $_POST['uemail'], FILTER_SANITIZE_EMAIL);
 }


 $u_age = trim($_POST['age']);	
if ((!empty($u_age)) && (preg_match('/[0-9]/',$u_age)) &&
		(strlen($u_age) <=150)) {				
	//Sanitize the trimmed first name
    $u_age = (int) $u_age;
    $u_age = (filter_var($u_age, FILTER_SANITIZE_STRIPPED));
    $age = $u_age;		
} else {	
	$reg_errors[] = 'Only alphanumeric characters, hyphens, and underscores are permitted in username';
}

 
//store all errors in variables
 //$errors = array_merge($reg_errors, $user->getErrors());
$errors1 = array_merge($reg_errors, $user->getErrors());
$errors = array_merge($errors1, $result2);


//ccreate profile picture if image is valid
if (isset($_FILES['pic']['name'])) {
    $pic = $username;
    $field_name = "pic";
    $uploadDp = $user->createProfilePic($pic, $field_name, false);
}

//get error message if upload failed
if (!$uploadDp) {
    $dperror = "Coundn't upload image please try again";
}

//register user if errors are empty
if (empty($errors)) {
    $register = $user->reg_user($firstname, $lastname, $username, $password, $email, $age); 
   }

//alert successful messgage if registraton is successful
if (($register) && (empty($errors))) { 
        echo "
<script type='text/javascript'>
    alert('Your Manager has been Added Successfully');
</script>"; 
        echo "
<script type='text/javascript'>
    window.location.href = '../admin.php';
</script>"; 
    } else {
       // echo "
//<script type='text/javascript'>
    //alert('Registration failed! username or email already exists');
//</script>";
//if ($errors) {
    //$errors=$user->getErrors();
    $errors1 = array_merge($reg_errors, $user->getErrors());
    $errors = array_merge($errors1, $result2);
   // $errors = array_merge($reg_errors, $user->getErrors());
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
    <title>Admin-Add Manager</title>

    <!-- external css and js files & plugins  -->
  <?php
      $links = 2;
      include 'include/external-files.php'; ?>
      
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper" class="d-flex align-content-center justify-content-center">
     <!-- nav sidebar-->
    <?php 
       $nav = 2;
       include('include/nav_sidebar.php');
    ?>

<!-- Content Wrapper -->   
<div id="content-wrapper" class="row d-flex flex-column">
<!-- Main Content -->
<div id="content" >
 <!-- Topbar -->
 <?php 
    $menu = 2;
   include('./include/topbar.php');
?>          

    <div class="container ">
           <h2 class="ml-5 pt-5">Add Manager</h2>
        <div class="card o-hidden border-0 shadow-lg my-3 mx-0 px-0">
            
    <?php
    //display errors if they occur
          //$errors1 = array_merge($errors, $img_errors);
             if (isset($errors) && !empty($errors))  {
               
                echo '<ul class="mt-3">';
                foreach ($errors as $error) {
                    echo "<li class=' text-danger'>$error</li>";
                }
                echo '</ul>';
            }

            if (isset($dperror))  {       
                echo "<span>$dperror</span>";
            }
                       
?>
          
            <div class="card-body p-0 ">
                <!-- Nested Row within Card Body -->
                <div class="row d-flex align-content-center justify-content-center">
                    <div class="col-lg-8">
                    <div class="p-5 px-3">
              <form action="registration.php" method="post" name="reg" enctype="multipart/form-data" 
                  onSubmit="return(submit_reg());">
                <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control form-control-user" name="firstname" placeholder="Enter first name"
                      value = "<?php if (isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname'], ENT_QUOTES); ?>"
                      onBlur = "disappear()" maxlength="40"
                      pattern="[a-zA-Z][a-zA-Z\s\.]*"
                      title="Alphabetic and space only max of 30 characters">
                      <span class="text-danger" id="error_message1"></span>
                   </div>
                  </div>

                <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control form-control-user" name="lastname" placeholder="Enter last name"
                      value = "<?php if (isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname'], ENT_QUOTES); ?>"
                      onBlur = "disappear()"  maxlength="40"
                      maxlength="40"  pattern="[a-zA-Z][a-zA-Z\s\-\']*"
                      title="Alphabetic, dash, quote and space only max of 40 characters" >
                      <span class="text-danger" id="error_message2"></span>
                </div>
                </div>
               </div>
             
                <div class="form-group">
                    <label for="uname">User Name:</label>
                    <input type="text" class="form-control form-control-user" name="uname" placeholder="exmple: kalu"
                        value = "<?php if (isset($_POST['uname'])) echo htmlspecialchars($_POST['uname'], ENT_QUOTES); ?>"
                        onBlur = "disappear()" maxlength="15"
                        pattern="[a-zA-Z][a-zA-Z\s\.]*"
                        title="Alphabetic and space only max of 30 characters">
                    <span class="text-danger" id="error_message3"></span>
                </div>
             
                <div class="form-group">
                    <label for="uemail">Email:</label>
                    <input type="email" class="form-control form-control-user" name="uemail" placeholder="example: kalu@gmail.com" 
                      value = "<?php if (isset($_POST['uemail'])) echo htmlspecialchars($_POST['uemail'], ENT_QUOTES); ?>"
                      onBlur = "disappear()" maxlength="50">
                    <span class="text-danger" id="error_message4"></span>
                </div>
        
            <div class="row">
              <div class="col-sm-6 mb-sm-0">
                <div class="form-group">
                    <label for="upass">Password:</label>
                    <input type="text" class="form-control form-control-user" name="upass"  id="upass" 
                    value = "<?php if (isset($_POST['upass'])) echo htmlspecialchars($_POST['upass'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                    title="One number, one upper, one lower, one special, with 8 to 12 characters" 
                    >
                    <span class="text-danger" id="error_message5"><?php  if (isset($result2) && !empty($result2))  {
               
               echo '<ul class="">';
               foreach ($result2 as $error) {
                   echo "<li class=' text-danger'>$error</li>";
               }
               echo '</ul>';
           }?></span>
                </div>
              </div>

              <div class="col-sm-6 mb-sm-0">
               <div class="form-group">
                    <label for="upass2">Confirm Password:</label>
                    <input type="text" class="form-control form-control-user" name="upass2"  id="upass2"
                    value = "<?php if (isset($_POST['upass2'])) echo htmlspecialchars($_POST['upass2'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                     title="One number, one upper, one lower, one special, with 8 to 12 characters" >
                        <span class="text-danger" id="error_message6"></span>
                </div>
               </div>
               </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" class="form-control form-control-user" name="age" placeholder="28"
                        value = "<?php if (isset($_POST['age'])) echo htmlspecialchars($_POST['age'], ENT_QUOTES); ?>"
                        onBlur = "disappear()" min="1" max="150"
                        title="numbers only" >
                        <span class="text-danger" id="error_message7"></span>
                </div>

                <div class="form-group">
                    <label for="pic">Upload Profile picture:</label>
                    <input type="file" name="pic" placeholder="" class="form-control form-control-user" >
                    <span>
                        <?php
                         if (isset($dperror))  {       
                            echo $dperror;
                        }
                       ?>
                 </span>
                </div>
                <div class="d-flex justify-content-center"> 
                   <button type="submit" class="btn btn btn-primary button my-3 px-5" name="submit" value="Add Manager">Submit</button>
                </div>
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

