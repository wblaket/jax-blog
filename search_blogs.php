<!-- Blake Tharp Last Updated 12.30.20
  This page will send user input to the ajax fucntions blogSearch() function
  located in the ajax_functions.inc.js file, and instantly display the results:
-->
<?php
  session_start(); // Include session
  // Redirect user if there's not a login session:
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
   redirect_user();
  }

  include ('includes/header.html'); // Display the page header
?>
<html>
<head>
    <title>Jax Blog | Search Posts</title>
</head>
  <body>
    <div class="content-wrap">
        <script src="includes/ajax_functions.inc.js"></script>
        <form id="searchform">
            <p><label>Looking for something?</p></label>
            <input type="text" name="searchterm" type="text" size="140"
            onkeyup="blogSearch(this.value)">
        </form>
      <div id="searchResults">
        <!-- Search results will be generated here. -->
      </div>
    </div>
  </body>
</html>
