
<?
  session_start();

  if( !(isset($_SESSION['username'])) ){
    header("Location: login.php");
    die();
  }


  include ("classes/s3-service.php");
  include ("classes/profiles.php");
 ?>

<!DOCTYPE html>
<html>
  <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>

    <?php
      $s3 = new S3();
      $profiles = new profiles();


      if(isset($_GET['username'])){
        $username = $_GET['username'];
        $profile = $profiles->getProfile($username);
        //if username was not found send to 404 page
        if($profile == NULL){
          header("Location: 404notfound.php");
          die();
        }

        if($_GET['username'] != $_SESSION['username']){
          echo "<h1> Access denied </h1>\n";
          die();
        }

      } else {
        header("Location: 404notfound.php");
        die();
      }





      if(isset($_POST['submit'])){

        $urlToImg = " ";

        if($_FILES["fileToUpload"]["tmp_name"]  != ""){
          $urlToImg = $s3->uploadPic($_FILES["fileToUpload"]["tmp_name"], $username );
        }

        if($_POST['name'] == "" || $_POST['bio'] == ""){
          echo "Bio and name can't be left empty\n";
        } else {
          $profiles->editProfile($_POST['name'], $_GET['username'], $urlToImg, $_POST['bio']);
          echo " succefully edited";
        }
        $username = $_GET['username'];
        $profile = $profiles->getProfile($username);




      }


    ?>

    
    <h1>Edit profile</h1>
    <p>Click to edit the following: </p>



    <form action="edit-profile.php?username=<? echo $_GET['username']; ?>" method="post" enctype="multipart/form-data">
      <img src="<?=$profile['img']['S']?>">
      <br>

      First name:
      <input type="text" name="name" id="name" value="<?=$profile['profileName']['S']?>">
      <br>

      <textarea name="bio" id="bio" rows="4" cols="50"><?=$profile['bio']['S']?></textarea>
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
