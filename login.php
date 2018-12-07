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
      <form class='border p-4'>
        <div class='form-group'>
          <label for='username'>Username:</label>
          <input type='text' class='form-control' id='username'>
        </div>
        <div class='form-group'>
          <label for='password'>Password:</label>
          <input type='password' class='form-control' id='password'>
        </div>

        <button type='submit' class='btn btn-lg btn-dark'>Login</button>
      </form>

      New user? <a href='register.php'>Register here.</a>
    </div>
  </body>
</html>