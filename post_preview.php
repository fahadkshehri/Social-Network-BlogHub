<?php
function echo_post_preview($title, $owner, $content)
{
    ?>
    <div class='jumbotron border border-dark'>
      <h1 class='display-4'><?=$title ?></h1>
      <p><em>By <?=$owner?></em></p>
      <p><?=$content ?></p>
      <a class='btn btn-primary btn-dark' href='#'>Read more</a>
    </div>
  <?php
}
?>
