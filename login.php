<?php
$errors = array();
if (isset($_POST['username']) || isset($_POST['password'])) {
    include 'classes/users.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === '') {
        $errors[] = 'Username cannot be empty.';
    }

    if ($password === '') {
        $errors[] = 'Password cannot be empty.';
    }

    if (count($errors) == 0) {
        $errors[] = loginUser($username, $password);
    }
}
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
    <div class='container p-5 mb-2'>
      <h2>Login to your Account</h2>
      <form class='border p-4' action='login.php' method='post'>

        <?
if (count($errors) > 0) {
    ?>
    <ul class='mb-3'>
    <?
    foreach ($errors as $error) {
        ?>
      <li class='text-danger'><?=$error ?></li>
    <?
    }
    ?>
    </ul>
  <?
}
?>

        <div class='form-group'>
          <label for='username'>Username:</label>
          <input type='text' class='form-control' id='username' name='username'>
        </div>
        <div class='form-group'>
          <label for='password'>Password:</label>
          <input type='password' class='form-control' id='password' name='password'>
        </div>

        <button type='submit' class='btn btn-lg btn-dark'>Login</button>
      </form>

      New user? <a href='register.php'>Register here.</a>
    </div>
  </body>
</html>