<?php

session_start();

define('ERROR_LOG','C:/Temp/logs/errors.log');
include_once 'include/class.user.php'; 
$user=new User(); 

if (!$user->get_session()) { 
    header("location:http://localhost:8080/hotel/admin/login.php"); 
}

if ((!$_SESSION['formStarted'])) {
    header("Location: http://localhost:8080/hotel/admin/login.php");
    exit;
}

try {


$room_id = "";

if (isset($_GET['id']))  { 
    $room_id = (int) ($_GET['id']);
}  else {
 $url = "http://localhost:8080/hotel/admin/login.php";
        header("Location: $url");
}

$sql = "SELECT * FROM room_category WHERE room_cat_id='$room_id'";

$query = $user->db->query($sql);
$row = $query->fetch();  


$deleted = false;

?>
<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags 
    <title>Hotel Booking</title>

    <-- Bootstrap -->
    <!--<link href="../css/bootstrap.min.css" rel="stylesheet">

<body>-->

<?php
if (isset($_GET['roomname']) && !$_POST) {

    
}

    //if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // if (isset($_POST['delete'])) {
        $room_id = (int) ($row['room_cat_id']);
        $roomname = $user->safe($row['roomname']);
        $room_qnty = (int) ($row['room_qnty']);

        $deleted = $user->delete_room_cat($roomname, $room_qnty, $room_id);

        if ($deleted)  {
            //$url = "http://localhost:8080/hotel_booking/show_room_cat.php";
            header("Location: http://localhost:8080/hotel/admin.php?deleted=true&roomname=$roomname");
            exit;
        }
   // }





if (isset($_POST['cancel_delete']) /*|| !isset($_GET['roomname'])*/)  {
    //$url = "http://localhost:8080/hotel_booking/show_room_cat.php";
    header("Location: http://localhost:8080/hotel_booking/show_room_cat.php");
    exit;
}

 // Close the PDO connection at the end of the script or when it's no longer needed
 $user->db = null;
 
}  catch(Exception $e) // We finally handle any problems here
{
// print "An Exception occurred. Message: " . $e->getMessage();
echo "Data can't be retrieved";
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
 echo "Data cannot be retrieved";
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

    
   <!-- <div class="container">-->
      
      <!--Header-->
     <!-- <img class="img-responsive" src="../images/home_banner.jpg" style="width:100%; height:180px;">

      <h4 class='header-title'>Delete Confirmation</h4>

    <h6 class="warning">Please confirm that you want to delete the following item. This action cannot be undone.</h6>
    
<form id="form1" method="post" action="delete_room_cat.php">
    <p>
        <// if (isset($room_cat) /*&& $article_id > 0*/) { ?>
            <input type="submit" name="delete" value="Confirm Deletion" class="btn btn-danger">&nbsp;&nbsp;&nbsp;&nbsp;
        < //} ?>
        <input name="cancel_delete" type="submit" id="cancel_delete" class="btn btn-primary" value="Cancel">
        < //if (isset($room_cat) /*&& $article_id > 0*/) { ?>
            <input name="roomname" type="hidden" value= // $user->safe($row['roomname'])  ?>">
            <input name="room_qnty" type="hidden" value="<// (int) $row['room_qnty']  ?>">
            <input name="room_id" type="hidden" value="< //(int) $row['room_cat_id']  ?>">-->
        <?php// }  
        
         ?>
    </p>
</form>

     

    </div>