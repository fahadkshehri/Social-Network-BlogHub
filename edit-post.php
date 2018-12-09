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
      $posts = new Posts();

      if( isset($_GET['id']) ){
        $postID = $_GET['id'];
        $currentPost = $posts->getPost($postID);
      }

      $s3 = new S3();

      if(isset($_POST['submit'])){

        $urlToImg = $currentPost['img_url'];

        if($_FILES["fileToUpload"]["tmp_name"]  != ""){
          $urlToImg = $s3->uploadPic($_FILES["fileToUpload"]["tmp_name"], $username );
        }

        $posts->editPost($postID, $_POST['postTitle'], $urlToImg, $_POST['content']);
        echo " succefully edited post";

        $postID = $_GET['id'];
        $currentPost = $posts->getPost($postID);

      }



    ?>


    <form action="edit-post.php?id=<? echo $postID; ?>" method="post" enctype="multipart/form-data">

      Enter Post title:
      <input type="text" name="postTitle" id="postTitle" value="<? echo $currentPost['title']; ?>">
      <br>

      Enter Post text:
      <textarea name="content" id="content" rows="4" cols="50"><? echo $currentPost['content']; ?></textarea>
      <br>

      <img width="100" src="<? echo $currentPost['img_url']; ?>" alt>
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
