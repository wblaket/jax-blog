<?php
  /* This file will be ran when the home.php page first loads.
  It will execute the displayBlogPosts function to print the blog posts in
  descending order by date. */
  session_start(); // Include login session
  require ('includes/mysqli_connect.php');
  require ('includes/blog_functions.inc.php');
  displayBlogPosts($dbc, null, true);
?>
