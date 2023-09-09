<?php

 catch (Exception $e) {
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
