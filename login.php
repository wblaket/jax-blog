<!-- Blake Tharp Last Update 6.7.21
  This file provides the login and registration forms that will send the input
  to the registerUser() and loginUser() ajax functions included in
  ajax_functions.inc.js.
-->

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require ('includes/login_functions.inc.php');
  require ('includes/mysqli_connect.php');
  list ($check, $data) = check_login($dbc, $_POST['user_id'], $_POST['user_password']);

  if ($check) {
    session_start();
    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['first_name'] = $data['first_name'];
    redirect_user('jax-blog/loggedin.php');
  } else {
    $errors = $data;
  }
  mysqli_close($dbc);
}
include ('includes/login_page.inc.php');
?>
