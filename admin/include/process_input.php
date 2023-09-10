
<?php 
include_once './PhpSolutions/File/Upload.php';
// Set Content Security Policy header
//header("Content-Security-Policy: default-src 'self'; script-src 'self' example.com");

// Prevent loading external scripts
//echo '<script src="https://malicious-site.com/evil.js"></script>';  // Blocked by CSP
    //initializing variables
    $add_errors = array();
    $img_errors = array();
    $full_pic = array();
    $semi_pic = array();
    $thumb = array();
    $names1 = array();  
   
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

?>