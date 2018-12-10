<?php
include 'classes/posts.php';

session_start();
$posts = new Posts();

if(isset($_GET['id'])){
  $post = $posts->getPost($_GET['id']);
}else {
  }

?>
<!DOCTYPE html>
<html>
  <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>

    <div class='container p-5'>
      <?
        if( isset($_SESSION['username']) ){
          if($_SESSION['username'] == $post['username']){
            ?>
            <a href="delete-post.php?id=<?=$_GET['id']?>">delete post</a>
            <a href="edit-post.php?id=<?=$_GET['id']?>">edit post</a>
            <?
          }
        }

      ?>

      <img src="https://s3-us-west-2.amazonaws.com/bloghub-profilepics/<?=$post['img_url']?>">


      <h2><?=$post['title']?></h2>
      <h4><?=$post['username']?></h4>
      <p><?=$post['content']?></P>
    </div>

  </body>
</html>
