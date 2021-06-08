<!--- Blake Tharp Last Updated 1-1-2021
    This file takes the data from the "registerUser()" ajax function from
    ajax_functions.inc.php and uploads the user data into the database.
-->

<?php

  require ('includes/blog_functions.inc.php');
  include ('includes/header.html'); // Include page header
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require ('includes/mysqli_connect.php'); // create database connection
    if (!$dbc) {
      echo '<p>Something went wrong!</p>';
    }

    $user_id = $_REQUEST['new_userid'];
    $user_fn = $_REQUEST['user_fn'];
    $user_ln = $_REQUEST['user_ln'];
    $user_email = $_REQUEST['user_email'];
    $user_password = $_REQUEST['new_user_password'];
    $user_dob = $_REQUEST['birthday'];

    // Create error array
    $errors = array();

    // Check for duplicate username:
    $usernameCheck = @mysqli_query($dbc, "SELECT * FROM users WHERE user_id = '$user_id'");
    if (mysqli_num_rows($usernameCheck) != 0) {
      $errors[] = "Username is already in use.";
    }

    // Ensure that the fields are filled out
    if (empty($user_id) || empty($user_password) || empty($user_fn) || empty($user_ln) ||
  empty($user_email) || empty($user_dob)) {
      $errors[] = 'One or more fields are missing information.';
    }  else {
        $u = mysqli_real_escape_string($dbc, trim($user_id));
        $p = mysqli_real_escape_string($dbc, trim($user_password));
        $fn = mysqli_real_escape_string($dbc, trim($user_fn));
        $ln = mysqli_real_escape_string($dbc, trim($user_ln));
        $dob = mysqli_real_escape_string($dbc, trim($user_dob));
        $email = mysqli_real_escape_string($dbc, trim($user_email));
    }

    // Check and make sure the entered email is a valid address:
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    // Ensure that the fields are filled out
    if (empty($_POST['new_userid'])) {
      $errors[] = 'You forgot to enter the username';
    }

    if (empty($_POST['user_fn'])) {
      $errors[] = 'You forgot to enter your first name.';
    }

    if (empty($_POST['user_ln'])) {
      $errors[] = 'You forgot to enter your last name,';
    }

    if (empty($_POST['new_user_password'])) {
      $errors[] = 'You forgot to enter your password.';
    }

    if (empty($errors)) {
     $q = "INSERT INTO users (user_id, user_fn, user_ln, user_email, user_password, user_dob)
      VALUES ('$u', '$fn', '$ln', '$email', '$p', '$dob')";
      $r= @mysqli_query($dbc, $q);

      if ($r) {
        echo '<h1 id="login_success">You have successfully registered! Go ahead and login.</h1>';
        echo '<h1>You will be redirected back to the home page in 5 seconds</h1>';
        header("Refresh:5; url=home.php");
      } else {
        echo '<p class="error">Something went wrong!</p>';
        echo '<p class="error">' . mysqli_error($dbc) . '</p>';
      }
      mysqli_close($dbc);
    } else {
      echo '<p class="error">An error has occured.</p>';
      foreach ($errors as $msg) {
        echo '<p class="error">Error -'. $msg . '<br />';
      }
        echo 'Click <a href="login.php">here</a> to return to the registration page.</h1>';
    }
  }
?>
