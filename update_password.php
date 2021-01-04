<!-- Blake Tharp Last Updated 12.30.20
  This page is used by edit_profile.php to update the password for the end-user.
  It collects the password from the page and updates the database.
-->

<?php
  session_start(); // Include the session information
  include ('includes/header.html'); // Include the page header
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = array();
    require ('includes/mysqli_connect.php'); // Include database connection
    $user_id = $_SESSION['user_id']; // Get user ID from session

    // Collect the passwords from the form:
    $old_password = trim($_REQUEST['old_password']);
    $new_password = trim($_REQUEST['new_password']);
    $confirm_password = trim($_REQUEST['confirm_password']);


    // Check and see if the old password is correct.
    $currentPasswordCheck = @mysqli_query ($dbc, "SELECT user_password FROM users WHERE user_id = '$user_id'");
    if ($currentPasswordCheck) {
      while ($row = mysqli_fetch_array($currentPasswordCheck, MYSQLI_ASSOC)){
        // If the old password is NOT the current password, add error message:
        if ($old_password != $row['user_password']) {
          $errors[] = '<p>Your current password is invalid. Please try again</p>';
        }
      }
    }

    // Check and make sure the new password and the confirmed new password match:
    if ($new_password != $confirm_password) {
      $errors[] = '<p>The new passwords you have entered do not match.</p>';
    }

    if (empty($errors)) {
        // If ther are no errors, update the password:
        $q = "UPDATE users SET user_password = '$new_password' WHERE user_id = '$user_id'";
        $r = @mysqli_query ($dbc, $q); // Run query
        if ($r) {
          echo '<h1>Your password was successfully updated.</h1>';
          echo '<h1>You will now be asked to log back in.</h1>';

          // Destroy the login session and force the user to return to the login page:
          $_SESSION = array();
          session_destroy();
          setcookie ('PDPSESSID', '', time()-3600, '/', '', 0, 0);
          header("Refresh:3; url=login.php");


        } else {
          // If the update query failed, print the mysqli errors:
          echo '<p>Something went wrong:</p>';
          echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q. '</p>';
        }
        mysqli_close($dbc);
    } else {
      // Print error messages:
      echo '<h1>An error has occured</h1>';
      foreach ($errors as $msg) {
          echo "Error - $msg<br />\n";
        }
    }
  } else {
    echo '<p>Something went wrong</p>';
  }

 ?>
