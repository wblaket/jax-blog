<!-- Blake Tharp Last Updated 12.30.20
  This PHP file will receive the user bio from the ajax function "insertBio()"
  located in ajax_functions.inc.php and insert the text into the database.
-->

<?php
  session_start(); // Include session info.
  require ('includes/mysqli_connect.php'); // Include SQL database connection.
  require ('includes/blog_functions.inc.php');

  $bioTxt = $dbc-> real_escape_string($_GET['q']); // Get the user bio text from ajax function
  $user_id = $_SESSION['user_id'];

  // Update the user entry in the database with the bio text
  $q = "UPDATE users SET user_bio = '$bioTxt' WHERE user_id = '$user_id'";
  $r = @mysqli_query ($dbc, $q);

  /* If the bio was successfully updated, display the blog posts
  starting with the latest blog posts: */
  if ($r) {
    displayProfileInfo($dbc, $user_id);
  } else {
    // If update fails display database errors:
    echo "<p>Something went wrong!</p>";
    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
  }
  mysqli_close($dbc);
?>
