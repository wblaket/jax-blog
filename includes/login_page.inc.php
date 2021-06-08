<!-- Blake Tharp Last Update 1.1.21
  This file provides the login and registration forms that will send the input
  to the registerUser() and loginUser() ajax functions included in
  ajax_functions.inc.js.
-->

<?php
  include ('includes/header.html');
  // Print any error messages:
  if (isset($errors) && !empty($errors)) {
    echo '<div class="error"><h1 class="error">The following error(s) occured:<br />';
    foreach ($errors as $msg) {
      echo " - $msg<br />";
    }
    echo '</h1><h1>Please try again.</h1></div>';
  }
?>

 <head>
   <link rel="stylesheet" href="includes\styles.css">

   <title>JaxBlog | Login </title>
 </head>

 <body>
   <div class="content-wrap">
     <!--------------------- USER REGISTRATION FORM -------------->
    <h1>Don't have an account? Register in less than a minute:</h1>
    <form action="register_user.php" class="registration_container" method="post">

        <div class="registration_label">
          <label for="new_userid">Username:</label>
        </div>
        <div class="registration_input">
          <input type="text" name="new_userid" id="new_userid" required/>
        </div>

        <div class="registration_label">
          <label for="user_fn">First Name:</label>
        </div>
        <div class="registration_input">
          <input type="text" name="user_fn" id="user_fn" required/>
        </div>

        <div class="registration_label">
          <label for="user_ln">Last Name:</label>
        </div>
        <div class="registration_input">
          <input type="text" name="user_ln"  id="user_ln" required/>
        </div>

        <div class="registration_label">
          <label for="user_email">E-mail Address:</label>
        </div>
        <div class="registration_input">
          <input type="email" name="user_email" id="user_email" required/>
        </div>

        <div class="registration_label">
          <label for ="birthday">Birthday:</label>
        </div>
        <div class="registration_input">
          <input type="date" id="birthday" name="birthday">
        </div>

        <div class="registration_label">
          <label for="new_user_password">Password:</label>
        </div>
        <div class="registration_input">
          <input type="password" name="new_user_password" id="new_user_password" required/>
        </div>
        <p><input id="register_button" type="submit" name="register" value="Register" class="button"/></p>
      </div>
    </form>

        <!--------------------- USER LOGIN FORM ------------------>
      <h1>Already have an account? Login here:</h1>
      <form action="login.php" id="login_form" method="post">
        <div>
          <label for="user_id">Username:</label>
          <input type="text" name="user_id" id="user_id" required>
        </div>
        <br />
        <div>
          <label for="user_password">Password:</label>
          <input type="password" name="user_password" id="user_password" required />
        </div>
        <div>
          <input id="login_button" type="submit" name="login" value="Login" class="button"/>
        </div>
      </form> <!-- END of login_form div -->
      <div id="confirmation"></div>
    </div> <!-- END of content-wrap div -->
</body>
