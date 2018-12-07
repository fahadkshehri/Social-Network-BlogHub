<?php
function echo_post_preview($title, $content)
{
    ?>
    <div class='jumbotron border border-dark'>
      <h1 class='display-4'><?=$title ?></h1>
      <p><?=$content ?></p>
      <a class='btn btn-primary btn-dark' href='#'>Read more</a>
    </div>
  <?php
}
?>
