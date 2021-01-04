<!-- Blake Tharp Last Updated 1.1.21
  This page includes all of the login functions to be used by multiple
  web pages.
-->

<?php

  function redirect_user ($page = 'jaxblog/login.php') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER)['PHP_SELF'];
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    header("Location: $url");
    exit();
  }


  function check_login($dbc, $user_id = '', $password = '') {

    $errors = array();
    if (empty($user_id)) {
      $errors[] = 'You forgot to enter your username.';
    } else {
      $u = mysqli_real_escape_string($dbc, trim($user_id));
    }

    if (empty($password)) {
      $errors[] = 'You forgot to enter your password.';
    } else {
      $p = mysqli_real_escape_string($dbc, trim($password));
    }

    if (empty($errors)) {
      $q = "SELECT user_id, user_fn FROM users WHERE user_id ='$u' AND user_password ='$p'";
      $r = @mysqli_query($dbc, $q);

      if (mysqli_num_rows($r) == 1) {
        $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
        return array(true, $row);
        redirect_user('jaxblog/home.php');
      } else {
        $errors[] = 'The user and/or password entered do not match those on file.';
      }
    }
      return array(false, $errors);
  }
 ?>
