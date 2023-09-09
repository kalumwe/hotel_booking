<?php 
session_start(); 
include_once 'include/class.user.php'; 

$user = new User(); 

$lgn_errors = array();
$login = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                
    $u_name = trim($_POST['emailusername']);	
    if ((!empty($u_name)) &&
        (strlen($u_name) <= 50))  {				
        //Sanitize the trimmed first name
        $u_name = filter_var( $_POST['emailusername'], FILTER_SANITIZE_STRING);
        $u_name = filter_var($u_name, FILTER_SANITIZE_STRIPPED);
        //$u_name =  filter_var( $_POST['emailusername'], FILTER_SANITIZE_EMAIL);		
    } else {	
        $lgn_errors[] = 'Only alphanumeric characters, hyphens, and underscores are permitted in username';
    }

    $u_pass = trim($_POST['password']);
    if ((empty($u_pass)) || (!preg_match( '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,12}$/', $u_pass))) {
        $lgn_errors[] = 'Invalid password, 8 to 12 chars, one upper, one lower, one number, one special.'; 
    } else {
        $u_pass = filter_var( $_POST['password'], FILTER_SANITIZE_STRING);
        $u_pass = (filter_var($u_pass, FILTER_SANITIZE_STRIPPED));
   
    }

$errors = array_merge($lgn_errors, $user->getErrors());

if (empty($errors)) {
   $login = $user->check_login($u_name, $u_pass);


   if (($login) && (empty($errors))) { 
    echo "<script>location='../admin.php'</script>"; 
    session_start();
  
   } else {  
    $errors = array_merge($lgn_errors, $user->getErrors());
    ?>
  <script type="text/javascript">
        document.getElementById("wrong_id").innerHTML = "Wrong username or password";
    </script>
<?php 
   }
                  
}
} ?>
    

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css" type="text/css">

    <script language="javascript" type="text/javascript">
        function submitlogin() {
            var form = document.login;
            if (form.emailusername.value == "") {
                alert("Enter email or username.");
                return false;
            } else if (form.password.value == "") {
                alert("Enter Password.");
                return false;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h2>Log In</h2>
            <?Php 
            if (isset($errors) && !empty($errors)) {
                echo '<ul>';
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo '</ul>';
            }
        //}
            
        ?>
            <hr>
            <form action="" method="post" name="login">
                <div class="form-group">
                    <label for="emailusername">Username or Email:</label>
                    <input type="text" name="emailusername" class="form-control" 
                    value = "<?php if (isset($_POST['emailusername'])) echo htmlspecialchars($_POST['emailusername'], ENT_QUOTES); ?>">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" 
                    value = "<?php if (isset($_POST['password'])) echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>">
                </div>
                <!--For showing error for wrong input  -->
                <p id="wrong_id" style=" color:red; font-size:12px; "></p>

                <button type="submit" name="submit" value="Login" onclick="retrun(submitlogin());" class="btn btn-lg btn-primary btn-block">Submit</button>
                
                <br>
                <p style="text-align: center; font-size: 14px;"><a href="../index.php">Back To Home</a></p>
                
                <?php
                if ((!$login) && (!empty($errors))) { 
                    ?>
                    <script type="text/javascript">
                    document.getElementById("wrong_id").innerHTML = "Wrong username or password";
                </script>
                <?php } ?>
  

         
        
           

       

            </form>
        </div>
    </div>

</body>
<?php
               //}
            //}
           // } else {
               // $errors = array_merge($lgn_errors, $user->getErrors());
            //}

        //}

        ?>
</html>