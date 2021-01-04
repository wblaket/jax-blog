<!--- Blake Tharp Last Updated 1-1-2021
    This file takes the data from the "registerUser()" ajax function from
    ajax_functions.inc.php and uploads the user data into the database.
-->

<?php

  session_start();
  require ('includes/mysqli_connect.php');
  require ('includes/blog_functions.inc.php');

  $user_id = $_GET['user_id'];
  $user_fn = $_GET['user_fn'];
  $user_ln = $_GET['user_ln'];
  $user_email = $_GET['user_email'];
  $user_password = $_GET['user_password'];
  $user_dob = $_GET['birthday'];

  // Check for duplicate username:
  $usernameCheck = @mysqli_query($dbc, "SELECT * FROM users WHERE user_id = '$user_id'");
  if (mysqli_num_rows($usernameCheck) != 0) {
    $errors[] = "Username is already in use.";
  }

  // Check for empty fields:
  if ($user_fn == null || $user_ln == null || $user_email == null || $user_dob == null || $user_password == null
  || $user_id == null) {
    $errors[] = 'One or more fields are blank.';
  } else {
    $user_id = trim($user_id);
    $user_fn = trim($user_fn);
    $user_ln = trim($user_ln);
    $user_email = trim($user_email);
    $user_password = trim($user_password);
  }

  // Check and make sure the entered email is a valid address:
  if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'Invalid email format';
  }

  if (empty($errors)) {
   $q = "INSERT INTO users (user_id, user_fn, user_ln, user_email, user_password, user_dob)
    VALUES ('$user_id', '$user_fn', '$user_ln', '$user_email', '$user_password', '$user_dob')";
    $r= @mysqli_query($dbc, $q);

    if ($r) {
      echo '<h1 id="login_success">You have successfully registered! Go ahead and login.</h1>';
    } else {
      echo '<p class="error">Something went wrong!</p>';
      echo '<p class="error">' . mysqli_error($dbc) . '</p>';
    }
    mysqli_close($dbc);
  } else {
    echo '<p>An error has occured.</p>';
    foreach ($errors as $msg) {
      echo "Error - $msg<br />\n";
    }
  }
?>
