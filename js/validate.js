$( function() {
    $( ".datepicker" ).datepicker({
                  dateFormat : 'yy-mm-dd'
                });
  } );

$(document).ready(function() {
    $("#book_room").submit(function() {
        // Prevent the form from submitting
        //event.preventDefault();
        
        // Validate the form fields
        var name = $("#name").val();
        var checkIn = $("#checkin").val();
        var checkOut = $("#checkout").val();
        var phone = $("#phone").val();
        
        // Add your validation logic here
        if (name === "") {
            $("#error_msg").text("name is required");
            return false;
        } else if (name.length > 80) {
            $("#error_msg").text("exceeded max characters");
            return false;
        }
        if (phone === "") {
            $("#error_msg").text("phone number is required");
            return false;
        } else if (phone.length > 80) {
            $("#error_msg").text("exceeded max characters");
            return false;
        }
        
       /* if (email === "") {
            alert("Email is required");
            return false;
        } else if (!isValidEmail(email)) {
            alert("Invalid email format");
            return false;
        }*/
         
        if (checkIn === "") {
            $("#error_msg").text("check-in date is required");
            return false;
        } 
        if (checkOut === "") {
            $("#error_msg").text("check-out date is required");
            return false;
        } 
               
    });
    
    // Function to validate email format
    function isValidEmail(email) {
        // Add your email validation logic here
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailRegex.test(email);
    }
});