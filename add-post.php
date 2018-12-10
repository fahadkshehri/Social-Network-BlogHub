<?
  session_start();

  include ("classes/s3-service.php");
  include ("classes/posts.php");

  if( !(isset($_SESSION['username'])) ){
    header("Location: login.php");
    die();
  }



?>

<!DOCTYPE html>
<html>
  <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>

    <?php
      $s3 = new S3();
      if(isset($_POST['submit'])){

        if($_FILES["fileToUpload"]["tmp_name"]  != ""){
          $imageFileType = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
          $urlToImg = $s3->uploadPic($_FILES["fileToUpload"]["tmp_name"], $imageFileType, $username);
        }


        $posts = new Posts();
        $posts->addPost($_POST['postTitle'], $_SESSION['id'], $_POST['content'], $urlToImg);
        echo "<div class='message'>succefully added post</div>";
        //send to post page
      }


    ?>

    <div class="wrapper">
      <h1>Add post</h1>
      <p>Complete the following data to add post:</p>
      <br>


      <form action="add-post.php" method="post" enctype="multipart/form-data">

        <label for="postTitle">Enter Post title:</label>
        <input class="form" type="text" name="postTitle" id="postTitle">

        <label for="content">Enter Post text:</label>
        <textarea name="content" id="content" rows="4" cols="50"></textarea>

        <label for="fileToUpload">Select post image to upload:</label>
        <input type="file" name="fileToUpload" accept="image/*" id="fileToUpload">

        <input type="submit" value="Add post" name="submit">

      </form>

    </div>

  </body>
</html>
