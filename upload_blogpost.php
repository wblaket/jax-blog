<!-- Blake Tharp Last Updated 12-30-20
  This PHP file will receive the blog post texst from the ajax function insertBlog()
  located ajax_functions.inc.js and insert the blogpost into the database,
  then display the blog posts again.
-->

<?php
  session_start(); // Include session information
  date_default_timezone_set('America/New_York'); // Set time-zone to EST

  require ('includes/mysqli_connect.php'); // Include SQL database connection.
  require ('includes/blog_functions.inc.php'); // Include blog functions file to use the displayBlogPosts() function.
  // Get the blog post from the ajax function
  $blogText = $dbc-> real_escape_string($_GET['q']);
  $user_id = $_SESSION['user_id'];

  $datetime = date("Y-m-d H:i:s"); // Get the current date and time
  $q = "INSERT INTO blogposts (blog_txt, blog_time, user_id) VALUES ('$blogText', '$datetime', '$user_id') ";
  $r = @mysqli_query ($dbc, $q); // Run query

  /* If the blog was successfully uploaded, display the blog posts
  starting with the latest blog posts */
  if ($r) {
    displayBlogPosts($dbc, null, true);
  } else { // If upload fails display database errors.
    echo "<p>Something went wrong!</p>";
    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
  }
  mysqli_close($dbc);
?>
