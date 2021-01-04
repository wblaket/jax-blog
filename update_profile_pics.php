<!-- Blake Tharp Last Updated 12.30.20
  This page is used by edit_profile.php to update the profile picture for the end-user.
  It collects the file from the page and uploads it into the database.
-->

<?php

  session_start(); //Include session information
  include ('includes/header.html'); // Print page header
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    require ('includes/mysqli_connect.php');

    // If file is selected
    if (isset($_FILES['upload']) && !empty($_FILES['upload']['tmp_name'])) {
      // Create array of acceptable file types
      $allowed = array ('image/jpeg', 'image/JPG', 'image/PNG', 'image/png', 'image', 'image/GIF', 'image/gif');
      // If the file type is in the range of accepted file types
      if (in_array($_FILES['upload']['type'], $allowed)) {
        // Attempt to move the file to the JaxBlog directory
        if (move_uploaded_file ($_FILES['upload']['tmp_name'], "includes/profilepics/{$_FILES['upload']['name']}")) {
          // Store the file path in a variable
          $imageFilePath = "includes/profilepics/{$_FILES['upload']['name']}";
        } else {
          // If the file couldn't move to the JaxBlog directory, add error message to array
          $errors[] = 'Unable to update profile picture.';
        }
      } else {
        // If the file wasn't the correct file type, add error message to array
        $errors[] = 'Please upload a JPEG, GIF, or PNG image.';
      }
    }
  } else {
    // If file wasn't selected, add error message to array.
    $errors[] = "File not selected.";
  }

  // If no errors encountered.
  if (empty($errors)) {

    $user_id = $_SESSION['user_id'];
    // Update the image file path for the user's profile picture in the database
    $q = "UPDATE users SET imageFilePath = '$imageFilePath' WHERE user_id = '$user_id'";
    $r = @mysqli_query ($dbc, $q);
    if ($r) {
      // If the profile picture update was successful, redirect back to the user info page
      header("Location: edit_profile.php");
      exit();
    } else {
      // else print error messages.
       echo '<p>Your profile picture could not be uploaded.</p>';
      echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q. '</p>';
     }
     mysqli_close($dbc); // close database connection
  } else {
    //print error messages
    echo '<h1>An error has occured</h1>';
    foreach ($errors as $msg) {
        echo "Error - $msg<br />\n";
      }
  }

 ?>
