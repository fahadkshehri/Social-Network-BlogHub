<?php
session_start();
?>
<nav class="navbar sticky-top navbar-dark bg-dark">
  <a class="navbar-brand mr-auto" href='./'><h1>BlogHub</h1></a>

  <?
if (isset($_SESSION['username'])) {
    ?>
    <a class='mr-2' href='profile.php'>
      <img class='profile-picture-sm' src='default-user.png'/>
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
