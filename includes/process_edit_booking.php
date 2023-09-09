<?php

    $roomname = $user->safe($_GET['roomname']); 
    $book_errors = array();
    $result = false;
    //SANITIZE AND VALIDATE user input    		
    if (!empty($_POST['checkin']))  {
        $checkin = trim($user->safe($_POST['checkin']));
        $checkin = filter_var( $checkin, FILTER_SANITIZE_STRING); 						
        $checkin = (filter_var($checkin, FILTER_SANITIZE_STRIPPED));	
    } else {	
	   $book_errors[] = 'missing field.';
    }
   		
    if (!empty($_POST['checkout']))  {
        $checkout = trim($user->safe($_POST['checkout']));
        $checkout = filter_var( $checkout, FILTER_SANITIZE_STRING); 					 	
        $checkout = (filter_var($checkout, FILTER_SANITIZE_STRIPPED));	
    } else {	
	   $book_errors[] = 'missing field.';
    }

    if (!empty($_POST['name'])) {	
        $name = trim($user->safe($_POST['name']));
        if ((preg_match('/[a-z\s]/i',$name)) && (strlen($name) <= 60)) {			
           $name = filter_var( $name, FILTER_SANITIZE_STRING);
           $name = (filter_var($name, FILTER_SANITIZE_STRIPPED));  
        } else {
            $book_errors[] = "not alphabetic and/or characters exceeded Max"; 
        }  	
    } else {	
	    $book_errors[] = 'missing field.';
    }
	    		
    if (!empty($_POST['phone']))  {					
	$phone = trim($user->safe($_POST['phone']));
    if (strlen($_POST['phone']) <= 30) {
       $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);	
	   $phone = (filter_var($phone, FILTER_SANITIZE_NUMBER_INT));
       $phone = preg_replace('/[^0-9]/', '', $phone);
    } else {
        $book_errors[] = "characters exceeded Max"; 
    }		
} else {	
    $book_errors[] = 'missing field.';
}

if (!empty($_POST['roomname'])) {
   $roomname = trim($user->safe($_POST['roomname']));
}  else {	
    $book_errors[] = 'missing field.';
}

//get all errors
$errors = array_merge($book_errors, $user->getErrors());

if (empty($errors)) {
    $result = $user->edit_all_room($checkin, $checkout, $name, $phone, $id);
}
  
if(($result) && (empty($errors))) {
        
    echo "<script type='text/javascript'>
          alert('".$result."');
     </script>";
     
     $url = "http://localhost:8080/hotel/room.php?id=$id&updated=true&roomname=$roomname";
     header("Location: $url");
     //exit;
} else {
    $errors = array_merge($book_errors, $user->getErrors());
}
?>