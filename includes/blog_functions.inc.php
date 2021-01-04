<!-- Blake Tharp Last Updated 1.1.21
  This a master file for commonly used PHP functions:
-->
<?php
  $firstBlogPost = 0;

  /* This function will be used to display 10 blog posts.
  It will accept three variables: the database connection, a pointer
  and a boolean that will check if we're loading the home page for the first time or not. */
  function displayBlogPosts($dbc, $pointer, bool $loadFirstPage) {
    // If we're loading the first page, query the database for the first 10 blog posts.
    if ($loadFirstPage == true) {
      $getBlogPosts = @mysqli_query ($dbc, "SELECT * FROM blogposts ORDER BY blog_time DESC LIMIT 10");
      // Intialize the pointer, which will store the ID of the blog at the top of the page. We will use the varaible for future queries
      // to determine which 10 blog posts we have to display next when the 'next' or 'previous' buttons are clicked.
      $pointer = getNewestBlogPost($dbc);
    // Otherwise, query the database for the next 10 blog enteries using the pointer.
    } else {
      $getBlogPosts = @mysqli_query ($dbc, "SELECT * FROM blogposts WHERE blog_id <= '$pointer' ORDER BY blog_time DESC LIMIT 10");
    }

    if ($getBlogPosts) { // If the query ran successfully:
      while ($row = mysqli_fetch_array($getBlogPosts, MYSQLI_ASSOC)) {
        $rowDateTime = strtotime($row['blog_time']); // Get the timestamp from when the blog was posted
        $user_id = $row['user_id']; // Get the username
        // Query the database for the user information based off the user_id tied to the blog post
        $userQuery = @mysqli_query ($dbc, "SELECT imageFilePath, user_fn, user_ln FROM users WHERE user_id = '$row[user_id]'");
        $userResult = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
        $imageFilePath = $userResult['imageFilePath'];
        $user_fn = $userResult['user_fn'];
        $user_ln = $userResult['user_ln'];
        // Print out the blog post:
        echo '<section class="blog_area"><div class="blog_poster"><img class="profilepic" src="' . $imageFilePath . '"/> <br>' . $user_fn . ' ' . $user_ln .
        '<span style="font-style:italic"> (' . $user_id .  ')</span><br /></div><div class="blog_content">
        <span class=datetime>' . date('n/j/y g:i:A ', $rowDateTime) . '</span><br>' . '   ' . $row['blog_txt'] . ' ' ;

        // Include a delete option, but only for user's own posts:
        if ($_SESSION['user_id'] == $row['user_id']) {
          echo '<br><button class="deleteButton" onclick="deleteBlog(' . $row['blog_id'] . ')">Delete</button></div></section>';
        } else {
          echo '</p></div></section>';
        }
      }
      // Set the pointer variables:
      $pointerPrevPage = $pointer + 10;
      $pointerNextPage = $pointer - 10;

      $topOfPage = getTopBlogPost($dbc, $pointer);
      $newestBlogPost = getNewestBlogPost($dbc); // Get blog ID of the newest blog in database

      echo '<div id=navButtons>';
      // If the top blog post of the previous page is the newest one, don't display a previous button.
      if ($newestBlogPost != $topOfPage){
        echo '<button type="button" id="prevPage" name="prevPage" onclick=displayNextPage('. $pointerPrevPage . ') />Previous Page </button>';
      }
      // If we've reached 10 blog posts and there's more blog posts after this page, display a next button.
      if (mysqli_num_rows($getBlogPosts) === 10 && checkMorePosts($dbc, $pointer) == true) { // If we haven't reached the end of the blog posts yet, display the option for another
        echo '<button type="button" id="nextPage" name="nextPage" onclick=displayNextPage(' . $pointerNextPage . ') />Next Page </button>';
      }
      echo '</div>';

    // If the query was not able to run, print the SQL error messages.
    } else {
      echo "<p>Something went wrong!</p>";
      echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
    }
    mysqli_close($dbc);
  }

  // Function that will return the blog ID of the newest blog post.
  function getNewestBlogPost($dbc) {
    $r = @mysqli_query ($dbc, "SELECT * FROM blogposts ORDER BY blog_time DESC LIMIT 1");
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
      $newestBlogPost = $row['blog_id'];
    }
    return $newestBlogPost;
  }


  function getTopBlogPost($dbc, $pointer) {
    $r = @mysqli_query($dbc, "SELECT blog_id FROM blogposts WHERE blog_id = '$pointer'");
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    $topBlogPost = $row['blog_id'];
    return $topBlogPost;
  }

  /* Function will check and see if there are any remaining blog posts
  after the 10 posts currently displayed */
  function checkMorePosts($dbc, $pointer) {
    $pointer = $pointer - 11;
    $r = @mysqli_query($dbc, "SELECT blog_id FROM blogposts WHERE blog_id = '$pointer'");

    if (mysqli_num_rows($r) == 0) {
      return false;
    } else {
      return true;
    }
  }

  // Function that will display user information on edit_profile.php
  function displayProfileInfo($dbc, $user_id) {

    // Run a query to pull user info based on username
    $user_id = $_SESSION['user_id']; // grab the username from session information
    $r = @mysqli_query($dbc, "SELECT * FROM users WHERE user_id = '$user_id'");
    if ($r) {
      while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $user_fn = $row['user_fn'];
        $user_ln = $row['user_ln'];
        $imageFilePath = $row['imageFilePath'];
        $user_email = $row['user_email'];
        $user_bio = $row['user_bio'];

        if ($imageFilePath == NULL) {
          $imageFilePath == "includes/profilepics/placeholder.png";
        }
        // If there's no user bio on record, display no information provided:
        if ($user_bio == null) { $user_bio = "No information provided."; }
        $user_dob = $row['user_dob'];

      // Print bio information:
      echo '<p><img class="profilepic" src="' . $imageFilePath . '"/> ' .
      //Display first and last name and username:
      $user_fn . ' ' . $user_ln . '<span class=username> (' .  $user_id . ')</span>' .
      '<p>' . $user_email . '</p>' .
      '<p><i>e-mail</i></p>' .
      // display date of birth
      '<p>' . $user_dob . '</p>' .
      '<p><i>birthday</i></p><br />' .
      // display bio information
      '<p>' . $user_bio . '</p>';
      }
    } else {
      // If the query couldn't run:
      echo "<p>Something went wrong!</p>";
      echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
    }
    mysqli_close($dbc);
  }
 ?>
