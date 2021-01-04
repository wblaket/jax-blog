<!-- Blake Tharp last updated 1.1.21
  This page displays the home page
  The ajax function loadHomePage() will automatically run when the page is loaded,
  and call home_page_load.php to display the

-->

<?php
  session_start(); // Include session
  if (!isset($_SESSION['user_id'])) { // If there's no session running, redirect user to the login page.
    require ('includes/login_functions.inc.php');
    redirect_user();
  }
  // Insert the page header
  include ('includes/header.html');
?>

<HTML>
  <head>
      <title>Jax Blog | Home </title>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="includes\styles.css">
  </head>

  <body onload="loadHomePage()">
  <div class="content-wrap">
    <form id="post_blog">
      <textarea id ="blogPost" name="blogPost" minlength="1" maxlength="140" rows="5" col="100"
      placeholder="What are you thinking about?" required/></textarea>

      <button type="button" id="submitbutton" name="submit" onclick="insertBlog(blogPost.value)"/>Post</button>
    </form>

    <div id="displayBlogPosts">
      <!-- Blog posts will be filled in here by the Ajax Functions  -->
    </div>

    <script src="includes/ajax_functions.inc.js"></script>
    </div>
    </body>
</HTML>
