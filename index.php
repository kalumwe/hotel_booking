<?php
ob_start();
session_start();

//Directory for errors log file
define('ERROR_LOG','admin/include/logs/errors.log');
try {
//include '../includes/title.php';

//initialize variables
$errors = [];
$missing = [];

// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // email processing script
    $to = 'kalukav55@gmail.com';  // use your own email address
    $subject = 'Feedback from Hotel Booking';
    // list expected fields
    $expected = ['email'];
    $required = ['email'];
    // set default values for variables that might not exist

    // create additional headers
    //$headers[] = 'From: Japan Journey<feedback@example.com>';
    $headers[] = 'Content-Type: text/plain; charset=utf-8';
    require './admin/include/feedback-handler.php';
    if ($mailSent) {
        //header('Location: http://localhost:8080/phpsols/gallery/thank_you.php');
        //exit;
        //echo "<script type='text/javascript'>
        //alert('');
   //</script>";
   $sent ="Thank you for signing up";
    } 
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="hotel_booking" content="" />
    <meta name="Kalu" content="" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hotel Booking</title>
    <!-- Bootstrap -->
    <?php require_once('./includes/plugins.php'); ?>
              
<style>   
    @media (min-width: 992px) {
     #mainNav {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    border: none;
    background-color: transparent;
    transition: padding-top 0.3s ease-in-out, padding-bottom 0.3s ease-in-out;
       }
    }
</style>   
</head>

<body id="page-top">
    <!-- header-->
    <?php 
     $menu = 1;
    include('admin/include/header.php');
    ?>

    <!-- Masthead-->
    <header class="masthead">
            <div class="container ">
                <div class="masthead-subheading" id="wordContainer"></div>
                <div class="masthead-heading text-uppercase" id="wordContainer2"></div>
                <a class="btn btn-primary btn-xl text-uppercase" href="room.php">See Rooms</a>
            </div>
     </header>

        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0" >At Your Service</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                            <h3 class=" mb-2">Swimming Pool</h3>
                            <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <h3 class=" mb-2">Cocktail Bar</h3>
                            <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class=" mb-2">Room Service</h3>
                            <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="mb-2">Gym</h3>
                            <p class="text-muted mb-0">Is it really open source if it's not made with love?</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr class="divider1">
    <div class="container mt-5">    
        <div class="jumbotron">
        <div class="w3-content w3-section">
            <img class="mySlides w3-animate-fading" src="images/home_gallary/1.jpg" style="width:100%; height:450px;">
            <img class="mySlides w3-animate-fading" src="images/home_gallary/2.jpg" style="width:100%; height:450px;">
            <img class="mySlides w3-animate-fading" src="images/home_gallary/3.jpg" style="width:100%; height:450px;">
            <img class="mySlides w3-animate-fading" src="images/home_gallary/4.jpg" style="width:100%; height:450px;">
            <img class="mySlides w3-animate-fading" src="images/home_gallary/5.jpg" style="width:100%; height:450px;">
            <img class="mySlides w3-animate-fading" src="images/home_gallary/6.jpg" style="width:100%; height:450px;">
        </div>    
        </div>      
    </div>

<!-- About 2 --
    <section class="page-section bg-primary" id="about2">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">We've got what you need!</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Start Bootstrap has everything you need to get your new website up and running in no time! Choose one of our open source, free to download, and easy to use themes! No strings attached!</p>
                        <a class="btn btn-light btn-xl" href="#services">Try Us!</a>
                    </div>
                </div>
            </div>
        </section>-->

        <section id="about" class="page-section about-heading mt-5">
            <div class="container">
            <div class="about-heading-content">
                    <div class="row">
                        <div class="col-xl-9 col-lg-10 mx-auto mt-5">
                            <div class="bg-faded rounded p-5">
                                <h2 class="section-heading mb-4">
                                    <span class="section-heading-upper">Best Rooms, Perfect Chill</span><br>
                                    <span class="section-heading-lower">About Our Hotel</span>
                                </h2>
                                <p>Online hotel reservations are a popular method for booking hotel rooms. Travelers can book rooms on a computer by using online security to protect their privacy and financial information and by using several online travel agents to compare prices and facilities at different hotels</p>
                               <br>
                               <p>Prior to the Internet, travelers could write, telephone the hotel directly, or use a travel agent to make a reservation. Nowadays, online travel agents have pictures of hotels and rooms, information on prices and deals, and even information on local resorts. Many also allow reviews of the traveler to be recorded with the online travel agent.</p>
                                <br>
                              <p>Online hotel reservations are also helpful for making last minute travel arrangements. Hotels may drop the price of a room if some rooms are still available. There are several websites that specialize in searches for deals on rooms.</p>
                           </div>
                        </div>
                    </div>
                </div>
                <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="images/home_gallary/14.jpg" alt="..." />              
            </div>

 <div class="container d-flex justify-content-center my-5 " id='contact'>
    <div class='col-md-10'>
            <aside class="bg-warning bg-gradient rounded-3 p-4 p-sm-5 mt-5 ">
                        <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                            <div class="mb-4 mb-xl-0">
                                <div class="fs-3 fw-bold text-white">For more information and details about us.</div>
                                <div class="text-white-50">Sign up for our newsletter for the latest updates.</div>
                            </div>
                            <div class="ms-xl-4">
                                <form action="index.php" method="post" name="feedbackform" id="feedbackform">
                                <div class="input-group mb-2">
                                    <input name="email" id="email" class="form-control" type="text" placeholder="Email address..." aria-label="Email address..." aria-describedby="button-newsletter" />
                                    <button class="btn btn-outline-light" id="button-newsletter" type="submit" onclick="return(submitreg());">Sign up</button>
                                </div>
                                <span id='info' class='text-danger'></span>
                                <div class="small text-white-50">We care about privacy, and will never share your data.</div>
                               </form>
                            </div>
                        </div>
                    </aside>
                    <?php if (($_POST && $suspect) || ($_POST && isset($errors['mailfail']))) { ?>
        <p class="text-warning">Sorry, your mail could not be sent. Please try later.</p>
        <?php } elseif ($missing || $errors) {
             ?>
        <p class="warning">Please make sure that your input is correct.</p>
        <?php } ?>

</div>
</div>

 <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

        </section>
               
<!-- footer-->
<?php 
     $menu = 1;
    include('./footer.php');
    ?>

<script language="javascript" type="text/javascript">
        //CHECK email feedback form
        function submitreg() {
            var form = document.feedbackform;
            if (form.email.value == "") {
                document.getElementById('info').innerHTML = "Enter email!.";
                //alert("Search something.");
                form.email.focus();
                return false;
            } 
        }
   
//scripts to show letters on page one at a time
const word = 'Welcome To Our Hotel!'; // The word to display
const delay = 80; // Delay between each letter in milliseconds

let index = 0;
const intervalId = setInterval(() => {
  if (index < word.length) {
    const currentLetter = word[index];
    const wordContainer = document.getElementById('wordContainer');
    wordContainer.textContent += currentLetter;
    index++; 
  } else {
    clearInterval(intervalId);
  }
   
}, delay);

   const word2 = 'It\'s Nice To Have You';
   const delay2 = 250;
   //const delay = 200; // Delay between each letter in milliseconds
   let index2 = 0;
   const intervalId2 = setInterval(() => {
   if (index2 < word2.length) {
       const currentLetter2 = word2[index2];
       const wordContainer2 = document.getElementById('wordContainer2');
       wordContainer2.textContent += currentLetter2;
       index2++;
    } else {
    clearInterval(intervalId2);
  }
   
}, delay2);
</script>
    
       
    <!-- Bootstrap core JavaScript-->
   <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="my_js/slide.js"></script>    
</body>
</html>

<?php 
} catch (Exception $e) {
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
ob_end_flush();
?>