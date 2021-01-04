<!-- Blake Tharp Last Updated 1.1.2021
  This file will be used by the loginUser() ajax function found in ajax_functions.inc.js
  It will collect the username and password from the function and check the login
  and will return true or false dependin on if the check is successful.
-->

<?php

  require ('includes/login_functions.inc.php');
  require ('includes/mysqli_connect.php');
  list ($check, $data) = check_login($dbc, $_GET['user_id'], $_GET['user_password'] );

  if ($check) {
    // If login was succesful start the session, and send a response of "true" to the ajax function:
    session_start();
    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['user_fn'] = $data['user_fn'];
    echo 'true';
  } else {
    // If the login was not succesful send a response of "false":
    echo 'false';
  }
  mysqli_close($dbc); // close database connection
?>
