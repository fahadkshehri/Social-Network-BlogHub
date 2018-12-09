<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>

    <a href="add-post.php"></a>

    <div class='container p-5'>
      <?
        include 'classes/posts.php';
        include 'post_preview.php';

        $posts = getAllPosts();

        foreach ($posts as $post) {
          echo_post_preview($post['title'], $post['username'], $post['content']);
        }
?>
    </div>

  </body>
</html>
