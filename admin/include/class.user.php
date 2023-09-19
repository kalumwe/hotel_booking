<?php

define('ERROR_LOG','C:/Temp/logs/errors.log');
/*CLASS User Definition*/
try {
//require database connection file
include "db_config.php";

     class User {
            public $db;
            protected array $errors = [];
            public function __construct() {
               //connection to database
                $this->db = new PDO("mysql:host=localhost;port=3307;dbname=hotel", DB_USERNAME, DB_PASSWORD);
            }


            //function to register users
            public function reg_user($firstname, $lastname, $username, $password, $email, $age) {
                $sql="SELECT * FROM managers WHERE uname=:username OR uemail=:email";
                $stmt = $this->db->prepare($sql);
                // bind parameters and insert the details into the database
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->rowCount() == 0) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                   $sql1="INSERT INTO managers SET uname=:uname, upass=:pass, first_name=:firstname, last_name=:lastname,
                          uemail=:email,  age=:uage";
                   $stmt = $this->db->prepare($sql1);
                   // bind parameters and insert the details into the database
                   $stmt->bindParam(':uname', $username, PDO::PARAM_STR);
                   $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                   $stmt->bindParam(':pass', $hashed_password, PDO::PARAM_STR);
                   $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                   $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                   $stmt->bindParam(':uage', $age, PDO::PARAM_INT);
                   $result= $stmt->execute();
                    return $result;

                } else {  
                        $this->errors[] = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
                        Please choose another username.';
                        return false;
                }
                // Close the PDO connection at the end of the script or when it's no longer needed
                $this->db = null;
             }
            
                //function to edit users info
                public function edit_user($firstname, $lastname, $username, $email, $u_id) {
                       $sql1="UPDATE managers SET uname=:uname, first_name=:firstname, last_name=:lastname, uemail=:email WHERE uid=:id";
                       $stmt = $this->db->prepare($sql1);
                       // bind parameters and insert the details into the database
                       $stmt->bindParam(':uname', $username, PDO::PARAM_STR);
                       $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                       $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                       $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
                       $stmt->bindParam(':id', $u_id, PDO::PARAM_INT);                       
                       $result= $stmt->execute();
                        return $result;
                           
                       $sql="SELECT * FROM managers WHERE uname=:username OR uemail=:email";
                       $stmt = $this->db->prepare($sql);
                       // bind parameters and insert the details into the database
                        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                        $stmt->execute();
 
                        if ($stmt->rowCount() == 0) {
                            $this->errors[] = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
                            Please choose another username.';
                            return false;
                         }                      
                        if ($e->getCode() == 23000) {
                            $this->errors[] = htmlentities($username) . ' or ' . htmlentities($email) .' is already in use.
                             Please choose another username.';
                        } 

                      // Close the PDO connection at the end of the script or when it's no longer needed
                      $this->db = null;

            }
            
            //get errors function
            public function getErrors() {
                return $this->errors;
            }

            //function to sanitize value or input 
            public function safe($text) {
                $text = trim($text);               
                $bad_chars = array( "{", "}", "(", ")", ";", ":", "<", ">", "/", "$" );
                $text = str_ireplace($bad_chars, "", $text);		
                return htmlspecialchars($text, ENT_COMPAT|ENT_HTML5, 'UTF-8', false);
            }

            //function to add room info 
            public function add_room($roomname, $room_qnty, $no_bed, $bedtype, $full_pic, $semi_pic, $thumb, $caption, $facility, $price) {
                    $available = $room_qnty;
                    $booked = 0;                        
                    //if ((!empty($full_pic))  || (!empty($semi_pic) ) || (!empty($thumb))) {
                        $sql = 'INSERT INTO images (full_pic, semi_pic, thumb, caption)
                        VALUES (:fullpic, :semi, :thb, :caption)';
                        $stmt = $this->db->prepare($sql);
                        if (!empty($full_pic && (isset($full_pic)))) {
                           $stmt->bindParam(':fullpic', $full_pic, PDO::PARAM_STR);
                        }  else {
                            // set image_id to NULL
                            $stmt->bindValue(':fullpic', NULL, PDO::PARAM_NULL);
                         }
                         if (!empty($semi_pic && (isset($semi_pic)))) {
                            $stmt->bindParam(':semi', $semi_pic, PDO::PARAM_STR);
                         }  else {
                             // set image_id to NULL
                             $stmt->bindValue(':semi', NULL, PDO::PARAM_NULL);
                          }
                          if (!empty($thumb && (isset($thumb)))) {
                            $stmt->bindParam(':thb', $thumb, PDO::PARAM_STR);
                          }  else {
                             // set image_id to NULL
                             $stmt->bindValue(':thb', NULL, PDO::PARAM_NULL);
                          }
                          if (!empty($caption && (isset($caption)))) {
                            $stmt->bindParam(':caption', $caption, PDO::PARAM_STR);
                           }  else {
                             // set image_id to NULL
                             $stmt->bindValue(':caption', NULL, PDO::PARAM_NULL);
                          }
                        $stmt->execute();
                        // use rowCount() to get the number of affected rows
                        $imageOK = $stmt->rowCount();
                       
                        // get the image's primary key or find out what went wrong
                       if ($imageOK) {
                           // lastInsertId() must be called on the PDO connection object
                           $image_id = $this->db->lastInsertId();
                        } //else {
                      //  }
                    
                    //$this->db->beginTransaction();
                    $sql="INSERT INTO room_category SET image_id=:img_id, roomname=:room, available=:avlable, 
                    booked=:booking, room_qnty=:qnty, no_bed=:beds, bedtype=:type, facility=:faclty, price=:Price";
                    $stmt = $this->db->prepare($sql);
                   // bind parameters and insert the details into the database
                   if (isset($image_id)) {
                       $stmt->bindParam(':img_id', $image_id, PDO::PARAM_INT);
                   } else {
                      // set image_id to NULL
                      $stmt->bindValue(':img_id', NULL, PDO::PARAM_NULL);
                   }
                   $stmt->bindParam(':room', $roomname, PDO::PARAM_STR);
                   $stmt->bindParam(':avlable', $available, PDO::PARAM_INT);
                   $stmt->bindParam(':booking', $booked, PDO::PARAM_INT);
                   $stmt->bindParam(':qnty', $room_qnty, PDO::PARAM_INT);
                   $stmt->bindParam(':beds', $no_bed, PDO::PARAM_INT);
                   $stmt->bindParam(':type', $bedtype, PDO::PARAM_STR);
                   $stmt->bindParam(':faclty', $facility, PDO::PARAM_STR);
                   $stmt->bindParam(':Price', $price, PDO::PARAM_STR);
                   $result = $stmt->execute();
                   $insertOK = $stmt->rowCount();

                  if ($insertOK) {
                     $cat_id =  $this->db->lastInsertId();
                  }

                   for($i=0;$i<$room_qnty;$i++) {
                        $false = 'false';
                        $sql="INSERT INTO room SET room_cat=:room, room_cat_id=:ct_id, book=:false";
                        $stmt = $this->db->prepare($sql);
                        // bind parameters and insert the details into the database                     
                        $stmt->bindParam(':room', $roomname, PDO::PARAM_STR);
                        $stmt->bindParam(':ct_id', $cat_id, PDO::PARAM_INT);
                        $stmt->bindParam(':false', $false, PDO::PARAM_STR);
                        $stmt->execute();
                        //$this->db->exec($sql);       
                    }

                //$done=$this->db->commit();                   
                return $result;

                if (isset($stmt)) {
                    $this->errors[] = $stmt->errorInfo()[2];
                    $this->errors[] = "Data cant inserted";
                }

                // Close the PDO connection at the end of the script or when it's no longer needed
                $this->db = null;
                         
          }
            
            //function to check room availability
            public function check_available($checkin, $checkout) {
                $sql = "SELECT DISTINCT room_cat FROM room WHERE room_id NOT IN (SELECT DISTINCT room_id
                FROM room WHERE (checkin <= :check_in AND checkout >= :check_out) OR (checkin >= :check_in 
                 AND checkin <= :check_out) OR (checkin <= :check_in AND checkout >= :check_in))";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':check_in', $checkin, PDO::PARAM_STR);
                $stmt->bindParam(':check_out', $checkout, PDO::PARAM_STR);
                //$stmt->execute();
                $check = $stmt->execute();
                return $check;

                if (isset($stmt)) {
                    $this->errors[] = $stmt->errorInfo()[2];
                    $this->errors[] = "Data cant be retrieved";
                }

           // Close the PDO connection at the end of the script or when it's no longer needed
           $this->db = null;
                      
        }
                        
            //function to book room
            public function booknow($checkin, $checkout, $name, $phone, $roomname) {
                $sql="SELECT * FROM room WHERE room_cat = :roomname AND (room_id NOT IN (SELECT DISTINCT room_id
                      FROM room WHERE checkin <= :check_in AND checkout >= :check_out))";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':roomname', $roomname, PDO::PARAM_STR);
                $stmt->bindParam(':check_in', $checkin, PDO::PARAM_STR);
                $stmt->bindParam(':check_out', $checkout, PDO::PARAM_STR);
                $stmt->execute();

                //if(mysqli_num_rows($check) > 0)
                if ($stmt->rowCount() > 0) {
                    //$row = mysqli_fetch_array($check);
                    $row = $stmt->fetch();
                    $id = $row['room_id'];
                     $book = 'true';   
                    $sql="UPDATE room SET checkin=:check_in, checkout=:check_out, name=:nme, phone=:phne, book=:true WHERE room_id=:id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':check_in', $checkin, PDO::PARAM_STR);
                    $stmt->bindParam(':check_out', $checkout, PDO::PARAM_STR);
                    $stmt->bindParam(':nme', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':phne', $phone, PDO::PARAM_STR);
                    $stmt->bindParam(':true', $book, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $send = $stmt->execute();
                    if ($send) {
                        $result="Your Room has been booked!!";
                    } else {
                        $result="Sorry, Internal Error";
                    }
                } else {
                    $result = "No Rooms Available";
                }
                return $result;
                    if (isset($stmt)) {
                        $this->errors[] = $stmt->errorInfo()[2];
                        $this->errors[] = "Data cannot be retrieved";
                    }          
               // Close the PDO connection at the end of the script or when it's no longer needed
               $this->db = null;

            }
                        
            //function to edit booked room info
             public function edit_all_room($checkin, $checkout, $name, $phone, $id) {                    
                    $id = (int)$id;
                    $sql = "UPDATE room SET checkin=:check_in, checkout=:check_out, name=:nme, phone=:phne, book='true' WHERE room_id=:id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':check_in', $checkin, PDO::PARAM_STR);
                    $stmt->bindParam(':check_out', $checkout, PDO::PARAM_STR);
                    $stmt->bindParam(':nme', $name, PDO::PARAM_STR);
                    $stmt->bindParam(':phne', $phone, PDO::PARAM_STR);
                    //$stmt->bindParam(':true', $book, PDO::PARAM_STR);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $send = $stmt->execute();

                    if ($send) {
                        $result="Your Room has been booked!!";
                    } else {
                        $result="Sorry, Internel Error";
                    }           
                    return $result;
                    if (isset($stmt)) {
                        $this->errors[] = $stmt->errorInfo()[2];
                        $this->errors[] = "Data cannot be retrieved";
                    }                 
                    // Close the PDO connection at the end of the script or when it's no longer needed
                    $this->db = null;

            }
                        
            //function to remove room
            public function remove_room($room_id) {
                    $sql="DELETE FROM room WHERE room_id='$room_id'";
                    $result = $this->db->query($sql);
                    $deleted = $result->rowCount();
                    if (!$deleted) {
                         $this->errors[] = 'There was a problem deleting the record.';
                     } else {
                        $done ='Deleted!';
                     }
                    return $result;

                    // Close the PDO connection at the end of the script or when it's no longer needed
                    $this->db = null;
            }

            //function to delete manager 
            public function deleteManager($id) {
                    $sql="DELETE FROM managers WHERE uid='$id'";
                    $result = $this->db->query($sql);
                    $deleted = $result->rowCount();

                    if (!$deleted) {
                         $this->errors[] = 'There was a problem deleting the record.';
                     } else {
                        $done ='Deleted!';
                     }
                    return $result;

                    // Close the PDO connection at the end of the script or when it's no longer needed
                    $this->db = null;

            }
            
            //function to edit room info
            public function edit_room_cat($roomname, $room_qnty, $no_bed, $bedtype, $full_pic, $semi_pic, $thumb, 
                    $caption, $facility, $price, $room_cat, $room_id) {
                    $available = $room_qnty;
                    $booked = 0;                      
                   //retrieve user info for display      
                   $sql1="SELECT image_id FROM room_category WHERE room_cat_id=$room_id";
                   $query = $this->db->query($sql1);
                   $row = $query->fetch();
                   $result = $query->rowCount();
                    
                   if ($result > 0) {
                    $img_id = $row['image_id'];
                      if ((empty($img_id) || !is_numeric($img_id))) {
                        $sql = 'INSERT INTO images (full_pic, semi_pic, thumb, caption)
                        VALUES (:fullpic, :semi, :thb, :caption)';
                      } else {
                        $sql = "UPDATE images SET full_pic=:fullpic, semi_pic=:semi, thumb=:thb, caption=:caption WHERE image_id=$img_id";
                      }
                   }                    
                    $stmt = $this->db->prepare($sql);
                    if (!empty($full_pic && (isset($full_pic)))) {
                       $stmt->bindParam(':fullpic', $full_pic, PDO::PARAM_STR);
                    }  else {
                        // set image_id to NULL
                        $stmt->bindValue(':fullpic', NULL, PDO::PARAM_NULL);
                     }
                     if (!empty($semi_pic && (isset($semi_pic)))) {
                        $stmt->bindParam(':semi', $semi_pic, PDO::PARAM_STR);
                     }  else {
                         // set image_id to NULL
                         $stmt->bindValue(':semi', NULL, PDO::PARAM_NULL);
                      }
                      if (!empty($thumb && (isset($thumb)))) {
                        $stmt->bindParam(':thb', $thumb, PDO::PARAM_STR);
                      }  else {
                         // set image_id to NULL
                         $stmt->bindValue(':thb', NULL, PDO::PARAM_NULL);
                      }
                     if (!empty($caption && (isset($caption)))) {
                        $stmt->bindParam(':caption', $caption, PDO::PARAM_STR);
                       }  else {
                         // set image_id to NULL
                         $stmt->bindValue(':caption', NULL, PDO::PARAM_NULL);
                      }
                      $stmt->execute();

                      if ((empty($img_id) || !is_numeric($img_id))) {
                         $image_id = $this->db->lastInsertId();
                      }                                
                   //$this->db->beginTransaction();
                    $sql="UPDATE room_category SET image_id=:img_id, roomname=:room, available=:avlable, 
                         booked=:booking, room_qnty=:qnty, no_bed=:beds, bedtype=:type, facility=:faclty, price=:Price
                         WHERE room_cat_id=:roomid";
                    $stmt = $this->db->prepare($sql);
                   // bind parameters and insert the details into the database
                   if (isset($image_id)) {
                        $stmt->bindParam(':img_id', $image_id, PDO::PARAM_INT);
                    } elseif (!empty($img_id) || is_numeric($img_id)) {
                        $stmt->bindParam(':img_id', $img_id, PDO::PARAM_INT);
                    } else {
                        // set image_id to NULL
                        $stmt->bindValue(':img_id', NULL, PDO::PARAM_NULL);
                    }
                   $stmt->bindParam(':room', $roomname, PDO::PARAM_STR);
                   $stmt->bindParam(':avlable', $available, PDO::PARAM_INT);
                   $stmt->bindParam(':booking', $booked, PDO::PARAM_INT);
                   $stmt->bindParam(':qnty', $room_qnty, PDO::PARAM_INT);
                   $stmt->bindParam(':beds', $no_bed, PDO::PARAM_INT);
                   $stmt->bindParam(':type', $bedtype, PDO::PARAM_STR);
                   $stmt->bindParam(':faclty', $facility, PDO::PARAM_STR);
                   $stmt->bindParam(':Price', $price, PDO::PARAM_STR);
                   $stmt->bindParam(':roomid', $room_id, PDO::PARAM_INT);
                   $send = $stmt->execute();
                   $updateOK = $stmt->rowCount();                  
                    if ($send) {
                        $result=" Updated Successfully!!";
                    } else {
                        $result="Sorry, Internel Error";
                    }                           
                    $sql3 = "DELETE FROM room WHERE room_cat=:roomcat";
                    $stmt3 = $this->db->prepare($sql3);
                    $stmt3->bindParam(':roomcat', $room_cat, PDO::PARAM_STR);
                    $stmt3->execute();
                    for ($i=0;$i<$room_qnty;$i++) {
                            //$sql3="INSERT INTO room SET room_cat='$roomname', book='false'";
                            //mysqli_query($this->db,$sql3);
                            $false = 'false';
                            $sql4 = "INSERT INTO room SET room_cat=:roomname, book=:false";
                            $stmt4 = $this->db->prepare($sql4);
                            $stmt4->bindParam(':roomname', $roomname, PDO::PARAM_STR);
                            $stmt4->bindParam(':false', $false, PDO::PARAM_STR);
                            $stmt4->execute();
                        }                        
                      // $done=$this->db->commit();
                        return $result;
                      // Close the PDO connection at the end of the script or when it's no longer needed
                       $this->db = null;
                    
        }
                            
        //function to delete room
        public function delete_room_cat($roomname, $room_qnty, $room_id) {
                $sql = "DELETE FROM room_category WHERE room_cat_id='$room_id'";
                $result = $this->db->query($sql);
                       //$result = $stmt->execute($room_id);
                       $deleted = $result->rowCount();
                    if (!$deleted) {
                       if ($result->errorCode() == 'HY000') {
                           $this->errors[] = 'That record has dependent files in a child table, and cannot be deleted.';
                       } else {
                        $this->errors[] = 'There was a problem deleting the record.';
                    }
                   
                }
                for ($i=0; $i<$room_qnty; $i++) {
                    //$sql3="INSERT INTO room SET room_cat='$roomname', book='false'";
                    //mysqli_query($this->db,$sql3);
                    $sql = "DELETE FROM room WHERE room_cat='$roomname'";
                    $this->db->query($sql);
                    //$stmt = $this->db->prepare($sql);
                    //$stmt->execute($roomname);                   
                }
             
                return $result;
                // Close the PDO connection at the end of the script or when it's no longer needed
                $this->db = null; 
         }
                
        //function to check and process login data
        public function check_login($emailusername,$password) {
                $sql = "SELECT uid, uname, upass, user_level from managers WHERE uemail=:emailusername OR uname=:emailusername";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':emailusername', $emailusername, PDO::PARAM_STR);              
                //$stmt->bindParam(':pwd', $password, PDO::PARAM_STR);
                $stmt->execute();
                $user_data = $stmt->fetch();
                $count_row = $stmt->rowCount();                 
                if ($count_row == 1) {
                    if (password_verify($password, $user_data['upass'])) {
                        $_SESSION['Log_in'] = true;
                        $_SESSION['id'] = $user_data['uid'];
                        $_SESSION['uname'] =  $user_data['uname'];
                        $_SESSION['user_level'] = (int) $user_data['user_level'];
                        //$_SESSION['hotel_sess_token'] =  true;
                        // Enable HttpOnly flag on session cookies
                        /*$_SESSION['cookie_params'] = session_set_cookie_params([
                            'httponly' => true,
                            'secure' => true,  // If using HTTPS
                         ]);*/
                        $url = ($_SESSION['user_level'] === 1) ? 'http://localhost:8080/hotel/admin.php'
                         : 'http://localhost:8080/hotel/index.php';
                        header('Location: ' . $url);
                        return true;  
                        
                        // Close the PDO connection at the end of the script or when it's no longer needed
                        $this->db = null;

                    } else {
                        $this->errors[] = "Username Or email is incorrect";
                        $this->errors[] = "Or password is incorrect";
                        $this->errors[] = 'Perhaps you need to register, just click the Register ';
                        return false;
                    }
                } else {
                    $this->errors[] = "Username Or email is incorrect";
                    $this->errors[] = "Or password is incorrect";
                    $this->errors[] = 'Perhaps you need to register, just click the Register ';
                }
           
        }

           // //get session variable 'login'
            public function get_session() {
                return $_SESSION['Log_in'];
            }
            

            //logout function
            public function user_logout() {
                $_SESSION['Log_in'] = false;
                $_SESSION = [];
                // invalidate the session cookie
                if (isset($_COOKIE[session_name()])) {
                    setcookie(session_name(), "", time()-86400, '/');
                }
                session_destroy();
            }

            //function to create profile picture
            public function createProfilePic($pic, $field_name, $deleteOriginal = false) {
                $saveto = "./img/dp/$pic.jpg";
                $success = move_uploaded_file($_FILES[$field_name]['tmp_name'], $saveto);
                if ($success) {
                    // add a message only if the original image is not deleted
                    if (!$deleteOriginal) {
                        $result = 'Profile picture was uploaded successfully';
                    } else {
                        $result = ' uploaded successfully';
                    }
                $typeok = TRUE;
                switch($_FILES[$field_name]['type']) {
                      case "image/gif": $src = imagecreatefromgif($saveto); break;
                      case "image/jpeg": // Both regular and progressive jpegs
                      case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
                      case "image/png": $src = imagecreatefrompng($saveto); break;
                      default: $typeok = FALSE; 
                      break;
                }
                if ($typeok) {  //making thumb for pofile pic display
                   list($w, $h) = getimagesize($saveto);
                   $max = 175;
                   $tw = $w;
                   $th = $h;
                   if ($w > $h && $max < $w) {
                      $th = $max / $w * $h;
                      $tw = $max;
                   } elseif ($h > $w && $max < $h) {
                      $tw = $max / $h * $w;
                      $th = $max;
                   
                  } elseif  ($max < $w) {
                     $tw = $th = $max;
                  }
        
                //sharpening image
                $tmp = imagecreatetruecolor($tw, $th);
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                imageconvolution($tmp, array(array(-1, -1, -1),
                array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                imagejpeg($tmp, $saveto);
                imagedestroy($tmp);
                imagedestroy($src);
               }
               if ($deleteOriginal) {
                unlink($saveto);
            }
             } else {
                $result = 'Could not upload image';
                //$this->errors[] = 'Could not upload ' . $file['name'];

            }
            return $result;                
        }

            //function to change user password
            public function changePassword($username, $password, $new_password) {
                $result = false;
               $sql = "SELECT uid, upass FROM managers WHERE ( uname=:user )";
               $stmt = $this->db->prepare($sql);
               $stmt->bindParam(':user', $username, PDO::PARAM_STR);
               $stmt->execute();
               $row = $stmt->fetch();
               $count_row = $stmt->rowCount(); 

               if (($count_row == 1) && password_verify($password, $row['upass'])) {

                   $hashed_passcode = password_hash($new_password, PASSWORD_DEFAULT);
                   $sql = "UPDATE managers SET upass=:pass WHERE uname=:user";
                   $stmt = $this->db->prepare($sql);
                   $stmt->bindParam(':user', $username, PDO::PARAM_STR);
                   $stmt->bindParam(':pass', $hashed_passcode, PDO::PARAM_STR);
                   $result = $stmt->execute();
                   $changed = $stmt->rowCount();

                   if ($changed == 1) {
                      $done = "Password Changed";
                   } else {
                    $this->errors[] = "Password couldn't be changed try again later";
                   }                    
               } else {
                $this->errors[] = "Username and/or Password is incorrect.";
               }
               return $result;
               // Close the PDO connection at the end of the script or when it's no longer needed
               $this->db = null;
        }
    }


    } catch (PDOException $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data can't be retrieved";
                // print "An Exception occurred. Message: " . $e->getMessage();
                //print "The system is busy please again try later";
                // $date = date('m.d.y h:i:s');                
                // $eMessage = $date . " | Exception Error | , " . $e->getMessage() . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Exception Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom:
                // Error Log <errorlog@helpme.com>" . "\r\n");

    } catch (PDOError $e) {
                $this->errors[] = $e->getMessage();
                $this->errors[] = "Data cannot be retrieved";
                // print "An Error occurred. Message: " . $e->getMessage();
                // print "The system is busy please try later";
                // $date = date('m.d.y h:i:s');        
                // $eMessage = $date . " | Error | , " . $e->getMessage() . |\n";
                // error_log($eMessage,3,ERROR_LOG);
                // e-mail support person to alert there is a problem
                // error_log("Date/Time: $date - Error, Check error log for
                //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error Log
                // <errorlog@helpme.com>" . "\r\n");

    }        

?>