/* Blake Tharp 11.15.20
This file will act as a master file for all ajax functions used by Jaxblog
*/

// Function used by home.php to insert blog posts into the database.
function insertBlog(blogTxt) {
  console.log(blogTxt);
  if (blogTxt.length == 0 ) {
    return;
  } else {
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("displayBlogPosts").innerHTML = this.responseText;
      }
    }
  };
  ajaxRequest.open("GET", "upload_blogpost.php?q=" + blogTxt, true);
  ajaxRequest.send();
}

// Function used by both home.php and search_blogs.php to delete user's blog posts.
function deleteBlog(blogID) {
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200 ) {
      document.getElementById("displayBlogPosts").innerHTML = this.responseText;
    }
  }
  ajaxRequest.open("GET", "delete_blogpost.php?q=" + blogID, true);
  ajaxRequest.send();
}

// Function executed by home.php immediately to load current blog posts.
function loadHomePage() {
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200 ) {
      document.getElementById("displayBlogPosts").innerHTML = this.responseText;
    }
  }
  ajaxRequest.open("GET", "home_page_load.php", true);
  ajaxRequest.send();
}

// Function to load user information when edit_profile.php is loaded.
function loadEditPage() {
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200 ) {
      document.getElementById("profile_info").innerHTML = this.responseText;
    }
  }
  ajaxRequest.open("GET", "edit_page_load.php", true);
  ajaxRequest.send();
}

// Function to be used by displayBlogPosts(). It will pass the pointer variable to display_nextpage
function displayNextPage(pointer) {
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200 ) {
      document.getElementById("displayBlogPosts").innerHTML = this.responseText;
    }
  }
  ajaxRequest.open("GET", "display_nextpage.php?q=" + pointer, true);
  ajaxRequest.send();
}

// Function used by login.php that takes the form information
// and sends to register_user.php for processing
function registerUser(user_id, user_fn, user_ln, user_email, user_password, birthday) {
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200 ) {
      document.getElementById("confirmation").innerHTML = this.responseText;
    }
  }
  ajaxRequest.open("GET", "register_user.php?user_id=" + user_id + "&user_fn=" + user_fn + "&user_ln=" + user_ln +
  "&user_email=" + user_email + "&user_password=" + user_password + "&birthday=" + birthday, true);
  ajaxRequest.send();
}

// Function used by search_blogs.php to collect search term
// and send to search_blogs.inc.php to run search
function blogSearch(sterm) {
  if (sterm.length == 0) {
    document.getElementById("searchResults").innerHTML = "";
    return;
  } else {
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200)  {
        document.getElementById("searchResults").innerHTML = this.responseText;
      }
    }
  };
  ajaxRequest.open("GET", "search_blogs.inc.php?q=" + sterm, true);
  ajaxRequest.send();
}

// Function used by edit_profile.php to collect user's new bio and
// send to upload_biotxt.php to update the database.
function insertBio(bioTxt) {
  if (bioTxt.length == 0 ) {
    return;
  } else {
    var ajaxRequest = new XMLHttpRequest();
    ajaxRequest.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        location.reload(); // Refresh the page to display new Bio
      }
    }
  };
  ajaxRequest.open("GET", "upload_biotxt.php?q=" + bioTxt, true);
  ajaxRequest.send();
}

// Function used to log users in. Information is sent to login.inc.php,
// which will send a response 'true' if successful and 'false' if unsuccessful.
// Function will also move user to the home.php page if succesful.
function loginUser(user_id, user_password) {
  var ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (this.responseText == "false") {
        document.getElementById("confirmation").innerHTML = "<p class=\"error\">An error occured. Your username or password was incorrect.";
      } else {
        document.getElementById("confirmation").innerHTML = "Login succesful!";
      }

      if (document.getElementById("confirmation").innerHTML.toString() == "Login succesful!") {
        window.location.replace('../jaxblog/home.php');
      }
    }
  }
  ajaxRequest.open("GET", "login.inc.php?user_id=" + user_id + "&user_password=" + user_password, true);
  ajaxRequest.send();
}
