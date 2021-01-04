<!-- Blake Tharp Last Update 1.1.21
  This file provides the login and registration forms that will send the input
  to the registerUser() and loginUser() ajax functions included in
  ajax_functions.inc.js.
-->

<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user('jaxblog/home.php');
  }
?>
 <head>
   <link rel="stylesheet" href="includes\styles.css">
   <title>JaxBlog | Login </title>
 </head>

 <header>
   <h1 id="title">'Jax Blog</h1>
 </header>
 <body>
   <div class="content-wrap">
    <h1>Don't have an account? Register in less than a minute:</h1>
      <div class="registration_container">
        <div class="registration_label"><label for="new_userid">Username:</label></div>
        <div class="registration_input"><input type="text" name="new_userid" id="new_userid" required/></div>
        <div class="registration_label"><label for="user_fn">First Name:</label></div>
        <div class="registration_input"><input type="text" name="user_fn" id="user_fn" required/></div>
        <div class="registration_label"><label for="user_ln">Last Name:</label></div>
        <div class="registration_input"><input type="text" name="user_ln"  id="user_ln" required/></div>
        <div class="registration_label"><label for="user_email">E-mail Address:</label></div>
        <div class="registration_input"><input type="email" name="user_email" id="user_email" required/></div>
        <div class="registration_label"><label for ="birthday">Birthday:</label></div>
        <div class="registration_input"><input type="date" id="birthday" name="birthday"></div>
        <div class="registration_label"><label for="new_user_password">Password:</label></div>
        <div class="registration_input"><input type="password" name="new_user_password" id="new_user_password" required/></div>
        <div><button type="button" id="register_button" name="register" onclick="registerUser(new_userid.value, user_fn.value,
        user_ln.value, user_email.value, new_user_password.value, birthday.value)"/>Register</button></div>
      </div>
      <h1>Already have an account? Login here:</h1>
      <div id="login_form">
        <div>
          <label for="user_id">Username:</label>
          <input type="text" name="user_id" id="user_id" required>
        </div>
        <div>
          <label for="user_password">Password:</label>
          <input type="password" name="user_password" id="user_password" required />
        </div>
        <div>
          <button type="button" id="login_button" name="login" onclick="loginUser(user_id.value, user_password.value)">Login</button>
        </div>
      </div> <!-- END of login_form div -->
      <div id="confirmation"></div>
    </div> <!-- END of content-wrap div -->
  <script src="includes/ajax_functions.inc.js"></script>
</body>
