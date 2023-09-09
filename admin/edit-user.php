<?php
session_start();

//include file(class)
include_once './include/class.user.php'; 
//require_once './PhpSolutions/Image/ThumbnailUpload.php';

//create object
$user=new User(); 

//initialize variables
$reg_errors = array();
$update = false;

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

//store session variable id if it exists and is numeric 
if (isset($_SESSION[ 'id']) && is_numeric($_SESSION[ 'id']))  { 
    $id = $_SESSION[ 'id'];
   //$id = $_GET['id'];
   //$id = (int)$id;
}  else {
    //$url = "http://localhost:8080/hotel/admin.php";
          // header("Location: $url");
    header("Location: http://localhost:8080/hotel/admin.php");
    exit;
   }

//store token if session variable is exists
if($_SESSION['formStarted']) {
    //store session value in variable
    $sessionToken = $_SESSION['hotel-sess-token'];
}
   
//retrieve user info for display      
$sql="SELECT * FROM managers WHERE uid='$id'";
$query = $user->db->query($sql);
$row = $query->fetch();


//if(isset($_REQUEST[ 'submit'])) 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    //extract($_REQUEST);

    //don't execute if POST token value doesn't match session token value
    if (!hash_equals($_SESSION['hotel-sess-token'], $_POST['hotel_sess_token'])) {
        die("Token validation failed.");
    }

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

//store variables
$firstname = $first_name;
$lastname = $last_name;
$username = $u_name;
//$upass = $password;
//$age = $u_age;
$u_id = (int) $_POST['uid'];


 $email = trim($user->safe($_POST['uemail']));
 if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
     $reg_errors[] = 'You forgot to enter your email address';
     $reg_errors[] = ' or the e-mail format is incorrect.';
 } else {
    $email = filter_var( $_POST['uemail'], FILTER_SANITIZE_EMAIL);
 }

 //get errors
 $errors = array_merge($reg_errors, $user->getErrors());

//upload profile pic if selected
if (isset($_FILES['pic']['name'])) {
    $pic = $username;
    $field_name = "pic";
    $uploadDp = $user->createProfilePic($pic, $field_name, false);
}

//save message if image failed to upload
if (!$uploadDp) {
    $dperror = "Coundn't upload image please try again";
}

//call function to edit user info if errors are empty
if (empty($errors)) {
    $update = $user->edit_user($firstname, $lastname, $username, $email, $u_id); 
    $url = "http://localhost:8080/hotel/admin/view-managers.php?changed=true&manager=$u_id";
    header("Location: $url");
    exit;  
} else {
    $errors = array_merge($reg_errors, $user->getErrors());
}

}
     
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="hotel_booking" content="" />
    <meta name="Kalu" content="" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin-Edit User</title>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
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
<div id="content d-flex align-content-center justify-content-center" >

 <!-- Topbar -->
 <?php 
    $menu = 2;
    include('./include/topbar.php');
?>
           
    <div class="container ">
        <h2 class="text-center mb-5 pt-5">Edit Details</h2>
        <div class="card o-hidden border-0 shadow-lg my-3">
            
    <?php
    //display error message(s) when error(s) occur
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
        <div class="col-lg-9 ">
            <div class="p-5 px-3 ">
                        
<?php
//image location
$loc ="./img/dp/";
if (isset($row['uname'])) { 
   $dp = $loc. $user->safe($row['uname']).".jpg";
}
?>

<span class="mx-auto text-center  text-gray-600 small"><?php
//if (isset($row['uname'])){
echo "<p class='text-muted'>My Profile";
//} 
echo '</p>';?></span>

<div class="d-flex align-content-center justify-content-center mb-5">
<?php if (isset($row['uname']) && file_exists($dp)) { ?>
   <img class="rounded-circle img-responsive " src="<?= $dp ?>"
alt=<?= $user->safe($row['uname']) ?> width="100" height="100">
<?php } else { ?>                                    
 <img class="img-profile rounded-circle" width="100" height="100" src="./img/undraw_profile.svg">
<?php } ?></div>
   <hr class="  mx-auto mb-5">

        <form action="edit-user.php" method="post" name="reg" enctype="multipart/form-data" id="contactForm"
                 onSubmit="return(submit_reg());">
              <div class="row">
                <div class="col-sm-6 mb-4 mb-sm-0">
                  <div class="form-floating mb-4">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control form-control-user" name="firstname" placeholder="Enter first name"
                      value = "<?php echo $user->safe($row['first_name']); 
                       if (isset($_POST['firstname'])) echo $user->safe($_POST['firstname'], ENT_QUOTES); ?>"
                      onBlur = "disappear()" maxlength="40"
                      pattern="[a-zA-Z][a-zA-Z\s\.]*"
                      title="Alphabetic and space only max of 30 characters">                     
                      <span class="text-danger" id="error_message1"></span>
                   </div>
                  </div>
               <div class="col-sm-6 mb-4 mb-sm-0">
                <div class="form-floating ">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control form-control-user" name="lastname" placeholder="Enter last name"
                      value = "<?php echo $user->safe($row['last_name']); 
                       if (isset($_POST['lastname'])) echo $user->safe($_POST['lastname'], ENT_QUOTES); ?>"
                      onBlur = "disappear()"  maxlength="40"
                      maxlength="40"  pattern="[a-zA-Z][a-zA-Z\s\-\']*"
                      title="Alphabetic, dash, quote and space only max of 40 characters" >  
                      <span class="text-danger" id="error_message2"></span>
                    </div>
                  </div>
                  </div>
                    <div class="form-floating mb-4">
                     <label for="uname">Username:</label>
                      <input type="text" class="form-control form-control-user" name="uname" placeholder="exmple: kalu"
                        value = "<?php  echo $user->safe($row['uname']);
                        if (isset($_POST['uname'])) echo $user->safe($_POST['uname'], ENT_QUOTES); ?>"
                        onBlur = "disappear()" maxlength="15"
                        pattern="[a-zA-Z][a-zA-Z\s\.]*"
                        title="Alphabetic and space only max of 30 characters">
                    <span class="text-danger" id="error_message3"></span>
                </div>               
                <div class="form-floating mb-4">
                    <label for="uemail">Email:</label>
                    <input type="email" class="form-control form-control-user" name="uemail" placeholder="example: kalu@gmail.com" 
                      value = "<?php echo $user->safe($row['uemail']);
                       if (isset($_POST['uemail'])) echo $user->safe($_POST['uemail'], ENT_QUOTES); ?>"
                      onBlur = "disappear()" maxlength="50">
                    <span class="text-danger" id="error_message4"></span>
                </div>
                <div class="form-group my-4">
                    <label for="pic">Change Profile picture:</label>
                    <input type="file" name="pic" placeholder="" class="form-control form-control-user" >
                    <span>
                        <?php
                        //show image upload error message if occurs
                         if (isset($dperror))  {       
                            echo $dperror;
                        }
                       ?>
                 </span>
                </div>
                <input name="uid" type="hidden" value="<?= (int) $row['uid'] ?>">
                <input type="hidden" name="hotel_sess_token" value="<?= $sessionToken ?>">
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn btn-primary button my-3 px-5" name="submit" value="Update Manager">Update</button>
                </div>
               <br>
                <div id="click_here">
                    <a href="../admin.php" class="text-primary  my-3">Back to Admin Panel</a>
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

