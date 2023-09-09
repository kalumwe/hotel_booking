
 //---------ADD ROOM Validation--------------------------------------------------------------   

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

// -------------------------------------------------------------------------------------------
function validate_name(the_string) {
    //var letters  = /[a-z0-9\s]/i;
    if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 30)) {
    return true;
  }
    else
  {
    return false;
  }
 }

// -------------------------------------------------------------------------------------------
function validate_caption(the_string)
  {
    if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 40))
  {
    return true;
  }
    else
  {
  }
 }

 function validate_facility(the_string)
  {
    if ((the_string.length > 0) && (allalphabetic(the_string)) && (the_string.length <= 200))
  {
    return true;
  }
    else
  {
  }
 }


function validate_rooms(the_string)
  {
    if ((the_string > 0 && the_string <= 10) && (!isNaN(the_string)))
   {
     return true;
   }
     else
   {
     return false;
   }
  }

  function validate_price(the_string)
  {
    if ((the_string > 0 && the_string <= 8) && (!isNaN(the_string)))
   {
     return true;
   }
     else
   {
     return false;
   }
  }

  function validate_beds(the_string)
  {
    if ((the_string > 0 && the_string <= 2) && (!isNaN(the_string)))
   {
     return true;
   }
     else
   {
     return false;
   }
  }
function validate_bedtype(the_string)
  {
    if ((the_string == "single") || (the_string == "double") || (the_string == "SINGLE") || (the_string == "DOUBLE") 
      || (the_string == "Single") || (the_string == "Double") && (allalphabetic(the_string)))
   {
     return true;
   }
     else
   {
     return false;
   }
  }  



// -----------------------------------------------------------------------------------------
function validate_input()
  {
   // var error_message = "";
    var form = document.roomcategory;
  if (/*!validate_name(form.roomname.value) ||*/ (form.roomname.value == ""))
  {
    document.getElementById("error_message1").innerHTML = 'Roomname missing. Alphabetic, numeric, space only max 30 characters';
    form.roomname.focus();    
    return false;
  }
  
  if (!validate_rooms(form.room_qnty.value)  || (form.room_qnty.value == ""))
  {
    document.getElementById("error_message2").innerHTML = 'Missing room quantity Selection'; 
    form.room_qnty.focus();    
    return false;
  }

  if (!validate_beds(form.no_bed.value)  || (form.no_bed.value == ""))
  {
    document.getElementById("error_message3").innerHTML = 'Missing number of beds Selection.'; 
    form.no_bed.focus();    
    return false;
  }

  if (!validate_bedtype(form.bedtype.value)  || (form.bedtype.value == ""))
  {
   document.getElementById("error_message4").innerHTML = 'Bed type missing.';
   form.bedtype.focus();     
    return false;
  }

  if (!validate_facility(form.facility.value)  || (form.facility.value == ""))
  {
   document.getElementById("error_message5").innerHTML = 'you forgot to enter Facilities Or exceeded max number of characters.';  
   form.facility.focus();   
    return false;
  }

  if ((form.price.value == ""))
  {
    document.getElementById("error_message6").innerHTML = 'Price missing. Must be Numberic.'; 
    form.price.focus();    
    return false;
  }

    return true;

}



//---------REGISTRATION Validation-------------------------------------------------------------- 

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



// ---------------------------------------------------------------------------------------- 
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
    document.getElementById("error_message3").innerHTML = 'Username missing. Alphabetic, numeric, max 15 characters';
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


//-----------CHECK PASSWORD----------------------------
function check_pass() {

  var form = document.change_pass;

  if (!validate_uname(form.uname.value) || (form.uname.value == "")) {
    document.getElementById("error_message1").innerHTML = 'Username missing. Alphabetic, numeric, max 15 characters';
    form.uname.focus();    
    return false;

  }

  if (!validate_pass(form.upass.value) || (form.upass.value == "")) {
    document.getElementById("error_message2").innerHTML = 'Password missing. 8 to 12 chars, one upper, one lower, one number, one special';
    form.upass.focus();    
    return false;

  } 

  if (!validate_pass(form.upass1.value) || (form.upass1.value == "")) {
    document.getElementById("error_message3").innerHTML = 'Enter New password';
    form.upass1.focus();    
    return false;

  } 

  if (!validate_pass(form.upass2.value) || (form.upass2.value == "")) {
    document.getElementById("error_message4").innerHTML = 'Confirm password';
    form.upass2.focus();    
    return false;

  } 
  



  if (document.getElementById('upass1').value ==
        document.getElementById('upass2').value) {
        document.getElementById('error_message4').style.color = 'green';
        document.getElementById('error_message4').innerHTML = 'Passwords match';
    } else {
        document.getElementById('error_message4').style.color = 'red';
        document.getElementById('error_message4').innerHTML = 'Passwords do not match';
        return false;
    } 
   
    return true;
}



//-----------CLEAR error message-------------------------------------


function disappear() { 
  document.getElementById('error_message1').innerHTML = '';
  document.getElementById('error_message2').innerHTML = '';
  document.getElementById('error_message3').innerHTML = '';
  document.getElementById('error_message4').innerHTML = '';
  document.getElementById('error_message5').innerHTML = '';
  document.getElementById('error_message6').innerHTML = '';
  document.getElementById('error_message7').innerHTML = '';
  }


  