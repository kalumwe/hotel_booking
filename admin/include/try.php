<?php
include "db_config.php";
$DB_SERVER = 'localhost';
$DB_USERNAME = 'kalumba';
$DB_PASSWORD = 'C0ffeep0t';
$DB_DATABASE = 'hotel';
$DB_PORT = '3307';
try {
    $conn = new PDO("mysql:host=localhost;port=3307;dbname=hotel", DB_USERNAME, DB_PASSWORD);
   
                //$conn = new PDO("mysql:host=$DB_SERVER;port=$DB_PORT;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
                
                echo "conn";
                //if(mysqli_connect_errno())
            } catch (PDOException $e) {
                echo $e->getMessage();
                echo "Error: Could not connect to database.";
            }
            ?>