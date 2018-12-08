<!DOCTYPE html>
<html>
  <head>
    <title>Edit Profile</title>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/app.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css">
<!-- //مكان تكتب الاسم
مكان تكتب في البايو انبت كلها
وملف تسوي فيه ابلود للبيكتشر -->



<!DOCTYPE html>
<html>
  <?php
include 'head.php';
?>
  <body>
  <?php
include 'menu.php';
?>
  </head>
  <body>
    <h1>Edit profile</h1>
    <p>Click to edit the following: </p>

    <form action="/action_page.php">
      First name: <input type="text" name="Name: "><br>
    </form>
<br>
    <textarea rows="4" cols="50">
Enter your bio here..
</textarea>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>


    <!-- <p>Username: </p>
    <p>Email: </p>
    <p>Bio: </p> -->
<br>
<br>

    <a href='./'>Back to Home</a>
  </body>
</html>
