<!DOCTYPE html>
<html>
  <?php
include 'head.php';
?>
  <body>
  <?php
include 'menu.php';
?>
    <div class='container p-5'>
  <?
include 'post_preview.php';
for ($i = 0; $i < 5; $i++) {
    echo_post_preview("Post " . $i, "Post content #" . $i);
}
?>
    </div>
  </body>
</html>
