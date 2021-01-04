<!-- Blake Tharp Last Updated 12.30.20

This page will pull information from the blogSearch() function located
in the ajax_functions.inc.js and output the results in search_blogs.php

-->

<?php
  // Establish connection to database.
  require ('includes/mysqli_connect.php');
  session_start();
  $searchterm = $_REQUEST['q']; // Grab the search term
  // Add wild cards to the search term for the MySQLi statement.
  $searchterm = "%" . $searchterm . "%";

  $q = "SELECT * FROM blogposts WHERE blog_txt LIKE '$searchterm'" ; // Create the query
  $r = @mysqli_query ($dbc, $q); // Run the query

  if ($r) {
    // If the query produces no results
    if (mysqli_num_rows($r) == 0 ){
      echo '<p class="error">Sorry, we could not find any blog posts.</p>';
      echo '<p class="error">Please refine your query and try again.</p>';
    } else {

      while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){

         $rowDateTime = strtotime($row['blog_time']);
         $user_id = $row['user_id'];
         // Run a new query to get the information of the user associated with the post
         $userQuery = @mysqli_query ($dbc, "SELECT * FROM users WHERE user_id = '$user_id'");
         $userQueryResults = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
         $user_fn = $userQueryResults['user_fn'];
         $user_ln = $userQueryResults['user_ln'];
         $imageFilePath = $userQueryResults['imageFilePath'];
         // Print the blog post to the search_blogs.php page
         echo '<section class="blog_area"><div class="blog_poster"><img class="profilepic" src="' . $imageFilePath . '"/> <br>' . $user_fn . ' ' . $user_ln .
         '<span class="username"> (' . $user_id .  ')</span><br /></div><div class="blog_content">
         <span class=datetime>' . date('n/j/y g:i:A ', $rowDateTime) . '</span><br>' . '   ' . $row['blog_txt'] . ' ' ;

         // Include a delete option, but only for users own posts
         if ($_SESSION['user_id'] == $row['user_id']) {
           echo '<br><button class="deleteButton" onclick="deleteBlog(' . $row['blog_id'] . ')">Delete</button></div></section>';
         } else {
           echo '</p></div></section>';
         }
      }
      mysqli_free_result ($r);
    }
  } else {
    echo "An error has occured.";
    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
  }
  mysqli_close ($dbc);   // close the database connection
 ?>
