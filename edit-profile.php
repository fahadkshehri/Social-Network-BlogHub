<!-- //مكان تكتب الاسم
مكان تكتب في البايو انبت كلها
وملف تسوي فيه ابلود للبيكتشر -->


<!DOCTYPE html>
<html>
  <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>
    <h1>Edit profile</h1>
    <p>Click to edit the following: </p>


    <?php
      if(isset($_POST['submit'])){
        $check = $_FILES["fileToUpload"]["tmp_name"];
        echo $check;
      }


    ?>


    <form action="edit-profile.php" method="post" enctype="multipart/form-data">
      First name: <input type="text" name="name" id="name"><br>
      <br >
      <textarea name="bio" id="bio" rows="4" cols="50">
          Enter your bio here..
      </textarea>
      <br>
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <br>
      <input type="submit" value="Upload Image" name="submit">
      <br>
    </form>



    <a href='./'>Back to Home</a>

  </body>
</html>
