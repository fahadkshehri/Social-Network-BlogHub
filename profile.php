<?php
include 'classes/profiles.php';

session_start();
$username = $_GET['username'];

$profile = new Profiles();
$profile->getProfile($username);

?>
<!DOCTYPE html>
<html>
  <?php
include 'head.php';
?>
  <body>
  <?php
include 'menu.php';
?>

    <div class='container p-5'>
      <h1>Profile Page</h1>

      <div class='border p-4 d-flex flex-row'>
        <img class='profile-picture mr-4' src='default-user.png' />

        <h2>Username: <?=$username ?> </h2>

      </div>
      <a class='btn btn-primary' href='edit-profile.php'>Edit Profile</a>
    </div>
  </body>
</html>
