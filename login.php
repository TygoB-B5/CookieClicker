<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="stylesheets/home.css">
</head>

<body>
  <div class="content">
    <div class="login">
      <h3>Log In</h3>
        <form  method="POST">
            <p>Username</p>
            <input type="text" name="name_login">
            <br>
            <p>Password</p>
            <input type="password" name="pass_login">
            <br><br>
            <input type="submit" name="submit" value="Log In">
        </form>
    </div>
    <br>
    <div class="register">
      <h3>Register</h3>
      <form  method="POST">
          <p>Username</p>
          <input type="text" name="name_register">
          <br>
          <p>Password</p>
          <input type="password" name="pass_register">
          <br><br>
          <input type="submit" name="submit" value="Register">
      </form>
    </div>
</div>

<div id="cookies"></div>

<script>

var cookieWrapper = document.getElementById('cookies');
var cookie = document.createElement('div');
cookie.classList.add('cookie');

var amountOfCookies = 15;
var cookies = [];
for (i = 0; i < amountOfCookies; i++) {
  var newCookie = cookie.cloneNode();
  cookies.push(newCookie);
  cookieWrapper.append(newCookie);
}

cookies.forEach(function(cookie) {
  var height = 0;
  var degrees = 0;
  var fall_speed = 0;

  reset();

  setInterval(fall, 10);

  function fall() {
    height += fall_speed;
    if (height < document.documentElement.clientHeight) {
      cookie.style.top = height + 'px';
    } else {
      reset();
    }
  }

  function reset() {
    height = 0;
    degrees = Math.random() * 360;
    fall_speed = Math.random() * 10 + 2;
    cookie.style.transform = 'rotate(' + degrees + 'deg)';
    cookie.style.left = Math.random() * document.documentElement.clientWidth + 'px';
  }
});

</script>
</body>
</html>

<?php
include_once 'php/connect_to_database.php';
include_once 'php/register_users.php';
include_once 'php/login_users.php';
include_once 'php/get_user_data.php';
?>


<?php

if(testfor_valid_register_input()) {
  if(register_user($_POST['name_register'], $_POST['pass_register']));
}



if(testfor_valid_login_input())
{
  if(login_correct($_POST['name_login'], $_POST['pass_login'])) {

    echo 'logged in';

    begin_session($_POST['name_login'], $_POST['pass_login']);

    header('location: game/game.php');
  }
  else
  {
    echo 'Wrong username / password';
  }
}

function begin_session($username, $password) {

  $current_user_data = get_user_data($username, $password);
  $_SESSION['data'] = $current_user_data;
  $_SESSION['data']['pass'] = null;
}

//validate data functions
#region
function testfor_valid_login_input() {

  if(!isset($_POST['name_login']) || !isset($_POST['pass_login'])) {
    return false;
  }

  if($_POST['name_login'] == '' || $_POST['pass_login'] == '') {
    return false;
  }

  if(strlen($_POST['name_login']) > 8) {
    return false;
  }

  if(strlen($_POST['pass_login']) > 8) {
    return false;
  }

  return true;
}

function testfor_valid_register_input() {

  if(!isset($_POST['name_register']) || !isset($_POST['pass_register'])) {
    return false;
  }

  if($_POST['name_register'] == '' || $_POST['pass_register'] == '') {
    return false;
  }

  if(strlen($_POST['name_register']) > 8) {
    echo 'username too long';
    return false;
  }
  return true;
}

#endregion

?>
