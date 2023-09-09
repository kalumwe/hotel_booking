// -------------------------------------------------------------------------------------------

function allalphabetic(the_string)
  {
    var letters = /^[a-zA-Z ]+$/;
  if (the_string.match(letters))
  {
    return true;
  }
    else
  {
    return false;
  }
 }

function validate_firstname(the_string) {
    //var letters  = '/[a-z\s]/i';
    if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 40)) {
    return true;
  }
    else
  {
    return false;
  }
 }


 
function validate_lastname(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 40)) {
  return true;
}
  else
{
  return false;
}
}


function validate_uname(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 15)) {
  return true;
}
  else
{
  return false;
}
}

function validate_pass(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length >= 8) && (the_string.length <= 12)) {
  return true;
}
  else
{
  return false;
}
}

function validate_email(the_string) {
  //var letters  = '/[a-z\s]/i';
  if ((the_string.length > 0) && (the_string.length <= 50)) {
  return true;
   } else if (the_string.indexOf("@") == -1 || the_string.indexOf(".") == -1) {
    return false;
  
 } else {  
  return false;
}
}

function validate_age(the_string)
//var letters  = '/[0-9]/';
  {
    if ((the_string > 0 && the_string <= 150) && (!isNaN(the_string)))
   {
     return true;
   }
     else
   {
     return false;
   }
  }



  
function submit_reg() {
 
  var form = document.reg;

  if (!validate_firstname(form.firstname.value) || (form.firstname.value == "")) {
    document.getElementById("error_message1").innerHTML = 'First name missing. Alphabetic, numeric, space only max 30 characters';
   // document.getElementById("error_message1").innerHTML.onblur() ="";
    form.firstname.focus();    
    return false;
    

  } 
  
  if (!validate_lastname(form.lastname.value) || (form.lastname.value == "")) {
    document.getElementById("error_message2").innerHTML = 'Last name missing. Alphabetic, numeric, space only max 40 characters';
    form.lastname.focus();    
    return false;

  }
  
  if (!validate_uname(form.uname.value) || (form.uname.value == "")) {
    document.getElementById("error_message3").innerHTML = 'User name missing. Alphabetic, numeric, max 15 characters';
    form.uname.focus();    
    return false;

  }
   if (!validate_pass(form.upass.value) || (form.upass.value == "")) {
    document.getElementById("error_message4").innerHTML = 'Password missing. 8 to 12 chars, one upper, one lower, one number, one special';
    form.upass.focus();    
    return false;

  } 
  
  if (!validate_pass(form.upass2.value) || (form.upass2.value == "")) {
    document.getElementById("error_message6").innerHTML = 'Confirm password';
    form.upass2.focus();    
    return false;

  } 
  
  if (!validate_email(form.uemail.value) || (form.uemail.value == "")) {
    document.getElementById("error_message4").innerHTML = 'Enter valid email!';
    form.uemail.focus();    
    return false;

  } 
  
  if (!validate_age(form.age.value) || (form.age.value == "")) {
    document.getElementById("error_message7").innerHTML = 'Enter your age.';
    form.age.focus();    
    return false;


  } 

  if (document.getElementById('upass').value ==
        document.getElementById('upass2').value) {
        document.getElementById('error_message6').style.color = 'green';
        document.getElementById('error_message6').innerHTML = 'Passwords match';
    } else {
        document.getElementById('error_message6').style.color = 'red';
        document.getElementById('error_message6').innerHTML = 'Passwords do not match';
        return false;
    } 
   
    return true;
  
  
}

function disappear() { 
  document.getElementById('error_message1').innerHTML = '';
  document.getElementById('error_message2').innerHTML = '';
  document.getElementById('error_message3').innerHTML = '';
  document.getElementById('error_message4').innerHTML = '';
  document.getElementById('error_message5').innerHTML = '';
  document.getElementById('error_message6').innerHTML = '';
  document.getElementById('error_message7').innerHTML = '';
  }