<?php
session_start();

//include file (class User)
include_once 'include/class.user.php'; 

//thumbnail upload class namespace and check password class namespace
//use PhpSolutions\Image\ThumbnailUpload;
use PhpSolutions\Authenticate\CheckPassword;

//directory for file (check password class)
require_once __DIR__ . '/./PhpSolutions/Authenticate/CheckPassword.php';

//create object
$user=new User(); 

//initialize variables
$reg_errors = array();
$result2 = [];
$pass =[];
$change = false;

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
    $sessionToken = $_SESSION['hotel-sess-token'];
}

//sanitize and save session variable if it exists
if (isset($_SESSION[ 'uname'])) { 
    $uname = $user->safe($_SESSION[ 'uname']);
   //$id = $_GET['id'];
   //$id = (int)$id;
}  else {
    $url = "http://localhost:8080/hotel/admin.php";
          // header("Location: $url");
}


   //retrive user data for display
   $sql = "SELECT uname FROM managers WHERE uname='$uname'";
   $query = $user->db->query($sql);
   $row = $query->fetch();


//if(isset($_REQUEST[ 'submit'])) 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //require_once './PhpSolutions/Image/ThumbnailUpload.php';
    //extract($_REQUEST);


//sanitize, validate and filter user input
$u_name = trim($user->safe($_POST['uname']));	
if ((!empty($u_name)) && (preg_match('/^[-_\p{L}\d]+$/ui',$u_name)) &&
		(strlen($u_name) <= 15)) {				
	//Sanitize the trimmed first name
    $u_name = filter_var( $_POST['uname'], FILTER_SANITIZE_STRING);
    $u_name = (filter_var($u_name, FILTER_SANITIZE_STRIPPED));
    $uname = $u_name;		
} else {	
	$reg_errors[] = 'Only alphanumeric characters, hyphens, and underscores are permitted in username';
}

$old_password = trim($user->safe($_POST['upass']));
$old_password = filter_var( $old_password, FILTER_SANITIZE_STRING);
$old_password = (filter_var($old_password, FILTER_SANITIZE_STRIPPED));

//store error message if it occurs
    if (empty($old_password)) {
        $reg_errors[] = 'You forgot to enter your old password.';
    }


// Check for a password and match against the confirmed password:
    $u_pass1 = trim($user->safe($_POST['upass1']));
    $u_pass1 = filter_var( $_POST['upass1'], FILTER_SANITIZE_STRING);
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
          $pass = $u_pass1;
        } else {
          $reg_errors[] = 'Your two password do not match.';
          $reg_errors[] = 'Please try again';
        }
    }
    }
    
    //checkpassword object and methods
    $checkPwd = new CheckPassword($u_pass1, 8);
    $checkPwd->requireMixedCase(true);
    $checkPwd->requireNumbers(1);
    $checkPwd->requireSymbols(1);
    if ($checkPwd->check()) {
        $result1 = ['Password OK'];
    } else {
        $result2 = $checkPwd->getErrors();
    }

//store variables
$username = $uname;
$new_password = $pass;
$password = $old_password;

//$age = $u_age;

// store error messages
$errors1 = array_merge($reg_errors, $user->getErrors());
$errors = array_merge($errors1, $result2);


//call function to change password if no errors exists
if (empty($errors)) {
    $change = $user->changePassword($username, $password, $new_password); 
}

//store and Display message if password changed
if (($change) && (empty($errors))) { 
    $done = "Your Password has been Changed Successfully";
        echo "
<script type='text/javascript'>
    alert('Your Password has been Changed Successfully');
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
    <title>Admin-Change Password</title>

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
        <h2 class="ml-5 pt-5">Change Password</h2>
        <div class="card o-hidden border-0 shadow-lg my-3 mx-auto ">
            
    <?php
    //dispay error messages if occurs
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
               
            //dispay message if pass changed
            if (($change) && (empty($errors))) { 
                echo "<p class='text-success'>$done</p>";
            }
 
    ?>
         
        <!-- Nested Row within Card Body -->
        <div class="row d-flex align-content-center justify-content-center">
            <div class="col-lg-9 mx-auto ">
                <div class="card-body p-0 mx-auto">
                    <div class="p-5">

            <form action="change-password.php" method="post" name="change_pass" enctype="multipart/form-data" 
                  onSubmit="return(check_pass());">
                <div class="form-group">
                    <label for="uname">Username:</label>
                    <input type="text" class="form-control form-control-user" name="uname" placeholder="exmple: kalu"
                        value = "<?php 
                         if (isset($_POST['uname'])) { echo htmlspecialchars($_POST['uname'], ENT_QUOTES);
                         } else { echo $user->safe($row['uname']);}  ?>"
                        onBlur = "disappear()" maxlength="15"
                        pattern="[a-zA-Z][a-zA-Z\s\.]*"
                        title="Alphabetic and space only max of 30 characters">
                    <span class="text-danger" id="error_message1"></span>
                </div>
        
                <div class="form-group">
                    <label for="upass">Current Password:</label>
                    <input type="text" class="form-control form-control-user" name="upass"  id="upass"
                    value = "<?php if (isset($_POST['upass'])) echo htmlspecialchars($_POST['upass'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                     title="One number, one upper, one lower, one special, with 8 to 12 characters" >
                        <span class="text-danger" id="error_message2"></span>
                </div>
                    
                <div class="form-group">
                    <label for="upass1">New Password:</label>
                    <input type="text" class="form-control form-control-user" name="upass1"  id="upass1" 
                    value = "<?php if (isset($_POST['upass1'])) echo htmlspecialchars($_POST['upass1'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                    title="One number, one upper, one lower, one special, with 8 to 12 characters" 
                    >
                    <span class="text-danger" id="error_message3">
                    <?php
                    //display error message
                      if (isset($result2) && !empty($result2))  {
               
                       echo '<ul class="">';
                       foreach ($result2 as $error) {
                        echo "<li class=' text-danger'>$error</li>";
                       }
                       echo '</ul>';
                     }?></span>
                </div>
              
               <div class="form-group">
                    <label for="upass2">Confirm Password:</label>
                    <input type="text" class="form-control form-control-user" name="upass2"  id="upass2"
                    value = "<?php if (isset($_POST['upass2'])) echo htmlspecialchars($_POST['upass2'], ENT_QUOTES); ?>"
                    onBlur = "disappear()"  minlength="8" maxlength="12" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,12}"
                     title="One number, one upper, one lower, one special, with 8 to 12 characters" >
                        <span class="text-danger" id="error_message4"></span>
                </div>
               
                <input type="hidden" name="hotel_sess_token" value="<?= $sessionToken ?>">
                <div class="d-flex justify-content-center">
                   <button type="submit" class="btn btn btn-primary button my-3 px-5" name="submit" value="Change Password">Submit</button>
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

       // Close the PDO connection at the end of the script or when it's no longer needed
       $user->db = null;
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

