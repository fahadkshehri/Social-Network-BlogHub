
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

        $urlToImg = $profile['img']['S'];

        if($_POST['name'] == "" || $_POST['bio'] == ""){

          echo "Bio and name can't be left empty\n";

        } else {

          if($_FILES["fileToUpload"]["tmp_name"]  != ""){


            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
              $s3->deletePic($profile['img']['S']);
              $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
              $urlToImg = $s3->uploadPic($_FILES["fileToUpload"]["tmp_name"], $imageFileType, $username);
              $profiles->editProfile($_POST['name'], $_GET['username'], $urlToImg, $_POST['bio']);
              echo " succefully edited";
            } else {
              echo "Invalid file type: you can upload pictures only";
            }

          }


        }

        $username = $_GET['username'];
        $profile = $profiles->getProfile($username);

      }


    ?>


    <h1>Edit profile</h1>
    <p>Click to edit the following: </p>



    <form action="edit-profile.php?username=<? echo $_GET['username']; ?>" method="post" enctype="multipart/form-data">
      <img src="https://s3-us-west-2.amazonaws.com/bloghub-bucket/<?=$profile['img']['S']?>">
      <br>

      First name:
      <input type="text" name="name" id="name" value="<?=$profile['profileName']['S']?>">
      <br>

      <textarea name="bio" id="bio" rows="4" cols="50"><?=$profile['bio']['S']?></textarea>
      <br>

      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <br>

      <input type="submit" accept="image/*" value="Upload Image" name="submit">
      <br>

    </form>



    <a href='./'>Back to Home</a>

  </body>
</html>
