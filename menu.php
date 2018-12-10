<?php
session_start();
include_once('classes/profiles.php');
$profiles = new Profiles();
?>
<nav class="navbar sticky-top navbar-dark bg-dark">
  <a class="navbar-brand mr-auto" href='./'><h1>BlogHub</h1></a>

  <?
if (isset($_SESSION['username'])) {
    ?>
    <a class='mr-2' href='profile.php?username=<? echo $_SESSION['username'] ?>'>
      <img class='profile-picture-sm' src='https://s3-us-west-2.amazonaws.com/bloghub-profilepics/<? echo $profiles->getImage($_SESSION['username']); ?>'/>
    </a>
    <a class='btn btn-outline-light btn-lg mr-2' href='logout.php'>Logout</a>
    <?
} else {
    ?>
    <a class='btn btn-outline-light btn-lg mr-2' href='login.php'>Login</a>
    <a class='btn btn-outline-light btn-lg' href='register.php'>Register</a>
    <?
}
?>
</nav>
