
<?
  include ("classes/s3-service.php");
  include ("classes/profiles.php");
 ?>

<!DOCTYPE html>
<html>
  <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>
    <h1>Edit profile</h1>
    <p>Click to edit the following: </p>


    <?php


      if(isset($_GET['username'])){
        $username = $_GET['username'];
      }

      $s3 = new S3();
      $profile = new profiles();

      if(isset($_POST['submit'])){

        $urlToImg = " ";

        if($_FILES["fileToUpload"]["tmp_name"]  != ""){
          $urlToImg = $s3->uploadPic($_FILES["fileToUpload"]["tmp_name"], $username );
        }

        if($_POST['name'] == "" || $_POST['bio'] == ""){
          echo "Bio and name can't be left empty\n";
        } else {
          $profile->editProfile($_POST['name'], $_GET['username'], $urlToImg, $_POST['bio']);
          echo " succefully edited";
        }


      }


    ?>


    <form action="edit-profile.php?username=<? echo $_GET['username']; ?>" method="post" enctype="multipart/form-data">
      First name:
      <input type="text" name="name" id="name">
      <br>

      <textarea name="bio" id="bio" rows="4" cols="50">Enter your bio here..</textarea>
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
