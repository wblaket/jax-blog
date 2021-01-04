<!-- Blake Tharp Last Updated 1.1.21
  This page will display the user's profile and display options to edit the profile.
  It will use the ajax function loadEditPage() located in ajax_functions.inc.js
  to pull down the user's profile info from the database.

  It also includes a form for updating profile picture, password, and bio.
  The update bio form uses an ajax function to update.
-->
<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
   redirect_user();
  }
  include ("includes/header.html");
 ?>

<html>
  <head>
    <title>JaxBlog | Edit Profile</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="includes\styles.css">
    <script src="includes/ajax_functions.inc.js"></script>
  </head>
  <body onload="loadEditPage()">
    <div class="content-wrap">
      <section id="profile_area">
          <div id ="profile_info">
              <!-- PHP code will fill this section in with the profile info -->
          </div>

          <div id="edit_fields">
            <h1>Update Profile Picture</h1>
            <form id="upload_profilepics" action="update_profile_pics.php"
              method ="post"  enctype="multipart/form-data">
              <label for="upload">Choose your profile picture:</label>
              <input type="file" name="upload" />
              <input type="submit" name ="submit" value="Upload Profile Pic" class="editpagebutton" />
            </form>

          <h1>Update Password</h1>

          <form id="update_password" action="update_password.php" method ="post"  enctype="multipart/form-data">
            <label class="update_password" for="old_password">Old Password:</label>
            <input type="password" name="old_password" id="old_password" required/>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required/>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required/>

            <input type="submit" name ="submit" value="Update Your Password" class="editpagebutton" />
          </form>

          <h1>Update Bio</h1>
          <form id="update_bio">
            <textarea name="bio_txt" id="bio_txt" rows="10" cols="50" maxlength="500" required /></textarea>
            <br />
            <button type="button" id="update_bio_button" name="submit" class="editpagebutton" onclick="insertBio(bio_txt.value)"/>Update Bio</button>

          </form>
        </div>
      </section>
    </div>
  </body>
</html>
