<?php
/*PHP Solution 11-9: Using Sessions for a Multipage Form*/

if (!isset($_SESSION)) {
session_start();
}
$filename = basename($_SERVER['SCRIPT_FILENAME']);  //(319)
$current = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
//create the URLs for the first and next pages(319)
$redirectFirst = str_replace($filename, $firstPage, $current);
$redirectNext = str_replace($filename, $nextPage, $current);
//To prevent users from accessing the multipage form without starting at the beginning
if ($filename != $firstPage && !isset($_SESSION['formStarted'])) {
    header("Location: $redirectFirst");
    exit;
}
?>