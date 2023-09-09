<?php

// pattern to locate suspect phrases
$pattern = '/[\s\r\n]|Content-Type:|Bcc:|Cc:/i';
// check the submitted email address
$suspect = preg_match($pattern,  $_POST['email']);


if (!$suspect) {
    foreach ($_POST as $key => $value) {
        // strip whitespace from $value if not an array
        if (!is_array($value)) {
            $value = trim($value);
        }
        if (!in_array($key, $expected)) {
            // ignore the value, it's not in $expected
            continue;
        }
        if (in_array($key, $required) && empty($value)) {
            // required value is missing
            $missing[] = $key;
            $$key = "";
            continue;
        }
        $$key = $value;
    }
}

if (strlen($email > 60))  {
    $errors['email'] = true;
}

// validate the user's email
if (!$suspect && !empty($email)) {
    $validemail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    if ($validemail) {
        $headers['Reply-To'] = $validemail;
    } else {
        $errors['email'] = true;
    }
}
$mailSent = false;

// go ahead only if not suspect, all required fields OK, and no errors
if (!$suspect && !$missing && !$errors) {
    // initialize the $message variable
    $message = '';
    // loop through the $expected array
    foreach($expected as $item) {
        // assign the value of the current item to $val
        if (isset($$item) && !empty($$item)) {
            $val = $$item;
        } else {
            // if it has no value, assign 'Not selected'
            $val = 'Not selected';
        }
        // if an array, expand as comma-separated string
        if (is_array($val)) {
            $val = implode(', ', $val);
        }
        // replace underscores in the label with spaces
        $item = str_replace('_', ' ', $item);
        // add label and value to the message body
        $message .= ucfirst($item).": $val\r\n\r\n";
    }
     // everything OK send e-mail #6
     //$subject = "Message from customer " . $first_nametrim . " " . $last_nametrim;
     $subject = "Email from customer " . $validemail ;
     $messageproper =
     "------------------------------------------------------------\n" .
     //"Name of sender: $first_nametrim $last_nametrim\n" .
     "Email of sender: $email\n" .
     //"Telephone: $phonetrim\n" .
     //"brochure?: $brochure\n" .
     //"Address: $address1trim\n" .
     //"Address: $address2trim\n" .
     //"City: $citytrim\n" .
    // "Postcode: $zcode_pcodetrim\n" .
    // //"Newsletter?:$letter\n" .
    // "------------------------- MESSAGE -------------------------\n\n" .
    // $commenttrim .
     "\n\n------------------------------------------------------------\n" ;
 
     //mail($mailto, $subject, $messageproper, "From: \"$first_nametrim $last_nametrim\"
     //<$email>" );
     //header( "Location: $thankyouurl" );
     //exit ;
 
    // limit line length to 70 characters
    $messageproper = wordwrap($messageproper, 100);
    $mailSent = mail($to, $subject, $messageproper, $headers);
    if (!$mailSent) {
        $errors['mailfail'] = true;
    }
}
