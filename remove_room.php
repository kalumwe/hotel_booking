<?php

//define('ERROR_LOG','C:/Temp/logs/errors.log');

try {
include_once 'admin/include/class.user.php'; 


$user=new User(); 
//$room_cat = "";


session_start();
if ((!$_SESSION['formStarted'])) {
    header("Location: http://localhost:8080/hotel/admin/login.php");
    exit;
}

if (isset($_GET['id']))  { 
    $id = (int) $_GET['id'];
    //$id = $_GET['id'];
    //$id = (int)$id;
 } else {
 $url = "http://localhost:8080/hotel_booking/show_all_room.php";
        header("Location: $url");
}

$sql="SELECT * FROM room WHERE room_id='$id'";

$query = $user->db->query($sql);
$row = $query->fetch();  


$deleted = false;

?>
<?php

    //if (isset($_POST['delete'])) {
        $room_id = (int) ($row['room_id']);
        $roomname = $user->safe($row['room_cat']);
        //$room_qnty = (int) ($_POST['room_qnty']);

        $deleted = $user->remove_room($room_id);

        if ($deleted)  {
            //$url = "http://localhost:8080/hotel_booking/show_room_cat.php";
            header("Location: http://localhost:8080/hotel/show_all_room.php?deleted=true&roomname=$roomname");
            exit;
        }
   // }


if (isset($_POST['cancel_delete']) || !isset($_GET['id']))  {
    //$url = "http://localhost:8080/hotel_booking/show_room_cat.php";
    header("Location: http://localhost:8080/hotel_booking/show_all_room.php");
    exit;
}
    ?>


        <?php 
        // Close the PDO connection at the end of the script or when it's no longer needed
        $user->db = null;
         
        }  catch(Exception $e) // We finally handle any problems here
        {
        // print "An Exception occurred. Message: " . $e->getMessage();
        echo "Action can't be completed";
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
         echo "Action cannot be completed";
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
    </p>
</form>

     
</div>