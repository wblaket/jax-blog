<!-- Blake Tharp Last Updated 1-1-21
  This file will be used to destroy the login session when the logout button is clicked.
  It will then redirect user to the login page.
-->

<?php
  session_start(); // Include session information
  include ('includes/header.html'); // Include the page header

  // If there isn't already a login session, redirect user back to login page:
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user();
  } else {
    // Destory the login session:
    $_SESSION = array();
    session_destroy();
    setcookie ('PDPSESSID', '', time()-3600, '/', '', 0, 0);
  }
  // Redirect user back the login page after several seconds
  echo "<h1>Logged out</h1><h1>You are now logged out!</h1>";
  header("Refresh:3; url=login.php");
?>
