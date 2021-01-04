<?php
  // include session information
  session_start();
  require ('includes/mysqli_connect.php');
  require ('includes/blog_functions.inc.php');

  // Get the pointer from the ajax function displayNextPage() and convert it to an int.
  $pointer = (int) $_GET['q'];
  // Run the displayBlogPosts function with the pointer from the ajax function
  displayBlogPosts($dbc, $pointer, false); // Since we're loading a new page, pass 'false' to function

 ?>
