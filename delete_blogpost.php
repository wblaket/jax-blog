<!-- Blake Tharp Last Updated 1.1.21
    This page will be ran by the ajax function "deleteBlog()" located in
    ajax_functions.inc.php.  It will delete the blog post from the database
    based off the blog ID.
-->

<?php
  session_start();
  require ('includes/mysqli_connect.php');
  require ('includes/blog_functions.inc.php');

  // Get the blog ID of the blog post being deleted from Ajax function deleteBlog()
  $blogID = $_GET['q'];

  // Delete blog post from database:
  $q = "DELETE FROM blogposts WHERE blog_id = '$blogID'";
  $r = @mysqli_query ($dbc, $q);

  if($r) {
    // Redisplay blog posts again starting with newest post:
    displayBlogPosts($dbc, null, true);
  } else {
    // Print SQL errors in case something goes wrong:
    echo "<p>Something went wrong!</p>";
    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

  }
 ?>
