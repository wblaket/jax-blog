<!-- Blake Tharp
  This file will be ran when the edit_profile.php page first loads.
  It will execute the displayBlogPosts function to print the blog posts in
  descending order by date
-->
<?php
  session_start();
  require ('includes/mysqli_connect.php');
  require ('includes/blog_functions.inc.php');
  displayProfileInfo($dbc, null, true);
?>
