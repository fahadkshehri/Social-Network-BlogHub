<?
  include ("classes/s3-service.php");
  include ("classes/posts.php");
?>

<!DOCTYPE html>
<html>
  <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>
    <h1>Add post</h1>
    <p>Complete the following data to add post:</p>


    <?php
      $s3 = new S3();

      if(isset($_POST['submit'])){
        $urlToImg = $s3->uploadPostPic($_FILES["fileToUpload"]["tmp_name"], $username );
        $posts = new Posts();
        $posts->addPost($_POST['postTitle'], 1, $_POST['content'], $urlToImg);
        echo " succefully added post";
      }


    ?>


    <form action="add-post.php" method="post" enctype="multipart/form-data">

      Enter Post title:
      <input type="text" name="postTitle" id="postTitle">
      <br>

      Enter Post text:
      <textarea name="content" id="content" rows="4" cols="50"></textarea>
      <br>

      Select post image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <br>

      <input type="submit" value="Add post" name="submit">
      <br>

    </form>



    <a href='./'>Back to Home</a>

  </body>
</html>
